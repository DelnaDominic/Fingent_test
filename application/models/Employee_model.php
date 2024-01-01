<?php
class Employee_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    //insert 
    public function insert($data){
        $this->db->where('employee_code', $data['employee_code']);
        $query = $this->db->get('tbl_employees');
        if ($query->num_rows() > 0) {
            return false;
        }else{
        	$result = $this->db->insert('tbl_employees', $data);
        	return $this->db->insert_id();
        }
    }
    public function get_employees($limit,$start){
        $this->db->select('*');
        $this->db->limit($limit,$start);
        $this->db->from('tbl_employees');
        $query = $this->db->get();
        return $result = $query->result_array();
    }
    public function employee_count() {
        $this->db->select('*');
        $this->db->from('tbl_employees');
        return $this->db->count_all_results();
    }
}