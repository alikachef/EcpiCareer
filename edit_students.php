<?php 
include "dbConnect.php";
$idf = $_GET['id'];

if(isset($_POST['submit'])) {
    
    
    if(!empty($_FILES["image"]["name"])){

        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        $image = $_FILES['image']['tmp_name']; 
        $img_content = addslashes(file_get_contents($image)); 

    }
    else {
        $img_content = $_POST['image'];
    }
    $feild_name = $_POST['first_name'];
    $feild_desc = $_POST['first_description'];
    

    $sql = "UPDATE `ecpiregistery`.`feilds`
            SET
            `feildName` = '$feild_name',
            `feildImage` = '$img_content',
            `feildDesc` = '$feild_desc'
            WHERE `idfeilds` = '$idf';";

    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: get_feilds.php?msg=Data Updated successfully");
    }
    else{
        echo "Failed: " . mysqli_error($conn);
    }
    

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
    <link  rel="stylesheet" href="student.css?v=<?php echo time(); ?>" type="text/css">
    <title>Document</title>
</head>
<body>
    <img class="ecpiLogo" src="./Assets/ECPI_Online.png"/>
    <nav class="navbar navbar-dark bg-dark">
        <h2 class="p-2 text-white">Feilds Of Study</h2>
    </nav>
    <?php 
        $sql = "SELECT * FROM `ecpiregistery`.`feilds` WHERE idfeilds = $idf LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row1 = mysqli_fetch_assoc($result);
    ?>
    <div class="ecpi-form container d-flex justify-content-center">
        <form enctype="multipart/form-data" action="" method="post" style="width: 50vw; min-width:300px;">
            <div class="row">
                <div class="col">
                    <label class="form-label">Feild Image: </label>
                    <img class="cardimage card-img-top" src="data:image/png;charset=utf8;base64,<?php echo base64_encode($row1['feildImage']); ?>" />
                    <input type="file" class="form-control" name="image" value="<?php  $row1['feildImage'] ?>"/>
                </div>
            </div>
        
            <div class="row">
                <div class="col">
                    <label class="form-label">Feild Name: </label>
                    <input type="text" class="form-control" name="first_name" value="<?php echo $row1['feildName'] ?>" />
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label class="form-label">Feild Description: </label>
                    <input type="text" class="form-control" name="first_description" value="<?php echo $row1['feildDesc'] ?>" />
                </div>
            </div>

            <div class="mt-2">
                <button type="submit" class=" btn btn-success" name="submit">Save</button>
                <a href="get_feilds.php" class="btn btn-danger"> Cancel</a>
            </div>
        </form>
    </div>

    

    <!--BootStrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>