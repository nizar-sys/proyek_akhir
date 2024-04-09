<?php

namespace App\Controllers;

use App\Models\penjualan2Model; //include pembelian model di dalam controller
use Dompdf\Dompdf;
use App\Models\JurnalModel;

class penjualan2 extends BaseController
{
    public function __construct()
    {
        $this->penjualan2Model = new Penjualan2Model();
    }

    // method tambah data
    public function add()
    {
        $penjualan2_model = model(penjualan2Model::class);
        $id_penjualan = $penjualan2_model->lastidcek();
        foreach($id_penjualan as $row):
            $status = $row->status;
            endforeach;
            //print_r($status);
    
            if($status == null){
                $status = (object) ['status' => 1];
                $status = $status->status;
            }else{
               $status = $status;
            }
        if($status == 1){        
            $date = date('dmy');
            $costum = 'TRSPMB'.$date.'-';
            $angka = $penjualan2_model->countAllResults() + 1;
            $angka = sprintf("%04d", $angka);
            $id = $costum . $angka;
            $penjualan2_model->save([
                'id_penjualan'=> $id,
                'jumlah'  => 0,
                'total' => 0,
                'status' =>0, 
                'tanggal' =>date('y-m-d'),
            ]);
            $data = [ 'id_transaksi' => $id];
            session()->setFlashdata($data);
            return redirect()->to('penjualan2/tambahdata');
        }else {
            return redirect()->to('penjualan2/tambahdata');
        }
    }

    
    public function tambahdata(){
        $penjualan2_model = model(penjualan2Model::class);
        $penjualandetail_model = model(penjualandetail::class);
        $pelanggan =  $penjualan2_model->getpelanggan();
        $karyawan =  $penjualan2_model->getkaryawan();
        $id_penjualan = $penjualan2_model->lastidcek();
        foreach($id_penjualan as $row):
            $id = $row->id_penjualan;
            endforeach;
        $data = $penjualandetail_model->getAllById($id);
        $barang = $penjualan2_model->getbarangnotin($id);
       // print_r($data);
        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('pembelian/add',
                    [
                        'title' => 'Penjualan',
                        'barang' => $barang,
                        'id_penjualan' => $id_penjualan,
                        'pelanggan'=>$pelanggan,
                        'karyawan'=>$karyawan,
                        'dataPenjualan2' =>$data,

                    ]
                 );
        echo view('template/Footertemplate');         
    }
    public function simpanbarang()
    {
        $penjualandetail_model = model(penjualandetail::class);
        $penjualan2_model = model(penjualan2Model::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'id_barang'  => 'required',
                'id_pelanggan'  => 'required',
                'jumlah'  => 'required',
                'subtotal' => 'required',
                'id_karyawan' => 'required',
               // 'id_supplier' => 'required',

                ],
                [  
                     //List Custom Pesan Error
                    
                    'id_barang' => [
                        'required' => 'id_barang tidak boleh kosong',
                    ],
                    'id_pelanggan' => [
                        'required' => 'id_pelanggan tidak boleh kosong',
                    ],
                    'jumlah' => [
                        'required' => 'Jumlah  tidak boleh kosong',
                    ],
                    'subtotal' => [
                        'required' => 'Subtotal tidak boleh kosong',
                    ],
                    'id_karyawan' => [
                        'required' => 'id_karyawan tidak boleh kosong',
                    ],
                
                  
                ]
            )
            ) 
        {
            $penjualabdetail_model->save([      
                'id_penjualan' => $this->request->getPost('id_penjualan'),       
                'jumlah'  => $this->request->getPost('jumlah'),
                'subtotal' => $this->request->getPost('subtotal'),
                'id_barang' => $this->request->getPost('id_barang'),
                'id_pelanggan' => $this->request->getPost('id_pelanggan'),
                'id_karyawan' => $this->request->getPost('id_karyawan'),
            ]);
            return redirect()->to('pembelian/tambahdata');

        } else {
        $penjualan2_model = model(penjualan2Model::class);
        $datapenjualan2 = $penjualan2_model->getDataBasedonId();
        $pelanggan =  $penjualan2_model->getpelanggan();
        $karyawan =  $penjualan2_model->getkaryawan();
        $id_penjualan = $penjualan2_model->lastidcek();
        foreach($id_penjualan as $row):
            $id = $row->id_penjualan;
            endforeach;
        $data = $penjualandetail_model->getAllById($id);
        $barang = $penjualan2_model->getbarangnotin($id);
        //$id_transaksi = session()->getFlashdata('id_transaksi');
       // print_r($id_transaksi);
        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('penjualan2/add',
                    [
                        'title' => 'Penjualan',
                        'barang' => $barang,
                        'id_penjualan' => $id_penjualan,
                        'pelanggan'=>$pelanggan,
                        'karyawan'=>$karyawan,
                        'validation' => $this->validator,
                        'dataPenjualan2' =>$data
                    ]
                 );
        echo view('template/Footertemplate');  
        }
    }
    public function delete($id_penjualan, $id_barang)
    {
        $this->db = \Config\Database::connect();
    
        $data = [
            'id_penjualan' => $id_penjualan,
            'id_barang' => $id_barang
        ];
    
        $this->db->table('detail_penjualan')->where($data)->delete();
        return redirect()->to('penjualan/tambahdata');
    }
    public function selesai()
    {
        $penjualandetail_model = model(penjualandetail::class);
        $penjualan2_model = model(penjualan2Model::class);
        $JurnalModel = model(JurnalModel::class);
        $id_penjualan = $penjualan2_model->lastidcek();
       // print_r($id_transaksi);
        foreach($id_penjualan as $row):
        $id = $row->id_penjualan;
        endforeach;
        $total = $penjualandetail_model->gettotaltransaksi($id);
         // print_r($total);
        if($total <=0){
        session()->setFlashdata('error_msg', 'Data belum lengkap.');
        return redirect()->to('penjualan2/viewpenjualan2');
        }else{
        $penjualandetail_model->SelesaiBelanja($id);
         $JurnalModel->save([
                'kode_coa' => '112',
                'nama_coa' => 'Persediaan',
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
          return redirect()->to('penjualan/viewpenjualan2');
    }

    public function viewpenjualan2(){

        $penjualan2_model = model(penjualan2Model::class);
        $datapenjualan2 = $penjualan2_model->getpenjualan();
        // print_r($datapembelian);
        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('penjualan2/View',
                    [
                        'title' => 'View Penjualan',
                        'data' => $datapenjualan2,
                    ]
                 );
        echo view('template/Footertemplate');            
    }

    public function show($id_penjualan)
    {
        $datapenjualan2 = $this->penjualan2Model->showPenjualan2($id_penjualan);

        echo view('template/Headertemplate');
        echo view('template/Sidebartemplate');
        echo view('penjualan2/show', ['datalengkap' => $dataPenjualan2]);
        echo view('template/Footertemplate');      
    }

    public function printInvoice($id_penjualan)
    {
        $dataPenjualan2 = $this->penjualan2Model->printInvoice($id_penjualan);

        $dompdf = new Dompdf();
        $html = view('penjualan2invoice', ['dataPenjualan2' => $dataPenjualan2]);
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A5', 'potrait');
        $dompdf->render();
        $dompdf->stream();
        $dompdf->set_option('isRemoteEnabled', true);
    }

}
