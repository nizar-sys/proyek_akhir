<div class="main-content">
        <section class="section">
          <div class="section-header">
          <h1 class="h2"><?= esc($title) ?></h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?=base_url('Coa/view')?>">Master Data</a></div>
              <div class="breadcrumb-item"><a href="<?=base_url('modal/view')?>">Transaksi</a></div>
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
        <form action="<?=base_url('modal/minus')?>" method="post" novalidate>
        <div class="card-body">
                   
                    <div class="form-group row">
                  <label for="jenis_produk" class="col-sm-2 col-form-label">Tanggal modal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tgl_modal" name="tgl_modal" value="<?= set_value('tgl_modal')?>" placeholder="Diisi dengan tanggal">
                    <div class="invalid-feedback" id="errortgl_modal"></div>            
                  </div>
                </div>   
                

                <?php 
                    // contoh mendapatkan error per komponen tanggal mulai
                    if(isset($validation)){
                        if($validation->getError('tgl_modal')) {?>
                            <script>
                                // modifikasi elemen class input form untuk tgl_modal menjadi is-invalid
                                document.getElementById('tgl_modal').setAttribute("class", "form-control is-invalid");
                                document.getElementById('errortgl_modal').innerHTML = "<?=$validation->getError('tgl_modal'); ?>";
                                // serta tambahkan div class invalid
                            </script>
                        <?php 
                        }else{
                            // tidak ada error di tgl_modal maka nilai is-invalid dihapuskan
                            ?>
                            <script>
                                // modifikasi elemen class input form untuk tgl_modal menjadi is-valid
                                document.getElementById('tgl_modal').setAttribute("class", "form-control is-valid");
                                document.getElementById('errortgl_modal').innerHTML = "";
                                // serta tambahkan div class is valid
                            </script>
                            <?php
                        }
                    }?>
                    
               <div class="form-group row">
                  <label for="jenis_produk" class="col-sm-2 col-form-label">Jumlah modal</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Modal" value="<?= set_value('jumlah')?>" >
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
                  <label for="jenis_produk" class="col-sm-2 col-form-label">Keterangan</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" name="keterangan" placeholder="Catatan Keterangan Pemodalan" >
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



     
