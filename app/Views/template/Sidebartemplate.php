
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Cv Bali-Bo</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">BC</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>

            
                    <li class="nav-item dropdown">
                <a href="<?=base_url('home/dashboard')?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master Data</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?=base_url('pelanggan/view')?>">Pelanggan</a></li>
                  <li><a class="nav-link" href="<?=base_url('karyawan/view')?>">Karyawan</a></li>
                  <li><a class="nav-link" href="<?=base_url('barang/view')?>">Barang</a></li>
                  <li><a class="nav-link" href="<?=base_url('coa/view')?>">COA</a></li>
                   <li><a class="nav-link" href="<?=base_url('supplier/view')?>">Supplier</a></li>
                                 
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Transaksi</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?=base_url('penjualan/view')?>">Penjualan</a></li>
                <li><a class="nav-link" href="<?=base_url('returpenjualan/view')?>">Retur Penjualan</a></li>
                <li><a class="nav-link" href="<?=base_url('pembelian/viewpembelian')?>">Pembelian</a></li>
                   <li><a class="nav-link" href="<?=base_url('returpembelian/view')?>">Retur Pembelian</a></li>
                </ul>
              </li>
            

              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Laporan</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?=base_url('laporan/penjualan')?>">Laporan Penjualan</a></li>
                <li><a class="nav-link" href="<?=base_url('laporan/returpenjualan')?>">Laporan Retur Penjualan</a></li>
                  <li><a class="nav-link" href="<?=base_url('laporan/pembelian')?>">Laporan Pembelian</a></li>
                    <li><a class="nav-link" href="<?=base_url('laporan/returpembelian')?>">Laporan Retur Pembelian</a></li>
                <li><a class="nav-link" href="<?=base_url('laporan/jurnalumum')?>">Jurnal Umum</a></li>
                <li><a class="nav-link" href="<?=base_url('laporan/bukubesar')?>">Buku Besar</a></li>
            
              

                </ul>
              </li>
        </aside>
      </div>