<?php

namespace App\Controllers;

use App\Models\penjualanModel; //include pembelian model di dalam controller
use Dompdf\Dompdf;
use App\Models\JurnalModel;

class penjualan extends BaseController
{
    public function __construct()
    {
        $this->penjualanModel = new PenjualanModel();
    }

    // method tambah data
    public function add()
    {
        $penjualan_model = model(penjualanModel::class);
        $JurnalModel = model(JurnalModel::class);
        $karyawan =  $penjualan_model->getkaryawan();
        $barang = $penjualan_model->getbarang();
        $pelanggan =  $penjualan_model->getpelanggan();
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'id_karyawan'  => 'required',
                // 'id_barang[]' => 'required',
                'id_pelanggan'  => 'required',
                'tanggal_jual'  => 'required',
                'jumlah_barang'  => 'required',
                'subtotal'  => 'required',
                ],
                [  
                     //List Custom Pesan Error
                     'id_karyawan' => [
                        'required' => 'Pilih Karyawan tidak boleh kosong',
                    ],
                    // 'id_barang[]' => [
                    //     'required' => 'Pilih Barang tidak boleh kosong',
                    // ],
                    'id_pelanggan' => [
                        'required' => 'Pilih Pelanggan tidak boleh kosong',
                    ],
                    'tanggal_jual' => [
                        'required' => 'Tanggal Jual tidak boleh kosong',
                    ],
                    'jumlah_barang' => [
                        'required' => 'Jumlah Barang tidak boleh kosong ',
                    ],
                    'subtotal' => [
                        'required' => 'Subtotal terisi auto jika barang dan jumlah barang di isi',
                    ],

                ]
            )
            ) 
        {
            var_dump($this->request->getPost('id_barang'));
            die;
            $penjualan_model->save([
                'id_karyawan' => $this->request->getPost('id_karyawan'),
                'id_barang' => $this->request->getPost('id_barang'),
                'id_pelanggan' => $this->request->getPost('id_pelanggan'),
                'tanggal_jual'  => $this->request->getPost('tanggal_jual'),
                'jumlah_barang' => $this->request->getPost('jumlah_barang'),
                'subtotal' => $this->request->getPost('subtotal'),
            ]);
            $JurnalModel->save([
                'kode_coa' => '111',
                'nama_coa' => 'Kas',
                'tgl_jurnal'  => $this->request->getPost('tanggal_jual'),
                'posisi_dr_cr'  => 'Debet',
                'nominal' => $this->request->getPost('subtotal'),
            ]);

            $JurnalModel->save([
                'kode_coa' => '411',
                'nama_coa' => 'Penjualan',
                'tgl_jurnal'  => $this->request->getPost('tanggal_jual'),
                'posisi_dr_cr'  => 'Kredit',
                'nominal' =>$this->request->getPost('subtotal'),
            ]);
       


            $session = session();
            $session->setFlashdata("status_dml", "Sukses Input");


            return redirect()->to('penjualan/view');

        } else {
            echo view('template/Headertemplate');
            echo view('template/Sidebartemplate');

            echo view('penjualan/add', [
                                    'title' => 'Input Penjualan',
                                    'validation' => $this->validator,
                                    'karyawan'=>$karyawan,
                                    'barang'=>$barang,
                                    'pelanggan'=>$pelanggan,
                                ]
                    );
            echo view('template/Footertemplate');           
        }
    }

    public function view(){

        $penjualan_model = model(penjualanModel::class);
        $datapenjualan = $penjualan_model->getpenjualan();
        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('penjualan/view',
                    [
                        'title' => 'View Penjualan',
                        'dataPenjualan' => $datapenjualan,
                    ]
                 );
        echo view('template/Footertemplate');            
    }

    public function show($id_penjualan)
    {
        $dataPenjualan = $this->penjualanModel->showPenjualan($id_penjualan);

        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('penjualan/show', ['dataPenjualan' => $dataPenjualan]);
        echo view('template/Footertemplate');      
    }

    public function printInvoice($id_penjualan)
    {
        $dataPenjualan = $this->penjualanModel->printInvoice($id_penjualan);

        $dompdf = new Dompdf();
        $html = view('penjualan/invoice', ['dataPenjualan' => $dataPenjualan]);
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A5', 'potrait');
        $dompdf->render();
        $dompdf->stream();
        $dompdf->set_option('isRemoteEnabled', true);

    }

}
