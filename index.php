<!-- rubah ubay -->
<?php
  session_start();
  error_reporting(0);
  include "config/koneksi.php";
  include "config/library.php";
  include "config/fungsi_indotgl.php";
  include "config/fungsi_seo.php";
  include "config/fungsi_rupiah.php";
  if (isset($_SESSION[id])){
      if ($_SESSION[level]=='admin'){
          $iden = mysql_fetch_array(mysql_query("SELECT * FROM iw_users where username='$_SESSION[id]'"));
           $nama =  $iden[nama_lengkap];
           $level = 'Administrator';
           $foto = 'dist/img/avatar5.png';
      }elseif($_SESSION[level]=='user'){
          $iden = mysql_fetch_array(mysql_query("SELECT * FROM iw_users where username='$_SESSION[id]'"));
           $nama =  $iden[nama_lengkap];
           $level = 'User';
           if (trim($gu[foto])==''){
              $foto = 'dist/img/avatar5.png';
           }else{
              $foto = 'foto_pegawai/'.$gu[foto];
           }
      }elseif($_SESSION[level]=='kasir'){
          $iden = mysql_fetch_array(mysql_query("SELECT * FROM iw_users where username='$_SESSION[id]'"));
           $nama =  $iden[nama_lengkap];
           $level = '';
           if (trim($gu[foto])==''){
              $foto = 'dist/img/avatar5.png';
           }else{
              $foto = 'foto_pegawai/'.$gu[foto];
           }
      }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SiPanjul || Iwan Motor</title>
    <meta name="author" content="sipanjul">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<!-- start datepicker -->
  <link href="jquery-ui-1.11.4/smoothness/jquery-ui.css" rel="stylesheet" />
  <script src="jquery-ui-1.11.4/external/jquery/jquery.js"></script>
  <script src="jquery-ui-1.11.4/jquery-ui.js"></script>
  <script src="jquery-ui-1.11.4/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="jquery-ui-1.11.4/jquery-ui.theme.css">
  <script>
   $(document).ready(function(){
    $("#tanggal").datepicker({
    })
   })
  </script>
<!-- end datepicker -->
<!-- start titik otomatis pada angka bayar -->
  <script type="text/javascript" src="my.js"></script>
<!-- end titik otomatis pada angka bayar -->
<!-- bootstrap css POP UP -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library POP UP -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<!-- bootstrap js POP UP -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- start autocomplate -->
<!-- end autocomplate -->
<!-- start data tampil ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript">
            function isi_otomatis(){
                var nim = $("#nim").val();
                $.ajax({
                    url: 'proses-ajax.php',
                    data:"nim="+nim ,
                }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);
                    $('#nama').val(obj.nama);
                    $('#jurusan').val(obj.jurusan);
                    $('#alamat').val(obj.alamat);
                });
            }
        </script>
<!-- end data tampil ajax -->
    <style type="text/css"> .files{ position:absolute; z-index:2; top:0; left:0; filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; opacity:0; background-color:transparent; color:transparent; } </style>
    <script type="text/javascript" src="plugins/jQuery/jquery-1.12.3.min.js"></script>
    <script language="javascript" type="text/javascript">
      var maxAmount = 160;
      function textCounter(textField, showCountField) {
        if (textField.value.length > maxAmount) {
          textField.value = textField.value.substring(0, maxAmount);
        } else {
          showCountField.value = maxAmount - textField.value.length;
        }
      }

    </script>

    <script type="text/javascript" src="js/jscolor.js"></script>

    <link rel="stylesheet" href="style.css" type="text/css" />

  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
          <?php include "main-header.php"; ?>
      </header>

      <aside class="main-sidebar">
            <?php
              if ($_SESSION[level]=='user'){
                include "menu-user.php";
              }elseif ($_SESSION[level]=='kasir'){
                include "menu-kasir.php";
              }elseif ($_SESSION[level]=='admin'){
                include "menu-admin.php";
              }else{
                include "menu-default.php";
              }
            ?>
      </aside>

      <div class="content-wrapper">
        <section class="content-header">
          <h1> Dashboard <small>Control panel</small> </h1>
        </section>

        <section class="content">
        <?php
          if ($_GET[view]=='home' OR $_GET[view]==''){
              if($_SESSION[level]=='admin'){
                  include "application/home_admin.php";
              }elseif($_SESSION[level]=='user'){
                  echo "<div class='row'>";
                          include "application/home_user_row1.php";
                  echo "</div>
                        <div class='row'>";
                          include "application/home_user_row2.php";
                  echo "</div>";
              }else{
                  echo "<div class='row'>";
                          include "application/home_default.php";
                  echo "</div>
                        <div class='row'>";
                          include "";
                  echo "</div>";
              }
          }
