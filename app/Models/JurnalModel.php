<?php

namespace App\Models;
   
use CodeIgniter\Model;

class JurnalModel extends Model
{
    protected $table ='jurnal';
    protected $primaryKey ='id';
    protected $allowedFields = ['id', 'kode_coa','nama_coa', 'tgl_jurnal', 'posisi_dr_cr', 'nominal'];

  
    function laporan_periode($tanggal1,$tanggal2)
    {
        $db = db_connect();
        $query=$db->query("SELECT * FROM jurnal
        WHERE tgl_jurnal between '$tanggal1' and '$tanggal2'
        group by id");
        $result = $query->getresult('array');
        return $result;
    }
    function laporan_default()
    {
        $db = db_connect();
        $query=$db->query('SELECT * FROM jurnal
        group by id');
        $result = $query->getresult('array');
        return $result;
    }

} 