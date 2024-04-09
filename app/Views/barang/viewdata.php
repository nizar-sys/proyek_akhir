<table class="table table-hover" id="databarang">
            <thead>
              <tr>
                <th scope="col">Nama barang</th>
                <th scope="col">Harga barang</th>
                <th scope="col">Stok Barang</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                  // looping hasil barang dari database
                  foreach($tampildata as $row):
                      ?>
                          <tr>
                            <th scope="row"><?=$row['nama_barang']?></th>
                            <td><?=$row['harga_barang']?></td>
                            <td><?=$row['stok']?></td>
                            <td>
                               <a href="<?=base_url('barang/viewData/'.$row['id_barang'])?>" class="btn btn-primary btn-sm">Ubah</a>
                               <a onclick="deleteConfirm('<?php echo base_url('barang/delete/'.$row['id_barang']) ?>')" href="#" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Hapus</a>
                               
                            </td>
                          </tr>
                      <?php
                  endforeach;
              
              ?>
              
            </tbody>
        </table>
        <script>
            $(document).ready(function(){
                    $('#databarang').DataTable();
                }
            );
        </script>