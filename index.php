<?php
$insert=false;
$server="localhost";
$username="root";
$password="";
$database="notes2";
$conn=mysqli_connect($server,$username,$password,$database);
if(!$conn){
  die("your connection with database failed");
}
if($_SERVER['REQUEST_METHOD']=='POST'){
  $title = $_POST["title"] ?? "";
  $desc = $_POST["desc"] ?? "";

  $sql= "INSERT INTO `table` (`title`, `desc`, `timestamp`) VALUES ('$title', '$desc', current_timestamp())";
  

  $result = mysqli_query($conn,$sql);
  if($result){
   $insert=true;
  }else{
    echo "The record has not been inserted successfully<br>".mysqli_error();
  }
}
$sql = "ALTER TABLE `table` AUTO_INCREMENT = 1";
$result=mysqli_query($conn, $sql);



?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <title>CRUD WEBSITE</title>
  </head>
  <style>
    .edit{
      color: black;
    }
    .delete{
      color: black;
    }
  </style>
  <body>
    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
 Edit Modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit NOtes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/crud/index.php" method="post">
        <div class="form-group">     
          <label for="title">Note Title</label>
          <input type="text" class="form-control" name="titleEdit" id="titleEdit" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="desc">Note Description</label>
            <textarea class="form-control" id="descEdit" name="descEdit" rows="3"></textarea>
          </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Satyamnotes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
      <?php

      if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Holy Success!</strong> Your note has been inserted successfully.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
      }
      ?>
      <div class="container my-5">
      <h1>Add a Note</h1>
      <form action="/crud/index.php" method="post">
        <div class="form-group">     
          <label for="title">Note Title</label>
          <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="desc">Note Description</label>
            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
          </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
      </form>
      </div>
      <div class="container my-5">
<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>

  </thead>
  <tbody>
    <hr>
  <?php
$sql="SELECT * FROM `table`";
$result=mysqli_query($conn,$sql);
$sno=0;
while($row=mysqli_fetch_assoc($result)){
  $sno=$sno+1;
  echo "<tr>
  <th scope='row'>".$sno."</th>
  <td>".$row['title']."</td>
  <td>".$row['desc']."</td>
  <td><button type='button' class='edit btn btn-primary'>Edit</button>
  <button type='button' class='delete btn btn-primary'>Delete</button>
  </td>
</tr>";
}
?>
  </tbody>
</table>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
} );let table = new DataTable('#myTable');
</script>
<script>
  edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        desc = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, desc);
        titleEdit.value = title;
        descEdit.value = Desc;
        $('#editModal').modal('toggle');
      })
    })

</script>
  </body>
</html>
