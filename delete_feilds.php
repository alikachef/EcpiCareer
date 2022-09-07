<?php 
     include 'dbConnect.php';
     $idf =  $_GET['id'];
     $sql = "DELETE FROM `ecpiregistery`.`feilds`
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