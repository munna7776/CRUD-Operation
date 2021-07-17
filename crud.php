<?php
    $insert = false;
    $update = false;
    $delete = false;
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "crud";

    $conn = mysqli_connect($server,$username,$password,$db);
    if(!$conn)
    {
      die("<h1>Not Connected</h1>".mysqli_connect_error());
    }
    if(isset($_GET['delete']))
    {
      $sno = $_GET['delete'];
      // echo $sno;
      $sql = "DELETE FROM `crud_details` WHERE `crud_details`.`S.No.` = $sno";
      $result = mysqli_query($conn,$sql);
      if($result)
      {
        $delete = true;
      }
    }
    if($_SERVER['REQUEST_METHOD']=="POST"){
      if(isset($_POST['snoEdit'])){
        $sno = $_POST['snoEdit'];
        $title=$_POST['titleEdit'];
        $describe = $_POST['describeEdit'];
        $sql = "UPDATE `crud_details` SET `title` = '$title', `description` = '$describe' WHERE `crud_details`.`S.No.` = $sno";
        $result = mysqli_query($conn,$sql);
        if($result)
        {
          $update = true;
        }
      }
      else{

        $title = $_POST['title'];
        $description = $_POST['describe'];
        $sql = "INSERT INTO `crud_details` (`title`, `description`) VALUES ('$title','$description')";
        $result = mysqli_query($conn,$sql);
        if($result)
        {
          $insert = true;
        }
        else{
          echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
        }
      }
    }


?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <title>CRUD Project</title>
  </head>
  <body>
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Launch demo modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="/munna/crud1/crud.php" method = "POST">
              <input type="hidden" name="snoEdit" id="snoEdit">
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="titlehelp">
              </div>
              <div class="form-group">
                  <label for="describe">Description</label>
                  <textarea class="form-control" id="describeEdit" name="describeEdit" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/munna/crud1/index.php"><img src="logo.png" alt="...." height="30px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="/munna/crud1/index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Contact Us</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="/munna/crud1/crud.php">CRUD</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="color: rgb(235, 223, 238);">Search</button>
              </form>
            </div>
          </nav>
    </header>
    <?php 
      if($insert)
      {
        echo "<div class='alert alert-success alert-dismissible fade show my-1' role='alert'>
        <strong>Successfully!</strong> Your note has been inserted.
        <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
      }
      if($update)
      {
        echo "<div class='alert alert-success alert-dismissible fade show my-1' role='alert'>
        <strong>Successfully!</strong> Your note has been updated.
        <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
      }
      if($delete)
      {
        echo "<div class='alert alert-danger alert-dismissible fade show my-1' role='alert'>
        <strong>Successfully!</strong> Your note has been deleted.
        <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
      }
    ?>
    <div class="container mt-4">
        <div class="d-flex justify-content-center">
            <img src="mynotes.png" height="50px" class="align-self-center mr-3" alt="...">
              <h3 class="mt-0">Add a note</h3>
          </div>
          <form action="/munna/crud1/crud.php" method = "POST">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="titlehelp">
            </div>
            <div class="form-group">
                <label for="describe">Description</label>
                <textarea class="form-control" id="describe" name="describe" rows="3"></textarea>
              </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>

    <div class="container mt-4">
      <table class="table " id="myTable">
        <thead class="thead-dark">
          <tr>
            <th scope="col">S.No.</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sql = "SELECT * FROM `crud_details`";
            $result = mysqli_query($conn,$sql);
            $sno = 0;
            while($row = mysqli_fetch_assoc($result))
            {
              $sno = $sno+1;
              echo "<tr>
              <th scope='row'>".$sno."</th>
              <td>".$row['title']."</td>
              <td>".$row['description']."</td>
              <td class='ml-auto justify-self-center d-flex'><button class='edit btn btn-md btn-primary mx-1' id=".$row['S.No.']." style='width: 72px;'>Edit</button>
              <button class='delete btn btn-md btn-primary mx-1' id= delete_".$row['S.No.'].">Delete</button></td>
            </tr>";
            }
          ?>
        </tbody>
      </table>
      <hr>
      <footer class="d-flex justify-content-center mb-4">
        <a href="https://facebook.com"><i class="bi bi-facebook" style="margin-left: 10px;font-size: 2rem; color: rgb(3, 48, 129);"></i></a>
        <a href="https://google.com"><i class="bi bi-google" style="margin-left: 10px;font-size: 2rem; color: rgb(80, 133, 230);"></i></a>
        <a href="https://twitter.com"><i class="bi bi-twitter" style="margin-left: 10px;font-size: 2rem; color: rgb(25, 116, 201);"></i></a>
        <a href="https://youtube.com"><i class="bi bi-youtube" style="margin-left: 10px;font-size: 2rem; color: rgb(207, 7, 7);"></i></a>
        <a href="https://linkedin.com"><i class="bi bi-linkedin" style="margin-left: 10px;font-size: 2rem; color: rgb(19, 87, 212);"></i></a>
      </footer>
      
      
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#myTable').DataTable();
      });
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
    <script>
        let edits = document.getElementsByClassName("edit");
        Array.from(edits).forEach(element => {
          element.addEventListener("click",(e)=>{
            tr = e.target.parentNode.parentNode;
            title =  tr.getElementsByTagName("td")[0].innerText;
            desc = tr.getElementsByTagName("td")[1].innerText;
            titleEdit.value = title;
            describeEdit.value = desc;
            snoEdit.value = e.target.id;
            $('#editModal').modal('toggle')
          })
        });

        let deletes = document.getElementsByClassName("delete");
        Array.from(deletes).forEach(element => {
          element.addEventListener("click",(e)=>{
            sno = e.target.id.substr(7,);
            if(confirm("Are you sure want to delete?"))
            {
              window.location = `/munna/crud1/crud.php?delete=${sno}`;
              // console.log("yes");
            }
          })
        });
    </script>
  </body>
</html>