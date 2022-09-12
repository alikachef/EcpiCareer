<?php
use PHPMailer\PHPMailer\PHPMailer;
include "dbConnect.php";

$sql = "SELECT * FROM `users` ";
$result = mysqli_query($conn, $sql);
if (isset($_POST["submit"])) {
    if (!empty($_POST['email'])) {
        $email = $_POST["email"];
        if (!$email) {
            header("Location:password_reset.php?Empty=Invalid Email Address");
        } else {
            $sel_query = "SELECT * FROM `users` WHERE email = '$email'";
            $results = mysqli_query($conn, $sel_query);
            $row = mysqli_num_rows($results);
            echo "succes";

            if ($row == "") {
                header("Location:password_reset.php?Empty=User Not Found");
            } else {

                $output = '';

                $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
                $expDate = date("Y-m-d H:i:s", $expFormat);
                $key = md5(time());
                $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
                $key = $key . $addKey;

                // mysqli_query($con, "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');");

                $output .= '<p>Please click on the following link to reset your password.</p>';

                //replace the site url
                $output .= '<p><a href="http://localhost/CourseApplication/password_reset_set.php?key=' . $key . '&email=' . $email . '&action=reset" target="_blank">http://localhost/CourseApplication/password_reset_set.php?key=' . $key . '&email=' . $email . '&action=reset</a></p>';
                $body = $output;
                $subject = "Password Recovery";

                $email_to = $email;

                require "./vendor/autoload.php";
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->Host = "smtp.gmail.com"; // Enter your host here
                $mail->SMTPAuth = true;
                $mail->Username = "alikachef1997@gmail.com"; // Enter your email here
                $mail->Password = "quukdglywowtliqs"; //Enter your passwrod here
                $mail->Port = 587;
                $mail->IsHTML(true);
                $mail->From = "support@ecpi.com";
                $mail->FromName = "Ecpi Registory";

                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->AddAddress($email);
                if (!$mail->Send()) {
                    header("Location:password_reset.php?Empty=Error! $mail->ErrorInfo");
                } else {
                    header("Location:password_reset.php?msg=Email was sent successflly");
                }

            }
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
                        <div class="mb-3 text-white">Enter Your Email Address You Signed Up With:</div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" name="email" class="form-control" placeholder="email">
                        </div>
                        <div>
                            <p class="text-white">Note: if a user signed up with an invalid email. this will result in a
                                lost account
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