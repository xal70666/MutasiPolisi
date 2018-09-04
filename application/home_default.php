<div class='col-md-12'>
          <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Selamat Datang di SiPanjul - Sistem Informasi Penjualan Iwan Motor</h3>
            </div>
            <div class='box-body'>
              <p>Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola Informasi dan Data pada System ini, berikut informasi akun anda saat ini : </p>
              <dl class='dl-horizontal'>
              <?php 
              $u = mysql_fetch_array(mysql_query("SELECT * FROM iw_users WHERE username='$_SESSION[id]'")); ?>
                <dt>Username</dt>
                <dd><?php echo $nama; ?></dd>

                <dt>Password</dt>
                <dd>***********</dd>

                <dt>Nama Lengkap</dt>
                <dd><?php echo $u[nama_lengkap]; ?></dd>

                <dt>Alamat Email</dt>
                <dd><?php echo $u[email]; ?></dd>

                <dt>No. Telpon</dt>
                <dd><?php echo $u[no_telp]; ?></dd>

                <dt>Level</dt>
                <dd><?php echo $u[level]; ?></dd>

                <dt>Hak Akses</dt>
                <dd></dd>
              </dl>
              <div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h4><i class='icon fa fa-info'></i> Info Penting!</h4>
                Diharapkan informasi akun sesuai dengan identitas pada Kartu Pengenal anda, Untuk Mengubah informasi Profile anda klik <a href='?module=user&act=edit&id=user'>disini</a>.
              </div>
            </div>
          </div>
        </div>
        </section>
        <div style='clear:both'></div>
      </div><!-- /.content-wrapper -->