<?php 
include "dbConnect.php";
$feild_id = $_GET['id'];

$sql = "SELECT * FROM `ecpiregistery`.`students` ";
$result = mysqli_query($conn, $sql);
$id = 1;
while ($row = mysqli_fetch_assoc($result)){
    if(intval($row['idstudents']) >= $id){
        $id= intval($row['idstudents']);
        $id += 1; 
    } 
}
echo $id;

if(isset($_POST['submit'])) {
    
    if(!empty($_FILES["image"]["name"])){

    $fileName = basename($_FILES["image"]["name"]); 
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
    $image = $_FILES['image']['tmp_name']; 
    $img_content = addslashes(file_get_contents($image)); 

    $student_name = $_POST['student_name'];
    $student_desc = $_POST['student_description'];
    $student_id = $id;
    $student_graduate = $_POST['student_gradute'];
    $student_degree =$_POST['degree'];
    

    $sql ="INSERT INTO `ecpiregistery`.`students`
    (`idstudents`, `studentName`,`studentImage`,`StudentDesc`,`studentDegree`,`studentGrad`,`feildID`)
    VALUES
    ('$student_id',
    '$student_name',
    '$img_content',
    '$student_desc',
    '$student_degree',
    '$student_graduate',
    '$feild_id');
    ";

    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: get_students.php?id=$feild_id&msg=New record created successfully");
    }
    else{
        echo "Failed: " . mysqli_error($conn);
    }
    
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
                    <input type="file" class="form-control" name="image" />
                </div>
            </div>
        
            <div class="row">
                <div class="col">
                    <label class="form-label">Student Name: </label>
                    <input type="text" class="form-control" name="student_name" placeholder="Feild Of Study" />
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label class="form-label">Student Short Description: </label>
                    <textarea rows="3" maxlength="110" class="form-control" name="student_description" placeholder="Student Short Description"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label class="form-label">Graduation Date: </label>
                    <input type="month" class="form-control" name="student_gradute" min="<?php echo $date ?>" />
                </div>
            </div>


            <label class="form-label">Degree: </label>
            <select class="mt-2 btn btn-secondary dropdown-toggle" name="degree" id="degree">
                <option value="Associate">Associate </option>
                <option value="Bachelor">Bachelor </option>
                <option value="Doctorate">Doctorate </option>
                <option value="Masters">Masters </option>
            </select>

            <div class="mt-2">
                <button type="submit" class=" btn btn-success" name="submit">Save</button>
                <a href="get_students.php?id=<?php echo $feild_id ?>" class="btn btn-danger"> Cancel</a>
            </div>
        </form>
    </div>

    

    <!--BootStrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>