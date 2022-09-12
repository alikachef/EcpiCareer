<?php 
     session_start();

     if (isset($_SESSION['User'])){
     
         include "dbConnect.php";
         echo $_SESSION['Role'];
     }
     else {
        header("Location:login.php?Empty= Please login to access");
     }
     
     $idf =  $_GET['id'];
     $sql = "DELETE FROM `feilds`
             WHERE `idfeilds` = '$idf'; " ;
 
 
             
             
     $result = mysqli_query($conn, $sql);
     if($result){
         header("Location: get_feilds.php?msg=Record Deleted Successfully '$idf'"  );
         echo "failed: " . mysqli_error($conn);
         
     }
     else {
         echo "Failed: ". mysqli_error($conn);
     }
?>