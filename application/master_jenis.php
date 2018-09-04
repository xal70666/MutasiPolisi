
<?php 
if ($_GET[act]==''){ 
?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Master Jenis</h3>
                   <?php if($_SESSION[level]!='admin' AND $_SESSION[level]!='user'){ ?>
                  <?php } ?>

                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action='' method='GET'>
                  <a style='margin-right:5px' class='pull-right btn btn-primary btn-sm' href='index.php?view=jenis&act=tambahjenis'>Tambahkan Jenis</a>
                  </form>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action='' method='POST'>
                <?php 
                    echo "<table id='example1' class='table table-bordered table-striped'>
                    <thead style='background:#00c0ef;'>";
                  echo "<th>ID Jenis</th>
                        <th>Nama Kategori</th>
                        <th>Nama Jenis</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";
                    $tampil = mysql_query("SELECT * FROM iw_jenis
                        ORDER BY id_jenis DESC");
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                      $k=mysql_fetch_array(mysql_query("SELECT * FROM iw_kategori WHERE id_kategori='$r[id_kategori]'"));
                    echo "<tr>";
                              echo "
                              <td width='100px'>$r[id_jenis]</td>
                              <td>$k[nm_kategori]</td>
                              <td>$r[nm_jenis]</td>
                              <td>$r[status]</td>
                              <td width='100px'><center>
                                  <a class='btn btn-info btn-xs' title='Edit Jenis' href='?view=jenis&act=editjenis&id=$r[id_jenis]'><span class='glyphicon glyphicon-edit'></span></a>

                                </center></td></tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysql_query("DELETE FROM iw_jenis where id_jenis='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=jenis';</script>";
                      }
                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </form>
            </div>
<?php 
}elseif($_GET[act]=='tambahjenis'){
  #cek_session_admin();
  include "../config/library.php";
  include "../config/fungsi_seo.php";
  if (isset($_POST[tambah])){
      $namajenis = strtoupper($_POST['nama']);

      mysql_query("INSERT INTO iw_jenis (nm_jenis, keterangan, id_kategori) VALUES ('$namajenis', '$_POST[keterangan]', '$_POST[kategori]')");

      echo "<script>document.location='index.php?view=jenis'</script>";
  }
  $k=mysql_fetch_array(mysql_query("SELECT count(*) as Kode FROM iw_jenis"));
  $kode=$k[Kode]+1;

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Jenis</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#tangki' id='tangki-tab' role='tab' data-toggle='tab' aria-controls='tangki' aria-expanded='true'>Data Jenis </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='jenis' aria-labelledby='jenis-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>ID Jenis</th> <td><input type='text' class='form-control' name='idjenis' value='$kode' disabled></td></tr>
                              <tr><th scope='row'>Kategori</th> <td><select class='form-control' name='kategori'> 
                                <option value='0' selected>- Pilih Kategori -</option>"; 
                                $kategori = mysql_query("SELECT * FROM iw_kategori");
                                  while($a = mysql_fetch_array($kategori)){
                                    echo "<option value='$a[id_kategori]'>$a[nm_kategori]</option>";
                                      }
                                    echo "</select></td></tr>
                              <tr><th width='130px' scope='row'>Nama Jenis</th> <td><input type='text' class='form-control' name='nama' required></td></tr>
                              <tr><th scope='row'>Keterangan</th><td><textarea rows='6' class='form-control' name='keterangan' placeholder='Tuliskan Keterangan (Max 160 Karakter)...' onKeyDown=\"textCounter(this.form.keterangan,this.form.countDisplay);\" onKeyUp=\"textCounter(this.form.keterangan,this.form.countDisplay);\" ></textarea>
                                              <input type='number' name='countDisplay' size='3' maxlength='3' value='160' style='width:20%; text-align:center' readonly> 
                                              Sisa Karakter</td></tr>
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
                            <a href='index.php?view=jenis'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                          </div> 
                      </div>
                </div>
            </div>
        </div>";

}elseif($_GET[act]=='editjenis'){
  #cek_session_admin();
  include "../config/library.php";
  include "../config/fungsi_seo.php";
  if (isset($_POST[update])){
      $namajenis = strtoupper($_POST['nama']);
      mysql_query("UPDATE iw_jenis SET 
                          nm_jenis = '$namajenis', 
                          keterangan = '$_POST[keterangan]',
                          status = '$_POST[status]'
                  WHERE id_jenis='$_POST[id]'");
    echo "<script>document.location='index.php?view=jenis'</script>";
  }
  $s=mysql_fetch_array(mysql_query("SELECT * FROM iw_jenis WHERE id_jenis='$_GET[id]'"));

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Jenis</h3>
                </div>
                <div class='box-body'>
                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#jenis' id='jenis-tab' role='tab' data-toggle='tab' aria-controls='jenis' aria-expanded='true'>Data Jenis </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='jenis' aria-labelledby='jenis-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                            <input type='hidden' value='$s[id_jenis]' name='id'>
                            <tr><th width='130px' scope='row'>ID Jenis</th> <td><input type='text' class='form-control' value='$s[id_jenis]' name='idjenis' disabled></td></tr>
                              <tr><th scope='row'>Kategori</th> <td><select class='form-control' name='kategori'> 
                              <option value='0' selected>- Pilih Kategori -</option>"; 
                                $kategori = mysql_query("SELECT * FROM iw_kategori");
                                while($a = mysql_fetch_array($kategori)){
                                if ($_SESSION[level] == 'user'){
                                if ($a[id_kategori] == $s[id_kategori]){
                                echo "<option value='$a[id_kategori]' selected>$a[nm_kategori]</option>";}}else{
                                if ($a[id_kategori] == $s[id_kategori]){
                                echo "<option value='$a[id_kategori]' selected>$a[nm_kategori]</option>";}else{echo "<option value='$a[id_kategori]'>$a[nm_kategori]</option>";}}}echo "</select></td></tr>
                              <tr><th width='130px' scope='row'>Nama Jenis</th> <td><input type='text' class='form-control' value='$s[nm_jenis]' name='nama' required></td></tr>
                              <tr><th scope='row'>Keterangan</th><td><textarea rows='6' class='form-control' value='$s[keterangan]' name='keterangan' placeholder='Tuliskan Keterangan (Max 160 Karakter)...' onKeyDown=\"textCounter(this.form.keterangan,this.form.countDisplay);\" onKeyUp=\"textCounter(this.form.keterangan,this.form.countDisplay);\" >$s[keterangan]</textarea>
                                              <input type='number' name='countDisplay' size='3' maxlength='3' value='160' style='width:20%; text-align:center' readonly> 
                                              Sisa Karakter</td></tr>
                            <tr><th scope='row'>Status</th> <td>";
                              if ($s[status]=='Y'){
                              echo "<input type='radio' name='status' value='Y' checked> Aktif
                              <input type='radio' name='status' value='N'> Tidak Aktif";
                                }else{echo "<input type='radio' name='status' value='Y'> Aktif
                              <input type='radio' name='status' value='N' checked> Tidak Aktif";} echo "</td></tr>

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
                          <a href='index.php?view=jenis'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                        </div> 
                        </form>
                    </div>
            </div>";

}
?>