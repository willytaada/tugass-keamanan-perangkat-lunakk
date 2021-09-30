<?php
require 'koneksi.php';
	session_start();
	if (isset($_SESSION["mahasiswa"])) {
		header('location: mahasiswa.php');
		exit;
	} elseif (isset($_SESSION["dosen"])) {
		header('location: dosen.php');
		exit;
	} elseif (isset($_SESSION["staff"])) {
		header('location: dashboard.php');
		exit;
	}

	if(isset($_POST["login"]))
	{
		try {
			global $db;
			$email = $_POST["email"];
	    	$password = $_POST["password"];

			$result = mysqli_query($db, "SELECT * FROM user WHERE email = '$email'")  or die(mysqli_error($db));
			
			if(mysqli_num_rows($result) === 1 )
	        {
	            $row = mysqli_fetch_assoc($result);
	            if (password_verify($password, $row["password"]))
	            {
					if ($row["verification"] == "yes") 
					{
						$_SESSION["id_user"] = $row["id_user"];

						if ($row["level"] == "mahasiswa") {
							// SET SESSION FREE
							$_SESSION["mahasiswa"] = true;

							// QUERY LOG ACTIVITY
							$userLog = $row["id_user"];
							$timeLog = date("Y-m-d H:i:s");
							$query_log = "INSERT INTO tb_log(id_user, time_log)	VALUES('$userLog', '$timeLog')";

							mysqli_query($db, $query_log) or die(mysqli_error($db));

							// Cek Remember
							// if (isset($_POST['remember_me'])) {
							// 	// Buat Cookie
							// 	setcookie('id_user', $row['id_user'], time() + 86400, '/');
							// 	setcookie('lodon', hash('sha256', $row['username']), time() + 86400, '/');
							// }

							header('location: home.php');
						}
						else if ($row["level"] == "dosen") {
							// SET SESSION FREE
							$_SESSION["dosen"] = true;

							// QUERY LOG ACTIVITY
							$userLog = $row["id_user"];
							$timeLog = date("Y-m-d H:i:s");
							$query_log = "INSERT INTO tb_log(id_user, time_log)	VALUES('$userLog', '$timeLog')";

							mysqli_query($db, $query_log) or die(mysqli_error($db));

							// Cek Remember
							// if (isset($_POST['remember_me'])) {
							// 	// Buat Cookie
							// 	setcookie('id_user', $row['id_user'], time() + 86400, '/');
							// 	setcookie('lodon', hash('sha256', $row['username']), time() + 86400, '/');
							// }

							header('location: dosen.php');
						}
						else if ($row["level"] == "staff") {
							// SET SESSION FREE
							$_SESSION["staff"] = true;

							// QUERY LOG ACTIVITY
							$userLog = $row["id_user"];
							$timeLog = date("Y-m-d H:i:s");
							$query_log = "INSERT INTO tb_log(id_user, time_log)	VALUES('$userLog', '$timeLog')";

							mysqli_query($db, $query_log) or die(mysqli_error($db));

							// Cek Remember
							// if (isset($_POST['remember_me'])) {
							// 	// Buat Cookie
							// 	setcookie('id_user', $row['id_user'], time() + 86400, '/');
							// 	setcookie('lodon', hash('sha256', $row['username']), time() + 86400, '/');
							// }

							header('location: dashboard.php');
						}else {
							throw new Exception("Level akses account anda tidak terdaftar !!");
						}
					}else {
                    	throw new Exception("Anda belum melakukan verifikasi account. Silahkan cek email anda !!");
                	}
	            }else {
					throw new Exception("Password yang anda masukkan salah !!");
				}
	        }else {
				throw new Exception("Email yang anda masukkan tidak terdaftar !!");
			}
		}catch (Exception $error) {
			echo "<script>
			alert ('" . $error->getMessage() . "');
				document.location.href = 'login.php';
			</script>";
		}
	}
?>
	
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<body>
	<div class="infinity-container">
		<!-- FORM CONTAINER BEGIN -->
		<div class="infinity-form-block">
			<div class="infinity-click-box text-center">Click Here to Login</div>
			
			<div class="infinity-fold">
				<div class="infinity-form">
					<form action="" method="post">
						<!-- Input Box -->
						<div class="form-input">
							<input type="email" name="email" placeholder="Email Address" required>
						</div>
						<div class="form-input">
							<input type="password" name="password" placeholder="Password" required>
						</div>
						<div class="row">
							<!--Remember Checkbox -->
			                <div class="col-auto d-flex align-items-center">
			                    <div class="custom-control custom-checkbox">
			                        <input type="checkbox" class="custom-control-input" id="cb1">
			                       	<label class="custom-control-label text-white" for="cb1">Remember me
		                        	</label>
				                </div>
				            </div>
		                </div>
		                <!-- Login Button -->
						<button type="submit" name="login"class="btn btn-block">Login</button>
						<div class="text-right">
		                    <a href="reset.php" class="forget-link">Forgot password?</a>
		                </div>
						<div class="text-center text-white">or login with</div>					
						<div class="text-center text-white">Don't have an account?
							<a class="register-link" href="register.php">Register here</a>
		            	</div>
					</form>
				</div>
			</div>
		</div>
		<!-- FORM CONTAINER END -->
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
