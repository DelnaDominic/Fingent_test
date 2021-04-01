 <?php
class Employees extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->library('pagination');   
    $this->load->model('employee_model');
  }
  public function index()
  {
    $config = array();
    $config["base_url"] = base_url() . "employees/index";
    $total_row = $this->employee_model->employee_count();
    $config["total_rows"] = $total_row;
    $config["per_page"] = 50;
    $config['use_page_numbers'] = TRUE;
    $config['num_links'] = $total_row;
    $config['cur_tag_open'] = '&nbsp;<a class="current">';
    $config['cur_tag_close'] = '</a>';
    $config['next_link'] = 'Next';
    $config['prev_link'] = 'Previous';
    $this->pagination->initialize($config);
    if($this->uri->segment(3)){
    $page = ($this->uri->segment(3)) ;
    }
    else{
    $page = 1;
    }
    $start_from = ($page-1) * $config["per_page"];
    $data['employees'] = $this->employee_model->get_employees($config["per_page"], $start_from);
    foreach ($data['employees'] as &$key) {
        $today = date("Y-m-d");
        $birthday = date("Y-m-d", strtotime($key['dob']));
        $age = date_diff(date_create($today), date_create($birthday));
        $key['age'] = $age->y.' years '.$age->m.' months '.$age->d.' days ';
        $joining_date = date("Y-m-d", strtotime($key['joining_date']));
        $experience = date_diff(date_create($today), date_create($joining_date));
        $key['experience'] = $experience->y.' years '.$experience->m.' months '.$experience->d.' days ';
    }
    $str_links = $this->pagination->create_links();
    $data["links"] = explode('&nbsp;',$str_links );
    $data['total_count'] = $total_row;
    $this->load->view("employees_list", $data);
  }  
  public function add(){
    $this->load->view("employee_form");
  }
  public function add_employee(){
    $data = array(
      'u_name' => $this->input->post('u_name'),
      'u_employee_code' => $this->input->post('u_employee_code'),
      'u_department' => $this->input->post('u_department'),
      'u_dob' => $this->input->post('u_dob'),
      'u_joining_date' => $this->input->post('u_joining_date')
    );

    $this->form_validation->set_rules('u_name', 'Username', 'required');
    $this->form_validation->set_rules('u_employee_code', 'Employee code', 'required');
    $this->form_validation->set_rules('u_department', 'Department', 'required');
    $this->form_validation->set_rules('u_dob', 'Date of Birth', 'required');
    $this->form_validation->set_rules('u_joining_date', 'Joining Date', 'required');
    if ($this->form_validation->run() == FALSE)
    {
        $this->load->view("employee_form",$data);
    }
    else{
        $this->load->library('csvimport');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '1000';
 
        $this->load->library('upload', $config);
 
        // If upload failed, display error
        if (!$this->upload->do_upload('u_csv')) {
            $data['error'] = $this->upload->display_errors();
 
            echo $data['error'];
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                if(count($csv_array)>20){
                    echo "<script>alert('Employee count exeeeded 20. Please upload another csv file with rows less than 20');
                    window.location.href='add';</script>";
                }
                $key = array_keys($csv_array[0]);
                if ((in_array($data['u_name'], $key))&&(in_array($data['u_employee_code'], $key))&&(in_array($data['u_department'], $key))&&(in_array($data['u_dob'], $key))&&(in_array($data['u_joining_date'], $key))) {
                    $employee_names = '';
                    foreach ($csv_array as $row) {
                        $insert_data = array(
                            'employee_id'=>'',
                            'employee_code'=>$row[$data['u_employee_code']],
                            'employee_name'=>$row[$data['u_name']],
                            'department'=>$row[$data['u_department']],
                            'dob'=>$row[$data['u_dob']],
                            'joining_date'=>$row[$data['u_joining_date']],
                        );
                        $id = $this->employee_model->insert($insert_data);
                        if($id==false){
                            $employee_names .= $insert_data['employee_name'].', ';
                        }else{
                        }
                    }
                    if($employee_names==''){
                        echo "<script>alert('Employees added successfully');
                        window.location.href='index';</script>";
                    }else{
                        echo "<script>alert('The following employees are already registered on our system ".$employee_names."');window.location.href='index'</script>"; 
                    }
                }else{
                    echo "<script>alert('Please upload a valid csv.');
                    window.location.href='add';</script>";
                }

            }else{
                echo "<script>alert('Please upload a valid csv.');
                window.location.href='add';</script>";
            }
        }
    }
  }
}