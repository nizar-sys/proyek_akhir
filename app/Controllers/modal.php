<?php

namespace App\Controllers;

use App\Models\modalModel; //include modal model di dalam controller
use Dompdf\Dompdf;
use App\Models\JurnalModel;

class modal extends BaseController
{
    public function __construct()
    {
        $this->modalModel = new modalModel();
    }

    // method tambah data
    public function add()
    {
        $modal_model = model(modalModel::class);
        $JurnalModel = model(JurnalModel::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'jumlah'  => 'required',
                'tgl_modal'  => 'required',

                ],
                [  
                     //List Custom Pesan Error
                    
                    'jumlah' => [
                        'required' => 'Jumlah Setor modal tidak boleh kosong',
                    ],
                    'tgl_modal' => [
                        'required' => 'Tanggal modal tidak boleh kosong',
                    ],

                ]
            )
            ) 
        {

            $modal_model->save([               
                'jumlah'  => $this->request->getPost('jumlah'),
                'tgl_modal' => $this->request->getPost('tgl_modal'),
                'keterangan' => $this->request->getPost('keterangan'),
                'status' => 'tambah'
            ]);
            $JurnalModel->save([
                'kode_coa' => '111',
                'nama_coa' => 'Kas',
                'tgl_jurnal'  => $this->request->getPost('tgl_modal'),
                'posisi_dr_cr'  => 'Debet',
                'nominal' => $this->request->getPost('jumlah'),
            ]);

            $JurnalModel->save([
                'kode_coa' => '311',
                'nama_coa' => 'Modal',
                'tgl_jurnal'  => $this->request->getPost('tgl_modal'),
                'posisi_dr_cr'  => 'Kredit',
                'nominal' =>$this->request->getPost('jumlah'),
            ]);


            $session = session();
            $session->setFlashdata("status_dml", "Sukses Input");


            return redirect()->to('modal/viewmodal');

        } else {
            echo view('template/Headertemplate');
            echo view('template/Sidebartemplate');

            echo view('modal/Add', [
                                    'title' => 'Input modal',
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('template/Footertemplate');           
        }
    }
    public function minus()
    {
        $modal_model = model(modalModel::class);
        $JurnalModel = model(JurnalModel::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'jumlah'  => 'required',
                'tgl_modal'  => 'required',
                
                ],
                [  
                     //List Custom Pesan Error
                    
                    'jumlah' => [
                        'required' => 'Jumlah Tarik modal tidak boleh kosong',
                    ],
                    'tgl_modal' => [
                        'required' => 'Tanggal modal tidak boleh kosong',
                    ],

                ]
            )
            ) 
        {
            $modal_model->save([               
                'jumlah'  => $this->request->getPost('jumlah'),
                'tgl_modal' => $this->request->getPost('tgl_modal'),
                'keterangan' => $this->request->getPost('keterangan'),
                'status' => 'kurang'
            ]);
            $JurnalModel->save([
                'kode_coa' => '311',
                'nama_coa' => 'Modal',
                'tgl_jurnal'  => $this->request->getPost('tgl_modal'),
                'posisi_dr_cr'  => 'Debet',
                'nominal' => $this->request->getPost('jumlah'),
            ]);

            $JurnalModel->save([
                'kode_coa' => '312',
                'nama_coa' => 'Prive',
                'tgl_jurnal'  => $this->request->getPost('tgl_modal'),
                'posisi_dr_cr'  => 'Kredit',
                'nominal' =>$this->request->getPost('jumlah'),
            ]);


            $session = session();
            $session->setFlashdata("status_dml", "Sukses Input");


            return redirect()->to('modal/viewmodal');

        } else {
            echo view('template/Headertemplate');
            echo view('template/Sidebartemplate');

            echo view('modal/minus', [
                                    'title' => 'Input modal',
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('template/Footertemplate');           
        }
    }

    public function viewmodal(){

        $modal_model = model(modalModel::class);
        $datamodal = $modal_model->getmodal();
        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('modal/View',
                    [
                        'title' => 'View modal',
                        'datamodal' => $datamodal,
                    ]
                 );
        echo view('template/Footertemplate');            
    }

    public function show($id_modal)
    {
        $datamodal = $this->modalModel->showmodal($id_modal);

        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('modal/show', ['datamodal' => $datamodal]);
        echo view('template/Footertemplate');      
    }

    public function printInvoice($id_modal)
    {
        $datamodal = $this->modalModel->printInvoice($id_modal);

        $dompdf = new Dompdf();
        $html = view('modal/invoice', ['datamodal' => $datamodal]);
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A5', 'potrait');
        $dompdf->render();
        $dompdf->stream();
        $dompdf->set_option('isRemoteEnabled', true);

    }

}
