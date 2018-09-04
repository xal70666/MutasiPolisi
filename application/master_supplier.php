
<?php 
if ($_GET[act]==''){ 
?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Master Supplier</h3>
                   <?php if($_SESSION[level]!='admin' AND $_SESSION[level]!='user'){ ?>
                  <?php } ?>

                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action='' method='GET'>
                  <a style='margin-right:5px' class='pull-right btn btn-primary btn-sm' href='index.php?view=supplier&act=tambahsupplier'>Tambahkan Supplier</a>
                  </form>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action='' method='POST'>
                <?php 
                    echo "<table id='example1' class='table table-bordered table-striped'>
                    <thead style='background:#00c0ef;'>";
                  echo "<th>ID Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";
                    $tampil = mysql_query("SELECT * FROM iw_supplier
                        ORDER BY id_supplier DESC");
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                    echo "<tr>";
                              echo "
                              <td width='100px'>$r[id_supplier]</td>
                              <td>$r[nm_supplier]</td>
                              <td>$r[alamat]</td>
                              <td>$r[no_telp]</td>
                              <td width='100px'><center>
                                  <a class='btn btn-info btn-xs' title='Edit Supplier' href='?view=supplier&act=editsupplier&id=$r[id_supplier]'><span class='glyphicon glyphicon-edit'></span></a>

                                </center></td></tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysql_query("DELETE FROM iw_kategori where id_kategori='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=kategori';</script>";
                      }
                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </form>
            </div>
<?php 
}elseif($_GET[act]=='tambahsupplier'){
  #cek_session_admin();
  include "../config/library.php";
  include "../config/fungsi_seo.php";
  if (isset($_POST[tambah])){
      $namasupplier = strtoupper($_POST['nama']);

      mysql_query("INSERT INTO iw_supplier (nm_supplier, alamat, no_telp, keterangan) VALUES ('$namasupplier', '$_POST[alamat]', '$_POST[notelp]', '$_POST[keterangan]')");

      echo "<script>document.location='index.php?view=supplier'</script>";
  }
  $k=mysql_fetch_array(mysql_query("SELECT count(*) as Kode FROM iw_supplier"));
  $kode=$k[Kode]+1;

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Supplier</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#supplier' id='supplier-tab' role='tab' data-toggle='tab' aria-controls='supplier' aria-expanded='true'>Data Supplier </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='supplier' aria-labelledby='supplier-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>ID Supplier</th> <td><input type='text' class='form-control' name='idsupplier' value='$kode' disabled></td></tr>
                              <tr><th width='130px' scope='row'>Nama Supplier</th> <td><input type='text' class='form-control' name='nama' required></td></tr>
                              <tr><th width='130px' scope='row'>Alamat</th> <td><input type='text' class='form-control' name='alamat' required></td></tr>
                              <tr><th width='130px' scope='row'>No Telepon</th> <td><input type='text' class='form-control' name='notelp' required></td></tr>
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
                            <a href='index.php?view=supplier'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                          </div> 
                      </div>
                </div>
            </div>
        </div>";

}elseif($_GET[act]=='editsupplier'){
  #cek_session_admin();
  include "../config/library.php";
  include "../config/fungsi_seo.php";
  if (isset($_POST[update])){
      $namasupplier = strtoupper($_POST['nama']);
      mysql_query("UPDATE iw_supplier SET 
                          nm_supplier = '$namasupplier', 
                          alamat = '$_POST[alamat]',
                          no_telp = '$_POST[notelp]',
                          keterangan = '$_POST[keterangan]',
                          status = '$_POST[status]'
                  WHERE id_supplier='$_POST[id]'");
    echo "<script>document.location='index.php?view=supplier'</script>";
  }
    include "../config/library.php";
    $s=mysql_fetch_array(mysql_query("SELECT * FROM iw_supplier WHERE id_supplier='$_GET[id]'"));
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Supplier</h3>
                </div>
                <div class='box-body'>
                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#supplier' id='supplier-tab' role='tab' data-toggle='tab' aria-controls='supplier' aria-expanded='true'>Data Supplier </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='supplier' aria-labelledby='supplier-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                            <input type='hidden' value='$s[id_supplier]' name='id'>
                            <tr><th width='130px' scope='row'>ID Supplier</th> <td><input type='text' class='form-control' value='$s[id_supplier]' name='idsupplier' disabled></td></tr>
                              <tr><th width='130px' scope='row'>Nama Supplier</th> <td><input type='text' class='form-control' value='$s[nm_supplier]' name='nama' required></td></tr>
                              <tr><th width='130px' scope='row'>Alamat</th> <td><input type='text' class='form-control' value='$s[alamat]' name='alamat' required></td></tr>
                              <tr><th width='130px' scope='row'>No Telepon</th> <td><input type='text' class='form-control' value='$s[no_telp]' name='notelp' required></td></tr>
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
                          <a href='index.php?view=supplier'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                        </div> 
                        </form>
                    </div>
            </div>";

}
?>