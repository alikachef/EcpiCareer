<?php 
include "dbConnect.php";
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--BootStrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link  rel="stylesheet" href="student.css?v=<?php echo time(); ?>" type="text/css">
    <title>Document</title>
</head>
<body>
    <img class="ecpiLogo" src="./Assets/ECPI_Online.png"/>
    <nav class="navbar navbar-dark bg-dark">
        <h2 class="p-2 text-white"><a href="get_feilds.php" class="back">&#8249;</a>Students</h2>
        <a href="add_students.php?id=<?php echo $id ?>"  id="addButton" class="m-2 btn btn-success">Add a Student</a>
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
        $sql = "SELECT * FROM `ecpiregistery`.`students` WHERE feildID = '$id'  ";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)){
    ?>
            <div class="card text-center" style="width: 20rem;"> 
                <div class = "imagecontainer">
                    <img class="cardimageS card-img-top" src="data:image/png;charset=utf8;base64,<?php echo base64_encode($row['studentImage']); ?>" />
                </div>
                <div class="card-body">
                    <h5 class="pt-3 card-title"><?php echo $row['studentName'] ?></h5>
                    <p class="carddescS card-text"> <?php echo $row['StudentDesc'] ?> </p>
                    <p>Degree: <?php echo $row['studentDegree'] ?>  </p>
                    <p>Expected Graduation Date : <?php echo $row['studentGrad'] ?></p>
                    <div>
                        <a href="" class="btn btn-primary">Contact</a>
                        <a href="edit_student.php?id=<?php echo $row['idstudents'] ?>" class="btn btn-info">Edit</a>
                        <a href="delete_student.php?id=<?php echo $row['idstudents'] ?>&idf=<?php echo $id ?>   " class="btn btn-danger">Delete</a>
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
</body>
</html>