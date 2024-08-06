
<div class="container">
  <h2>Add Employee</h2>
  <div class="panel panel-primary">
    <div class="panel-heading">Add Employee Here</div>
    <div class="panel-body">
        <form action="javascript:void(0)" method="post" id="ems-frm-add-employee">

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
                <input type="text" required class="form-control" id="designation" placeholder="Enter Name" name="name">
            </div>



            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
  </div>
</div>

