<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';


require "koneksi.php";





if (isset($_SESSION["mahasiswa"])) {
    header('location: mahasiswa.php');
    exit;
} elseif (isset($_SESSION["dosen"])) {
    header('location: index-userPremium.php');
    exit;
} elseif (isset($_SESSION["staff"])) {
    header('location: admin_dashboard.php');
    exit;
}
?>

<?php

if (isset($_POST["reset"])) {

    global $db;
    $emailTo = $_POST["email"];

    $result = mysqli_query($db, "SELECT * FROM user WHERE email = '$emailTo' ");

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);
        $code = uniqid();
        $otp = mt_rand(100000, 999999);

        
        $query = "INSERT INTO tb_reset_password(code, id_user, otp) VALUES('$code', '" . $row["id_user"] . "', '$otp')";
        mysqli_query($db, $query) or die(mysqli_error($db));


        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            //Server settings
            $mail->isSMTP();                                          //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                 //Enable SMTP authentication
            $mail->Username   = 'willytaada@gmail.com';     //SMTP	 username
            $mail->Password   = 'willytaasmara';               //SMTP password
            $mail->SMTPSecure = 'ssl';                                //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('willytaada@gmail.com', 'Login-Mbull	');
            $mail->addAddress($emailTo);                     //Add a recipient
            $mail->addReplyTo('no-reply@gmail.com', 'No Reply');

            //Content
            $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/pass.php?code=$code";
            $mail->isHTML(true);                              //Set email format to HTML
            $mail->Subject = 'Your Password Reset Link';
            $mail->Body    = "<h1>You Requested a password reset</h1><br>
            <h3>Kode OTP : " . $otp . "</h3>
            Click <a href='$url'>This Link</a> to do so";
            $mail->AltBody = 'Thankyou.';

            $mail->send();
            echo "<script>
                    alert ('Reset Password link has been sent to your email');
                    document.location.href = 'login.php';
                </script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>
            alert ('Email yang anda masukkan tidak terdaftar !');
            document.location.href = 'pass.php';
        </script>";
    }
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Reset 6</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<body>
	<div class="infinity-container">
		<div class="infinity-form-block">
			<div class="infinity-click-box text-center">Reset Your password</div>
			
			<div class="infinity-fold">
				<div class="infinity-form">
					<div class="reset-form d-block">
					    <form action="" class="reset-password-form px-3" method="post" >
			                <p class="mb-3 text-white">
			                    Please enter your email address and we will send you a password reset link.
			                </p>
			                <div class="form-input">
								<input type="email" name="email" placeholder="Email Address" tabindex="10"required>
							</div>
				              
				            <div class="col-12 mb-3 text-right"> 
								<button type="submit" name="reset" class="btn">Send Reset Link</button>
							</div>
				        </form>
					</div>

				
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function()
		{
			$('.infinity-click-box').click(function()
			{
				$('.infinity-fold').toggleClass('active')
			})
		})
		

		window.addEventListener('load', function() {
    			PasswordReset();
		});
	</script>
	<script src="js/reset_password.js"></script>	
	
</body>
</html>
