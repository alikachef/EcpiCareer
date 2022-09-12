<?php 
session_start();

if (isset($_SESSION['User'])){
    include "dbConnect.php";
}
else {
   header("Location:login.php?Empty= Please login to access");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--BootStrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link  rel="stylesheet" href="student.css?v=<?php echo time(); ?>" type="text/css">
    <link  rel="stylesheet" href="modal.css?v=<?php echo time(); ?>" type="text/css">


    <title>Ecpi Registery</title>
</head>
<body>
    <img class="ecpiLogo" src="./Assets/ECPI_Online.png"/>
    <nav class="navbar navbar-dark bg-dark">
        <h2 class="p-2 text-white">Feilds Of Study</h2>
        <div>
        <?php
            if($_SESSION['Role'] == "admin"){
                echo '<a href="add_feilds.php"  id="addButton" class="m-2 btn btn-success">Add a Feild</a>';
                echo '<button   id="mybtn" class=" btn btn-primary text-white"><i class="fas fa-user-lock"></i></button>';
            }
        ?>
            <a  class="m-2 btn btn-outline-light" href="logout.php?logout">logout</a>
        </div>
    </nav>
    <div id="usermodal" class="user-modal">
        <div class="modal-content">
            <h1>Users:</h1>
            <div >
                <span class="close-modal">&times;</span>
            </div>
            <p>Some text in the Modal..</p>
        </div>
    </div>  
    <div class="ecpicardscontainer">
    <div class="ecpialert">
        <?php 
            if(isset($_GET['msg'])){
                $msg= $_GET['msg'];
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Success</strong> '.$msg.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        ?>
    </div>
        <div class="ecpicards">
    <?php 
        $sql = "SELECT * FROM `feilds` ";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)){
    ?>
            <div class="card" style="width: 18rem;"> 
                <div class = "imagecontainer">
                    <img class="cardimage card-img-top" src="data:image/png;charset=utf8;base64,<?php echo base64_encode($row['feildImage']); ?>" />
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['feildName'] ?></h5>
                    <p class="carddesc card-text"> <?php echo $row['feildDesc'] ?> </p>
                    <div>
                        <a href="get_students.php?id=<?php echo $row['idfeilds'] ?>" class="btn btn-primary">Students</a>
                        <?php
                            if($_SESSION['Role'] == "admin"){
                                echo '<a href="edit_feilds.php?id=<?php echo '.$row['idfeilds'].' ?>" class="m-2 btn btn-info">Edit</a>';
                                echo '<a href="delete_feilds.php?id=<?php echo ' . $row['idfeilds']. ' ?>" class="btn btn-danger">Delete</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
    <?php
        }
    ?>
        </div>
    </div>
    
    

    <!--BootStrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="index.js?v=<?php echo time(); ?>" ></script>
</body>
</html>