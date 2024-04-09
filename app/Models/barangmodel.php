<?php

namespace App\Models;

use CodeIgniter\Model;

class barangmodel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    // atribut yang diijinkan untuk diinput menggunakan query builder
    protected $allowedFields = ['nama_barang','harga_barang', 'stok'];

    // method untuk mendapatkan seluruh data pada tabel kos
    public function getbarang(){
        return $this->findAll();
    }

    // method untuk menghapus data
    public function deletebarang($id_barang){
        $db = db_connect();
        $builder = $db->table('barang');
        $builder->delete(['id_barang' => $id_barang]);
    }
   
    // method untuk viewData berdasarkan id_barang
    public function getbarangBasedOnid($id_barang){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM barang WHERE id_barang = ? ', array($id_barang));
        $results = $query->getResult();
        return $results;
    }

    // method untuk updateData kosan
    public function updatebarang(){
        $db = db_connect();

        $data = [
            'nama_barang' => $_POST['nama_barang'],
            'harga_barang' => $_POST['harga_barang'], //nama adalah atribut database, sedangkan nama_kos adalah nama input formnya
            'stok'  => $_POST['stok'],

        ];
        $builder = $db->table('barang');
        $builder->where('id_barang', $_POST['id_barang']);
        $builder->update($data);
    }
    
}