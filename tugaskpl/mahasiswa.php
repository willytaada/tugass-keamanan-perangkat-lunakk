<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mahasiswa</title>
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
.box{
  padding: 30px 40px;
  border-radius: 5px;
  background-color: #f6f3ee;
  box-shadow: 1px 2px 4px #bdbcbc;
  width: 70%;
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
          <a class="navbar-brand" href="#">Selamat Datang Mahasiswa!</a>
        </div>
      </nav>
      <aside class="sidebar">
        <menu>
          <ul class="menu-content">
            <li><a href="mahasiswa.html"><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href="dosenmaha.html"><span>Daftar Dosen</span></a></li>
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
  </form>
  
  <br>

  <div class="container" style="margin-top: 30px;">
        <div class="row">
          <div class="col-md-4">
            <div class="box">
              <div class="row">
              <div class="card-body"><center>
                  <h2 class="card-title">Dashboard</h2>
                  <img class="img-fluid mb-3" src="img/user.png" alt="Card image cap" style="height: 85px; width: 85px;"> <br><br>
                  <a href="mahasiswa.html" class="btn btn-primary">
                  <i class="fa fa-sign-in"></i> Kunjungi Halaman</a>
                  </center>
                </div>
              </div>
            </div>
          </div>

        <div class="col-md-4">
            <div class="box">
              <div class="row">
              <div class="card-body"><center>
                  <h2 class="card-title">Daftar Dosen</h2>
                  <img class="img-fluid mb-3" src="img/admin.png" alt="Card image cap" style="height: 85px; width: 85px;"> <br><br>
                  <a href="dosenmaha.html" class="btn btn-primary">
                  <i class="fa fa-sign-in"></i> Kunjungi Halaman</a></center>
                </div>
              </div>
            </div>
          </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      </section>

      
    </div>


    
  

</body>
</html>