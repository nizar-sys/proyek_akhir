<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';

    // atribut yang diijinkan untuk diinput menggunakan query builder
    protected $allowedFields = ['nama_karyawan', 'alamat', 'no_telepon'];

    // method untuk mendapatkan seluruh data pada tabel karyawan
    public function getKaryawan(){
        return $this->findAll();
    }

    // method untuk menghapus data
    public function deleteKaryawan($id_karyawan){
        $db = db_connect();
        $builder = $db->table('karyawan');
        $builder->delete(['id_karyawan' => $id_karyawan]);
    }

    // method untuk viewData berdasarkan id
    public function getKaryawanBasedOnId($id_karyawan){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM karyawan WHERE id_karyawan = ? ', array($id_karyawan));
        $results = $query->getResult();
        return $results;
    }

    // method untuk updateData Karyawan
    public function updateKaryawan(){
        $db = db_connect();

        $data = [
            'nama_karyawan' => $_POST['nama_karyawan'], //nama adalah atribut database, sedangkan nama_karyawan adalah nama input formnya
            'alamat'  => $_POST['alamat'], //alamat adalah atribut di database, sedangkan alamat adalah input formnya
            'no_telepon'  => $_POST['no_telepon'],
        ];
        $builder = $db->table('karyawan');
        $builder->where('id_karyawan', $_POST['id_karyawan']);
        $builder->update($data);
    }
    
}