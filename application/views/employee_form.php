<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Employee add" />
  <meta name="keywords" content="Add Employee" />
  <title>Add Employee</title>
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>

<body> 
  <div class="center-container">
    <div class="main">
      <h1 class="w3layouts_head">Upload CSV</h1>
      <div class="w3layouts_main_grid">
        <?php
        $attributes = array('id' => 'myform','enctype' => 'multipart/form-data');
        echo form_open('employees/add_employee', $attributes);
        ?>
        <div class="w3_agileits_main_grid w3l_main_grid">
          <span class="agileits_grid">
            <label>Enter the column corresponding to Name</label>
            <input type="text" name="u_name" id="u_name" placeholder="Enter the column corresponding to Name" value="<?php echo set_value('u_name'); ?>"/>
          </span>
          <h5 style="color: #ff0000;"><?php echo form_error('u_name'); ?></h5>
        </div>
        <div class="w3_agileits_main_grid w3l_main_grid">
          <span class="agileits_grid">
            <label>Enter the column corresponding to Employee code</label>
            <input type="text" name="u_employee_code" id="u_employee_code" placeholder="Enter the column corresponding to Employee code" value="<?php echo set_value('u_employee_code'); ?>"/>
            <h5 style="color: #ff0000;"><?php echo form_error('u_employee_code'); ?></h5>
          </span>
        </div> 
        <div class="w3_agileits_main_grid w3l_main_grid">
          <span class="agileits_grid">
            <label>Enter the column corresponding to Department</label>
            <input type="text" name="u_department" id="u_department" placeholder="Enter the column corresponding to Department" value="<?php echo set_value('u_department'); ?>"/>
            <h5 style="color: #ff0000;"><?php echo form_error('u_department'); ?></h5>
          </span>
        </div> 
        <div class="w3_agileits_main_grid w3l_main_grid">
          <span class="agileits_grid">
            <label>Enter the column corresponding to Date of Birth (date should be in dd-mm-yyyy format)</label>
            <input type="text" name="u_dob" id="u_dob" placeholder="Enter the column corresponding to Date of Birth" value="<?php echo set_value('u_dob'); ?>"/>
            <h5 style="color: #ff0000;"><?php echo form_error('u_dob'); ?></h5>
          </span>
        </div> 
        <div class="w3_agileits_main_grid w3l_main_grid">
          <span class="agileits_grid">
            <label>Enter the column corresponding to Joining Date(date should be in dd-mm-yyyy format)</label>
            <input type="text" name="u_joining_date" id="u_joining_date" placeholder="Enter the column corresponding to Joining Date" value="<?php echo set_value('u_joining_date'); ?>"/>
            <h5 style="color: #ff0000;"><?php echo form_error('u_joining_date'); ?></h5>
          </span>
        </div> 
        <div class="w3_agileits_main_grid w3l_main_grid">
          <span class="agileits_grid">
            <label>Upload CSV</label>
            <input type="file" name="u_csv" id="u_csv"/>
            <h5 style="color: #ff0000;"><?php echo form_error('u_csv'); ?></h5>
          </span>
        </div> 
        <div class="btn-group">
          <button type="submit" name="submit" id="submit" class="button button1">Proceed</button>
        </div>
      </div>
    </div>
    <?php echo form_close();?>
  </div>

  <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
  <script>

    jQuery.validator.setDefaults({
      success: "valid"
    });

    $( "#myform" ).validate({
      ignore: "",
      rules: {
        u_name: "required",
        u_employee_code:{
          required: true
        },
        u_department: {
          required: true
        },
        u_dob: {
          required: true
        },
        u_joining_date: {
          required: true
        },
        u_csv: {
          required: true,
          extension: "csv"
        }
      },
      messages:{
        u_name: {
          required:'Please enter the column corresponding to Name'
        },
        u_employee_code: {
          required:'Please enter the column corresponding to Employee code'
        },
        u_department: {
          required:'Please enter the column corresponding to Department'
        },
        u_dob: {
          required:'Please enter the column corresponding to Date of Birth'
        },
        u_joining_date: {
          required:'Please enter the column corresponding to Joining Date'
        },
        u_csv: {
          required:'Please upload csv',
          extension:'Please upload valid CSV file'
        }
      }
    });
</script>

</body>
</html>