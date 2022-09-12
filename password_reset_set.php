<?php
use PHPMailer\PHPMailer\PHPMailer;
include "dbConnect.php";

$sql = "SELECT * FROM `users` ";
$result = mysqli_query($conn, $sql);
if (isset($_POST["submit"])) {
    $email = $_GET['email'];

    if ($_POST['password1'] == $_POST['password2']){
        $password = $_POST['password1'];

        $encrypt = password_hash($password, PASSWORD_BCRYPT);
		$sql ="UPDATE `users`
        SET
        `password` = '$encrypt'
        WHERE `email` = '$email'";

    	$result = mysqli_query($conn, $sql);

    	if($result){
     		header("Location: login.php?msg=User Created successfully");
    	}
    	else{
			header("location:password_reset_set.php?Empty=Something Went Wrong" . mysqli_error($conn));

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>" type="text/css">
    <title>Ecpi Registery</title>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Password Reset</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <img class="ecpiseal" src="./Assets/ECPI-Seal.png" />
                    </div>
                </div>
                <div class="card-body">
                    <div class="ecpialert">
                        <?php
if (isset($_GET['Empty'])) {
    $msg = $_GET['Empty'];
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Failed</strong> ' . $msg . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
}
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success</strong> ' . $msg . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
}
?>
                    </div>
                    <form action="" method="post">
                        <div class="mb-3 text-white">Enter Your New Password:</div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password1" class="form-control" placeholder="New Password">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password2" class="form-control" placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <input type="submit" name='submit' value="Reset" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex  justify-content-center links">
                        Have an account?<a href="login.php">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--BootStrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="index.js"></script>
</body>

</html>