// DATA MASTER ////////////////////////////////////////////////////
          elseif ($_GET[view]=='kategori'){
            echo "<div class='row'>";
                    include "application/master_kategori.php";
            echo "</div>";
          }elseif ($_GET[view]=='jenis'){
            echo "<div class='row'>";
                    include "application/master_jenis.php";
            echo "</div>";
          }elseif ($_GET[view]=='produk'){
            echo "<div class='row'>";
                    include "application/master_produk.php";
            echo "</div>";
          }elseif ($_GET[view]=='supplier'){
            echo "<div class='row'>";
                    include "application/master_supplier.php";
            echo "</div>";
          }elseif ($_GET[view]=='merk'){
            echo "<div class='row'>";
                    include "application/master_merk.php";
            echo "</div>";
          }elseif ($_GET[view]=='type'){
            echo "<div class='row'>";
                    include "application/master_type.php";
            echo "</div>";
<<<<<<< HEAD
          }
=======
          }  
// DATA TRANSAKSI ///////////////////////////////////////////////
          elseif ($_GET[view]=='pembelian'){
            echo "<div class='row'>";
                    include "application/transaksi_pembelian.php";
            echo "</div>";
          }elseif ($_GET[view]=='penjualan'){
            echo "<div class='row'>";
                    include "application/transaksi_penjualan.php";
            echo "</div>";
          }		  
>>>>>>> babfd38df4acd38b54eb883366327c27c5242994
// DATA MASTER MUTASI ////////////////////////////////////////////////////
          elseif ($_GET[view]=='polda'){
            echo "<div class='row'>";
                    include "application/master_polda.php";
            echo "</div>";
          }elseif ($_GET[view]=='pangkat'){
            echo "<div class='row'>";
                    include "application/master_pangkat.php";
            echo "</div>";
          }elseif ($_GET[view]=='pendidikan'){
            echo "<div class='row'>";
                    include "application/master_pendidikan.php";
            echo "</div>";
<<<<<<< HEAD
          }
// DATA TRANSAKSI ///////////////////////////////////////////////
          elseif ($_GET[view]=='pembelian'){
=======
          }     
// DATA MUTASI POLRI ///////////////////////////////////////////////
          elseif ($_GET[view]=='mutasi'){
>>>>>>> babfd38df4acd38b54eb883366327c27c5242994
            echo "<div class='row'>";
                    include "application/mutasi_polri.php";
            echo "</div>";
          }		  
// DATA LAPORAN ////////////////////////////////////////////////////
          elseif ($_GET[view]=='laporanpembelian'){
            echo "<div class='row'>";
                    include "application/laporan_pembelian.php";
            echo "</div>";
          }elseif ($_GET[view]=='laporanpenjualan'){
            echo "<div class='row'>";
                    include "application/laporan_penjualan.php";
            echo "</div>";
          }elseif ($_GET[view]=='stockopname'){
            echo "<div class='row'>";
                    include "application/laporan_stockopname.php";
            echo "</div>";
          }
// DATA PENGATURAN ////////////////////////////////////////////////////
          elseif ($_GET[view]=='pengaturanstok'){
            echo "<div class='row'>";
                    include "application/pengaturan_stok.php";
            echo "</div>";
          }elseif ($_GET[view]=='pengaturanpengguna'){
            echo "<div class='row'>";
                    include "application/pengaturan_pengguna.php";
            echo "</div>";
          }

        ?>
        </section>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
          <?php include "footer.php"; ?>
      </footer>
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>

    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

        $('#example3').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": false,
          "autoWidth": false,
          "pageLength": 200
        });
      });
      $('.datepicker').datepicker();
    </script>



  </body>
</html>

<?php
  }else{
    include "login.php";
  }
?>
