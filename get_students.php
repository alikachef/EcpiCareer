<?php 
session_start();

if (isset($_SESSION['User'])){
    include "dbConnect.php";
}
else {
   header("Location:login.php?Empty= Please login to access");
}
$id = $_GET['id'];


$sql = "SELECT * FROM `students` WHERE feildID = '$id'  ";
$result = mysqli_query($conn, $sql);

function get_file($fileid){
    $sql1 = "SELECT * FROM `students` WHERE feildID = '$id' AND idstudents = '$fileid' ";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    return $row1('studentRes');


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--BootStrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="student.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="modal.css?v=<?php echo time(); ?>" type="text/css">

    <link rel="icon" href="Assets/ecpiseal.png" />
    <title>Ecpi Registery</title>
</head>

<body>
    <img class="ecpiLogo" src="./Assets/ECPI_Online.png" />
    <nav class="navbar navbar-dark bg-dark">
        <h2 class="p-2 text-white"><a href="get_feilds.php"
                class="back">&#8249;</a><?php echo isset( $_GET['fname']) ?  $_GET['fname'] : "" ?> Students</h2>
        <div>
            <?php
                if($_SESSION['Role'] == "admin"){
                    echo '<a href="add_students.php?id='.$id. '"id="addButton" class="m-2 btn btn-success">Add a Student</a>';
                }
            ?>
            <a class="m-2 btn btn-outline-light" href="logout.php?logout">logout</a>
        </div>
    </nav>
    

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
        

        while ($row = mysqli_fetch_assoc($result)){   
    ?>
            <div class="card text-center" style="width: 20rem;">
                <div class="imagecontainer">
                    <img class="cardimageS card-img-top"
                        src="data:image/png;charset=utf8;base64,<?php echo base64_encode($row['studentImage']); ?>" />
                </div>

                <div class="card-body">
                    <h5 class="pt-3 card-title"><?php echo $row['studentName'] ?></h5>
                    <p class="carddescS card-text"> <?php echo $row['StudentDesc'] ?> </p>
                    <p>Degree: <?php echo $row['studentDegree'] ?> </p>
                    <p>Expected Graduation Date : <?php echo $row['studentGrad'] ?></p>
                    <div>
                       <?php // <button id="mybtn" class="btn btn-primary">Contact</button> ?>
                       <button type="button" class="btn btn-primary" onclick="myFunction(this, '<?php  echo base64_encode($row['studentRes']); ?>')" id="mybtn<?php echo $row['idstudents']?>">Contact</button>

                        <?php
                            if($_SESSION['Role'] == "admin"){
                                echo '<a href="edit_student.php?id='.$row['idstudents'].'&idf='.$id.'" class="m-2 btn btn-info">Edit</a>';
                                echo '<a href="delete_student.php?id='.$row['idstudents'].'&idf='.$id.'" class="btn btn-danger">Delete</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div id="usermodal" class="user-modal">
                <div id="content" class="modal-content-r">
                    
                </div>
                
            </div>
            
            <?php
        }
    ?>
        </div>
        

    </div>




    <!--BootStrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="indexR.js?v=<?php echo time(); ?>"></script>

</body>

</html>