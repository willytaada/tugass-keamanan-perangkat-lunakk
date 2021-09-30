<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;

	require 'vendor/phpmailer/phpmailer/src/Exception.php';
	require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
	require 'vendor/phpmailer/phpmailer/src/SMTP.php';
	
	session_start();
	require 'koneksi.php';
	if( isset($_POST["daftar"]))
	{
		if(regis($_POST) > 0)
		{
			$emailTo = $_POST["email"];

			$result = mysqli_query($db, "SELECT * FROM user WHERE email = '$emailTo' ");
			if(mysqli_num_rows($result) === 1)
			{
				$row = mysqli_fetch_assoc($result);
				$code = uniqid();

				$mail = new PHPMailer(true);

				try {
				$mail->SMTPDebug = 0;
                $mail->isSMTP();
                //Server settings
                $mail->isSMTP();                                          //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                 //Enable SMTP authentication
                $mail->Username   = 'willytaada@gmail.com';     		  //SMTP username
                $mail->Password   = 'willytaasmara';               			  //SMTP password
                $mail->SMTPSecure = 'ssl';                                //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

				//Recipients
                $mail->setFrom('willytaada@gmail.com', 'Login-Mbull');
                $mail->addAddress($emailTo);                     //Add a recipient
                $mail->addReplyTo('no-reply@gmail.com', 'No Reply');

				//Content
                $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/verification.php?code=$code&email=$emailTo";
                $mail->isHTML(true);                              //Set email format to HTML
                $mail->Subject = 'Your Verification Account Link';
                $mail->Body    = "<h1>Please click this link to verification your account</h1><br>
                    Click <a href='$url'>This Link</a> to verification your account";
                $mail->AltBody = 'Welcome to our site.';

                $mail->send();
			}catch (Exception $e) {
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
			echo "<script>
					alert('akun admin berhasil dibuat');
					document.location.href = 'login.php';  
				</script>";
		}else
		{
			mysqli_error($db);
		}
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<body>
	<div class="infinity-container">
		<div class="infinity-form-block">
			<div class="infinity-click-box text-center">Click Here to Register</div>
			
			<!-- FORM BEGIN -->
			<div class="infinity-fold">
				<div class="infinity-form">
					<!-- Form -->
					<form action="" method="post">
						<!-- Input Box -->
						<div class="form-input">
							<input type="text" name="username" placeholder="Full Name" required>
						</div>
						<div class="form-input">
							<input type="email" name="email" placeholder="Email Address" required>
						</div>
						<div class="form-input">
							<input type="password" name="password" placeholder="Password" required>
						</div>
						<div class="form-input">
							<input type="password" name="password2" placeholder="Konfirmasi Password" required>
						</div>
						<div class="form-input">
							<input type="text" name="level" placeholder="Sebagai" required>
						</div>
						<!-- Register Button -->
						<button type="submit" name="daftar" class="btn btn-block">Register</button>
						<div class="text-center text-white">or register with</div>
						<div class="text-center text-white">Already have an account?
							<a class="login-link" href="login.php">Login Now</a>
		            	</div>
					</form>
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
	</script>
</body>
</html>
