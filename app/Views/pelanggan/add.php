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
              <form action="<?=base_url('pelanggan/add')?>" method="post" novalidate>
                <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama pelanggan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama_pelanggan" placeholder="Masukkan Nama pelanggan" name="nama_pelanggan" value="<?= set_value('nama_pelanggan')?>">
                      <div class="invalid-feedback" id="errornama_pelanggan"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('nama_pelanggan')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('nama_pelanggan').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errornama_pelanggan').innerHTML = "<?=$validation->getError('nama_pelanggan'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('nama_pelanggan').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errornama_pelanggan').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat Pelanggan</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" placeholder="Masukkan Alamat Pelanggan" value="<?= set_value('alamat')?>">
                        <div class="invalid-feedback" id="erroralamat_pelanggan"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('alamat_pelanggan')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('alamat_pelanggan').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('erroralamat_pelanggan').innerHTML = "<?=$validation->getError('alamat_pelanggan'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is valid
                                    document.getElementById('alamat_pelanggan').setAttribute("class", "form-control is-valid");
                                    document.getElementById('erroralamat_pelanggan').innerHTML = "";
                                    // serta tambahkan div class invalid
                                </script>
                                <?php
                            }
                        }?> 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No Telp Pelanggan</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_telp_pelanggan" name="no_telp_pelanggan" placeholder="Masukkan No Telp Pelanggan" value="<?= set_value('no_telp_pelanggan')?>">
                        <div class="invalid-feedback" id="erroralamat"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('no_telp_pelanggan')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('no_telp_pelanggan').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorno_telp-pelanggan').innerHTML = "<?=$validation->getError('no_telp_pelanggan'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is valid
                                    document.getElementById('no_telp_pelanggan').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorno_telp_pelanggan').innerHTML = "";
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