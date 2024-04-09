<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Retur Penjualan</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url('returpenjualan/add') ?>" class="btn btn-icon icon-left btn-success rounded float-right"><i class="fa fa-plus fa-xl"></i>&nbsp Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">No Penjualan</th>
                                            <th class="text-center">Nama Barang</th>
                                            <th class="text-center">Jumlah Barang</th>
                                            <th class="text-center">Subtotal</th>
                                            <th class="text-center">Tanggal Retur</th>
                                            <th class="text-center">Nama Karyawan</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        helper('number') ?>
                                        <?php foreach ($dataRetur as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td class="text-center"><?= $data->penjualan?></td>
                                                <td class="text-center"><?= $data->nama_barang ?></td>
                                                <td class="text-center"><?= $data->jumlah_barang ?></td>
                                                <td class="text-center"><?= number_to_currency($data->subtotal, 'IDR', 'id_ID', 2) ?></td>
                                                <td class="text-center"><?= $data->tanggal_retur ?></td>
                                                <td class="text-center"><?= $data->nama_karyawan?></td>
                                                <td class="text-center">
                                                    <!-- <a href="<?= base_url('Returpenjualan/show/' . $data->id_retur_penjualan) ?>" class="btn btn-info"><i class="fas fa-eye"></i>
                                                    </a> -->
                                                    <a href="<?= base_url('Returpenjualan/printInvoice/' . $data->id_retur_penjualan) ?>" class="btn btn-success" target="_blank"><i class="fas fa-print"></i>
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
