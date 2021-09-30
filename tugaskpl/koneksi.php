<?php

		$db = mysqli_connect("localhost", "root", "", "register");

		function regis($data){
			global $db; 

			$username = strtolower(stripcslashes($data["username"]));
			$email = htmlspecialchars($data["email"]);
			$password = mysqli_real_escape_string($db, $data["password"]);
			$password2 = mysqli_real_escape_string($db, $data["password2"]);
			$level = $data["level"];

			$result =mysqli_query($db, "SELECT email FROM user WHERE email = '$email'");

			if(mysqli_fetch_assoc($result))
			{
				echo "<script>
				alert('username sudah terdaftar');
				</script>";
				return false;
			}
			if($password !== $password2)
			{
				echo "<script>
				alert('Konfirmasi password tidak sesuai');
				</script>";
				return false;
			}
			$password = password_hash ($password, PASSWORD_DEFAULT);
			$query = "INSERT INTO user(username, email, password, level, verification) VALUES ( '$username', '$email', '$password', '$level', 'no')";

			mysqli_query ($db, $query ) or die (mysqli_error($db));

			return mysqli_affected_rows($db);
		}
		function verification_account($email)
		{
			global $db;

			//query update data tb_user
			$query = "UPDATE user SET verification = 'yes' WHERE email = '$email' ";

			mysqli_query($db, $query) or die(mysqli_error($db));

			// MENGEMBALIKAN NILAI BERUPA "-1"(false) atau "1"(true)
			return mysqli_affected_rows($db);
		}
		function forgot_password($data)
		{
			global $db;

			$otp = mysqli_real_escape_string($db, $data["otp"]);
			$new_pwd = mysqli_real_escape_string($db, $data["password"]);
			$new_pwd2 = mysqli_real_escape_string($db, $data["password2"]);

			$result = mysqli_query($db, "SELECT * FROM tb_reset_password WHERE otp = '$otp' ");

			if (mysqli_num_rows($result) === 0) {
				echo "<script>
				alert('Incorrect OTP code');
				</script>";

				return false;
			}

			// CEK APAKAH PASSWORD BENAR 
			$row = mysqli_fetch_assoc($result);

			// CEK KONFIRMASI PASSWORD 
			if ($new_pwd !== $new_pwd2) {
				echo "<script>
				alert('Konfirmasi password salah');
				</script>";

				return false;
			}

			// ENSKRIPSI PASSWORD
			$passwordValid = password_hash($new_pwd, PASSWORD_DEFAULT);

			// QUERY
			$query_delete = "DELETE FROM tb_reset_password WHERE otp = '$otp' ";
			mysqli_query($db, $query_delete) or die(mysqli_error($db));

			$query_reset = "UPDATE user SET password = '$passwordValid' WHERE id_user = '" . $row["id_user"] . "' ";
			mysqli_query($db, $query_reset) or die(mysqli_error($db));

			// MENGEMBALIKAN NILAI BERUPA "-1"(false) atau "1"(true)
			return mysqli_affected_rows($db);
		}
		function query($query)
		{
			global $db;

			$result = mysqli_query($db, $query) or die(mysqli_error($db));
			$boxs = [];

			// AMBIL DATA (FETCH) DARI VARIABEL RESULT DAN MASUKKAN KE ARRAY
			while ($box = mysqli_fetch_assoc($result)) {
				$boxs[] = $box;
			}
			return $boxs;
		}
?>
