
<?php 
if ($_GET[act]==''){ 
?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Master Type</h3>
                   <?php if($_SESSION[level]!='admin' AND $_SESSION[level]!='user'){ ?>
                  <?php } ?>

                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action='' method='GET'>
                  <a style='margin-right:5px' class='pull-right btn btn-primary btn-sm' href='index.php?view=type&act=tambahtype'>Tambahkan Type</a>
                  </form>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action='' method='POST'>
                <?php 
                    echo "<table id='example1' class='table table-bordered table-striped'>
                    <thead style='background:#00c0ef;'>";
                  echo "<th>ID Type</th>
                        <th>Nama Type</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";
                    $tampil = mysql_query("SELECT * FROM iw_type
                        ORDER BY id_type DESC");
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                    echo "<tr>";
                              echo "
                              <td width='100px'>$r[id_type]</td>
                              <td>$r[nm_type]</td>
                              <td>$r[status]</td>
                              <td width='100px'><center>
                                  <a class='btn btn-info btn-xs' title='Edit Type' href='?view=type&act=edittype&id=$r[id_type]'><span class='glyphicon glyphicon-edit'></span></a>

                                </center></td></tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysql_query("DELETE FROM iw_type where id_type='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=type';</script>";
                      }
                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </form>
            </div>
<?php 
}elseif($_GET[act]=='tambahtype'){
  #cek_session_admin();
  include "../config/library.php";
  include "../config/fungsi_seo.php";
  if (isset($_POST[tambah])){
      $namatype = strtoupper($_POST['nama']);

      mysql_query("INSERT INTO iw_type (nm_type, keterangan) VALUES ('$namatype', '$_POST[keterangan]')");

      echo "<script>document.location='index.php?view=type'</script>";
  }
  $k=mysql_fetch_array(mysql_query("SELECT count(*) as Kode FROM iw_type"));
  $kode=$k[Kode]+1;

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Type</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#tangki' id='tangki-tab' role='tab' data-toggle='tab' aria-controls='tangki' aria-expanded='true'>Data Type </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='type' aria-labelledby='type-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>ID Type</th> <td><input type='text' class='form-control' name='idtype' value='$kode' disabled></td></tr>
                              <tr><th width='130px' scope='row'>Nama Type</th> <td><input type='text' class='form-control' name='nama' required></td></tr>
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
                            <a href='index.php?view=type'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                          </div> 
                      </div>
                </div>
            </div>
        </div>";

}elseif($_GET[act]=='edittype'){
  #cek_session_admin();
  include "../config/library.php";
  include "../config/fungsi_seo.php";
  if (isset($_POST[update])){
      $namatype = strtoupper($_POST['nama']);
      mysql_query("UPDATE iw_type SET 
                          nm_type = '$namatype', 
                          keterangan = '$_POST[keterangan]',
                          status = '$_POST[status]'
                  WHERE id_type='$_POST[id]'");
    echo "<script>document.location='index.php?view=type'</script>";
  }
  $s=mysql_fetch_array(mysql_query("SELECT * FROM iw_type WHERE id_type='$_GET[id]'"));

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Type</h3>
                </div>
                <div class='box-body'>
                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#type' id='type-tab' role='tab' data-toggle='tab' aria-controls='type' aria-expanded='true'>Data Type </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='type' aria-labelledby='type-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                            <input type='hidden' value='$s[id_type]' name='id'>
                            <tr><th width='130px' scope='row'>ID Type</th> <td><input type='text' class='form-control' value='$s[id_type]' name='idtype' disabled></td></tr>
                              <tr><th width='130px' scope='row'>Nama Type</th> <td><input type='text' class='form-control' value='$s[nm_type]' name='nama' required></td></tr>
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
                          <a href='index.php?view=type'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                        </div> 
                        </form>
                    </div>
            </div>";

}
?>