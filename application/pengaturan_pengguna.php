
<?php 
if ($_GET[act]==''){ 
?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Pengaturan Pengguna</h3>
                   <?php if($_SESSION[level]!='admin' AND $_SESSION[level]!='user'){ ?>
                  <?php } ?>

                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action='' method='GET'>
                  <a style='margin-right:5px' class='pull-right btn btn-primary btn-sm' href='index.php?view=pengaturanpengguna&act=tambahpengguna'>Tambahkan Pengguna</a>
                  </form>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action='' method='POST'>
                <?php 
                    echo "<table id='example1' class='table table-bordered table-striped'>
                    <thead style='background:#00c0ef;'>";
                  echo "<th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Level</th>
                        <th>Blokir</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";
                    $tampil = mysql_query("SELECT * FROM iw_users
                        ORDER BY username DESC");
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                    echo "<tr>";
                              echo "
                              <td width='150px'>$r[username]</td>
                              <td>$r[nama_lengkap]</td>
                              <td>$r[level]</td>
                              <td>";if($r[blokir]=='N'){echo"Aktif";}else{echo"Non Aktif";}echo"</td>
                              <td width='100px'><center>
                                  <a class='btn btn-info btn-xs' title='Edit Pengguna' href='?view=pengaturanpengguna&act=editpengguna&id=$r[username]'><span class='glyphicon glyphicon-edit'></span></a>

                                </center></td></tr>";
                      $no++;
                      }
                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </form>
            </div>
<?php 
}elseif($_GET[act]=='tambahpengguna'){
  #cek_session_admin();
  include "../config/library.php";
  include "../config/fungsi_seo.php";
  if (isset($_POST[tambah])){
      $pass = md5($_POST[password]);

      mysql_query("INSERT INTO iw_users (username, password, nama_lengkap, email, no_telp, level, id_session) 
        VALUES ('$_POST[username]', '$pass', '$_POST[nama]', '$_POST[email]', '$_POST[telp]', '$_POST[level]', '$pass')");
      echo "<script>document.location='index.php?view=pengaturanpengguna'</script>";
  }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Pengguna</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#pengguna' id='pengguna-tab' role='tab' data-toggle='tab' aria-controls='pengguna' aria-expanded='true'>Data Pengguna </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='pengguna' aria-labelledby='pengguna-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>Username</th> <td><input type='text' class='form-control' name='username' required></td></tr>
                              <tr><th width='130px' scope='row'>Password</th> <td><input type='password' class='form-control' name='password' required></td></tr>
                              <tr><th width='130px' scope='row'>Nama Lengkap</th> <td><input type='text' class='form-control' name='nama' required></td></tr>
                              <tr><th width='130px' scope='row'>Email</th> <td><input type='text' class='form-control' name='email' required></td></tr>
                              <tr><th width='130px' scope='row'>No Telepon</th> <td><input type='text' class='form-control' name='telp' required></td></tr>
                              <tr><th scope='row'>Level</th> <td><select class='form-control' name='level'>"; 
                                    echo "<option value='user' selected>User</option>";
                                    echo "<option value='admin'>Admin</option>";
                                    echo "</select></td></tr>
                            </tbody>
                            </table>
                          </div>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                            </tbody>
                            </table>
                          </div>  
                          <div style='clear:both'></div>
                          <div class='box-footer'>
                            <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                            <a href='index.php?view=pengaturanpengguna'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                          </div> 
                      </div>
                </div>
            </div>
        </div>";

}elseif($_GET[act]=='editpengguna'){
  #cek_session_admin();
  include "../config/library.php";
  include "../config/fungsi_seo.php";
  if (isset($_POST[update])){
    $pass = md5($_POST[password]);
      if (trim($_POST[password])==''){
        mysql_query("UPDATE iw_users SET nama_lengkap = '$_POST[nama]',
                                         email = '$_POST[email]',
                                         no_telp = '$_POST[telp]',
                                         level = '$_POST[level]',
                                         blokir = '$_POST[blokir]' where username='$_POST[id]'");
      }else{
        mysql_query("UPDATE iw_users SET password = '$pass',
                                         nama_lengkap = '$_POST[nama]',
                                         email = '$_POST[email]',
                                         no_telp = '$_POST[telp]',
                                         level = '$_POST[level]',
                                         blokir = '$_POST[blokir]' where username='$_POST[id]'");
      }
    echo "<script>document.location='index.php?view=pengaturanpengguna'</script>";
  }
  $s=mysql_fetch_array(mysql_query("SELECT * FROM iw_users WHERE username='$_GET[id]'"));

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Pengguna</h3>
                </div>
                <div class='box-body'>
                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#pengguna' id='pengguna-tab' role='tab' data-toggle='tab' aria-controls='pengguna' aria-expanded='true'>Data Pengguna </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='jenis' aria-labelledby='pengguna-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                            <input type='hidden' value='$s[username]' name='id'>
                            <tr><th width='130px' scope='row'>Username</th> <td><input type='text' class='form-control' value='$s[username]' name='username' disabled></td></tr>
                            <tr><th width='130px' scope='row'>Password</th> <td><input type='text' class='form-control' placeholder='Kosongkan saja Jika Password tidak diganti,...' name='password'></td></tr>
                            <tr><th width='130px' scope='row'>Nama Lengkap</th> <td><input type='text' class='form-control' value='$s[nama_lengkap]' name='nama' required></td></tr>
                            <tr><th width='130px' scope='row'>Email</th> <td><input type='text' class='form-control' value='$s[email]' name='email' required></td></tr>
                            <tr><th width='130px' scope='row'>No Telepon</th> <td><input type='text' class='form-control' value='$s[no_telp]' name='telp' required></td></tr>
                            <tr><th scope='row'>Level</th> <td>";
                              if ($s[level]=='admin'){
                              echo "<input type='radio' name='level' value='admin' checked> Admin
                              <input type='radio' name='level' value='user'> User";
                                }else{echo "<input type='radio' name='level' value='admin'> Admin
                              <input type='radio' name='level' value='user' checked> User";} echo "</td></tr>
                            <tr><th scope='row'>Blokir</th> <td>";
                              if ($s[blokir]=='N'){
                              echo "<input type='radio' name='blokir' value='N' checked> Aktif
                              <input type='radio' name='blokir' value='Y'> Non Aktif";
                                }else{echo "<input type='radio' name='blokir' value='N'> Aktif
                              <input type='radio' name='blokir' value='Y' checked> Non Aktif";} echo "</td></tr>

                          </tbody>
                          </table>
                        </div>
                        <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>                            
                          </tbody>
                          </table>
                        </div>  
                        <div style='clear:both'></div>
                        <div class='box-footer'>
                          <button type='submit' name='update' class='btn btn-info'>Update</button>
                          <a href='index.php?view=pengaturanpengguna'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                        </div> 
                        </form>
                    </div>
            </div>";

}
?>