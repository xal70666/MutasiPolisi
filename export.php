<?php
error_reporting(0);
include "config/koneksi.php"; 
include "config/library.php"; 
$kasir = $_GET[kasir];
$k = mysql_fetch_array(mysql_query("SELECT * from er_kasir where iduser='$kasir'"));
$tgl = $_GET[tahun].'-'.$_GET[bulan].'-'.$_GET[tanggal];
$nama = $_GET[tanggal].''.$_GET[bulan].''.$_GET[tahun].''.$k[namauser];
$SQL = "SELECT t.bulan,t.tahun,t.nosambungan,p.nama,p.alamat,date(t.tglbayar) as tglbayar,t.idtarif,t.pakai,t.tagihan,IFNULL(tg.denda,0) as denda1,IFNULL(tg.denda1,0) as denda2,IFNULL(t.tagihan+tg.denda+tg.denda1,t.tagihan) as total
           FROM tagihan t
           LEFT JOIN pelanggan p ON t.nosambungan=p.nosambungan
           LEFT JOIN stanmeter s ON t.nosambungan=s.nosambungan and t.bulan=s.bulan and t.tahun=s.tahun
           LEFT JOIN tunggakan tg ON t.nosambungan=tg.nosambungan and t.bulan=tg.bulan and t.tahun=tg.tahun
           LEFT JOIN tagihanpasba tp ON t.nosambungan=tp.nosambungan and t.bulan=tp.bulan and t.tahun=tp.tahun
           WHERE t.lunas = 1 And date(t.tglbayar) = '". $tgl ."' And t.iduser='". $kasir ."'
           ORDER BY nosambungan,bulan ASC";
$header = '';
$result ='';
$exportData = mysql_query ($SQL ) or die ( "Sql error : " . mysql_error( ) );
 
$fields = mysql_num_fields ( $exportData );
 
for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysql_field_name( $exportData , $i ) . "\t";
}
 
while( $row = mysql_fetch_row( $exportData ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $result .= trim( $line ) . "\n";
}
$result = str_replace( "\r" , "" , $result );
 
if ( $result == "" )
{
    $result = "\nNo Record(s) Found!\n";                        
}
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$nama.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$result";
?>