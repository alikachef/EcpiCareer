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

    $sql = "DELETE FROM `users`
            WHERE `idusers` = '$id'; " ;


    $result = mysqli_query($conn, $sql);
    if($result){
        header("Location: get_feilds.php?id=$idfeild&msg=Record Deleted Successfully '$idf'"  );
        echo "failed: " . mysqli_error($conn);
        
    }
    else {
        echo "Failed: ". mysqli_error($conn);
    }
?>
