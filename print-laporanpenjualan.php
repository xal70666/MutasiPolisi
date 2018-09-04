<?php 
session_start();
error_reporting(0);
include "config/koneksi.php"; 
include "config/fungsi_indotgl.php";
include "config/library.php"; 
?>
<head>
<title>Laporan Penerimaan Penjualan</title>
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
      <div style="text-align: center;font-size: 18px;"> Laporan Penerimaan Penjualan </div>
<?php
            echo "
            <h4><font size='2'>
            Tanggal : $_GET[tanggal] - $_GET[bulan] - $_GET[tahun] </font></h4>
                <table width='100%' id='tablemodul1'>
                    <thead>
                      <tr><th style='background-color:#00FFFF' rowspan='2'><font size='1,5'>NO</font></th>
                        <th style='background-color:#00FFFF' rowspan='2'><font size='1,5'>NAMA USER</font></th>
                        <th style='background-color:#00FFFF' rowspan='2'><font size='1,5'>JUMLAH NOTA</font></th>
                        <th style='background-color:#00FFFF' rowspan='2'><font size='1,5'>TOTAL</font></th>
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
                      $lmbr=$lmbr+$j[sumJumlah];
                      $lmbr_rp=number_format($lmbr);
                      $gt=$gt+$i[sumJual];
                      $gt_rp=number_format($gt);
                    echo "<tr><td><font size='1'><center>$no</center></font></td>
                              <td><font size='1,5'>$s[nama_lengkap]</font></td>
                              <td align=center><font size='1,5'>$j[sumJumlah]</font></td>
                              <td align=right><font size='1,5'>Rp. $jual_rp</font></td>";
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