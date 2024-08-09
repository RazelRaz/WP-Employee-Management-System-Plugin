<?php 
    $message = '';
    $status  = '';

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
?>

<div class="container">
  <h2>Add Employee</h2>
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

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=employee-system" method="post" id="ems-frm-add-employee">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" required class="form-control" id="name" placeholder="Enter Name" name="name">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" required class="form-control" id="email" placeholder="Enter email" name="email">
            </div>

            <div class="form-group">
                <label for="phoneNo">Phone:</label>
                <input type="number" required class="form-control" id="phoneNo" placeholder="Enter Phone Number" name="phoneNo">
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" required class="form-control" id="designation" placeholder="Enter Designation" name="designation">
            </div>



            <button type="submit" class="btn btn-success" name="btn_submit">Submit</button>
        </form>
    </div>
  </div>
</div>

