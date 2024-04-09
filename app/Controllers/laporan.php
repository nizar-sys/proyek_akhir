<?php

namespace App\Controllers;

use App\Models\JurnalModel; 
use App\Models\penjualanmodel; 
use App\Models\returpenjualanModel;

class laporan extends BaseController
{

    public function jurnalumum()
    {
        $jurnalmodel = model(JurnalModel::class);
        if(isset($_POST['submit']))
        {
            $tanggal1 = $this->request->getPost('tanggal1');
            $tanggal2 = $this->request->getPost('tanggal2');
            $data = $jurnalmodel->laporan_periode($tanggal1,$tanggal2);
           echo view('template/Headertemplate');
           echo view('template/Sidebartemplate');
           echo view('laporan/JurnalUmum',[
            'title' => 'Laporan Jurnal Umum',
            'data' => $data,
            'periode1' => $tanggal1,
            'periode2' => $tanggal2
            
          ]);
           echo view('template/Footertemplate');
        }
        else 
        {
      $jurnalmodel = model(JurnalModel::class);
      $data= $jurnalmodel->laporan_default();
       echo view('template/Headertemplate');
       echo view('template/Sidebartemplate');
       echo view('laporan/JurnalUmum', [
                           'title' => 'Laporan Jurnal Umum',
                             'data' => $data,
                             'periode1' =>'Keseluruhan',
                             'periode2' => '.'
                         ]);
       echo view('template/footertemplate');
        }
    }
    public function penjualan()
    {
        $penjualanmodel = model(penjualanmodel::class);
        if(isset($_POST['submit']))
        {
            $tanggal1 = $this->request->getPost('tanggal1');
            $tanggal2 = $this->request->getPost('tanggal2');
            $data = $penjualanmodel->laporan_periode($tanggal1,$tanggal2);
           echo view('template/Headertemplate');
           echo view('template/Sidebartemplate');
           echo view('laporan/penjualan',[
            'title' => 'Laporan Penjualan ',
            'data' => $data,
            'periode1' => $tanggal1,
            'periode2' => $tanggal2
          ]);
           echo view('template/Footertemplate');
        }
        else 
        {
      $penjualanmodel = model(penjualanmodel::class);
      $data= $penjualanmodel->laporan_default();
       echo view('template/Headertemplate');
       echo view('template/Sidebartemplate');
       echo view('laporan/penjualan', [
                             'title' => 'Laporan Penjualan ',
                             'data' => $data,
                             'periode1' =>'Keseluruhan',
                             'periode2' => '.'
                         ]);
       echo view('template/Footertemplate');
        }
    }
    public function returpenjualan()
    {
        $returpenjualanmodel = model(returpenjualanmodel::class);
        if(isset($_POST['submit']))
        {
            $tanggal1 = $this->request->getPost('tanggal1');
            $tanggal2 = $this->request->getPost('tanggal2');
            $data = $returpenjualanmodel->laporan_periode($tanggal1,$tanggal2);
           echo view('template/Headertemplate');
           echo view('template/Sidebartemplate');
           echo view('laporan/returpenjualan',[
            'title' => 'Laporan Retur Penjualan ',
            'data' => $data,
            'periode1' => $tanggal1,
            'periode2' => $tanggal2
          ]);
           echo view('template/Footertemplate');
        }
        else 
        {
      $returpenjualanmodel = model(returpenjualanmodel::class);
      $data= $returpenjualanmodel->laporan_default();
       echo view('template/Headertemplate');
       echo view('template/Sidebartemplate');
       echo view('laporan/returpenjualan', [
                             'title' => 'Laporan Retur Penjualan ',
                             'data' => $data,
                             'periode1' =>'Keseluruhan',
                             'periode2' => '.'
                         ]);
       echo view('template/Footertemplate');
        }
    }
    function bukubesar()
    {
      $this->model = model(bukubesarmodel::class);
      if (isset($_POST['kode_coa'])) {
        $kode_coa = $_POST['kode_coa'];
      } else {
        $kode_coa = '111';
      }
  
      if (isset($_POST['bulan'])) {
        $bulan = $_POST['bulan'];
      } else {
        $bulan = date('m');
      }
  
      if (isset($_POST['tahun'])) {
        $tahun = $_POST['tahun'];
      } else {
        $tahun = date('Y');
      }
      $tgl = $tahun . "-" . $bulan . "-01";
  
      $data['coa'] = $this->model->GetDatacoa(array('kode_coa >' => 100));
      $data['datacoa'] = $this->model->GetSaldocoa($kode_coa);
      $data['jurnal'] = $this->model->GetDataBukuBesar($kode_coa, $bulan, $tahun);
      $data['tahun'] = $tahun;
      $data['bulan'] = $bulan;
      // $data['debit'] = $this->model->getSaldoDebit(array($kode_coa,$tgl));
      // $data['kredit'] = $this->model->getSaldoKredit(array( $kode_coa,$tgl));
      $data['title']		= 'Buku Besar';
      echo view('template/Headertemplate');
      echo view('template/Sidebartemplate');
      echo view('laporan/bukubesar', $data);
      echo view('template/Footertemplate');
    }
  
} 

    

  

