<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">    
        <h1>Penjualan</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url('penjualan/add') ?>" class="btn btn-icon icon-left btn-success rounded float-right"><i class="fa fa-plus fa-xl"></i>&nbsp Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th scope="col">Pelanggan</th>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Subtotal</th>
                                            <th scope="col">Tanggal Penjualan</th>
                                            <th scope="col">Nama Karyawan</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        helper('number') ?>
                                        <?php foreach ($dataPenjualan as $data) { ?>
                                            <tr>
                                                <td align="center"><?= $no; ?></td>
                                                <td align="center"><?= $data->nama_pelanggan ?></td>
                                                <td align="center"><?= $data->nama_barang ?></td>
                                                <td align="right"><?= number_to_currency($data->subtotal, 'IDR', 'id_ID', 2) ?></td>
                                                <td align="center"><?= $data->tanggal_jual ?></td>
                                                <td align="center"><?= $data->nama_karyawan ?></td>
                                                <td >
                                                    <!-- <a href="<?= base_url('Penjualan/show/' . $data->id_penjualan) ?>" class="btn btn-info"><i class="fas fa-eye"></i>
                                                    </a> -->
                                                    <a href="<?= base_url('Penjualan/printInvoice/' . $data->id_penjualan) ?>" class="btn btn-success" target="_blank"><i class="fas fa-print"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
