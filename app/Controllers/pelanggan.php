<?php

namespace App\Controllers;

use App\Models\pelangganModel; //include pelanggan model di dalam controller

class pelanggan extends BaseController
{
    
    // method tambah data
    public function add()
    {
        $pelanggan_model = model(pelangganModel::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'nama_pelanggan' => 'required|min_length[3]|max_length[50]',
                'alamat_pelanggan'  => 'required',
                'no_telp_pelanggan'  => 'required|numeric',

                ],
                [  
                     //List Custom Pesan Error
                    'nama_pelanggan' => [
                        'required' => 'Nama pelanggan tidak boleh kosong',
                        'min_length' => 'Panjang nama pelanggan tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama pelanggan tidak boleh lebih dari 50',
                    ],
                    'alamat_pelanggan' => [
                        'required' => 'Alamat pelanggan tidak boleh kosong',
                    ],
                    'no_telp_pelanggan' => [
                        'required' => 'No telp pelanggan tidak boleh kosong',
                        'numeric' => 'No telp pelanggan harus angka'
                    ],
                    
                ]
            )
            ) 
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung masukkan ke database
            $pelanggan_model->save([
                'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
                'alamat_pelanggan' => $this->request->getPost('alamat_pelanggan'),
                'no_telp_pelanggan'  => $this->request->getPost('no_telp_pelanggan'),
            

            ]);

            $session = session();
            $session->setFlashdata("status_dml", "Sukses Input");

            // redirect ke daftar kosan
            return redirect()->to('pelanggan/view');

        } else {
            echo view('template/Headertemplate');
            echo view('template/Sidebartemplate');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            echo view('pelanggan/Add', [
                                    'title' => 'Input Pelanggan',
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('template/Footertemplate');           
        }
    }

    // method view daftar kosan
    public function view(){

        $pelanggan_model = model(pelangganModel::class);
        $datapelanggan = $pelanggan_model->getpelanggan();
        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('pelanggan/View',
                    [
                        'title' => 'View Pelanggan',
                        'datapelanggan' => $datapelanggan,
                    ]
                 );
        echo view('template/Footertemplate');            
    }

    //method ambil data
    
    // method view daftar pelanggan dgn menggunakan AJAX
    
    
    // method untuk menghapus kosan
    public function delete($id){
        $pelanggan_model = model(pelangganModel::class);
        $pelanggan_model->deletepelanggan($id);

        $session = session();
        $session->setFlashdata("status_dml", "Sukses Delete");

        return redirect()->to('pelanggan/view');
    }

    // method untuk melihat data kos berdasarkan id kos
    public function viewData($id){
        $pelanggan_model = model(pelangganModel::class);
        $datapelanggan = $pelanggan_model->getpelangganBasedOnId($id);

        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('pelanggan/Edit',
                    [
                        'title' => 'Ubah Pelanggan',
                        'datapelanggan' => $datapelanggan,
                    ]
                 );
        echo view('template/Footertemplate');         
    }

    // method untuk mengupdate data kos 
    public function update(){
        $pelanggan_model = model(pelangganModel::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'nama_pelanggan'  => 'required|min_length[3]|max_length[50]',
                'alamat_pelanggan' => 'required',
                'no_telp_pelanggan'  => 'required|numeric',

                ],
                [   //List Custom Pesan Error                
                    'nama_pelanggan' => [
                        'required' => 'Nama pelanggan tidak boleh kosong',
                        'min_length' => 'Panjang nama pelanggan tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama pelanggan tidak boleh lebih dari 50',
                    ],
                    'alamat_pelanggan' => [
                        'required' => 'Alamat pelanggan tidak boleh kosong',
                    ],
                    'no_telp_pelanggan'=> [
                        'required' => 'No telp pelanggan tidak boleh kosong',
                        'numeric' => 'No telp pelanggan harus angka'
                    ],
                    
                ]
            )
            ) 
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung update ke database
            $pelanggan_model->updatepelanggan();

            $session = session();
            $session->setFlashdata("status_dml", "Sukses Update");
            // redirect ke daftar kosan
            return redirect()->to('pelanggan/view');

        } else {
            echo view('template/Headertemplate');
            echo view('template/Sidebartemplate');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            $datapelanggan = $pelanggan_model->getpelangganBasedOnId($_POST['id']);
            echo view('pelanggan/Edit', [
                                    'title' => 'Ubah Pelanggan',
                                    'datapelanggan' => $datapelanggan,
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('template/Footertemplate');           
        }
    }

    // function untuk tambah pop up
   
    

}
