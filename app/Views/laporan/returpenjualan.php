<div class="main-content">
        <section class="section">
          <div class="section-header">
          <h1 class="h2"><?= esc($title) ?></h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?=base_url('menu/view')?>">Master Data</a></div>
              <div class="breadcrumb-item"><a href="<?=base_url('penjualan/view')?>">Transaksi</a></div>
            </div>
          </div>

      <div class="alert alert-success" role="alert">
          <?php 
            $session = session();
            echo "Selamat datang ".$session->get('user_name');
          ?>
      </div>
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header"> 
      <div class="card-body">
      <form class="row g-3 needs-validation" action="<?=base_url('Laporan/returpenjualan')?>" method="post"
        novalidate>
<div class="container-fluid mb-3">
<table class="table table-bordered">

            <div class="col-sm-6">
                <input type="date" name="tanggal1" placeholder="Tanggal Mulai" class="form-control">
            </div><br>
            <div class="col-sm-6">
                <input type="date" name="tanggal2" placeholder="Tanggal Selesai" class="form-control">
            </div><br>
</td></tr>
        <button type="submit" name="submit" class="btn btn-primary btn-sm">Proses</button>
    </td></tr>
</table>

<hr>
<div class="container-fluid">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <tr class="success"><th colspan="6">Transaksi Penjualan <?= $periode1 ?> - <?= $periode2 ?> </th></tr>
    <tr>
        <th>#</th>
        <th>Tanggal Retur</th>
        <th>Nama Barang</th>
        <th>Jumlah Barang</th>
        <th>Subtotal</th>
        <th>No Faktur</th>

    </tr>
    <?php
    $total=0;
    $total1=0;
    $no = 1;
    foreach ($data as $r)
    {
        ?>
        <tr>

            <td align="center"><?= $no++;?></td>
            <td><?php echo $r["tanggal_retur"];?></td>
            <td><?php echo $r["nama_barang"];?></td>
            <td align="center"><?= $r['jumlah_barang'];?></td>
            <td align="center"><?php echo format_rupiah($r['subtotal']);?></td>
            <td><?php echo $r["no_faktur"];?></td>
    </tr>
    <?php
         $total=$total+($r['subtotal']);
         $total1=$total1+($r['jumlah_barang']);
    }?>

   
    <tr style=" background-color: yellow "><td colspan="4"><p align="center">Total</p></td>
    <td align="center"><?php echo $total1;?></td>
    <td align="center"><?php echo format_rupiah($total);?></td>
    <div>
</table>