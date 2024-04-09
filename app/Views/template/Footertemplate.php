
  <!-- General JS Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="<?=base_url()?>/template/assets/js/stisla.js"></script>
  <script src="<?=base_url('js/bootstrap.bundle.min.js')?>"></script>


  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="<?=base_url()?>/template/assets/js/scripts.js"></script>
  <script src="<?=base_url()?>/template/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?= base_url('/template/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('/template/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>

<script>
   $('#id_barang, #jumlah_barang').on('change', function() {
    var selectedOption = $('#id_barang').find(':selected');
  var price = selectedOption.data('price');
  console.log(price);
  var value2 = $('#jumlah_barang').val();
  var result = price * value2;
  $('#harga_auto').val(result);
});
    </script>

<script>
  $(function () {
    $("#myTable2").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#myTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  </script> 
<!-- Jquery Masking -->
<script src="<?= base_url('jquery/jquery.mask.js')?>"></script>

<!-- Awal Masking -->
<script>
        $(document).ready(function(){
          // Format .
          $('#no_telp').mask('0000-0000-0000', {reverse: true});	
          $('#header_akun').mask('0-0000', {reverse: true});	
        })
	</script>
    <!-- Akhir Masking -->

    <script>
      $(document).ready(function() {
          $('.select-id-barang').select2({
            multiple: true,
          });
      });
    </script>


</body>
</html>
