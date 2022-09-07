<?php 
    include 'dbConnect.php';
    
    $sql1 = "SELECT * FROM `ecpiregistery`.`students` WHERE idstudents = $ids LIMIT 1";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $idfeild = $_GET['idf'];
    

    $ids =  $_GET['id'];

    $sql = "DELETE FROM `ecpiregistery`.`students`
            WHERE `idstudents` = '$ids'; " ;


    $result = mysqli_query($conn, $sql);
    if($result){
        header("Location: get_students.php?id=$idfeild&msg=Record Deleted Successfully '$idf'"  );
        echo "failed: " . mysqli_error($conn);
        
    }
    else {
        echo "Failed: ". mysqli_error($conn);
    }
?>
