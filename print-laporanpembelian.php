<?php 
session_start();
error_reporting(0);
include "config/koneksi.php"; 
include "config/fungsi_indotgl.php";
include "config/library.php"; 
?>
<head>
<title>Laporan Pengeluaran Harian</title>
<link rel="stylesheet" href="bootstrap/css/printer.css">
</head>
<body>
<script type="text/javascript">
window.print();
window.onfocus=function(){ window.close();}
</script>
<div style="float:center;text-align:center; font-size: 18px; text-transform:uppercase;">
        <b style="font-size: 20px;">BENGKEL IWAN MOTOR<br></b>
        <i style="font-size: 14px;text-transform:capitalize;">
          Alamat: Jl. KP. Pintu Air No. 50 RT.03/RW.01 Kelurahan Marga Mulya <br> Kecamatan Bekasi Utara, Bekasi, Jawa Barat - Indonesia - <span style="text-transform: none;"></span>
        </i>
      </div>
      <div style="border-bottom:1px solid #000;margin-bottom: 1px;clear:both;">
      </div>
      <div style="border-bottom:2px solid #000;margin-bottom: 20px;clear:both;">
      </div>
      <div style="text-align: center;font-size: 18px;"> Laporan Pengeluaran Harian </div>
<?php
            echo "
            <h4><font size='2'>
            Tanggal : $_GET[tanggal] - $_GET[bulan] - $_GET[tahun] </font></h4>
                <table width='100%' id='tablemodul1'>
                    <thead>
                      <tr><th style='background-color:#00FFFF' rowspan='2'><font size='1,5'>NO</font></th>
                        <th style='background-color:#00FFFF' rowspan='2'><font size='1,5'>SUPPLIER</font></th>
                        <th style='background-color:#00FFFF' rowspan='2'><font size='1,5'>JUMLAH NOTA</font></th>
                        <th style='background-color:#00FFFF' rowspan='2'><font size='1,5'>TOTAL</font></th>
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
                      $lmbr=$lmbr+$j[sumJumlah];
                      $lmbr_rp=number_format($lmbr);
                      $gt=$gt+$i[sumBeli];
                      $gt_rp=number_format($gt);
                    echo "<tr><td><font size='1'><center>$no</center></font></td>
                              <td><font size='1,5'>$s[nm_supplier]</font></td>
                              <td align=center><font size='1,5'>$j[sumJumlah]</font></td>
                              <td align=right><font size='1,5'>Rp. $beli_rp</font></td>";
                            echo "</tr>";
                      $no++;
                      }
                      echo"<tr>
                      <td style='background-color:#FFFF00' colspan=2><font size='1,5'><center><b>Total</b></center></font></td>
                      <td style='background-color:yellow' align=center><font size='1,5'><b>$lmbr_rp </b></font></td>
                      <td style='background-color:yellow' align=right><font size='1,5'><b>Rp. $gt_rp</b></font></td>
                      $trumah</b></font></td>";

                  ?>
                    </tbody>
                  </table>
</body>