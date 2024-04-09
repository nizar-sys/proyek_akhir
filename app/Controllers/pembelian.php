<?php

namespace App\Controllers;

use App\Models\pembelianModel; //include pembelian model di dalam controller
use Dompdf\Dompdf;
use App\Models\JurnalModel;

class pembelian extends BaseController
{
    public function __construct()
    {
        $this->pembelianModel = new PembelianModel();
    }

    // method tambah data
    public function add()
    {
        $pembelian_model = model(pembelianModel::class);
        $id_transaksi = $pembelian_model->lastidcek();
        foreach($id_transaksi as $row):
            $status = $row->status;
            endforeach;
       // print_r($status);
    
            if($status == null){
                $status = (object) ['status' => 1];
                $status = $status->status;
            }else{
               $status = $status;
            }
        if($status == 1){        
            $date = date('dmy');
            $costum = 'TRSPMB'.$date.'-';
            $angka = $pembelian_model->countAllResults() + 1;
            $angka = sprintf("%04d", $angka);
            $id = $costum . $angka;

            $pembelian_model->save([
                'id_transaksi'=> $id,
                'jumlah'  => 0,
                'total' => 0,
                'status' =>0, 
                'tanggal' =>date('y-m-d'),
            ]);
            $data = [ 'id_transaksi' => $id];
            session()->setFlashdata($data);
            return redirect()->to('pembelian/tambahdata');
        }else {
            return redirect()->to('pembelian/tambahdata');
        }
    }

    public function tambahdata(){
        $pembelian_model = model(pembelianModel::class);
        $pembeliandetail_model = model(pembeliandetail::class);
       
        $supplier =  $pembelian_model->getsupplier();
        $id_transaksi = $pembelian_model->lastidcek();
        foreach($id_transaksi as $row):
            $id = $row->id_transaksi;
            endforeach;
        $data = $pembeliandetail_model->getAllById($id);
        $barang = $pembelian_model->getbarangnotin($id);
       // print_r($data);
        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('pembelian/add',
                    [
                        'title' => 'Pembelian',
                        'barang' => $barang,
                        'id_transaksi' => $id_transaksi,
                        'supplier'=>$supplier,
                        'dataPembelian' =>$data,

                    ]
                 );
        echo view('template/Footertemplate');         
    }

   public function simpanbarang()
    {
        $pembeliandetail_model = model(pembeliandetail::class);
        $pembelian_model = model(pembelianModel::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'id_barang'  => 'required',
                'id_supplier'  => 'required',
                'jumlah'  => 'required',
                'subtotal' => 'required',
               // 'id_supplier' => 'required',

                ],
                [  
                     //List Custom Pesan Error
                    
                    'id_barang' => [
                        'required' => 'id_barang tidak boleh kosong',
                    ],
                    'id_supplier' => [
                        'required' => 'id_supplier tidak boleh kosong',
                    ],
                    'jumlah' => [
                        'required' => 'Jumlah  tidak boleh kosong',
                    ],
                    'subtotal' => [
                        'required' => 'Subtotal tidak boleh kosong',
                    ],
                    // 'id_supplier' => [
                    //     'required' => 'Id Supplier tidak boleh kosong',
                    // ],

                ]
            )
            ) 
        {
            $pembeliandetail_model->save([      
                'id_transaksi' => $this->request->getPost('id_transaksi'),       
                'jumlah'  => $this->request->getPost('jumlah'),
                'subtotal' => $this->request->getPost('subtotal'),
                'id_barang' => $this->request->getPost('id_barang'),
                'id_supplier' => $this->request->getPost('id_supplier'),
            ]);
            return redirect()->to('pembelian/tambahdata');

        } else {
        $pembelian_model = model(pembelianModel::class);
        $datapembelian = $pembelian_model->getDataBasedonId();
        $supplier =  $pembelian_model->getsupplier();
        $id_transaksi = $pembelian_model->lastidcek();
        foreach($id_transaksi as $row):
            $id = $row->id_transaksi;
            endforeach;
        $data = $pembeliandetail_model->getAllById($id);
        $barang = $pembelian_model->getbarangnotin($id);
        //$id_transaksi = session()->getFlashdata('id_transaksi');
       // print_r($id_transaksi);
        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('pembelian/add',
                    [
                        'title' => 'Pembelian',
                        'barang' => $barang,
                        'id_transaksi' => $id_transaksi,
                        'supplier'=>$supplier,
                        'validation' => $this->validator,
                        'dataPembelian' =>$data
                    ]
                 );
        echo view('template/Footertemplate');  
        }
    }
    public function delete($id_transaksi, $id_barang)
    {
        $this->db = \Config\Database::connect();
    
        $data = [
            'id_transaksi' => $id_transaksi,
            'id_barang' => $id_barang
        ];
    
        $this->db->table('detail_pembelian')->where($data)->delete();
        return redirect()->to('pembelian/tambahdata');
    }

    public function selesai()
    {
        $pembeliandetail_model = model(pembeliandetail::class);
        $pembelian_model = model(pembelianModel::class);
        $JurnalModel = model(JurnalModel::class);
        $id_transaksi = $pembelian_model->lastidcek();
       // print_r($id_transaksi);
        foreach($id_transaksi as $row):
        $id = $row->id_transaksi;
        endforeach;
        $total = $pembeliandetail_model->gettotaltransaksi($id);
         // print_r($total);
        if($total <=0){
        session()->setFlashdata('error_msg', 'Data belum lengkap.');
        return redirect()->to('pembelian/viewpembelian');
        }else{
        $pembeliandetail_model->SelesaiBelanja($id);
         $JurnalModel->save([
                'kode_coa' => '112',
                'nama_coa' => 'Pembelian',
                'tgl_jurnal'  => date('y-m-d'),
                'posisi_dr_cr'  => 'Debet',
                'nominal' => $total,
            ]);

            $JurnalModel->save([
                'kode_coa' => '111',
                'nama_coa' => 'kas',
                'tgl_jurnal'  => date('y-m-d'),
                'posisi_dr_cr'  => 'Kredit',
                'nominal' =>$total,
            ]);
        }
          $session = session();
          $session->setFlashdata("status_dml", "Sukses Input");
          return redirect()->to('pembelian/viewpembelian');
    }

    public function viewpembelian(){

        $pembelian_model = model(pembelianModel::class);
        $datapembelian = $pembelian_model->getpembelian();
        // print_r($datapembelian);
        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('pembelian/View',
                    [
                        'title' => 'View pembelian',
                        'dataPembelian' => $datapembelian,
                    ]
                 );
        echo view('template/Footertemplate');            
    }

    public function show($id_transaksi)
    {
        $dataPembelian = $this->pembelianModel->showPembelian($id_transaksi);

        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('pembelian/show', ['datalengkap' => $dataPembelian]);
        echo view('template/Footertemplate');      
    }

    public function printInvoice($id_transaksi)
    {
        $dataPembelian = $this->pembelianModel->printInvoice($id_transaksi);

        $dompdf = new Dompdf();
        $html = view('pembelian/invoice', ['dataPembelian' => $dataPembelian]);
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A5', 'potrait');
        $dompdf->render();
        $dompdf->stream();
        $dompdf->set_option('isRemoteEnabled', true);
    }

}
