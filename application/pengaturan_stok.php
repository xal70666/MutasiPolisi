<?php 
if ($_GET[act]==''){ 
  include "../config/library.php";
  include "../config/fungsi_seo.php";
  if (isset($_POST[update])){
      mysql_query("UPDATE iw_tools_stok SET 
                          batas_1 = '$_POST[batas1]', 
                          batas_2 = '$_POST[batas2]',
                          batas_3 = '$_POST[batas3]',
                          warna_1 = '$_POST[warna1]', 
                          warna_2 = '$_POST[warna2]',
                          warna_3 = '$_POST[warna3]',
                          keterangan_1 = '$_POST[keterangan1]',
                          keterangan_2 = '$_POST[keterangan2]',
                          keterangan_3 = '$_POST[keterangan3]'
                  WHERE id='$_POST[id]'");
    echo "<script>document.location='index.php?view=pengaturanstok'</script>";
  }
  $s=mysql_fetch_array(mysql_query("SELECT * FROM iw_tools_stok"));

        echo"<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Pengaturan Tools Stok</h3>
                </div>
                <div class='box-body'>
                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#tools' id='tools-tab' role='tab' data-toggle='tab' aria-controls='tools' aria-expanded='true'>Tools Batas</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='tools1' aria-labelledby='tools1-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                            <input type='hidden' value='$s[id]' name='id'>
                            <tr><td align=center><b>Batas Awal</b></td></tr>
                            <tr><th width='130px' scope='row'>Batas</th> <td><input type='text' class='form-control' value='$s[batas_1]' name='batas1' required></td></tr>
                            <tr><th width='130px' scope='row'>Warna</th> 
                            <td><input style='width:100%;height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; color: #555;background-color: #fff; background-image: none; border: 1px solid #ccc;' 
                            type='text' class='jscolor' value='$s[warna_1]' name='warna1' required></td></tr>
                            <tr><th width='130px' scope='row'>Keterangan</th> <td><input type='text' class='form-control' value='$s[keterangan_1]' name='keterangan1' required></td></tr> 
                            <tr><td align=center><b>Batas Tengah</b></td></tr>
                            <tr><th width='130px' scope='row'>Batas</th> <td><input type='text' class='form-control' value='$s[batas_2]' name='batas2' required></td></tr>
                            <tr><th width='130px' scope='row'>Warna</th> 
                            <td><input style='width:100%;height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; color: #555;background-color: #fff; background-image: none; border: 1px solid #ccc;' 
                            type='text' class='jscolor' value='$s[warna_2]' name='warna2' required></td></tr>
                            <tr><th width='130px' scope='row'>Keterangan</th> <td><input type='text' class='form-control' value='$s[keterangan_2]' name='keterangan2' required></td></tr> 
                            <tr><td align=center><b>Batas Akhir</b></td></tr>
                            <input type='hidden' value='$s[id]' name='id'>
                            <tr><th width='130px' scope='row'>Batas</th> <td><input type='text' class='form-control' value='$s[batas_3]' name='batas3' required></td></tr>
                            <tr><th width='130px' scope='row'>Warna</th> 
                            <td><input style='width:100%;height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; color: #555;background-color: #fff; background-image: none; border: 1px solid #ccc;' 
                            type='text' class='jscolor' value='$s[warna_3]' name='warna3' required></td></tr>
                            <tr><th width='130px' scope='row'>Keterangan</th> <td><input type='text' class='form-control' value='$s[keterangan_3]' name='keterangan3' required></td></tr> 
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
                        </div>
                        </form>
                    </div>   
            </div>";
            }
?>