<?php 
if ($_GET[act]==''){ 
?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Pengeluaran Harian </h3>
                   <?php if($_SESSION[level]!='kasie'){ ?>
                  <a class='pull-right btn btn btn-primary btn-sm' href='index.php?view=laporanpembelian'>Clear</a>
                  <a style='margin-right:5px' class='pull-right btn btn-success btn-sm' target='_BLANK' href='print-laporanpembelian.php?tanggal=<?php echo $_GET[tanggal]; ?>&bulan=<?php echo $_GET[bulan]; ?>&tahun=<?php echo $_GET[tahun]; ?>&supplier=<?php echo $_GET[supplier]; ?>'>Print Pengeluaran</a>
                  <?php } ?>

                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action='' method='GET'>
                    <input type="hidden" name='view' value='laporanpembelian'>
                    <input type="number" name='tanggal' style='padding:3px' placeholder='Tanggal' value='<?php echo $_GET[tanggal]; ?>'>
                    <input type="number" name='bulan' style='padding:3px' placeholder='Bulan' value='<?php echo $_GET[bulan]; ?>'>
                    <input type="number" name='tahun' style='padding:3px' placeholder='Tahun' value='<?php echo $thn_sekarang; ?>'>
                    <select name='supplier' style='padding:4px'>
                        <?php 
                            echo "<option value=''>- Filter Supplier -</option>";
                            $user = mysql_query("SELECT * FROM iw_supplier ORDER BY id_supplier ASC");
                            while ($u = mysql_fetch_array($user)){
                              if ($_GET[supplier]==$u[id_supplier]){
                                echo "<option value='$u[id_supplier]' selected>$u[nm_supplier]</option>";
                              }else{
                                echo "<option value='$u[id_supplier]'>$u[nm_supplier]</option>";
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
                <input type="hidden" name='supplier' value='<?php echo $_GET[supplier]; ?>'>
                <?php 
                    echo "<table id='example' class='table table-bordered table-striped'>
                            <thead style='background:#00c0ef;'>
                              <tr>";
                  echo "<th>No</th>
                        <th>Nama Supplier</th>
                        <th>Jumlah Nota</th>
                        <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>";

                  if ($_GET[tanggal] != '' AND $_GET[bulan] != '' AND $_GET[tahun] != '' AND $_GET[supplier] != ''){
                // Baca input tanggal yang dikirimkan user
                $tgl=$_GET[tahun].'-'.$_GET[bulan].'-'.$_GET[tanggal];
                    $tampil = mysql_query("SELECT *
                      FROM iw_pembelian as p
                      WHERE p.tgl_pembelian like '$tgl%'
                      AND p.id_supplier='$_GET[supplier]'");
                  }elseif ($_GET[tanggal] != '' AND $_GET[bulan] != '' AND $_GET[tahun] != '' AND $_GET[supplier] == ''){
                // Baca input tanggal yang dikirimkan user
                $tgl=$_GET[tahun].'-'.$_GET[bulan].'-'.$_GET[tanggal];
                    $tampil = mysql_query("SELECT *
                      FROM iw_pembelian as p
                      WHERE p.tgl_pembelian like '$tgl%'");
                  }elseif ($_GET[tanggal] == '' AND $_GET[bulan] != '' AND $_GET[tahun] != '' AND $_GET[supplier] == ''){
                // Baca input tanggal yang dikirimkan user
                $tgl=$_GET[tahun].'-'.$_GET[bulan];
                    $tampil = mysql_query("SELECT *
                      FROM iw_pembelian as p
                      WHERE p.tgl_pembelian like '$tgl%'");
                  }elseif ($_GET[tanggal] == '' AND $_GET[bulan] != '' AND $_GET[tahun] != '' AND $_GET[supplier] != ''){
                // Baca input tanggal yang dikirimkan user
                $tgl=$_GET[tahun].'-'.$_GET[bulan];
                    $tampil = mysql_query("SELECT *
                      FROM iw_pembelian as p
                      WHERE p.tgl_pembelian like '$tgl%'
                      AND p.id_supplier='$_GET[supplier]'");
                  }elseif ($_GET[tanggal] == '' AND $_GET[bulan] == '' AND $_GET[tahun] != '' AND $_GET[supplier] == ''){
                // Baca input tanggal yang dikirimkan user
                $tgl=$_GET[tahun];
                    $tampil = mysql_query("SELECT *
                      FROM iw_pembelian as p
                      WHERE p.tgl_pembelian like '$tgl%'");
                  }elseif ($_GET[tanggal] == '' AND $_GET[bulan] == '' AND $_GET[tahun] != '' AND $_GET[supplier] != ''){
                // Baca input tanggal yang dikirimkan user
                $tgl=$_GET[tahun];
                    $tampil = mysql_query("SELECT *
                      FROM iw_pembelian as p
                      WHERE p.tgl_pembelian like '$tgl%'
                      AND p.id_supplier='$_GET[supplier]'");
                  }
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                      $s=mysql_fetch_array(mysql_query("SELECT * FROM iw_supplier WHERE id_supplier='$r[id_supplier]'"));
                      $i=mysql_fetch_array(mysql_query("SELECT SUM(harga_beli) as sumBeli FROM iw_pembelian_item WHERE no_pembelian='$r[no_pembelian]'"));
                      $j=mysql_fetch_array(mysql_query("SELECT COUNT(*) as sumJumlah FROM iw_pembelian WHERE no_pembelian='$r[no_pembelian]'"));
                      // rumus //
                      $beli_rp=number_format($i[sumBeli]);
                      $gt=$gt+$i[sumBeli];
                      $gt_rp=number_format($gt);
                    echo "<tr>";
                              echo "<td>$no</td>
                              <td><a title='Export Excel Detail LPH' target='_BLANK' href='export.php?tanggal=$_GET[tanggal]&bulan=$_GET[bulan]&tahun=$_GET[tahun]&supplier=$r[id_supplier]'>$s[nm_supplier]</a></td>
                              <td><a title='Print Detail LPH' target='_BLANK' href='print-detaillppkasir.php?tanggal=$_GET[tanggal]&bulan=$_GET[bulan]&tahun=$_GET[tahun]&user=$r[username]'>$j[sumJumlah]</a></td>
                              <td>$beli_rp</td>
                              </tr>";
                      $no++;
                      }
                    echo "<tr>";
                              echo "<td colspan=3><center><b>GRAND TOTAL</b></center></td>
                              <td><b>$gt_rp</b></td>
                              </tr>";
                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <?php 
                    if ($_GET[tanggal] == '' AND $_GET[bulan] == '' AND $_GET[tahun] == '' AND $_GET[supplier] == ''){
                        echo "<center style='padding:60px; color:red'>Silahkan Input Tanggal, Bulan, Tahun serta Jenis Transaksi... </center>";
                    }
                ?>
              </div><!-- /.box -->

              </form>
            </div>
<?php    
}
?>