<!DOCTYPE html>
<html>
<head>
  <title>Employee list</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
<!--   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 -->  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/employee_list.css">
</head>
<body>
  <div class="container">
    <h1>Employees List<br></h1>
    <h5>Total employees:<?php echo $total_count;?></h5> 
  <a href="<?php echo base_url(); ?>employee_controller/add" target="_blank"><input id="btn_add" name="btn_add" type="button" class="btn btn-default" value="Add Employees" /></a>
    <table class="data_table">
     <thead class="data_table">
      <tr class="data_table">
        <th class="data_table">ID</th>
        <th class="data_table">Name</th>
        <th class="data_table">Email</th>
        <th class="data_table">Gender</th>
        <th class="data_table">Mobile number</th>    
      </tr>
    </thead>
    <tbody>
     <?php foreach ($employees as $employee) {
      ?>
      <tr class="data_table">
        <td class="data_table"><?php echo $result1['u_id']; ?></td>
        <td class="data_table"><?php echo $result1['u_name']; ?></td>
        <td class="data_table"><?php echo $result1['u_email']; ?></td>
        <td class="data_table"><?php echo $result1['u_gender']; ?></td>
        <td class="data_table"><?php echo $result1['u_mobile']; ?></td>
      </tr>
      <?php
    }
    ?>
  </tbody>
</table>
<div id="pagination">
  <ul class="tsc_pagination">

    <!-- Show pagination links -->
    <?php foreach ($links as $link) {
      echo "  ". $link."  ";
    } ?>
  </div>
</div>
</body>


</html>