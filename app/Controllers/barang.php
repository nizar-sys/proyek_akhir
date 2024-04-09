<?php

namespace App\Controllers;

use App\Models\barangModel; //include barang model di dalam controller

class barang extends BaseController
{
    // method tambah data
    public function add()
    {
        $barang_model = model(barangModel::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'nama_barang' => 'required|min_length[3]|max_length[50]',
                'harga_barang'  => 'required',
                'stok'  => 'required',

                ],
                [  
                     //List Custom Pesan Error
                    'nama_barang' => [
                        'required' => 'Nama barang tidak boleh kosong',
                        'min_length' => 'Panjang nama barang tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama barang tidak boleh lebih dari 50',
                    ],
                    'harga_barang' => [
                        'required' => 'harga_barang barang tidak boleh kosong',
                    ],
                    'stok' => [
                        'required' => 'harga_barang barang tidak boleh kosong',
                    ],
                    
                ]
            )
            ) 
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung masukkan ke database
            $barang_model->save([
                'stok' => $this->request->getPost('stok'),
                'nama_barang' => $this->request->getPost('nama_barang'),
                'harga_barang'  => $this->request->getPost('harga_barang'),
            

            ]);

            $session = session();
            $session->setFlashdata("status_dml", "Sukses Input");

            // redirect ke daftar kosan
            return redirect()->to('barang/view');

        } else {
            echo view('template/Headertemplate');
            echo view('template/Sidebartemplate');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            echo view('barang/Add', [
                                    'title' => 'Input barang',
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('template/Footertemplate');           
        }
    }

    // method view daftar kosan
    public function view(){

        $barang_model = model(barangModel::class);
        $databarang = $barang_model->getbarang();
        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('barang/View',
                    [
                        'title' => 'View barang',
                        'databarang' => $databarang,
                    ]
                 );
        echo view('template/Footertemplate');            
    }

    //method ambil data
    
    // method view daftar barang dgn menggunakan AJAX
    
    
    // method untuk menghapus kosan
    public function delete($id){
        $barang_model = model(barangModel::class);
        $barang_model->deletebarang($id);

        $session = session();
        $session->setFlashdata("status_dml", "Sukses Delete");

        return redirect()->to('barang/view');
    }

    // method untuk melihat data kos berdasarkan id kos
    public function viewData($id){
        $barang_model = model(barangModel::class);
        $databarang = $barang_model->getbarangBasedOnId($id);

        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('barang/Edit',
                    [
                        'title' => 'Ubah barang',
                        'databarang' => $databarang,
                    ]
                 );
        echo view('template/Footertemplate');         
    }

    // method untuk mengupdate data kos 
    public function update(){
        $barang_model = model(barangModel::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'stok'  => 'required',
                'nama_barang' => 'required|min_length[3]|max_length[50]',
                'harga_barang'  => 'required',

                ],
                [   //List Custom Pesan Error
                    'stok' => [
                        'required' => 'harga_barang barang tidak boleh kosong',
                    ],
                    'nama' => [
                        'required' => 'Nama barang tidak boleh kosong',
                        'min_length' => 'Panjang nama barang tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama barang tidak boleh lebih dari 50',
                    ],
                    'harga_barang' => [
                        'required' => 'harga_barang barang tidak boleh kosong',
                    ],
                    
                ]
            )
            ) 
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung update ke database
            $barang_model->updatebarang();

            $session = session();
            $session->setFlashdata("status_dml", "Sukses Update");
            // redirect ke daftar kosan
            return redirect()->to('barang/view');

        } else {
            echo view('template/Headertemplate');
            echo view('template/Sidebartemplate');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            $databarang = $barang_model->getbarangBasedOnId($_POST['id']);
            echo view('barang/Edit', [
                                    'title' => 'Ubah barang',
                                    'databarang' => $databarang,
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('template/Footertemplate');           
        }
    }

    // function untuk tambah pop up
   
    

}
