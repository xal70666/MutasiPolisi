<section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $foto; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $nama; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header" style='color:#fff; border-bottom:2px solid #00c0ef'><marquee> <b>"Berdoa dan Berkerja"</b></marquee></li>
            <li><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

            <li class="treeview">
              <a href="#"><i class="fa fa-th"></i> <span>Data Master</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="index.php?view=kategori"><i class="fa fa-circle-o"></i> Master Kategori</a></li>
                <li><a href="index.php?view=jenis"><i class="fa fa-circle-o"></i> Master Jenis</a></li>
                <li><a href="index.php?view=produk"><i class="fa fa-circle-o"></i> Master Produk</a></li>
                <li><a href="index.php?view=supplier"><i class="fa fa-circle-o"></i> Master Supplier</a></li>
                <li><a href="index.php?view=merk"><i class="fa fa-circle-o"></i> Master Merk Kendaraan</a></li>
                <li><a href="index.php?view=type"><i class="fa fa-circle-o"></i> Master Type Kendaraan</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-tag"></i> <span>Data Transaksi</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="index.php?view=pembelian"><i class="fa fa-circle-o"></i> Transaksi Pembelian</a></li>
                <li><a href="index.php?view=penjualan"><i class="fa fa-circle-o"></i> Transaksi Penjualan</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-book"></i> <span>Data Laporan</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="index.php?view=laporanpembelian"><i class="fa fa-circle-o"></i> Laporan Pembelian</a></li>
                <li><a href="index.php?view=laporanpenjualan"><i class="fa fa-circle-o"></i> Laporan Penjualan</a></li>
                <li><a href="index.php?view=stockopname"><i class="fa fa-circle-o"></i> Stock Opname</a></li>
              </ul>
            </li>

              </ul>
            </li>
                
        </section>