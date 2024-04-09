<?php

namespace App\Models;

use CodeIgniter\Model;

class suppliermodel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    // atribut yang diijinkan untuk diinput menggunakan query builder
    protected $allowedFields = ['nama_supplier','alamat', 'no_telp'];

    // method untuk mendapatkan seluruh data pada tabel kos
    public function getsupplier(){
        return $this->findAll();
    }

    // method untuk menghapus data
    public function deletesupplier($id_supplier){
        $db = db_connect();
        $builder = $db->table('supplier');
        $builder->delete(['id_supplier' => $id_supplier]);
    }

    // method untuk viewData berdasarkan id_supplier
    public function getsupplierBasedOnid($id_supplier){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM supplier WHERE id_supplier = ? ', array($id_supplier));
        $results = $query->getResult();
        return $results;
    }

    // method untuk updateData kosan
    public function updatesupplier(){
        $db = db_connect();

        $data = [
            'nama_supplier' => $_POST['nama_supplier'],
            'alamat' => $_POST['alamat'], //nama adalah atribut database, sedangkan nama_kos adalah nama input formnya
            'no_telp'  => $_POST['no_telp'],

        ];
        $builder = $db->table('supplier');
        $builder->where('id_supplier', $_POST['id_supplier']);
        $builder->update($data);
    }
    
}