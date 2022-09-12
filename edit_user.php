<?php 
    session_start();

    if (isset($_SESSION['User'])){
    
        include "dbConnect.php";
        echo $_SESSION['Role'];
    }
    else {
       header("Location:login.php?Empty= Please login to access");
    }

    $id =  $_GET['id'];

    $sql = "SELECT * FROM `users` WHERE idusers = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if($row = mysqli_fetch_assoc($result)){
        if($row['role'] == "user"){
            $newrole = "admin";
        }
        else {
            $newrole = "user";
        }
    }

    $sql1 = "UPDATE `users`
             SET`role` = '$newrole'
             WHERE `idusers` = $id " ;

    $result1 = mysqli_query($conn, $sql1);

    if($result1){
        header("Location: get_feilds.php?id=$idfeild&msg=Record Updated Successfully "  );
        echo "failed: " . mysqli_error($conn);
        
    }
    else {
        echo "Failed: ". mysqli_error($conn);
    }
?>
