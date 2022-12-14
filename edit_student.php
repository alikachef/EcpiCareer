<?php
session_start();

if (isset($_SESSION['User'])) {

    include "dbConnect.php";
    echo $_SESSION['Role'];
} else {
    header("Location:login.php?Empty= Please login to access");
}

$ids = $_GET['id'];

$sql1 = "SELECT * FROM `students` WHERE `idstudents` = '$ids' LIMIT 1";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);

if (isset($_POST['submit'])) {

    if (!empty($_FILES["image"]["name"])) {

        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $image = $_FILES['image']['tmp_name'];
        $img_content = addslashes(file_get_contents($image));

        if (!empty($_FILES['resume']['name'])) {
            $fileR = basename($_FILES["resume"]["name"]);
            $fileT = pathinfo($fileR, PATHINFO_EXTENSION);
            $res = $_FILES['resume']['tmp_name'];
            $res_content = addslashes(file_get_contents($res));
        } else {
            $res_content = $_POST['resumev'];
        }
        $student_name = $_POST['student_name'];
        $student_desc = $_POST['student_description'];
        $student_graduate = $_POST['student_gradute'];
        $student_degree = $_POST['degree'];
        $idfeild = $row1['feildID'];

        $sql = "UPDATE `students`
    SET
    `studentName` = '$student_name',
    `studentImage` = '$img_content',
    `StudentDesc` = '$student_desc',
    `studentDegree` = '$student_degree',
    `studentGrad` = '$student_graduate',
    `studentRes` = '$res_content'
    WHERE `idstudents` = '$ids';";
    } else {
        if (!empty($_FILES['resume']['name'])) {
            $fileR = basename($_FILES["resume"]["name"]);
            $fileT = pathinfo($fileR, PATHINFO_EXTENSION);
            $res = $_FILES['resume']['tmp_name'];
            $res_content = addslashes(file_get_contents($res));
        } else {
            $res_content = $_POST['resumev'];
        }
        $student_name = $_POST['student_name'];
        $student_desc = $_POST['student_description'];
        $student_graduate = $_POST['student_gradute'];
        $student_degree = $_POST['degree'];
        $idfeild = $row1['feildID'];

        $sql = "UPDATE `students`
    SET
    `studentName` = '$student_name',
    `StudentDesc` = '$student_desc',
    `studentDegree` = '$student_degree',
    `studentGrad` = '$student_graduate',
    `studentRes` = '$res_content'
    WHERE `idstudents` = '$ids';";
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: get_students.php?id=$idfeild&msg=New record created successfully");
    } else {
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

    <div class="ecpi-form container d-flex justify-content-center">
        <form enctype="multipart/form-data" action="" method="post" style="width: 50vw; min-width:300px;">
            <div class="row">
                <div class="col">
                    <label class="form-label">Student Image: </label>
                    <img class="cardimage card-img-top" src="data:image/png;charset=utf8;base64,<?php echo base64_encode($row1['studentImage']); ?>" />
                    <input type="file" class="form-control" name="image" />
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label class="form-label">Student Name: </label>
                    <input type="text" class="form-control" name="student_name" value="<?php echo $row1['studentName'] ?>" />
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label class="form-label">Student Short Description: </label>
                    <textarea type="textbox" rows="3" maxlength="110" class="form-control" name="student_description" ><?php echo $row1['StudentDesc'] ?></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label class="form-label">Student Resume: </label>
                    <input type="file"  class="mb-2 form-control" name="resume" />
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label class="form-label">Graduation Date: </label>
                    <input type="month" class="form-control" name="student_gradute" value="<?php echo $row1['studentGrad'] ?>" />
                </div>
            </div>


            <label class="form-label">Degree: </label>
            <select class="mt-2 btn btn-secondary dropdown-toggle" name="degree" id="degree" value = "<?php echo $row1['studentDegree'] ?>">
                <option value="Associate">Associate</option>
                <option value="Bachelor">Bachelor</option>
                <option value="Doctorate">Doctorate</option>
                <option value="Masters">Masters</option>
            </select>

            <div class="mt-2">
                <button type="submit" class=" btn btn-success" name="submit">Save</button>
                <a href="get_students.php?id=<?php echo $row1['feildID'] ?>" class="btn btn-danger"> Cancel</a>
            </div>
        </form>
    </div>



    <!--BootStrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>