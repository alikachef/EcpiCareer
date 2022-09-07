<?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "mimoali";
    $dbName = "ecpiregistery";

    $conn = mysqli_connect($servername, $username, $password, $dbName);

    if(!$conn) {
        die("Connection Failed" . mysqli_connect_error());
    }
    else {
      // echo " Connected Successfully";
    }
