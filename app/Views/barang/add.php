<div class="main-content">
        <section class="section">
          <div class="section-header">
          <h1 class="h2"><?= esc($title) ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="<?=base_url('menu/view')?>">Master Data</a></div>
            </div>
          </div>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form <?= esc($title)?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?=base_url('barang/add')?>" method="post" novalidate>
                <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama barang :</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama_barang" placeholder="Masukkan Nama barang" name="nama_barang" value="<?= set_value('nama_barang')?>">
                      <div class="invalid-feedback" id="errornama_barang"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('nama_barang')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('nama_barang').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errornama_barang').innerHTML = "<?=$validation->getError('nama_barang'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('nama_barang').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errornama_barang').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Harga barang : </label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="harga_barang" min="0" placeholder="Masukkan harga barang" name="harga_barang" value="<?= set_value('harga_barang')?>">
                      <div class="invalid-feedback" id="errorharga_barang"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('harga_barang')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk harga_kos menjadi is-invalid
                                    document.getElementById('harga_barang').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorharga_barang').innerHTML = "<?=$validation->getError('harga_barang'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di harga_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk harga_kos menjadi is-valid
                                    document.getElementById('harga_barang').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorharga_barang').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Stok barang : </label>
                     <div class="col-sm-10">
                        <input type="number" class="form-control" id="stok_akun" min="0" name="stok" placeholder="Masukkan stok barang" value="<?= set_value('stok')?>">
                        <div class="invalid-feedback" id="errorstok"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('stok')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('stok').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorstok').innerHTML = "<?=$validation->getError('stok'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is valid
                                    document.getElementById('stok').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorstok').innerHTML = "";
                                    // serta tambahkan div class invalid
                                </script>
                                <?php
                            }
                        }?> 
                    </div>
                </div>
                
                <div class="mb-3 row">
                <div class="col-sm-5"></div>
                <input class="col-sm-1 btn btn-success" type="submit" value="Input">
                <div class="col-sm-5"></div>
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