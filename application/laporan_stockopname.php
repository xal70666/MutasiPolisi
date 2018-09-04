
<?php 
if ($_GET[act]==''){ 
?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Stock Opname</h3>
                   <?php if($_SESSION[level]!='admin' AND $_SESSION[level]!='user'){ ?>
                  <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action='' method='POST'>
                <?php 
                    echo "<table id='example1' class='table table-bordered table-striped'>
                    <thead style='background:#00c0ef;'>";
                  echo "<th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Stok</th>
                        <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>";
                    $tampil = mysql_query("SELECT * FROM iw_produk
                        ORDER BY stok DESC");
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                      $beli=number_format($r[harga_beli]);
                      $jual=number_format($r[harga_jual]);
                    // batas //
                      $batas=mysql_fetch_array(mysql_query("SELECT * FROM iw_tools_stok ORDER BY id DESC LIMIT 1"));
                      $bts1=$batas[batas_1];
                      $wrn1=$batas[warna_1];
                      $ktr1=$batas[keterangan_1];

                      $bts12=$batas[batas_1]+1;
                      $bts2=$batas[batas_2];
                      $wrn2=$batas[warna_2];
                      $ktr2=$batas[keterangan_2];

                      $bts23=$batas[batas_2]+1;
                      $bts3=$batas[batas_3];
                      $wrn3=$batas[warna_3];
                      $ktr3=$batas[keterangan_3];
                    echo "<tr>";
                              echo "
                              <td width='100px'>$r[id_produk]</td>
                              <td>$r[nm_produk]</td>
                              <td>$r[stok]</td>";
                              if($r[stok]<=$bts1)
                                {echo"<td style='background-color:#$wrn1;'><b><font color='white'>$ktr1</font></b></td>";}
                              elseif(($r[stok]>=$bts12)&&($r[stok]<$bts3))
                                {echo"<td style='background-color:#$wrn2;'><b><font color='white'>$ktr2</font></b></td>";}
                              elseif(($r[stok]>=$bts23)&&($r[stok]>=$bts3))
                                {echo"<td style='background-color:#$wrn3;'><b><font color='white'>$ktr3</font></b></td>";}
                              echo"</tr>";
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
}
?>