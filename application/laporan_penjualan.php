<?php 
if ($_GET[act]==''){ 
?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Penerimaan Penjualan </h3>
                   <?php if($_SESSION[level]!='kasie'){ ?>
                  <a class='pull-right btn btn btn-primary btn-sm' href='index.php?view=laporanpenjualan'>Clear</a>
                  <a style='margin-right:5px' class='pull-right btn btn-success btn-sm' target='_BLANK' href='print-laporanpenjualan.php?tanggal=<?php echo $_GET[tanggal]; ?>&bulan=<?php echo $_GET[bulan]; ?>&tahun=<?php echo $_GET[tahun]; ?>&user=<?php echo $_GET[username]; ?>'>Print Penerimaan</a>
                  <?php } ?>

                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action='' method='GET'>
                    <input type="hidden" name='view' value='laporanpenjualan'>
                    <input type="number" name='tanggal' style='padding:3px' placeholder='Tanggal' value='<?php echo $_GET[tanggal]; ?>'>
                    <input type="number" name='bulan' style='padding:3px' placeholder='Bulan' value='<?php echo $_GET[bulan]; ?>'>
                    <input type="number" name='tahun' style='padding:3px' placeholder='Tahun' value='<?php echo $thn_sekarang; ?>'>
                    <select name='user' style='padding:4px'>
                        <?php 
                            echo "<option value=''>- Filter User -</option>";
                            $user = mysql_query("SELECT * FROM iw_users ORDER BY username ASC");
                            while ($u = mysql_fetch_array($user)){
                              if ($_GET[user]==$u[username]){
                                echo "<option value='$u[username]' selected>$u[nama_lengkap]</option>";
                              }else{
                                echo "<option value='$u[username]'>$u[nama_lengkap]</option>";
                              }
                            }
                        ?>
                    </select>
                    <input type="submit" style='margin-top:-4px' class='btn btn-info btn-sm' value='Lihat'>
                  </form>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action='' method='POST'>
                <input type="hidden" name='tanggal' value='<?php echo $_GET[tanggal]; ?>'>
                <input type="hidden" name='bulan' value='<?php echo $_GET[bulan]; ?>'>
                <input type="hidden" name='tahun' value='<?php echo $_GET[tahun]; ?>'>
                <input type="hidden" name='user' value='<?php echo $_GET[user]; ?>'>
                <?php 
                    echo "<table id='example' class='table table-bordered table-striped'>
                            <thead style='background:#00c0ef;'>
                              <tr>";
                  echo "<th>No</th>
                        <th>Nama User</th>
                        <th>Jumlah Nota</th>
                        <th>Total Perbaikan</th>
                        <th>Total Suku Cadang</th>
                        <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>";

                  if ($_GET[tanggal] != '' AND $_GET[bulan] != '' AND $_GET[tahun] != '' AND $_GET[user] != ''){
                // Baca input tanggal yang dikirimkan user
                $tgl=$_GET[tahun].'-'.$_GET[bulan].'-'.$_GET[tanggal];
                    $tampil = mysql_query("SELECT *
                      FROM iw_penjualan as p
                      WHERE p.tgl_penjualan like '$tgl%'
                      AND p.username='$_GET[user]'");
                  }elseif ($_GET[tanggal] != '' AND $_GET[bulan] != '' AND $_GET[tahun] != '' AND $_GET[user] == ''){
                // Baca input tanggal yang dikirimkan user
                $tgl=$_GET[tahun].'-'.$_GET[bulan].'-'.$_GET[tanggal];
                    $tampil = mysql_query("SELECT *
                      FROM iw_penjualan as p
                      WHERE p.tgl_penjualan like '$tgl%'");
                  }elseif ($_GET[tanggal] == '' AND $_GET[bulan] != '' AND $_GET[tahun] != '' AND $_GET[user] == ''){
                // Baca input tanggal yang dikirimkan user
                $tgl=$_GET[tahun].'-'.$_GET[bulan];
                    $tampil = mysql_query("SELECT *
                      FROM iw_penjualan as p
                      WHERE p.tgl_penjualan like '$tgl%'");
                  }elseif ($_GET[tanggal] == '' AND $_GET[bulan] != '' AND $_GET[tahun] != '' AND $_GET[user] != ''){
                // Baca input tanggal yang dikirimkan user
                $tgl=$_GET[tahun].'-'.$_GET[bulan];
                    $tampil = mysql_query("SELECT *
                      FROM iw_penjualan as p
                      WHERE p.tgl_penjualan like '$tgl%'
                      AND p.username='$_GET[user]'");
                  }elseif ($_GET[tanggal] == '' AND $_GET[bulan] == '' AND $_GET[tahun] != '' AND $_GET[user] == ''){
                // Baca input tanggal yang dikirimkan user
                $tgl=$_GET[tahun];
                    $tampil = mysql_query("SELECT *
                      FROM iw_penjualan as p
                      WHERE p.tgl_penjualan like '$tgl%'");
                  }elseif ($_GET[tanggal] == '' AND $_GET[bulan] == '' AND $_GET[tahun] != '' AND $_GET[user] != ''){
                // Baca input tanggal yang dikirimkan user
                $tgl=$_GET[tahun];
                    $tampil = mysql_query("SELECT *
                      FROM iw_penjualan as p
                      WHERE p.tgl_penjualan like '$tgl%'
                      AND p.username='$_GET[user]'");
                  }
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                      $s=mysql_fetch_array(mysql_query("SELECT * FROM iw_users WHERE username='$r[username]'"));
                      $i=mysql_fetch_array(mysql_query("SELECT SUM(harga_jual) as sumJual FROM iw_penjualan_item WHERE no_penjualan='$r[no_penjualan]'"));
                      $j=mysql_fetch_array(mysql_query("SELECT COUNT(*) as sumJumlah FROM iw_penjualan WHERE no_penjualan='$r[no_penjualan]'"));
                      // rumus //
                      $jual_rp=number_format($i[sumJual]);
                      $gt=$gt+$i[sumJual];
                      $gt_rp=number_format($gt);
                    echo "<tr>";
                              echo "<td>$no</td>
                              <td><a title='Export Excel Detail LPH' target='_BLANK' href='export.php?tanggal=$_GET[tanggal]&bulan=$_GET[bulan]&tahun=$_GET[tahun]&user=$r[username]'>$s[nama_lengkap]</a></td>
                              <td><a title='Print Detail LPH' target='_BLANK' href='print-detaillppkasir.php?tanggal=$_GET[tanggal]&bulan=$_GET[bulan]&tahun=$_GET[tahun]&user=$r[username]'>$j[sumJumlah]</a></td>
                              <td></td>
                              <td></td>
                              <td>$jual_rp</td>
                              </tr>";
                      $no++;
                      }
                    echo "<tr>";
                              echo "<td colspan=5><center><b>GRAND TOTAL</b></center></td>
                              <td><b>$gt_rp</b></td>
                              </tr>";
                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <?php 
                    if ($_GET[tanggal] == '' AND $_GET[bulan] == '' AND $_GET[tahun] == '' AND $_GET[user] == ''){
                        echo "<center style='padding:60px; color:red'>Silahkan Input Tanggal, Bulan, Tahun serta Jenis Transaksi... </center>";
                    }
                ?>
              </div><!-- /.box -->

              </form>
            </div>
<?php    
}
?>