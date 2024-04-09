<div class="main-content">
        <section class="section">
          <div class="section-header">
          <h1 class="h2"><?= esc($title) ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="<?=base_url('supplier/view')?>">Master Data</a></div>
            </div>
          </div>

      <!-- Main content -->
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
              <!-- Looping data kosan -->
                <?php 
                    foreach ($datasupplier as $row) {
                        $id_supplier = $row-> id_supplier;
                        $nama_supplier = $row->nama_supplier;
                        $alamat = $row->alamat; 
                        $no_telp = $row->no_telp; 
  

                    }
                ?>
              <!-- form start -->
              <form action="<?=base_url('supplier/update')?>" method="post">
              <?= csrf_field() ?>
                <div class="card-body">
              <div hidden class="form-group row">
                <label hidden for="inputEmail3" class="col-sm-2 col-form-label">Id supplier </label>
                    <div hidden class="col-sm-2">
                      <input hidden type="text" class="form-control" id="id_supplier" name="id_supplier" value="<?=$id_supplier?>" readonly>                         
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama supplier</label>
                    <div class="col-sm-10">
                        <?php
                            //jika set value idkosan tidak kosong maka isi $id diganti dengan isian dari user
                            if(strlen(set_value('nama_supplier'))>0){
                            $nama_supplier = set_value('nama_supplier');
                            }
                        ?>
                      <input type="text" class="form-control" id="nama_supplier" placeholder="Nama Supplier" name="nama_supplier" value="<?=$nama_supplier?>">
                      <div class="invalid-feedback" id="errornama_supplier"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('nama_supplier')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk id_kos menjadi is-invalid
                                    document.getElementByid('nama_supplier').setAttribute("class", "form-control is-invalid");
                                    document.getElementByid('errornama_supplier').innerHTML = "<?=$validation->getError('nama_supplier'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di id_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk id_kos menjadi is-valid
                                    document.getElementByid('nama_supplier').setAttribute("class", "form-control is-valid");
                                    document.getElementByid('errornama_supplier').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">alamat supplier</label>
                    <div class="col-sm-10">
                        <?php
                            //jika set value idkosan tidak kosong maka isi $nama diganti dengan isian dari user
                            if(strlen(set_value('alamat'))>0){
                            $alamat = set_value('alamat');
                            }
                        ?>
                      <input type="text" class="form-control" id="alamat" placeholder="Nama" name="alamat" value="<?=$alamat?>">
                      <div class="invalid-feedback" id="erroralamat"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('alamat')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementByid('alamat').setAttribute("class", "form-control is-invalid");
                                    document.getElementByid('erroralamat').innerHTML = "<?=$validation->getError('alamat'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementByid('alamat').setAttribute("class", "form-control is-valid");
                                    document.getElementByid('erroralamat').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">no_telp supplier</label>
                     <div class="col-sm-10">
                        <?php
                            //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                            if(strlen(set_value('no_telp'))>0){
                            $no_telp = set_value('no_telp');
                            }
                        ?>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="no_telp" value="<?=$no_telp?>">
                        <div class="invalid-feedback" id="errorno_telp"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('no_telp')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementByid('no_telp').setAttribute("class", "form-control is-invalid");
                                    document.getElementByid('errorno_telp').innerHTML = "<?=$validation->getError('no_telp'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is valid
                                    document.getElementByid('no_telp').setAttribute("class", "form-control is-valid");
                                    document.getElementByid('errorno_telp').innerHTML = "";
                                    // serta tambahkan div class invalid
                                </script>
                                <?php
                            }
                        }?> 
                    </div>
                </div>
               
               

                <!-- /.card-body -->
                <div class="mb-3 row">
                <div class="col-sm-5"></div>
                <input class="col-sm-1 btn btn-success" type="submit" value="Ubah">
                <div class="col-sm-5"></div>
                </div>
                
                <div class="col-md-12">
                      <?php
                          if(isset($validation)){
                      ?>
                          <div class="alert alert-danger d-flex align-items-center" role="alert">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                              </svg>
                              <div>
                                  <?=$validation->listErrors();?>
                              </div>
                          </div>
                      <?php
                          }
                      ?>
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