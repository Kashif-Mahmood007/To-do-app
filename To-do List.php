<?php


$server = "localhost";
$username = "root";
$password = "";
$dbname = "notes";

$conn = mysqli_connect($server, $username, $password, $dbname);

if(!$conn){
    die("The connection is established successfully". mysqli_connect_error());
}
else{
    // echo "The connection is established SuccessFully <br>";
}


?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <title>Notes taking App</title>
</head>
<body>

    <!-- Edit Button modal -->
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="container">
            <form action = "project_1_notes.php" method="POST">
                  <input type="hidden" name="snoEdit" id = "snoEdit">
                <div class="form-group">
                  <label for="titleLabel">Title</label>
                  <input type="text" class="form-control" id="titleEdit" name = "titleEdit" placeholder="Enter title">
                </div>
                <div class="form-group">
                  <label for="descLabel">Description</label>
                  <textarea class="form-control" id="descEdit" rows="3" name = "descEdit" placeholder="Enter Description"></textarea>
                </div>
                <button type = "submit" class="btn btn-primary" name = "edit">Update Note</button>
              </form>
        </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Delete Button modal -->
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="container">
              <form action = "project_1_notes.php" method="POST">
                  <input type="hidden" name="snoDelete" id = "snoDelete">
                  <div class="form-group">
                    <label for="titleLabel">Delete this Note??</label>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name = "delete">Delete Note</button>
              </div>
            </form>
            </div>
        </div>
      </div>



    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" href="#">About <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="#">Contact <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder = "Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <?php
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        if(isset($_POST['insert'])){
          $title = mysqli_real_escape_string($conn , $_POST['title']);
          $desc = mysqli_real_escape_string($conn , $_POST['desc']);
          
          $sql = "INSERT INTO `notes` (`title`, `description`, `timestamp`) VALUES ('$title', '$desc', current_timestamp())"; 
          $result = mysqli_query($conn, $sql);
          
          if(!$result){
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Danger!</strong> The Record is not inserted Successfully due to some technical error
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ';
        }
      
        else{
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> The Record is inserted Successfully
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ';
        }
      }    

      elseif(isset($_POST['edit'])){

          $title = mysqli_real_escape_string($conn, $_POST['titleEdit']);
          $desc = mysqli_real_escape_string($conn, $_POST['descEdit']); 
          $sno = mysqli_real_escape_string($conn, $_POST['snoEdit']);

          $sql = "UPDATE `notes`
          SET `title` = '$title' , `description` = '$desc' 
          WHERE `sno` = '$sno'";

          $result = mysqli_query($conn, $sql);

          if(!$result){
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Danger!</strong> The Record is not Updated Successfully due to some technical error
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ';
          }
      
        else{
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> The Record is Updated Successfully
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ';
          }
        }
      
      elseif(isset($_POST['delete'])){
        $snoDel = $_POST['snoDelete'];
        // echo "The serial number is ".$snoDel;

        $sql = "DELETE FROM `notes`
        WHERE `sno` = '$snoDel'";

        $result = mysqli_query($conn, $sql);


        if(!$result){
          echo '
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Danger!</strong> The Record is not Updated Successfully due to some technical error
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>
          ';
        }
    
        else{
          echo '
          <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> The Record is Updated Successfully
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>
          ';
        }
      }
    }
    ?>


    <div class="container">
        <h2 class = "my-4">
            Note Taking App
        </h2>
        <form action = "project_1_notes.php" method="POST">
            <div class="form-group">
              <label for="titleLabel">Title</label>
              <input type="text" class="form-control" id="title" name = "title" placeholder="Enter title">
            </div>
            <div class="form-group">
              <label for="descLabel">Description</label>
              <textarea class="form-control" id="desc" rows="3" name = "desc" placeholder="Enter Description"></textarea>
            </div>
            <button type = "submit" class="btn btn-primary" name = "insert">Add Note</button>
          </form>
    </div>


    <div class="container my-5" >
        <table class="table" id = "myTable">
            <thead>
              <tr>
                <th scope="col">Sno</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
              
              <?php
                $sql = "SELECT * FROM `notes`";
                $result = mysqli_query($conn, $sql);
                $num = 1;
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                      echo "<tr>
                      <th scope='row'>". $num . "</th>
                      <td>".$row['title'] ."</td>
                      <td>".$row['description']. "</td>
                      <td><button class='btn btn-sm btn-primary editButton' id = " .$row['sno']. " name = 'edit'>Edit</button>
                        <button class='btn btn-sm btn-primary deleteButton' id = d" .$row['sno']. " name = 'delete'>Delete</button></td>
                      </tr>";
                      $num++;
                    }
                }
              ?>

          </table>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
    <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
      let table = new DataTable('#myTable');
    </script>

    <script>  

        document.addEventListener("click", (e) => {
          if (e.target.classList.contains("editButton")) {
            let tr = e.target.parentNode.parentNode;
            let title = tr.getElementsByTagName("td")[0].innerText;
            let description = tr.getElementsByTagName("td")[1].innerText;
            let snoEdit = e.target.id;
            // Rest of your edit button click handling code here
            document.getElementById("descEdit").value = description;
            document.getElementById("titleEdit").value = title;
            document.getElementById("snoEdit").value = snoEdit;
            $('#editModal').modal('toggle');
          }
        });


        document.addEventListener("click", (e) => {
          if(e.target.classList.contains("deleteButton")){
            let snoDelete = e.target.id.slice(1);
            console.log(snoDelete);
            document.getElementById("snoDelete").value = snoDelete;
            $('#deleteModal').modal('toggle');
          }
        });



    </script>
</body>

</html>