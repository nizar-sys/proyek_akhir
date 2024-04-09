<?php
namespace App\Models;

use CodeIgniter\Model;

class BukuBesarModel extends Model
{
    protected $db;
    protected $session;

    public function __construct()
    {
        $this->db = db_connect();
        $this->session = session();
    }
        public function GetDatacoa(){

         $query = $this->db->query("SELECT * From jurnal join coa on jurnal.kode_coa = coa.kode_coa group by jurnal.kode_coa order by jurnal.kode_coa ASC ");
         $result = $query->getResult();
         return $result;
        }

        public function GetSaldocoa($kode_coa){
            //mengambil data saldo coa

            $query = $this->db->query("SELECT * From coa where kode_coa = ?",array($kode_coa) );
            $result = $query->getResultArray();
            return $result;
             }
        public function GetDataBukuBesar($kode_coa,$bln,$thn){
            $this->db = db_connect();

            $query = $this->db->query("SELECT * From jurnal join coa on coa.kode_coa = jurnal.kode_coa  where coa.kode_coa = ? AND DATE_FORMAT(jurnal.tgl_jurnal, '%Y') = ? AND  DATE_FORMAT(jurnal.tgl_jurnal, '%m') = ? ",array($kode_coa ,$thn ,$bln) );
            $result = $query->getResult();
            return $result;
        }

    //     public function getSaldoDebit($kode_coa,$tgl){
    //         $this->db = db_connect();         
    //         $query = $this->db->query("SELECT *,sum(nominal) From jurnal where posisi_dr_cr = 'debet' and kode_coa = ? and tgl_jurnal =? " ,array($kode_coa,$tgl));
    //         $result = $query->getResult();
    //         return $result;
    //     }

    //     public function getSaldoKredit($kode_coa,$tgl){
    //         $query = $this->db->query("SELECT sum(nominal) From jurnal where posisi_dr_cr = 'kredit' and kode_coa = ? and tgl_jurnal =? " ,array($kode_coa,$tgl));
    //         return $query;
    // }

    

}
// SELECT jurnal.nominal_jurnal 
// FROM jurnal JOIN transaksi
// ON jurnal.no_transaksi = transaksi.no_transaksi
// WHERE transaksi.id_perusahaan = 1 AND jurnal.debit_kredit = 'Kredit' 
// AND jurnal.kode_coa = 11111 AND
// DATE_FORMAT(jurnal.tanggal_jurnal, '%Y%m') < '2023-12'

