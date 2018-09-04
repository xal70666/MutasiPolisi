
<?php 
if ($_GET[act]==''){
  include "../config/library.php";
  $tampil=mysql_fetch_array(mysql_query("SELECT count(*) as JumTransaksi FROM iw_penjualan"));
  $kode=$tampil[JumTransaksi]+1;
  $hariini = date("YmdHis");
  if (isset($_POST[tambah])){
    mysql_query("INSERT INTO iw_penjualan_tmp (id_produk, jumlah, username) VALUES ('$_POST[produk]', '$_POST[jumlah]', '$_SESSION[id]')");
    }
  if (isset($_POST[simpan])){
    if($_POST[merk] != '' AND $_POST[type] != '' AND $_POST[nomor] != ''){
    mysql_query("INSERT INTO iw_penjualan (no_penjualan, tgl_penjualan, catatan, id_merk, id_type, nomor_kendaraan, username) VALUES ('$kode', '$hariini', '', '$_POST[merk]', '$_POST[type]', '$_POST[nomor]', '$_SESSION[id]')");
    // Ambil semua data produk yang dipilih, berdasarkan user yg login //
    $t=mysql_query("SELECT iw_produk.*,tmp.jumlah FROM iw_produk, iw_penjualan_tmp as tmp 
      WHERE iw_produk.id_produk=tmp.id_produk AND tmp.username='$_SESSION[id]'"); 
    while($dataTemp=mysql_fetch_array($t)){
    // Baca data dari tabel produk dan jumlah yang dibeli dari tmp //
      $dataProduk = $dataTemp[id_produk];
      $dataBeli   = $dataTemp[harga_beli];
      $dataJual   = $dataTemp[harga_jual];
      $dataJumlah = $dataTemp[jumlah];
    // MEMINDAH DATA, Masukkan semua data di atas dari tabel TMP ke tabel ITEM //
    mysql_query("INSERT INTO iw_penjualan_item SET no_penjualan='$kode', 
                                                  id_produk='$dataProduk', 
                                                  harga_beli='$dataBeli',
                                                  harga_jual='$dataJual',
                                                  jumlah='$dataJumlah'");
    // update stok produk //
    mysql_query("UPDATE iw_produk SET stok = stok - $dataJumlah WHERE id_produk='$dataProduk'");
  }
    // kosongkan table tmp //
    mysql_query("DELETE FROM iw_penjualan_tmp WHERE username='$_SESSION[id]'");
    // Refresh form
    echo "<meta http-equiv='refresh' content='0; url=index.php?view=penjualan'>";
    } else {echo"<meta http-equiv='refresh' content='0; url=index.php?view=penjualan'>";}
  }
?> 
<?php
            echo"<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Transaksi Penjualan</h3>
                </div>
                <div class='box-body'>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='penjualan' aria-labelledby='penjualan-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              
                              <tr><th scope='row'>Nama Produk</th><td><input type='text' list='produk' class='form-control' name='produk'><datalist id='produk'>";
                              $qry=mysql_query("SELECT id_produk,nm_produk From iw_produk");
                                while ($p=mysql_fetch_array($qry)) {
                                echo "<option value='$p[id_produk]-$p[nm_produk]'>$p[nm_produk]</option>";
                                }
                              echo"
                              <tr><th width='130px' scope='row'>Jumlah</th> <td><input type='number' class='form-control' name='jumlah'></td></tr>
                              <tr><th></th><td><button type='submit' name='tambah' class='btn btn-warning'>Tambah</button></td></tr>";
echo"

                            </tbody>
                            </table>
                          </div>

                          <div class='col-md-6'>
                          <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>Kode Transaksi</th> <td><input type='text' class='form-control' name='kode' VALUE='$kode' disabled></td></tr>
                              <tr><th scope='row'>Tanggal</th> <td><input type='text' class='form-control' VALUE='$tgl_skrg-$bln_sekarang-$thn_sekarang' disabled></td></tr>
                              <tr><th width='120px' scope='row'>Jenis Transaksi</th> <td><select class='form-control' name='jenis'>";
                              echo "<option value='tunai' selected>TUNAI</option>";
                              echo "<option value='kredit'>KREDIT</option>";echo "</select></td></tr>
                              <tr><th scope='row'>Merk Kendaraan</th><td><input type='text' list='merk' class='form-control' name='merk'><datalist id='merk'>";
                              $qry=mysql_query("SELECT id_merk,nm_merk From iw_merk");
                                while ($m=mysql_fetch_array($qry)) {
                                echo "<option value='$m[id_merk]-$m[nm_merk]'>$m[nm_merk]</option>";
                                }
                              echo"
                              <tr><th scope='row'>Type Kendaraan</th><td><input type='text' list='type' class='form-control' name='type'><datalist id='type'>";
                              $qry=mysql_query("SELECT id_type,nm_type From iw_type");
                                while ($t=mysql_fetch_array($qry)) {
                                echo "<option value='$t[id_type]-$t[nm_type]'>$t[nm_type]</option>";
                                }
                              echo"
                              <tr><th width='130px' scope='row'>Nomor Kendaraan</th> <td><input type='text' class='form-control' name='nomor'></td></tr>
                            </tbody>
                            </table>
                          </div>  

                          <div style='clear:both'>
                      <table id='myTable' class='table table-bordered table-striped'>
                      <thead style='background:#00c0ef;'><tr>
                        <th width='50px'>No</th>
                        <th>PRODUK</th>
                        <th>HARGA</th>
                        <th>JUMLAH</th>
                        <th>TOTAL</th>
                        <th width='50px'>AKSI</th>
                        </tr></thead>
                        <tbody><tr>";
                    $tampil = mysql_query("SELECT * FROM iw_penjualan_tmp WHERE username='$_SESSION[id]'");
                    $no = 1;
                    while($s=mysql_fetch_array($tampil)){
                      $p=mysql_fetch_array(mysql_query("SELECT * FROM iw_produk WHERE id_produk='$s[id_produk]'"));
                      $jual_rp=number_format($p[harga_jual]);
                      // rumus //
                      $total=$p[harga_jual]*$s[jumlah];
                      $total_rp=number_format($total);
                      $grandtotal=$grandtotal+$total;
                      $grandtotal_rp=number_format($grandtotal);
                    echo "<tr>";
                              echo "<td align=center>$no</td>
                              <td align=left>$p[nm_produk]</td>
                              <td align=left>$jual_rp</td>
                              <td align=left>$s[jumlah]</td>
                              <td align=left>$total_rp</td>
                              <td align=center><a href='index.php?view=penjualan&delete=".$s[id]."' class='btn btn-xs btn-danger' title='Hapus Transaksi' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a></td>
                              </tr>";
                      $no++;
                      }
                      if (isset($_GET[delete])){
                          mysql_query("DELETE FROM iw_penjualan_tmp WHERE id='$_GET[delete]'");
                          echo "<script>document.location='index.php?view=penjualan';</script>";}
                      echo" 
                      <tr><th></th><th></th><th></th><th width='100px' scope='row'>Grand Total</th> <td width='150px'><b>$grandtotal_rp</b></td></tr>
                      </tbody>
                      </table>
                        
                          </div>
                          <div class='box-footer'>
                            <button type='submit' name='simpan' class='btn btn-info pull-right'>Simpan Transaksi</button>
                          </div> 
                          </form>
                </div>
            </div>
        </div>";

}
?>
