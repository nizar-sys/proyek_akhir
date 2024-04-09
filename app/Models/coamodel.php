<?php

namespace App\Models;

use CodeIgniter\Model;

class coamodel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'coa';
    protected $primaryKey = 'id';
    // atribut yang diijinkan untuk diinput menggunakan query builder
    protected $allowedFields = ['kode_coa','nama_coa', 'header_coa' ,];

    // method untuk mendapatkan seluruh data pada tabel kos
    public function getcoa(){
        return $this->findAll();
    }

    // method untuk menghapus data
    public function deletecoa($id){
        $db = db_connect();
        $builder = $db->table('coa');
        $builder->delete(['id' => $id]);
    }

    // method untuk viewData berdasarkan id
    public function getcoaBasedOnId($id){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM coa WHERE id = ? ', array($id));
        $results = $query->getResult();
        return $results;
    }

    // method untuk updateData kosan
    public function updatecoa(){
        $db = db_connect();

        $data = [
            'kode_coa' => $_POST['kode_coa'],
            'nama_coa' => $_POST['nama_coa'], //nama adalah atribut database, sedangkan nama_kos adalah nama input formnya
            'header_coa'  => $_POST['header_coa'],

        ];
        $builder = $db->table('coa');
        $builder->where('id', $_POST['id']);
        $builder->update($data);
    }
    
}