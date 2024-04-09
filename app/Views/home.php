
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="alert alert-success" role="alert">
          <?php 
            $session = session();
            echo "Selamat datang ".$session->get('user_name');
          ?>
      </div>
      <?php foreach($alldata as $data){
 ?>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                <i class="fas fa-box"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                        <h4>Total Barang</h4>
                  </div>
                  <div class="card-body">
                  <?= $data['stok'] ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Penjualan</h4>
                  </div>
                  <div class="card-body">
                  <?= format_rupiah($data['total']) ?>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
      
        
            
            
           