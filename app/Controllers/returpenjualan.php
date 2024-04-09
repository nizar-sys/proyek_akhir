<?php

namespace App\Controllers;

use App\Models\returpenjualanModel; //include pembelian model di dalam controller
use Dompdf\Dompdf;
use App\Models\JurnalModel;

class returpenjualan extends BaseController
{
    public function __construct()
    {
        $this->returpenjualanModel = new ReturpenjualanModel();
    }

    // method tambah data
    public function add()
    {
        $returpenjualan_model = model(returpenjualanModel::class);
        $JurnalModel = model(JurnalModel::class);
        $barang = $returpenjualan_model->getbarang();
        $penjualan = $returpenjualan_model->getpenjualan();
        $karyawan =  $returpenjualan_model->getkaryawan();
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'id_barang' => 'required',
                'id_penjualan' => 'required',
                'tanggal_retur'  => 'required',
                'jumlah_barang'  => 'required',
                'subtotal'  => 'required',
                'id_karyawan'  => 'id_karyawan',
                ],
                [  
                     //List Custom Pesan Error
                    'id_barang' => [
                        'required' => 'Pilih Barang tidak boleh kosong',
                    ],
                    'id_penjualan' => [
                        'required' => 'Pilih Penjualan tidak boleh kosong',
                    ],
                    'tanggal_retur' => [
                        'required' => 'Tanggal Retur tidak boleh kosong',
                    ],
                    'jumlah_barang' => [
                        'required' => 'Jumlah Barang tidak boleh kosong ',
                    ],
                    'subtotal' => [
                        'required' => 'Subtotal terisi auto jika barang dan jumlah barang di isi',
                    ],
                    'id_karyawan' => [
                        'required' => 'Id Karyawan tidak boleh kosong',
                    ],

                ]
            )
            ) 
        {
            $returpenjualan_model->save([
                'id_barang' => $this->request->getPost('id_barang'),
                'id_penjualan' => $this->request->getPost('id_penjualan'),
                'tanggal_retur'  => $this->request->getPost('tanggal_retur'),
                'jumlah_barang' => $this->request->getPost('jumlah_barang'),
                'subtotal' => $this->request->getPost('subtotal'),
                'id_karyawan' => $this->request->getPost('id_karyawan'),
            ]);
            $JurnalModel->save([
                'kode_coa' => '412',
                'nama_coa' => 'Retur Penjualan',
                'tgl_jurnal'  => $this->request->getPost('tanggal_retur'),
                'posisi_dr_cr'  => 'Debet',
                'nominal' => $this->request->getPost('subtotal'),
            ]);

            $JurnalModel->save([
                'kode_coa' => '111',
                'nama_coa' => 'Kas',
                'tgl_jurnal'  => $this->request->getPost('tanggal_retur'),
                'posisi_dr_cr'  => 'Kredit',
                'nominal' =>$this->request->getPost('subtotal'),
            ]);
       


            $session = session();
            $session->setFlashdata("status_dml", "Sukses Input");


            return redirect()->to('returpenjualan/view');

        } else {
            echo view('template/Headertemplate');
            echo view('template/Sidebartemplate');

            echo view('returpenjualan/add', [
                                    'title' => 'Input Retur Penjualan',
                                    'validation' => $this->validator,
                                    'barang'=>$barang,
                                  
                                    'karyawan'=>$karyawan,
                                ]
                    );
            echo view('template/Footertemplate');           
        }
    }

    public function view(){

        $returpenjualan_model = model(returpenjualanModel::class);
        $dataretur = $returpenjualan_model->getreturpenjualan();
        $datareturpenjualan = $returpenjualan_model->getpenjualan();
        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('returpenjualan/view',
                    [
                        'title' => 'View Retur Penjualan',
                        'dataRetur' => $dataretur,
                        'dataReturpenjualan' => $datareturpenjualan,
                    ]
                 );
        echo view('template/Footertemplate');            
    }

    public function show($id_retur_penjualan)
    {
        $dataReturpenjualan = $this->returpenjualanModel->showReturpenjualan($id_retur_penjualan);

        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('returpenjualan/show', ['dataReturpenjualan' => $dataReturpenjualan]);
        echo view('template/Footertemplate');      
    }

    public function printInvoice($id_retur_penjualan)
    {
        $dataReturpenjualan = $this->returpenjualanModel->printInvoice($id_retur_penjualan);

        $dompdf = new Dompdf();
        $html = view('returpenjualan/invoice', ['dataReturpenjualan' => $dataReturpenjualan]);
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A5', 'potrait');
        $dompdf->render();
        $dompdf->stream();
        $dompdf->set_option('isRemoteEnabled', true);

    }

}

