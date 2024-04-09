<div class="main-content">
        <section class="section">
          <div class="section-header">
          <h1 class="h2"><?= esc($title) ?></h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?=base_url('menu/view')?>">Master Data</a></div>
              <div class="breadcrumb-item"><a href="<?=base_url('penjualan/view')?>">Transaksi</a></div>
            </div>
          </div>

      <div class="alert alert-success" role="alert">
          <?php 
            $session = session();
            echo "Selamat datang ".$session->get('user_name');
          ?>
      </div>
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header"> 
      <div class="card-body">
      <form class="row g-3 needs-validation" action="<?=base_url('Laporan/bukubesar')?>" method="post"
        novalidate>
<div class="container-fluid mb-3">
       <table class="table table-bordered">
        
       <div class="form-group row">
                  <label for="tgl_awal" class="col-sm-2 col-form-label">Pilih Coa</label>
                  <div class="col-sm-10">
                  <select name="kode_coa" class="form-control select2">
                         <option value="#" disabled selected>Pilih Chart Of Account (COA)</option>
                                <?php foreach($coa as $data){
                                  echo "
                                   <option value = ".$data->kode_coa.">".$data->nama_coa."</option> "; }
                                    ?>
                                 </select>
                    <div class="invalid-feedback" id="errortgl_jual"></div>            
                  </div>
                </div>   
                <div class="form-group row">
                  <label for="tgl_akhir" class="col-sm-2 col-form-label">Pilih Bulan</label>
                  <div class="col-sm-10">
                  <select name="bulan" class="form-control">
                                                    <option value="" disabled selected>Pilih Bulan Transaksi</option>
                                                    <option value="01">Jan</option>
                                                    <option value="02">Feb</option>
                                                    <option value="03">Mar</option>
                                                    <option value="04">Apr</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Jun</option>
                                                    <option value="07">Jul</option>
                                                    <option value="08">Agt</option>
                                                    <option value="09">Sept</option>
                                                    <option value="10">Okt</option>
                                                    <option value="1">Nov</option>
                                                    <option value="12">Des</option>
                                                </select>
                    <div class="invalid-feedback" id="errortanggal_jual"></div>            
                  </div>
                </div>   
                <div class="form-group row">
                  <label for="tgl_akhir" class="col-sm-2 col-form-label">Pilih Tahun</label>
                  <div class="col-sm-10">
                  <select name="tahun" class="form-control">
                                                    <option value="" disabled selected>Pilih Tahun Transaksi</option> <?php for ($i=2020; $i < 2025; $i++) {
                                                        echo "<option value". $i.">".$i."</option>"; } ?>
                                                </select>
                    <div class="invalid-feedback" id="errortanggal_jual"></div>            
                  </div>
                </div>   

        <button type="submit" name="submit" class="btn btn-primary btn-sm">Proses</button>
       </table>
                       <hr>
                                    <?php
                                     foreach($coa as $data){

                                     }
                                        foreach($jurnal as $d){
                                             $nama_coa = $data->nama_coa;
                                        }
                                    ?>
                            <br>
                            <center>
                            <h4>Buku Besar</h4>
                            <h4>CV Bali-Bo</h4>
                            <?php if(isset($_POST->bulan) && isset($_POST->tahun)){
                              $tgl = $this->input->post('tahun')."-".$this->input->post('bulan')."-01";
                            ?>
                              <h4>Periode <?= date('M', strtotime($tgl)) ?> - <?= $this->input->post('tahun')?></h4>
                            <?php }else{?>
                              <h4>Semua Periode</h4>
                            <?php } ?>
                            </center>
                            <br>
                            <div class="container-fluid md-3">
                             <p> Chart Of Account : 
                            <?php if(isset($_POST->bulan) && isset($_POST->tahun)){
                                echo $datacoa->nama_coa; }else{
                                    echo "Kas";
                                }?>
                            </p>
                            </div>

                            <div class="container-fluid md-3">
                            <table class="table table-bordered table-hover" >
                            <tr>
                                <th rowspan=2>Tanggal</th>
                                <th rowspan=2>Keterangan</th>
                                <th rowspan=2>Reff</th>
                                <th rowspan=2>Debit</th>
                                <th rowspan=2>Kredit</th>
                                <th colspan=2>Saldo</th>
                            </tr>
                            <tr>
                                <th>Debit</th>
                                <th>Kredit</th>
                            </tr>
                            <?php
                                $saldo_awal=0;
                                if(isset($_POST->bulan) && isset($_POST->tahun)){
                                    if($datacoa->header_coa == 1 or ($datacoa->header_coa == 5 and $datacoa->kode_coa != 501) or $datacoa->header_coa == 6){  
                                        $saldo_awal = $debit->saldo_awal_debit - $kredit->saldo_awal_kredit;
                                    }else{
                                        $saldo_awal = $debit->saldo_awal_debit + $kredit->saldo_awal_kredit;
                                    }
                                }
                                echo "
                                <tr>
                                <th>00-00-0000</th>
                                <th>Saldo Awal</th>
                                <th></th>
                                <th></th>
                                <th></th>";
                                if((($data->kode_coa == 111 or ($data->kode_coa == 5  and $data->kode_coa == 501 ) or $data->kode_coa == 6) and $saldo_awal>=0) or (($data->kode_coa == 21111 or $data->kode_coa == 4 or $data->kode_coa == 311 or $data->kode_coa == 31211 or $data->kode_coa == 311 or $data->kode_coa == 31212 ) and $saldo_awal<0)){  
                                    echo "<td align = 'right'><b>".format_rupiah($saldo_awal)."</b></td>";
                                }else{
                                    echo "<td></td>";
                                }

                                if((($data->kode_coa == 111  or ($data->kode_coa == 5 and $data->kode_coa->kode_coa != 501) or $data->kode_coa == 6) and $saldo_awal>=0) or (($data->kode_coa == 21111 or $data->kode_coa == 4 or $data->kode_coa == 311 or $data->kode_coa == 31211 or $data->kode_coa == 311 or $data->kode_coa == 31212 ) and $saldo_awal<0)){  
                                    echo "<td></td>";
                                }else{
                                    echo "<td align = 'right'><b>".format_rupiah($saldo_awal)."</b></td>";
                                }
                                echo "
                                </tr>
                                    ";
                                        foreach($jurnal as $data){
                                        echo "
                                            <tr>
                                                <td>".$data->tgl_jurnal."</td>
                                                <td>".$data->nama_coa."</td>
                                                <td>".$data->kode_coa."</td>
                                            ";
                                        if($data->posisi_dr_cr == 'Debet'){
                                   
                                            //if($data->kode_coa == d or $datacoa->header_coa == 5 or $datacoa->header_coa == 6){
                                            if($data->kode_coa == 111 or ($data->kode_coa == 5 and $data->kode_coa != 501) or $data->kode_coa == 6 ){  
                                                $saldo_awal = $saldo_awal + $data->nominal;
                                            }else{
                                                $saldo_awal = $saldo_awal - $data->nominal;
                                            }
                                            echo "
                                                <td align = 'right'>".format_rupiah($data->nominal)."</td>
                                                <td></td>";
                                                if((($data->kode_coa == 111 or ($data->kode_coa == 5 and $data->kode_coa != 501) or $data->kode_coa == 6) and $saldo_awal>=0) or (($data->kode_coa == 211 or $data->kode_coa == 4 or $data->kode_coa == 311 or $data->kode_coa == 312 ) and $saldo_awal<0)){  
                                                    echo "<td align = 'right'>".format_rupiah($saldo_awal)."</td>";
                                                }else{
                                                    echo "<td></td>";
                                                }

                                                if((($data->kode_coa == 111 or ($data->kode_coa == 5 and $data->kode_coa != 501) or $data->kode_coa == 6) and $saldo_awal>=0) or (($data->kode_coa == 211 or $data->kode_coa == 4 or $data->kode_coa == 311 or $data->kode_coa == 312 ) and $saldo_awal<0)){  
                                                    echo "<td></td>";
                                                }else{
                                                    echo "<td align = 'right'>".format_rupiah($saldo_awal)."</td>";
                                                }
                                           
                                            echo "
                                            </tr>
                                            ";

                                        }else{
                                            if($data->kode_coa == 111 or ($data->kode_coa == 5 and $data->kode_coa != 501) or $data->kode_coa == 6){
                                                $saldo_awal = $saldo_awal - $data->nominal;
                                            }else{
                                                $saldo_awal = $saldo_awal + $data->nominal;
                                            }
                                            
                                            echo "
                                                <td></td>
                                                <td align = 'right'>".format_rupiah($data->nominal)."</td>";
                                                if((($data->kode_coa == 111 or ($data->kode_coa == 5 and $data->kode_coa != 501) or $data->kode_coa == 6) and $saldo_awal>=0) or (($data->kode_coa == 211 or $data->kode_coa == 4 or $data->kode_coa == 311 or $data->kode_coa == 312 ) and $saldo_awal<0)){  
                                                    echo "<td align = 'right'>".format_rupiah($saldo_awal)."</td>";
                                                }else{
                                                    echo "<td></td>";
                                                }

                                                if((($data->kode_coa == 111 or ($data->kode_coa == 5 and $data->kode_coa != 501) or $data->kode_coa == 6) and $saldo_awal>=0) or (($data->kode_coa == 211 or $data->kode_coa == 4 or $data->kode_coa == 311 or $data->kode_coa == 312 ) and $saldo_awal<0)){  
                                                    echo "<td></td>";
                                                }else{
                                                    echo "<td align = 'right'>".format_rupiah($saldo_awal)."</td>";
                                                }
                                           
                                            echo "
                                                
                                            </tr>
                                            ";
                                        }
                                }
                                echo "
                                <tr>
                                    <th>00-00-0000</th>
                                    <th>Saldo Akhir</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>";
                                    if((($data->kode_coa == 111 or ($data->kode_coa == 5 and $data->kode_coa != 501) or $data->kode_coa == 6) and $saldo_awal>=0) or (($data->kode_coa == 211 or $data->kode_coa == 4 or $data->kode_coa == 311 or $data->kode_coa == 312 ) and $saldo_awal<0)){  
                                        echo "<td align = 'right'><b>".format_rupiah($saldo_awal)."</b></td>";
                                    }else{
                                        echo "<td></td>";
                                    }
                                    if((($data->kode_coa == 111 or ($data->kode_coa == 5 and $data->kode_coa != 501) or $data->kode_coa == 6) and $saldo_awal>=0) or (($data->kode_coa == 211 or $data->kode_coa == 4 or $data->kode_coa == 311 or $data->kode_coa == 312 ) and $saldo_awal<0)){  
                                        echo "<td></td>";
                                    }else{
                                        echo "<td align = 'right'><b>".format_rupiah($saldo_awal)."</b></td>";
                                    }
                                echo "
                                </tr>
                                ";
                            ?>
                        </table>
                  </div>
                  </div>
              </div>
            </div>
     </div>

        <!-- /page content -->

        <script>
function deleteConfirm(url){
  $('#btn-delete').attr('href', url);
  $('#deleteModal').modal();
}
</script>
<!-- Logout Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">X</span>
        </button>
      </div>
      <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
      </div>
    </div>
  </div>
</div>