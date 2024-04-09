<?php

namespace App\Controllers;

use App\Models\karyawanModel; //include karyawan model di dalam controller

class karyawan extends BaseController
{
    // method tambah data
    public function add()
    {
        $karyawan_model = model(karyawanModel::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'nama_karyawan' => 'required|min_length[3]|max_length[50]',
                'alamat'  => 'required',
                'no_telepon'  => 'required|numeric',

                ],
                [  
                     //List Custom Pesan Error
                    'nama_karyawan' => [
                        'required' => 'Nama karyawan tidak boleh kosong',
                        'min_length' => 'Panjang nama karyawan tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama karyawan tidak boleh lebih dari 50',
                    ],
                    'alamat' => [
                        'required' => 'Alamat tidak boleh kosong',
                    ],
                    'no_telepon' => [
                        'required' => 'No telp karyawan tidak boleh kosong',
                        'numeric' => 'No telp karyawan harus angka'
                    ],
                    
                ]
            )
            ) 
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung masukkan ke database
            $karyawan_model->save([
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'alamat' => $this->request->getPost('alamat'),
                'no_telepon'  => $this->request->getPost('no_telepon'),
            

            ]);

            $session = session();
            $session->setFlashdata("status_dml", "Sukses Input");

            // redirect ke daftar kosan
            return redirect()->to('karyawan/view');

        } else {
            echo view('template/Headertemplate');
            echo view('template/Sidebartemplate');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            echo view('karyawan/Add', [
                                    'title' => 'Input Karyawan',
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('template/Footertemplate');           
        }
    }

    // method view daftar kosan
    public function view(){

        $karyawan_model = model(karyawanModel::class);
        $datakaryawan = $karyawan_model->getkaryawan();
        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('karyawan/View',
                    [
                        'title' => 'View Karyawan',
                        'datakaryawan' => $datakaryawan,
                    ]
                 );
        echo view('template/Footertemplate');            
    }

    //method ambil data
    
    // method view daftar karyawan dgn menggunakan AJAX
    
    
    // method untuk menghapus kosan
    public function delete($id){
        $karyawan_model = model(karyawanModel::class);
        $karyawan_model->deletekaryawan($id);

        $session = session();
        $session->setFlashdata("status_dml", "Sukses Delete");

        return redirect()->to('karyawan/view');
    }

    // method untuk melihat data kos berdasarkan id kos
    public function viewData($id){
        $karyawan_model = model(karyawanModel::class);
        $datakaryawan = $karyawan_model->getkaryawanBasedOnId($id);

        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('karyawan/Edit',
                    [
                        'title' => 'Ubah Karyawan',
                        'datakaryawan' => $datakaryawan,
                    ]
                 );
        echo view('template/Footertemplate');         
    }

    // method untuk mengupdate data kos 
    public function update(){
        $karyawan_model = model(karyawanModel::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'nama_karyawan'  => 'required|min_length[3]|max_length[50]',
                'alamat' => 'required',
                'no_telepon'  => 'required|numeric',

                ],
                [   //List Custom Pesan Error                
                    'nama_karyawan' => [
                        'required' => 'Nama karyawan tidak boleh kosong',
                        'min_length' => 'Panjang nama karyawan tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama karyawan tidak boleh lebih dari 50',
                    ],
                    'alamat' => [
                        'required' => 'Alamat karyawan tidak boleh kosong',
                    ],
                    'no_telepom'=> [
                        'required' => 'No telp karyawan tidak boleh kosong',
                        'numeric' => 'No telp karyawan harus angka'
                    ],
                    
                ]
            )
            ) 
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung update ke database
            $karyawan_model->updatekaryawan();

            $session = session();
            $session->setFlashdata("status_dml", "Sukses Update");
            // redirect ke daftar kosan
            return redirect()->to('karyawan/view');

        } else {
            echo view('template/Headertemplate');
            echo view('template/Sidebartemplate');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            $datakaryawan = $karyawan_model->getkaryawanBasedOnId($_POST['id']);
            echo view('karyawan/Edit', [
                                    'title' => 'Ubah Karyawan',
                                    'datakaryawan' => $datakaryawan,
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('template/Footertemplate');           
        }
    }

    // function untuk tambah pop up
   
    

}
