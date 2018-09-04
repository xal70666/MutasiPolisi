<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SiPanjul Iwan Motor | Log in</title>
    <meta name="author" content="sipanjul">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <link rel="shortcut icon" href="faviconiw.png" />
  </head>
  
  <body class="hold-transition login-page">
    <body style="background-image: url('assets/img/bg1.png');">
                  <br>
          <div class="container">
            <div class="row">
              <div class="col-sm-3"></div>
              <div class="col-sm-6">
                <div class="box-primary">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title">Form Login SiPanjul</h3></div>
                      <div class="panel-body"><br>
                        <center><img width="100px" style="" class="img-thumbnail" src="assets/img/logo iw.png"></center>
                      </div>
                        <center><h2 class="text-primary" style="text-transform: uppercase;font-family: sans-serif;">SiPanjul Iwan Motor Bekasi </h2></center>
                        <hr>
                      <form  class="form-horizontal" role="form" action="" method="post">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Username <i class="glyphicon glyphicon-user"></i> :</label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" name='a' placeholder="Masukan Username" required autofocus="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Password <i class="glyphicon glyphicon-lock"></i> :</label>
                          <div class="col-sm-6">
                            <input type="password" class="form-control" name='b' placeholder="Masukan Password" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label"></label>
                          <div class="col-sm-6">
                                <span class="text-primary"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label"></label>
                          <div class="col-sm-6">
                            <button name="login" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-sign-out"></i> Masuk</button>
                            <a href="index.php"  class="btn btn-warning btn-sm"><i class="fa fa-remove"></i> Batal</a>
                          </div>
                        </div>
                      </form>
                      <hr>
                     <div><center>Develop by: 
                     <img width="30px" src="assets/img/logo iw.png"><hr>
                      </div></center>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>

<?php 

if (isset($_POST[login])){
 $passlain=anti_injection($_POST[b]);
 $pass    =anti_injection(md5($_POST[b]));
 //$data=md5(anti_injection($_POST[b]));
 //$pass=hash("sha512",$data);
 $admin = mysql_query("SELECT * FROM iw_users WHERE username='".anti_injection($_POST[a])."' AND password='$pass'");
 $kasir = mysql_query("SELECT * FROM iw_users WHERE username='".anti_injection($_POST[a])."' AND password='$passlain'");
 $user = mysql_query("SELECT * FROM iw_users WHERE username='".anti_injection($_POST[a])."' AND password='$pass'");
 
 $hitungadmin = mysql_num_rows($admin);
 $hitungkasir = mysql_num_rows($kasir);
 $hitunguser = mysql_num_rows($user);
 if ($hitungadmin >= 1){
    $r = mysql_fetch_array($admin);
    $_SESSION[id]           = $r[username];
    $_SESSION[namalengkap]  = $r[nama_lengkap];
    $_SESSION[level]        = $r[level];
    include "config/user_agent.php";
    mysql_query("INSERT INTO iw_users_aktivitas VALUES('','$r[id_user]','$ip','$user_browser $version','$user_os','$r[level]','".date('H:i:s')."','".date('Y-m-d')."')");
    echo "<script>document.location='index.php';</script>";
 }elseif ($hitungkasir >= 1){
    $r = mysql_fetch_array($kasir);
    $_SESSION[id]           = $r[username];
    $_SESSION[namalengkap]  = $r[nama_lengkap];
    $_SESSION[level]        = $r[level];
    include "config/user_agent.php";
    mysql_query("INSERT INTO iw_users_aktivitas VALUES('','$r[nip]','$ip','$user_browser $version','$user_os','guru','".date('H:i:s')."','".date('Y-m-d')."')");
    echo "<script>document.location='index.php';</script>";
 }elseif ($hitunguser >= 1){
    $r = mysql_fetch_array($user);
    $_SESSION[id]           = $r[username];
    $_SESSION[namalengkap]  = $r[nama_lengkap];
    $_SESSION[level]        = $r[level];
    include "config/user_agent.php";
    mysql_query("INSERT INTO iw_users_aktivitas VALUES('','$r[nisn]','$ip','$user_browser $version','$user_os','siswa','".date('H:i:s')."','".date('Y-m-d')."')");
    echo "<script>document.location='index.php';</script>";
 }else{
    echo "<script>window.alert('Maaf, Anda Tidak Memiliki akses');
                                  window.location=('index.php?view=login')</script>";
 }
}
?>

          
