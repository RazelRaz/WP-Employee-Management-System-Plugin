<!DOCTYPE html>
<html lang="en">
<head>
  <title>List Employee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
</head>
<body>

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

          <tr>
            <td>1</td>
            <td>John Doe</td>
            <td>john@example.com</td>
            <td>4569867543</td>
            <td>Male</td>
            <td>Web Developer</td>
            <td>
              <a href="" class="btn btn-warning">Edit</a>
              <a href="" class="btn btn-danger">Delete</a>
              <a href="" class="btn btn-info">View</a>
            </td>
          </tr>
          
        </tbody>
      </table>
    </div>
  </div>         
</div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      // list employee data table
      new DataTable('#tbl-employee');
    });
  </script>
</body>
</html>
