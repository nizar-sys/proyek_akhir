<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pemodalan</h1>
        </div>


        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url('modal/add') ?>" class="btn btn-icon icon-left btn-primary rounded float-right"><i class="fa fa-plus fa-xl"></i>&nbsp Setor Modal</a>
                            <a>&nbsp</a>
                            <a href="<?= base_url('modal/minus') ?>" class="btn btn-icon icon-left btn-warning rounded float-right"><i class="fa fa-minus fa-xl"></i>&nbsp Tarik Modal</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Tanggal modal</th>
                                            <th class="text-center">Total modal</th>
                                            <th class="text-center">keterangan</th>

                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        helper('number') ?>
                                        <?php foreach ($datamodal as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td class="text-center"><?= $data->tgl_modal ?></td>
                                                <td class="text-center"><?= number_to_currency($data->jumlah, 'IDR', 'id_ID', 2) ?></td>
                                                <td class="text-center"><?= $data->keterangan ?></td>
                                                <td class="text-center">
                                                    <!-- <a href="<?= base_url('modal/show/' . $data->id_modal) ?>" class="btn btn-info"><i class="fas fa-eye"></i>
                                                    </a> -->
                                                    <a href="<?= base_url('modal/printInvoice/' . $data->id_modal) ?>" class="btn btn-success" target="_blank"><i class="fas fa-print"></i>
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
