<div class="main-content">
        <section class="section">
          <div class="section-header">
          <h1 class="h2"><?= esc($title) ?></h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?=base_url('menu/view')?>">Master Data</a></div>
              <div class="breadcrumb-item"><a href="<?=base_url('returpenjualan/view')?>">Transaksi</a></div>
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
                <h3 class="card-title">Form <?= esc($title) ?></h3>
              </div>
              <form action="<?=base_url('returpenjualan/add')?>" method="post" novalidate>
              <div class="card-body">
                <div class="form-group row">
                <label for="id_barang" class="col-sm-2 col-form-label">Pilih Barang</label>
                  <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" id="id_barang" name="id_barang">
                        <option value="" selected disabled>Pilih Barang</option>
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
                        <div class="invalid-feedback" id="errorreturpenjualan"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('id_retur_penjualan')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('id_retur_penjualan').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorreturpenjualan').innerHTML = "<?=$validation->getError('id_retur_penjualan'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('id_retur_penjualan').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorreturpenjualan').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                    </div>

                    <div class="form-group row">
                  <label for="jenis_produk" class="col-sm-2 col-form-label">Tanggal Retur</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal_retur" name="tanggal_retur" value="<?= set_value('tanggal_retur')?>" placeholder="Diisi dengan tanggal">
                    <div class="invalid-feedback" id="errortanggal_retur"></div>            
                  </div>
                </div>   
                

                <?php 
                    // contoh mendapatkan error per komponen tanggal mulai
                    if(isset($validation)){
                        if($validation->getError('tanggal_retur')) {?>
                            <script>
                                // modifikasi elemen class input form untuk tgl_pembelian menjadi is-invalid
                                document.getElementById('tanggal_retur').setAttribute("class", "form-control is-invalid");
                                document.getElementById('errortanggal_retur').innerHTML = "<?=$validation->getError('tanggal_retur'); ?>";
                                // serta tambahkan div class invalid
                            </script>
                        <?php 
                        }else{
                            // tidak ada error di tgl_pembelian maka nilai is-invalid dihapuskan
                            ?>
                            <script>
                                // modifikasi elemen class input form untuk tgl_pembelian menjadi is-valid
                                document.getElementById('tanggal_retur').setAttribute("class", "form-control is-valid");
                                document.getElementById('errortanggal_retur').innerHTML = "";
                                // serta tambahkan div class is valid
                            </script>
                            <?php
                        }
                    }?>
                    
                    <div class="form-group row">
                <label for="id_penjualan" class="col-sm-2 col-form-label">Pilih Penjualan</label>
                  <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" id="id_penjualan" name="id_penjualan">
                        <option value="" selected disabled>Pilih Penjualan</option>
                            <?php
                                //looping supplier
                                foreach($penjualan as $row):
                                   
                                    $id_penjualan = $row->id_penjualan;
                                 

                                    if(set_value('id_penjualan')==$id_penjualan){
                                      ?>
                                        <option value="<?= $id_penjualan ?>" selected><?= $id_penjualan?></option>
                                      <?php
                                    }else{
                                      ?>
                                        <option value="<?= $id_penjualan ?>"><?= $id_penjualan?></option>
                                      <?php
                                    }
                                endforeach;
                            ?>
                        </select>
                        <div class="invalid-feedback" id="errorpenjualan"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('id_penjualan')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('id_penjualan').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorpenjualan').innerHTML = "<?=$validation->getError('id_penjualan'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('id_penjualan').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorpenjualan').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                    </div>
                    
               <div class="form-group row">
                  <label for="jenis_produk" class="col-sm-2 col-form-label">Jumlah Barang</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" id="jumlah_barang" name="jumlah_barang" placeholder="Jumlah Barang" value="<?= set_value('jumlah_barang')?>" >
                  <div class="invalid-feedback" id="errorjumlah_barang"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('jumlah_barang')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('jumlah_barang').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorjumlah_barang').innerHTML = "<?=$validation->getError('jumlah_barang'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('jumlah_barang').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorjumlah_barang').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                  </div>
                  
              

             
                <div class="form-group row">
                  <label for="jenis_produk" class="col-sm-2 col-form-label">Subtotal</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" id="harga_auto" name="subtotal" placeholder="Total Harga"  readonly>
                  </div>
                </div>  


                <div class="mb-3 row">
                <div class="col-sm-5"></div>
                <input type="submit" class="col-sm-1 btn btn-success"  value="Submit" ></input>
                <div class="col-sm-5"></div>
            </form>
            </div>
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



     

                