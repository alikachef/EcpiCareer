<?php 
session_start();

if (isset($_SESSION['User'])){
    include "dbConnect.php";
}
else {
   header("Location:login.php?Empty= Please login to access");
}

if(isset($_POST['search'])){
    $value_seach = $_POST['value_search'];
    $query ="SELECT * FROM ecpiregistery.feilds where feildName like '%".$value_seach."%'";
    $resultf = filterTable($query);
}
else{
    $sql = "SELECT * FROM `feilds` ";
    $resultf = filterTable($sql);
}

function filterTable($query){
    include "dbConnect.php";

    $resultu = mysqli_query($conn, $query);
    return $resultu;
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="student.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="modal.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="icon" href="Assets/ecpiseal.png" />

    <title>Ecpi Registery</title>
</head>

<body>
    <img class="ecpiLogo" src="./Assets/ECPI_Online.png" />
    <nav class="navbar navbar-dark bg-dark">
        <h2 class="p-2 text-white">Fields Of Study</h2>
        <div class=" formSearch">
            <form action="" method="post">
                <div class="input-group ">
                    <input type="text" name="value_search" class=" form-control" placeholder="Search Field Name...">
                    <div class="input-group-append">
                        <button name="search" class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <?php
            if($_SESSION['Role'] == "admin"){
                echo '<a href="add_feilds.php"  id="addButton" class="m-2 btn btn-success">Add Field</a>';
                echo '<button   id="mybtn" class="m-2 btn btn-primary text-white"><i class="fas fa-user-lock"></i></button>';
            }
        ?>
            <a class="m-2 btn btn-outline-light" href="logout.php?logout">logout</a>

        </div>
    </nav>
    <div id="usermodal" class="user-modal">
        <div class="modal-content">
            <h1>Users:</h1>
            <?php 
                $sql = "SELECT * FROM `users` ";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)){
                ?>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo $row['username']?>
                    <div>
                        <a href="edit_user.php?id=<?php echo $row['idusers']?>"
                            class="btn btn-success "><?php echo $row['role']?></a>
                        <a href="delete_user.php?id=<?php echo $row['idusers']?>" class="btn btn-danger">Block</a>
                    </div>
                </li>
            </ul>

            <?php 
                }
                ?>
            <div class="mt-2 modal-footer">
                <button type="button" class="btn btn-danger close-modal" data-dismiss="modal">Close</button>
            </div>
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

            while ($row = mysqli_fetch_assoc($resultf)){
        ?>
            <div class="card" style="width: 18rem;">
                <div class="imagecontainer">
                    <img class="cardimage card-img-top"
                        src="data:image/png;charset=utf8;base64,<?php echo base64_encode($row['feildImage']); ?>" />
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['feildName'] ?></h5>
                    <p class="carddesc card-text"> <?php echo $row['feildDesc'] ?> </p>
                    <div>
                        <a href="get_students.php?id=<?php echo $row['idfeilds'] ?>&fname=<?php echo $row['feildName']?>"
                            class="btn btn-primary">Students</a>

                        <?php
                            if($_SESSION['Role'] == "admin"){
                                echo '<a href="edit_feilds.php?id='.$row['idfeilds'].'" class="m-2 btn
                        btn-info">Edit</a>';
                        echo '<a href="delete_feilds.php?id='.$row['idfeilds'].'"
                            class="btn btn-danger">Delete</a>';
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="index.js?v=<?php echo time(); ?>"></script>
</body>

</html>