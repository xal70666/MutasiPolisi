
<?php 
if ($_GET[act]==''){ 
?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Master Produk</h3>
                   <?php if($_SESSION[level]!='admin' AND $_SESSION[level]!='user'){ ?>
                  <?php } ?>

                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action='' method='GET'>
                  <a style='margin-right:5px' class='pull-right btn btn-primary btn-sm' href='index.php?view=produk&act=tambahproduk'>Tambahkan Produk</a>
                  </form>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action='' method='POST'>
                <?php 
                    echo "<table id='example1' class='table table-bordered table-striped'>
                    <thead style='background:#00c0ef;'>";
                  echo "<th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";
                    $tampil = mysql_query("SELECT * FROM iw_produk
                        ORDER BY id_produk DESC");
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                      $beli=number_format($r[harga_beli]);
                      $jual=number_format($r[harga_jual]);
                    echo "<tr>";
                              echo "
                              <td width='100px'>$r[id_produk]</td>
                              <td>$r[nm_produk]</td>
                              <td>$beli</td>
                              <td>$jual</td>
                              <td>$r[stok]</td>
                              <td width='100px'><center>
                                  <a class='btn btn-info btn-xs' title='Edit Produk' href='?view=produk&act=editproduk&id=$r[id_produk]'><span class='glyphicon glyphicon-edit'></span></a>

                                </center></td></tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysql_query("DELETE FROM iw_produk where id_produk='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=produk';</script>";
                      }
                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </form>
            </div>
<?php 
}elseif($_GET[act]=='tambahproduk'){
  #cek_session_admin();
  include "../config/library.php";
  include "../config/fungsi_seo.php";
  if (isset($_POST[tambah])){
      $namaproduk = strtoupper($_POST['nama']);
      $bl= $_POST['beli'] ;
      $beli= str_replace(".", "", $bl);
      $jl= $_POST['jual'] ;
      $jual= str_replace(".", "", $jl);

      mysql_query("INSERT INTO iw_produk (nm_produk, harga_beli, harga_jual, stok, keterangan, id_kategori, id_jenis) 
        VALUES ('$namaproduk', '$beli', '$jual', '$_POST[stok]', '$_POST[keterangan]', '$_POST[kategori]', '$_POST[jenis]')");

      echo "<script>document.location='index.php?view=produk'</script>";
  }
  $k=mysql_fetch_array(mysql_query("SELECT count(*) as Kode FROM iw_produk"));
  $kode=$k[Kode]+1;

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Produk</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#produk' id='produk-tab' role='tab' data-toggle='tab' aria-controls='produk' aria-expanded='true'>Data Produk</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='produk' aria-labelledby='produk-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>ID Produk</th> <td><input type='text' class='form-control' name='idproduk' value='$kode' disabled></td></tr>
                              <tr><th scope='row'>Kategori</th> <td><select class='form-control' name='kategori'> 
                                <option value='0' selected>- Pilih Kategori Produk -</option>"; 
                                $kategori = mysql_query("SELECT * FROM iw_kategori");
                                  while($a = mysql_fetch_array($kategori)){
                                    echo "<option value='$a[id_kategori]'>$a[nm_kategori]</option>";
                                      }
                                    echo "</select></td></tr>
                              <tr><th scope='row'>Jenis</th> <td><select class='form-control' name='jenis'> 
                                <option value='0' selected>- Pilih Jenis Produk -</option>"; 
                                $jenis = mysql_query("SELECT * FROM iw_jenis");
                                  while($a = mysql_fetch_array($jenis)){
                                    echo "<option value='$a[id_jenis]'>$a[nm_jenis]</option>";
                                      }
                                    echo "</select></td></tr>
                              <tr><th width='130px' scope='row'>Nama Produk</th> <td><input type='text' class='form-control' name='nama' required></td></tr>
                              <tr><th width='130px' scope='row'>Harga Beli</th> <td><input type='text' class='form-control' id='beli' name='beli' onkeydown='return numbersonly(this, event);' onkeyup='javascript:tandaPemisahTitik(this);' required></td></tr>
                              <tr><th width='130px' scope='row'>Harga Jual</th> <td><input type='text' class='form-control' id='jual' name='jual' onkeydown='return numbersonly(this, event);' onkeyup='javascript:tandaPemisahTitik(this);' required></td></tr>
                              <tr><th width='130px' scope='row'>Stok</th> <td><input type='number' class='form-control' name='stok' required></td></tr>
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
                            <a href='index.php?view=produk'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                          </div> 
                      </div>
                </div>
            </div>
        </div>";

}elseif($_GET[act]=='editproduk'){
  #cek_session_admin();
  include "../config/library.php";
  include "../config/fungsi_seo.php";
  if (isset($_POST[update])){
      $namaproduk = strtoupper($_POST['nama']);

      mysql_query("UPDATE iw_produk SET 
                          nm_produk = '$namaproduk', 
                          harga_beli = '$_POST[beli]',
                          harga_jual = '$_POST[jual]',
                          stok = '$_POST[stok]',
                          keterangan = '$_POST[keterangan]',
                          id_kategori = '$_POST[kategori]',
                          id_jenis = '$_POST[jenis]'
                  WHERE id_produk='$_POST[id]'");
    echo "<script>document.location='index.php?view=produk'</script>";
  }
    include "../config/library.php";
    $s=mysql_fetch_array(mysql_query("SELECT * FROM iw_produk WHERE id_produk='$_GET[id]'"));
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Produk</h3>
                </div>
                <div class='box-body'>
                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#produk' id='produk-tab' role='tab' data-toggle='tab' aria-controls='produk' aria-expanded='true'>Data Produk </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='produk' aria-labelledby='produk-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                            <input type='hidden' value='$s[id_produk]' name='id'>
                            <tr><th width='130px' scope='row'>ID Produk</th> <td><input type='text' class='form-control' value='$s[id_produk]' name='idproduk' disabled></td></tr>
                              <tr><th scope='row'>Kategori Produk</th> <td><select class='form-control' name='kategori'> 
                              <option value='0' selected>- Pilih Kategori Produk -</option>"; 
                                $kategori = mysql_query("SELECT * FROM iw_kategori");
                                while($a = mysql_fetch_array($kategori)){
                                if ($a[id_kategori] == $s[id_kategori]){
                                echo "<option value='$a[id_kategori]' selected>$a[nm_kategori]</option>";}else{echo "<option value='$a[id_kategori]'>$a[nm_kategori]</option>";}}
                                echo "</select></td></tr>
                              <tr><th scope='row'>Jenis Produk</th> <td><select class='form-control' name='jenis'> 
                              <option value='0' selected>- Pilih Jenis Produk -</option>"; 
                                $jenis = mysql_query("SELECT * FROM iw_jenis");
                                while($a = mysql_fetch_array($jenis)){
                                if ($a[id_jenis] == $s[id_jenis]){
                                echo "<option value='$a[id_jenis]' selected>$a[nm_jenis]</option>";}else{echo "<option value='$a[id_jenis]'>$a[nm_jenis]</option>";}}
                                echo "</select></td></tr>    
                              <tr><th width='130px' scope='row'>Nama Produk</th> <td><input type='text' class='form-control' value='$s[nm_produk]' name='nama' required></td></tr>
                              <tr><th width='130px' scope='row'>Harga Beli</th> <td><input type='text' class='form-control' value='$s[harga_beli]' name='beli' required></td></tr>
                              <tr><th width='130px' scope='row'>Harga Jual</th> <td><input type='text' class='form-control' value='$s[harga_jual]' name='jual' required></td></tr>
                              <tr><th width='130px' scope='row'>Stok</th> <td><input type='number' class='form-control' value='$s[stok]' name='stok' required></td></tr>
                              <tr><th scope='row'>Keterangan</th><td><textarea rows='6' class='form-control' value='$s[keterangan]' name='keterangan' placeholder='Tuliskan Keterangan (Max 160 Karakter)...' onKeyDown=\"textCounter(this.form.keterangan,this.form.countDisplay);\" onKeyUp=\"textCounter(this.form.keterangan,this.form.countDisplay);\" >$s[keterangan]</textarea>
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
                          <button type='submit' name='update' class='btn btn-info'>Update</button>
                          <a href='index.php?view=produk'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                        </div> 
                        </form>
                    </div>
            </div>";

}
?>