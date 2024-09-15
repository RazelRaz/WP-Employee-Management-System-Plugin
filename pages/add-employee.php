<?php 
    $message = '';
    $status  = '';
    // for view
    $action = '';
    $empId = '';

    // find request for view & edit
    if( isset($_GET['action']) && isset($_GET['empId']) ) {

        global $wpdb;
        $empId = $_GET['empId'];

        // action: edit
        if( $_GET['action'] == 'edit' ) {
            $action = 'edit';

        }

        // action: view
        if( $_GET['action'] == 'view' ) {
            $action = 'view';

        }

        // single employee information
        $employee = $wpdb->get_row(
            $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ems_system WHERE id = %d", $empId ), ARRAY_A
        );

        // echo '<pre>';
        // print_r($employee);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($employee['gender']);
        // echo '</pre>';
    }

    // save form data
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_submit'])) {
        // form submitted
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        global $wpdb;
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_text_field($_POST['email']);
        $phoneNo = sanitize_text_field($_POST['phoneNo']);
        $gender = sanitize_text_field($_POST['gender']);
        $designation = sanitize_text_field($_POST['designation']);


        // action type
        if ( isset( $_GET['action'] ) ) {

            $empId = $_GET['empId'];

            // edit operation
            $wpdb->update("{$wpdb->prefix}ems_system",
                array(
                    'name' => $name,
                    'email' => $email,
                    'phoneNo' => $phoneNo,
                    'gender' => $gender,
                    'designation' => $designation,
                ), array (
                    "id" => $empId
                )
            );

            $message = 'Employee Updated successfully';
            $status = 1;

        } else {
            // add operation
            // insert command
            $wpdb->insert("{$wpdb->prefix}ems_system",
                array(
                    'name' => $name,
                    'email' => $email,
                    'phoneNo' => $phoneNo,
                    'gender' => $gender,
                    'designation' => $designation,
                ),
            );

            $last_inserted_id = $wpdb->insert_id;
            if ($last_inserted_id > 0) {
                $message = 'Employee saved successfully';
                $status = 1;
            } else {
                $message = 'Failed to save an employee';
                $status = 0;
            }
        } 
    }
?>

<div class="container">
  <?php 
    if( $action == 'view' ) {
        echo "<h2>View Employee</h2>";
    } else if ( $action == 'edit' ) {
        echo "<h2>Update Employee</h2>";
    }
    else {
        echo "<h2>Add Employee</h2>";
    }
  ?>
  
  
  <div class="panel panel-primary">
    <div class="panel-heading">Add Employee Here</div>
    <div class="panel-body">

        <?php 
            if(!empty($message)) {

                if($status == 1) {
                    ?>
                        <div class="alert alert-success">
                            <?php echo $message; ?>
                        </div>
                    <?php
                } else {
                    ?>
                        <div class="alert alert-danger">
                            <?php echo $message; ?>
                        </div>
                    <?php
                }

            } else {

            }
        ?>

        <form 
        action = '<?php 
            if ( $action == 'edit' ) {
                echo 'admin.php?page=employee-system&action=edit&empId='.$empId ;
            } else {
                echo 'admin.php?page=employee-system';
            }
        ?>'
         method="post" id="ems-frm-add-employee">

            <div class="form-group">
                <label for="name">Name</label>

                <input type="text" value="<?php if( $action == 'view' || $action == 'edit' ) { echo $employee['name']; } ?>" 
                required 
                <?php if( $action == 'view' ) { echo "readonly='readonly'"; } ?>
                class="form-control" id="name" placeholder="Enter Name" name="name">


            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" value="<?php if( $action == 'view' || $action == 'edit' ) { echo $employee['email']; } ?>" 
                required
                <?php if( $action == 'view' ) { echo "readonly='readonly'"; } ?>
                class="form-control" id="email" placeholder="Enter email" name="email">
            </div>

            <div class="form-group">
                <label for="phoneNo">Phone:</label>
                <input type="number" value="<?php if( $action == 'view' || $action == 'edit' ) { echo $employee['phoneNo']; } ?>" 
                required 
                <?php if( $action == 'view' ) { echo "readonly='readonly'"; } ?>
                class="form-control" id="phoneNo" placeholder="Enter Phone Number" name="phoneNo">
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" <?php if( $action == "view") {echo "disabled";} ?> id="gender" class="form-control">
                <option value="">Select Gender</option>
                    
                    <option value="male"
                    <?php if( ( $action == 'view' || $action == 'edit' ) && $employee['gender'] == "Male" ) { echo "selected"; } ?>
                    >Male</option>



                    <option value="female"
                    <?php if( ( $action == 'view' || $action == 'edit' ) && $employee['gender'] == "Female" ) { echo "selected"; } ?>
                    >Female</option>
                    <option value="other"
                    <?php if( ( $action == 'view' || $action == 'edit' ) && $employee['gender'] == "Other" ) { echo "selected"; } ?>
                    >Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" value="<?php if( $action == 'view' || $action == 'edit' ) { echo $employee['designation']; } ?>" required 
                <?php if( $action == 'view' ) { echo "readonly='readonly'"; } ?>
                class="form-control" id="designation" placeholder="Enter Designation" name="designation">
            </div>


            <?php 
                if( $action == 'view' ) {
                    // no button
                } else if ( $action == 'edit' ) {
                    ?>
                        <button type="submit" class="btn btn-success" name="btn_submit">Update Info</button>
                    <?php
                }
                
                else {
                    ?>
                        <button type="submit" class="btn btn-success" name="btn_submit">Submit</button>
                    <?php
                }
            ?>

            
        </form>
    </div>
  </div>
</div>

