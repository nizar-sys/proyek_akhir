<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?=base_url('sign-in/signin.css')?>" rel="stylesheet">
    <title>Login</title>
  </head>

  <body>
       <div class="container">
         <div class="box">
           <div class="row contentForm">
             <div class="col-sm-12 col-md-6 col-lg-6">
             <img src="/Pictures/balibo.jpg" alt="" class="img-fluid">
             </div>
                 <div class="col-sm-12 col-md-6 col-lg-6">
                 <?php 
            // cek variabel pesan dari $data['pesan'] di kontroller
            if(isset($pesan)){
                // keluarkan alert
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Warning!</strong> <?=$pesan?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            }
    
    ?>


            <form action="<?=base_url('home/ceklogin')?>" method="post">

    <h4 class="text-center">Please sign in</h4>
    <div class="mb-3">
    <label  class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
    </div>
    <div class="mb-3">
    <label  class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">

    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
  </form>

        
             </div>
             </div>
           </div>
         </div>
       </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>