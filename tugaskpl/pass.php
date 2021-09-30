<?php
// MENGHUBUNGKAN KONEKSI DATABASE
require "koneksi.php";

if (!isset($_GET["code"])) {
    echo "<script>
        alert( 'The link has expired' );
        document.location.href = 'login.php';
    </script>";
}

$code = $_GET["code"];

$getEmailQuery = mysqli_query($db, "SELECT * FROM tb_reset_password WHERE code='$code'");

if (mysqli_num_rows($getEmailQuery) === 0) {
    echo "<script>
        alert( 'The link has expired' );
        document.location.href = 'login.php';
    </script>";
}
?>

<?php
if (isset($_POST["reset"])) {
    // CEK APAKAH BERHASIL DIUBAH ATAU TIDAK
    if (forgot_password($_POST) > 0) {
        echo "<script>
            alert( 'recovery password success !' );
            document.location.href = 'login.php';
        </script>";
    } else {
        echo "<script>
            alert( 'recovery password failed !' );
            document.location.href = 'pass.php?code=" . $code . " ';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <title>Forgot Password</title>
 <link href="assets/css/bootstrap.min.css" rel="stylesheet">
 <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
 <link rel="shortcut icon" href ="img/6.png">
 <style>
  body {
   font-family: "Muli", sans-serif;
   background-color: #fff7e3;
  }

#card {
    background: #fbfbfb;
    border-radius: 8px;
    box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
    height: 355px;
    margin: 6rem auto 8.1rem auto;
    width: 759px;
    margin-top: 80px;
    margin-bottom: 70px;
}
body {
    background: #fff7e3;
    background-repeat: no-repeat;
}
#card-content {
    padding: 12px 44px;
}
#card-title {
    font-family: "Muli", sans-serif;
    letter-spacing: 4px;
    padding-bottom: 23px;
    padding-top: 13px;
    text-align: center;
    margin-top: 30px;
}
.underline-title {
    background: -webkit-linear-gradient(right, #fbbc58,  #000);
    height: 2px;
    margin: 0.1rem auto 0 auto;
    width: 614px;
}
a {
    text-decoration: none;
}
label {
    font-family: "Muli", sans-serif;
    font-size: 11pt;
}
#forgot-pass {
    color:#2e302f;
    font-family: "Muli", sans-serif;
    font-size: 10pt;
    margin-top: 3px;
    text-align: right;
}
.form {
    align-items: left;
    display: flex;
    flex-direction: column;
}
.form-border {
    background: -webkit-linear-gradient(right, #fbbc58,  #000);
    height: 1px;
    width: 100%;
}
.form-content {
    background: #fbfbfb;
    border: none;
    outline: none;
    padding-top: 14px;
}
#signup {
    color: #2e302f;
    font-family: "Muli", sans-serif;
    font-size: 10pt;
    margin-top: 16px;
    text-align: center;
}
#submit-btn {
    background: #FBBC58;
    border: none;
    border-radius: 21px;
    box-shadow: 0px 1px 8px #888b8a;
    cursor: pointer;
    color: #000;
    font-family: "Muli", sans-serif;
    height: 42.3px;
    margin: 0 auto;
    margin-top: 50px;
    margin-bottom: 10px;
    transition: 0.25s;
    width: 153px;
    outline: none;
}
#submit-btn:hover {
    box-shadow: 0px 1px 18px#2e302f;
}
.asking {
    margin: auto;
    justify-content: space-between;
    font-family: "Muli", sans-serif;
    font-size: 13px;
}
.footer {
  padding:50px 0;
  color:#000;
  background-color:#fff7e3;
}

.footer .copyright {
  text-align:center;
  padding-top:24px;
  opacity:0.3;
  font-size:13px;
  margin-bottom:0;
}
</style>

</head>
<body>

 <div class="container-fluid" id="codelatte">
    <div id="card"> 
        <div id="card-content">
            <div id="card-title">
              <h2 style="font-size: 30px;">Enter Re-New Password</h2>
              <div class="underline-title"></div>
        </div>
        <form method="post" action="">
          <input type="text" name="otp" placeholder="Code OTP">
          <input type="password" name="password" placeholder="New Password">
          <input type="password" name="password2" placeholder="Confirm Password">
          <br>
          <input type="submit" name="reset" value="Update Password">
      </form>
    </div>
 </div>
</div>
</body>
</html>


