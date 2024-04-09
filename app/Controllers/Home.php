<?php

namespace App\Controllers;

use App\Models\AkunModel; //include akun model di dalam controller

class Home extends BaseController
{
    public function index()
    {
       
        $session = session();
        $session->destroy();


        return view('login-page'); // memanggil view di app/views/login.php
    }

    public function ceklogin(){
        
        
        // load model akun model
        $akunmodel = model(AkunModel::class);
        $hasil = $akunmodel->cekUsernamePassword();
        foreach ($hasil as $row) {
            $jml = $row->jml; //atribut hasil query diberi alias jml
        }
        if($jml==0){
            // artinya tidak ada pasangan username dan password yang cocok, kembalikan ke halaman login
            $data['pesan'] = "Pasangan username dan password tidak tepat";
            echo view('login-page',$data);
        }else{
            // artinya ada pasangan username dan password yang cocok, teruskan ke halaman welcome_message
            // aktifkan session dan simpan username ke dalam session serta buat variabel logged_in
            $session = session();

         
           $ses_data = [
                'user_name'     => $_POST['username'],
                'logged_in'     => TRUE,
              
            ];
            $session->set($ses_data);
          return redirect()->to('home/dashboard');  
        }
    }
    public function dashboard(){

        $semuadata = model(AkunModel::class);
        $alldata = $semuadata->getall();
       

        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('home',
                    [
                        'title' => 'View Penjualan',
                        'alldata' => $alldata,
              
                    ]
                 );
        echo view('template/Footertemplate');            
    }


}
