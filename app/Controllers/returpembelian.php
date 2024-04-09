<?php

namespace App\Controllers;

use App\Models\returpembelianModel; //include pembelian model di dalam controller
use Dompdf\Dompdf;
use App\Models\JurnalModel;

class returpembelian extends BaseController
{
    public function __construct()
    {
        $this->returpembelianModel = new ReturpembelianModel();
    }

    // method tambah data
    public function add()
    {
        $returpembelian_model = model(returpembelianModel::class);
        $JurnalModel = model(JurnalModel::class);
        $barang = $returpembelian_model->getbarang();
        $pembelian =  $returpembelian_model->getpembelian();
        $supplier =  $supplier_model->getsupplier();
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'id_pembelian' => 'required',
                'id_barang' => 'required',
                'id_karyawan' => 'required',
                'id_supplier' => 'required',
                'tanggal_retur'  => 'required',
                'jumlah'  => 'required',
                'total'  => 'required',
                ],
                [  
                     //List Custom Pesan Error
                    'id_pembelian' => [
                        'required' => 'Pilih Pembelian tidak boleh kosong',
                    ],
                    'id_barang' => [
                        'required' => 'Pilih Barang tidak boleh kosong',
                    ],
                    'id_karyawan' => [
                        'required' => 'Pilih Karyawan tidak boleh kosong',
                    ],
                    'id_supplier' => [
                        'required' => 'Pilih Supplier tidak boleh kosong',
                    ],
                    'tanggal_retur' => [
                        'required' => 'Tanggal Retur tidak boleh kosong',
                    ],
                    'jumlah' => [
                        'required' => 'Jumlah Barang tidak boleh kosong ',
                    ],
                    'total' => [
                        'required' => 'total terisi auto jika barang dan jumlah barang di isi',
                    ],
                  

                ]
            )
            ) 
        {
            $returpembelian_model->save([
                'id_pembelian' => $this->request->getPost('id_pembelian'),
                'id_barang' => $this->request->getPost('id_barang'),
                'id_karyawan' => $this->request->getPost('id_karyawan'),
                'id_supplier' => $this->request->getPost('id_supplier'),
                'tanggal_retur'  => $this->request->getPost('tanggal_retur'),
                'jumlah' => $this->request->getPost('jumlah'),
                'total' => $this->request->getPost('total'),
            ]);
            $JurnalModel->save([
                'kode_coa' => '113',
                'nama_coa' => 'Retur Pembelian',
                'tgl_jurnal'  => $this->request->getPost('tanggal_retur'),
                'posisi_dr_cr'  => 'Kredit',
                'nominal' => $this->request->getPost('total'),
            ]);

            $JurnalModel->save([
                'kode_coa' => '111',
                'nama_coa' => 'Kas',
                'tgl_jurnal'  => $this->request->getPost('tanggal_retur'),
                'posisi_dr_cr'  => 'Debet',
                'nominal' =>$this->request->getPost('subtotal'),
            ]);
       


            $session = session();
            $session->setFlashdata("status_dml", "Sukses Input");


            return redirect()->to('returpembelian/view');

        } else {
            echo view('template/Headertemplate');
            echo view('template/Sidebartemplate');

            echo view('returpembelian/add', [
                                    'title' => 'Input Retur Pembelian',
                                    'validation' => $this->validator,
                                    'barang'=>$barang,
                                    'pembelian'=>$pembelian,
                                    'supplier'=>$supplier,

                                ]
                    );
            echo view('template/Footertemplate');           
        }
    }

    public function view(){

        $returpembelian_model = model(returpembelianModel::class);
        $dataretur = $returpembelian_model->getreturpembelian();
        $datareturpembelian = $returpembelian_model->getpembelian();
        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('returpembelian/view',
                    [
                        'title' => 'View Retur Pembelian',
                        'dataRetur' => $dataretur,
                        'dataReturpembelian' => $datareturpembelian,
                    ]
                 );
        echo view('template/Footertemplate');            
    }

    public function show($id_retur_pembelian)
    {
        $dataReturpembelian = $this->returpembelianModel->showReturpembelian($id_retur_pembelian);

        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('returpembelian/show', ['dataReturpembelian' => $dataReturpembelian]);
        echo view('template/Footertemplate');      
    }

    public function printInvoice($id_retur_pembelian)
    {
        $dataReturpembelian = $this->returpembelianModel->printInvoice($id_retur_pembelian);

        $dompdf = new Dompdf();
        $html = view('returpembelian/invoice', ['dataReturpembelian' => $dataReturpembelian]);
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A5', 'potrait');
        $dompdf->render();
        $dompdf->stream();
        $dompdf->set_option('isRemoteEnabled', true);

    }

}

