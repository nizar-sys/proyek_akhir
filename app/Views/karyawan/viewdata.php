<table class="table table-hover" id="datakaryawan">
            <thead>
              <tr>
                <th scope="col">Id Karyawan</th>
                <th scope="col">Nama Karyawan</th>
                <th scope="col">Alamat</th>
                <th scope="col">No Telepon</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                  // looping hasil karyawan dari database
                  foreach($tampildata as $row):
                      ?>
                          <tr>
                            <th scope="row"><?=$row['id_karyawan']?></th>
                            <td><?=$row['nama_karyawan']?></td>
                            <td><?=$row['alamat']?></td>
                            <td><?=$row['no_telepon']?></td>
                            <td>
                               <a href="<?=base_url('karyawan/viewData/'.$row['id_karyawan'])?>" class="btn btn-primary btn-sm">Ubah</a>
                               <a onclick="deleteConfirm('<?php echo base_url('karyawan/delete/'.$row['id']) ?>')" href="#" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Hapus</a>
                               
                            </td>
                          </tr>
                      <?php
                  endforeach;
              
              ?>
              
            </tbody>
        </table>
        <script>
            $(document).ready(function(){
                    $('#datakaryawan').DataTable();
                }
            );
        </script>