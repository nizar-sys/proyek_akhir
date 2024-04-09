<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Retur Pembelian</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url('returpembelian/add') ?>" class="btn btn-icon icon-left btn-success rounded float-right"><i class="fa fa-plus fa-xl"></i>&nbsp Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th class="text-right">#</th>
                                            <th class="text-center">Supplier</th>
                                            <th class="text-center">Nama Barang</th>
                                            <th class="text-center">Total Pembelian</th>
                                            <th class="text-center">Tanggal Pembelian</th>
                                            <th class="text-center">Nama Karyawan</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        helper('number') ?>
                                        <?php foreach ($dataRetur as $data) { ?>
                                            <tr>
                                                <td align="center"><?= $no; ?></td>
                                                <td align="center"><?= $data->nama_supplier ?></td>
                                                <td align="center"><?= $data->nama_barang ?></td>
                                                <td align="right"><?= number_to_currency($data->total, 'IDR', 'id_ID', 2) ?></td>
                                                <td align="center"><?= $data->tgl_pembelian ?></td>
                                                <td align="center"><?= $data-> nama_karyawan ?></td>
                                                <td >
                                                    <!-- <a href="<?= base_url('Returpembelian/show/' . $data->id_retur_pembelian) ?>" class="btn btn-info"><i class="fas fa-eye"></i>
                                                    </a> -->
                                                    <a href="<?= base_url('Returpembelian/printInvoice/' . $data->id_retur_pembelian) ?>" class="btn btn-success" target="_blank"><i class="fas fa-print"></i>
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
