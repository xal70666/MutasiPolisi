
<?php 
if ($_GET[act]==''){ 
?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">DAFTAR MUTASI POLRI</h3>
                   <?php if($_SESSION[level]!='admin' AND $_SESSION[level]!='user'){ ?>
                  <?php } ?>

                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action='' method='GET'>
                  <a style='margin-right:5px' class='pull-right btn btn-primary btn-sm' href='index.php?view=mutasi&act=tambahmutasi'>Tambahkan Mutasi</a>
                  </form>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action='' method='POST'>
                <?php 
                    echo "<table id='example1' class='table table-bordered table-striped'>
                    <thead style='background:#00c0ef;'>";
                  echo "<th>ID Mutasi</th>
						<th>Nama Anggota POLRI</th>
                        <th>POLDA</th>
						<th>Pangkat</th>
						<th>Pendidikan Kepolisian</th>
						<th>Keterangan</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";
                    $tampil = mysql_query("SELECT * FROM iw_mutasi
                        ORDER BY id_mutasi DESC");
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                    echo "<tr>";
                              echo "
                              <td width='100px'>$r[id_mutasi]</td>
                              <td>$r[nm_anggota]</td>
							  <td>$r[id_polda]</td>
							  <td>$r[id_pangkat]</td>
							  <td>$r[id_pendidikan]</td>
							  <td>$r[keterangan]</td>
                              <td>$r[status]</td>
                              <td width='100px'><center>
                                  <a class='btn btn-info btn-xs' title='Edit mutasi' href='?view=mutasi&act=editmutasi&id=$r[id_mutasi]'><span class='glyphicon glyphicon-edit'></span></a>
								 
                                </center></td></tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysql_query("DELETE FROM iw_mutasi where id_mutasi='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=mutasi';</script>";
                      }
                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </form>
            </div>
<?php 
}elseif($_GET[act]=='tambahmutasi'){
  #cek_session_admin();
  include "../config/library.php";
  include "../config/fungsi_seo.php";
  if (isset($_POST[tambah])){
      $namamutasi = strtoupper($_POST['nama']);

      mysql_query("INSERT INTO iw_mutasi (nm_anggota, id_polda, id_pangkat, id_pendidikan, keterangan) 
	  VALUES 
	  ('$nama_anggota','$_POST[polda]','$nama_pangkat','$nama_pendidikan', '$_POST[keterangan]')");

      echo "<script>document.location='index.php?view=mutasi'</script>";
  }
  $k=mysql_fetch_array(mysql_query("SELECT count(*) as Kode FROM iw_mutasi"));
  $kode=$k[Kode]+1;

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data mutasi</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#tangki' id='tangki-tab' role='tab' data-toggle='tab' aria-controls='tangki' aria-expanded='true'>Data mutasi </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='mutasi' aria-labelledby='mutasi-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>ID mutasi</th> <td><input type='text' class='form-control' name='idmutasi' value='$kode' disabled></td></tr>
                              <tr><th width='130px' scope='row'>Nama Anggota</th> <td><input type='text' class='form-control' name='nama' required></td></tr>
							  <tr><th scope='row'>POLDA</th><td><input type='text' list='polda' class='form-control' name='polda'><datalist id='polda'>";
                              $qry=mysql_query("SELECT id_polda,nm_polda From iw_polda");
                                while ($s=mysql_fetch_array($qry)) {
                                echo "<option value='$s[nm_polda]'>$s[nm_polda]</option>";
                                }
                              echo"</td></tr>
							  <tr><th width='130px' scope='row'>Pangkat</th> <td><input type='text' class='form-control' name='pangkat' required></td></tr>
							  <tr><th width='130px' scope='row'>Pendidikan</th> <td><input type='text' class='form-control' name='pendidikan' required></td></tr>
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
                            <a href='index.php?view=mutasi'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                          </div> 
                      </div>
                </div>
            </div>
        </div>";

}elseif($_GET[act]=='editmutasi'){
  #cek_session_admin();
  include "../config/library.php";
  include "../config/fungsi_seo.php";
  if (isset($_POST[update])){
      $nama_anggota = strtoupper($_POST['nama']);
      mysql_query("UPDATE iw_mutasi SET 
                          nm_anggota = '$nama_anggota',
						  id_polda = '$_POST[polda]',
						  id_pangkat = '$nama_pangkat',
						  id_pendidikan = '$nama_pendidikan',
                          keterangan = '$_POST[keterangan]',
                          status = '$_POST[status]'
                  WHERE id_mutasi='$_POST[id]'");
    echo "<script>document.location='index.php?view=mutasi'</script>";
  }
  $s=mysql_fetch_array(mysql_query("SELECT * FROM iw_mutasi WHERE id_mutasi='$_GET[id]'"));

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data mutasi</h3>
                </div>
                <div class='box-body'>
                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#mutasi' id='mutasi-tab' role='tab' data-toggle='tab' aria-controls='mutasi' aria-expanded='true'>Data mutasi </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='mutasi' aria-labelledby='mutasi-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                            <input type='hidden' value='$s[id_mutasi]' name='id'>
                            <tr><th width='130px' scope='row'>ID Mutasi</th> <td><input type='text' class='form-control' value='$s[id_mutasi]' name='idmutasi' disabled></td></tr>
                            <tr><th width='130px' scope='row'>Nama Anggota</th> <td><input type='text' class='form-control' value='$s[nm_anggota]' name='nama' required></td></tr>
							<tr><th scope='row'>POLDA</th><td><input type='text' list='polda' class='form-control' name='polda'><datalist id='polda'>";
                              $qry=mysql_query("SELECT id_polda,nm_polda From iw_polda");
                                while ($s=mysql_fetch_array($qry)) {
                                echo "<option value='$s[nm_polda]'>$s[nm_polda]</option>";
                                }
                              echo"
							<tr><th width='130px' scope='row'>Pangkat</th> <td><input type='text' class='form-control' value='$s[id_pangkat]' name='pangkat' required></td></tr>
							<tr><th width='130px' scope='row'>Pendidikan</th> <td><input type='text' class='form-control' value='$s[id_pendidikan]' name='pendidikan' required></td></tr>
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
                          <a href='index.php?view=mutasi'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                        </div> 
                        </form>
                    </div>
            </div>";

}
?>