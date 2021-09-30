<?php
  require 'koneksi.php';
  session_start(); 
	if(!isset($_SESSION["staff"]))
	{
  	header("Location: login.php");
  	exit;
  }else{
    if (isset($_SESSION['id_user'])) {
      // var_dump($_SESSION['id_user']); die;
      $my_id = $_SESSION['id_user'];
    } 
  $lodon = query("SELECT * FROM user WHERE id_user = '$my_id' ")[0];
  }
  $data_user = query("SELECT * FROM user");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href ="img/logoa.png">
    <style>
    body{
	
  font-family: 'Quicksand', sans-serif;
}

.wrapper{
width: 100%;
height: 100%;
}
.navbar{
margin-bottom: 0;
}
.sidebar{
width: 100%;
height: 100%;
background: #293949;
position: absolute;
z-index: 100;
}
th .user_password {
    padding-right: 40px;
}
ul{
padding: 0;
margin-left: -40px;
}
ul li{
list-style: none;
border-bottom: 1px solid rgba(255, 255, 255, 0.5); 
}
ul li a{
text-decoration: none;
color: #aeb2b7;
display: block;
padding: 19px 0px 18px 25px;
transition: all 200ms ease-in;
}
ul li a:hover{
text-decoration: none;
color: #1abc9c;
}
ul li a:visited{
text-decoration: none;
color: #fff;
}
li li a span{
display: inline-block;
}
ul ul{
display: none;
margin:0px;
}
ul li a .fa-angle-down{
margin-right: 10px;
}
/*apabila lebar min 768px*/
@media(min-width: 768px) {
.sidebar{
  width: 240px;
}
.content{
  margin-left: 250px;
}
.inner{
  padding: 15px;
}
}
    </style>
</head>
<body>
  <div class="wrapper">
      <nav class="navbar navbar-default">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Selamat Datang  <?= $lodon["username"];?>!</a>
        </div>
      </nav>
      <aside class="sidebar">
        <menu>
          <ul class="menu-content">
            <li><a href="dashboard.php"><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href="datauser.php"><span>Data User</span></a></li>
            <li><a href="loguser.php"><span>Log User</span></a></li>
            <li><a href="logout.php"><span>Logout</span></a></li>
          </ul>
        </menu>
      </aside>
      <section class="content">
        <div class="inner">
          
  <br><br>

  <form action="" method="post" >
    
    <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan Keyword" autocomplete="off">
    <button type="submit" name="cari">Cari!</button>
    
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Data User</h2>
                        <div class="row">
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                        <th>
                          ID
                        </th>
                        <th>
                          Name
                        </th>
                        <th>
                          Email
                        </th>
                        <th>
                          Password
                        </th>
                        <th>
                          Sebagai
                        </th>
                        <th>
                          Status Verifikasi
                        </th>
                      </thead>
                      <tbody>
                        <?php $i = 1;?>
                        <?php foreach ($data_user as $row) : ?>
                        <tr>
                          <td>
                          <?= $i; ?>
                          </td>
                          <td>
                          <?= $row["username"]; ?>
                          </td>
                          <td>
                          <?= $row["email"]; ?>
                          </td>
                          <td>
                          <?= $row["password"]; ?>
                          </td>
                          <td>
                          <?= $row["level"]; ?>
                          </td>
                          <td>
                          <?= $row["verification"]; ?>
                          </td>
                        </tr>
                        <?php $i++ ?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>