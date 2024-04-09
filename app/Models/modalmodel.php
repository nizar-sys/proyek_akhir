<?php

namespace App\Models;

use CodeIgniter\Model;

class modalmodel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'modal';
    protected $primaryKey = 'id_modal';
    // atribut yang diijinkan untuk diinput menggunakan query builder
    protected $allowedFields = ['jumlah','tgl_modal','keterangan','status'];



    // method untuk mendapatkan seluruh data pada tabel kos
    public function getmodal(){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM modal');
        $results = $query->getResult();
        return $results;
    }
    public function showmodal($id_modal)
    {
        $query = $this->db->query("SELECT * FROM modal join barang on barang.id_barang = modal.id_barang
        join supplier on supplier.id_supplier = modal.id_supplier
        WHERE id_modal = ?", array($id_modal));
        return $query;
    }
    public function printInvoice($id_modal)
    {
        $query = $this->db->query("SELECT * FROM modal WHERE id_modal = ?", array($id_modal));
        return $query;
    }
}


    
