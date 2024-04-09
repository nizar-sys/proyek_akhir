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
                        <div class="card-body">
                            <?php
                            if (session()->has("success")) {
                            ?>
                                <div class="alert alert-primary alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        <b><?= session("success"); ?></b>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No Transaksi</th>
                                            <th class="text-center">Nama Barang</th>
                                            <th class="text-center">Nama Supplier</th>
                                            <th class="text-center">Tanggal Pembelian</th>
                                            <th class="text-center">Subtotal Pembelian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        $total = 0;
                                        helper('number') ?>
                                        <?php foreach ($datalengkap->getResult() as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $data->id_transaksi ; ?></td>
                                                <td class="text-center"><?= $data->nama_barang ?></td>
                                                <td class="text-center"><?= $data->nama_supplier ?></td>
                                                <td class="text-center"><?= $data->tanggal ?></td>
                                                <td class="text-center"><?= number_to_currency($data->subtotal, 'IDR', 'id_ID', 2) ?></td>
                                            </tr>
                                            <?php $no++; 
                                            $total = $total+$data->subtotal;?>
                                        <?php } ?>
                                    </tbody>
                                    <tr>
                                         <td align="center" colspan="4">Total: </td>
                                        <td align="center" class="gray"><?=  number_to_currency( $total, 'IDR', 'id_ID', 2);?></td>
                                                            </tr>     
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>