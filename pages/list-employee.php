<?php 
  global $wpdb;
  $employees = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ems_system", ARRAY_A );
  echo '<pre>';
  print_r($employees);
  echo '</pre>';
?>

<div class="container">
  <h2>List Employee</h2>
  <p>Employee data table list.</p>
  <div class="panel panel-primary">
      <div class="panel-heading">Employee List</div>
      <div class="panel-body">
      <table class="table" id="tbl-employee">
        <thead>
          <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>PHONE</th>
            <th>GENDER</th>
            <th>DESIGNATION</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>

          <?php 

            if( count($employees) > 0 ) {
              foreach ( $employees as $employee ) {
                ?>
                  <tr>
                    <td><?php echo $employee['id'] ?></td>
                    <td><?php echo $employee['name'] ?></td>
                    <td><?php echo $employee['email'] ?></td>
                    <td><?php echo $employee['email'] ?></td>
                    <td><?php echo ucfirst($employee['gender']) ?></td>
                    <td><?php echo $employee['designation'] ?></td>
                    <td>
                      <a href="admin.php?page=employee-system&action=edit&empId=<?php echo $employee['id'] ?>" class="btn btn-warning">Edit</a>
                      <a href="admin.php?page=list-employee&action=delete&empId=<?php echo $employee['id'] ?>" class="btn btn-danger">Delete</a>
                      <a href="admin.php?page=employee-system&action=view&empId=<?php echo $employee['id'] ?>" class="btn btn-info">View</a>
                    </td>
                  </tr>
                <?php
              }
            }else {
              echo 'No Employees Found';
            }

          ?>

        </tbody>
      </table>
    </div>
  </div>         
</div>



