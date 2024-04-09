<div class="main-content">
        <section class="section">
          <div class="section-header">
          <h1 class="h2"><?= esc($title) ?></h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?=base_url('menu/view')?>">Master Data</a></div>
              <div class="breadcrumb-item"><a href="<?=base_url('penjualan/view')?>">Transaksi</a></div>
            </div>
          </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>

      <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Transaksi <?= esc($title) ?></h3>
              </div>
              <?php 
              if (!empty($error_msg)) {
                echo $error_msg;
            }            
              ?>

        <form action="<?=base_url('pembelian/simpanbarang')?>" method="post" novalidate>
        <div class="card-body">
        <?php
                                //looping supplier
                                foreach($id_transaksi as $row):
                                    $id_transaksi = $row->id_transaksi;
                                    endforeach;
                                  ?>

                                  
        <div class="form-group row">
                <label  for="inputEmail3" class="col-sm-2 col-form-label">Id_Transaksi </label>
                    <div  class="col-sm-4">
                      <input  type="text" class="form-control" id="id_transaksi" name="id_transaksi" value="<?= $id_transaksi  ?>" readonly>                         
                    </div>
                </div>

                <div class="form-group row">
                <label for="id_barang" class="col-sm-2 col-form-label">Pilih barang</label>
                  <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" id="id_barang" name="id_barang">
                        <option value="" selected disabled>Pilih barang</option>
                            <?php
                                //looping supplier
                                foreach($barang as $row):
                                   
                                    $id_barang = $row->id_barang;
                                    $nama_barang = $row->nama_barang;
                                    $harga_barang = $row->harga_barang;

                                    if(set_value('id_barang')==$id_barang){
                                      ?>
                                        <option data-price="<?php echo $row->harga_barang; ?>" value="<?= $id_barang ?>" selected><?= $nama_barang?>-<?= format_rupiah($harga_barang)?></option>
                                      <?php
                                    }else{
                                      ?>
                                        <option data-price="<?php echo $row->harga_barang; ?>" value="<?= $id_barang ?>"><?= $nama_barang?>-<?= format_rupiah($harga_barang)?></option>
                                      <?php
                                    }
                                endforeach;
                            ?>
                        </select>
                        <div class="invalid-feedback" id="errorpembelian"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('id_barang')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('id_barang').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorpembelian').innerHTML = "<?=$validation->getError('id_barang'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('id_barang').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorpembelian').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                    </div>
              

              
                <div class="form-group row">
                <label for="id_supplier" class="col-sm-2 col-form-label">Pilih supplier</label>
                  <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" id="id_supplier" name="id_supplier">
                        <option value="" selected disabled>Pilih supplier</option>
                            <?php
                                //looping supplier
                                foreach($supplier as $row):
                                   
                                    $id_supplier = $row->id_supplier;
                                    $nama_supplier = $row->nama_supplier;

                                    if(set_value('id_supplier')==$id_supplier){
                                      ?>
                                        <option value="<?= $id_supplier ?>" selected><?= $nama_supplier?></option>
                                      <?php
                                    }else{
                                      ?>
                                        <option value="<?= $id_supplier ?>"><?= $nama_supplier ?></option>
                                      <?php
                                    }
                                endforeach;
                            ?>
                        </select>
                        <div class="invalid-feedback" id="errorsupplier"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('id_supplier')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('id_supplier').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorsupplier').innerHTML = "<?=$validation->getError('id_supplier'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('id_supplier').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorsupplier').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                    </div>
                    
               <div class="form-group row">
                  <label for="jenis_produk" class="col-sm-2 col-form-label">Jumlah Pembelian</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="jumlah Pembelian" value="<?= set_value('jumlah')?>" >
                  <div class="invalid-feedback" id="errorjumlah"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('jumlah')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('jumlah').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorjumlah').innerHTML = "<?=$validation->getError('jumlah'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('jumlah').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorjumlah').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                  </div>
                  
              

             
                <div class="form-group row">
                  <label for="jenis_produk" class="col-sm-2 col-form-label">Total</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" id="harga_auto" name="subtotal" placeholder="Total Harga"  readonly>
                  </div>
                </div>  
                  

                <div class="mb-3 row">
                <div class="col-sm-5"></div>
                <input type="submit" class="col-sm-1 btn btn-success"  value="Tambah" ></input>
                <div class="col-sm-5"></div>
            </form>
            <form action="<?=base_url('pembelian/selesai')?>" method="post" novalidate>      
            </div>
            <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">nama barang</th>
                                            <th class="text-center">Nama Supplier</th>
                                            <th class="text-center">Jumlah Beli</th>
                                            <th class="text-center">Subtotal</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        $total = 0;
                                        helper('number') ?>
                                        <?php foreach ($dataPembelian as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td class="text-center"><?= $data->nama_barang ?></td>
                                                <td class="text-center"><?= $data->nama_supplier ?></td>
                                                <td class="text-center"><?= $data->jumlah ?></td>
                                                <td class="text-center"><?= number_to_currency($data->subtotal, 'IDR', 'id_ID', 2) ?></td>
                                
                                                <td class="text-center">
                                                    <a href="<?= base_url('pembelian/delete/' . $data->id_transaksi.'/'.$data->id_barang) ?>" class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $no++; 
                                            
                                            $total = $total+$data->subtotal;
                                            ?>

                                        <?php } ?>
                                    </tbody>
                                    <tr>
                                         <td align="center" colspan="4">Total: </td>
                                        <td align="center" class="gray"><?=  number_to_currency($total, 'IDR', 'id_ID', 2);?></td>
                                                            </tr>      
                                </table>
                                </div>
                        </div>

                <div class="form-group row">
                     <label for="jenis_produk" class="col-sm-3 col-form-label">Total Belanja Seluruhnya</label>
                  <div class="col-sm-5">
                     <input type="text" class="form-control" id="harga_auto" name="total" placeholder="Total Harga" value="<?=number_to_currency($total, 'IDR', 'id_ID', 2);?>" readonly>
                  </div>
                  <div class="col-sm-4">
                     <input type="submit" class="col-sm-3 btn btn-success"  value="Selesai" ></input>
                  </div>
                </div>
     
              
                    </form>
          </div>
            <!-- /.card -->
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
    </main>
  </div>
</div>



     
