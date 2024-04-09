<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pembelian</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url('Pembelian/add') ?>" class="btn btn-icon icon-left btn-success rounded float-right"><i class="fa fa-plus fa-xl"></i>&nbsp Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Id Transaksi</th>
                                            <th class="text-center">Tanggal Pembelian</th>
                                            <th class="text-center">Total Pembelian</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        helper('number') ?>
                                        <?php foreach ($dataPembelian as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $data->id_transaksi ?></td>
                                                <td class="text-center"><?= $data->tanggal ?></td>
                                                <td class="text-center"><?= number_to_currency($data->total, 'IDR', 'id_ID', 2) ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('Pembelian/show/' . $data->id_transaksi) ?>" class="btn btn-info"><i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="<?= base_url('Pembelian/printInvoice/' . $data->id_transaksi) ?>" class="btn btn-success" target="_blank"><i class="fas fa-print"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                               
                                            <?php ?>
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
