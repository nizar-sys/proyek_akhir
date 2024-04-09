<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';

    // atribut yang diijinkan untuk diinput menggunakan query builder
    protected $allowedFields = ['nama_pelanggan', 'alamat_pelanggan', 'no_telp_pelanggan'];

    // method untuk mendapatkan seluruh data pada tabel pelanggan
    public function getPelanggan(){
        return $this->findAll();
    }

    // method untuk menghapus data
    public function deletePelanggan($id_pelanggan){
        $db = db_connect();
        $builder = $db->table('pelanggan');
        $builder->delete(['id_pelanggan' => $id_pelanggan]);
    }

    // method untuk viewData berdasarkan id
    public function getPelangganBasedOnId($id_pelanggan){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM pelanggan WHERE id_pelanggan = ? ', array($id_pelanggan));
        $results = $query->getResult();
        return $results;
    }

    // method untuk updateData pelanggan
    public function updatePelanggan(){
        $db = db_connect();

        $data = [
            'nama_pelanggan' => $_POST['nama_pelanggan'], //nama adalah atribut database, sedangkan nama_pelanggan adalah nama input formnya
            'alamat_pelanggan'  => $_POST['alamat_pelanggan'], //alamat adalah atribut di database, sedangkan alamat adalah input formnya
            'no_telp_pelanggan'  => $_POST['no_telp_pelanggan'],
        ];
        $builder = $db->table('pelanggan');
        $builder->where('id_pelanggan', $_POST['id_pelanggan']);
        $builder->update($data);
    }
    
}