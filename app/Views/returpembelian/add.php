<div class="main-content">
        <section class="section">
          <div class="section-header">
          <h1 class="h2"><?= esc($title) ?></h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?=base_url('menu/view')?>">Master Data</a></div>
              <div class="breadcrumb-item"><a href="<?=base_url('pembelian/view')?>">Transaksi</a></div>
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
              <form action="<?=base_url('returpembelian/add')?>" method="post" novalidate>
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
                        <div class="invalid-feedback" id="errorreturpembelian"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('id_retur_pembelian')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('id_retur_pembelian').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorreturpembelian').innerHTML = "<?=$validation->getError('id_retur_pembelian'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('id_retur_pembelian').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorreturpembelian').innerHTML = "";
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
                <label for="id_pembelian" class="col-sm-2 col-form-label">Pilih Pembelian</label>
                  <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" id="id_pembelian" name="pembelian">
                        <option value="" selected disabled>Pilih Pembelian</option>
                            <?php
                                //looping supplier
                                foreach($pembelian as $row):
                                   
                                    $id_pembelian = $row->id_pembelian;
                                    $pembelian = $row->pembelian;

                                    if(set_value('id_pembelian')==$id_pembelian){
                                      ?>
                                        <option value="<?= $id_pembelian ?>" selected><?= $pembelian?></option>
                                      <?php
                                    }else{
                                      ?>
                                        <option value="<?= $id_pembelian ?>"><?= $pembelian?></option>
                                      <?php
                                    }
                                endforeach;
                            ?>
                        </select>
                        <div class="invalid-feedback" id="errorpembelian"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('id_pembelian')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('id_pembelian').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorpembelian').innerHTML = "<?=$validation->getError('id_pembelian'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('id_pembelian').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorpembelian').innerHTML = "";
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
                  <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Barang" value="<?= set_value('jumlah')?>" >
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
                  <input type="text" class="form-control" id="harga_auto" name="Total" placeholder="Total Harga"  readonly>
                  </div>
                </div>  

                <div class="form-group row">
                <label for="id_karyawan" class="col-sm-2 col-form-label">Pilih Karyawan</label>
                  <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" id="id_karyawan" name="id_karyawan">
                        <option value="" selected disabled>Pilih Karyawan</option>
                            <?php
                                //looping supplier
                                foreach($karyawan as $row):
                                   
                                    $id_karyawan = $row->id_karyawan;
                                    $nama_karyawan = $row->nama_karyawan;

                                    if(set_value('id_karyawan')==$id_karyawan){
                                      ?>
                                        <option value="<?= $id_karyawan ?>" selected><?= $nama_karyawan?></option>
                                      <?php
                                    }else{
                                      ?>
                                        <option value="<?= $id_karyawan ?>"><?= $nama_karyawan ?></option>
                                      <?php
                                    }
                                endforeach;
                            ?>
                        </select>
                        <div class="invalid-feedback" id="errorkaryawan"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('id_karyawan')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('id_karyawan').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorkaryawan').innerHTML = "<?=$validation->getError('id_karyawan'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('id_karyawan').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorkaryawan').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
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



     

                