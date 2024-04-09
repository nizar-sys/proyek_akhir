<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'akun';

    // method untuk mengecek apakah username dan password dari $_POST sudah sesuai
    public function cekUsernamePassword(){
        
        $nama = $_POST['username'];
        $pwd = $_POST['password'];
        // query dengan bind parameter username dan pwd untuk mencegah sql injection
        $db = db_connect();
        $query   = $db->query('SELECT COUNT(*) as jml FROM akun WHERE username = ? AND pwd = ?', array($nama,md5($pwd)));
        $results = $query->getResult();
        return $results;
    }
    public function getall(){
        $db = db_connect();
        $query   = $db->query('SELECT sum(penjualan.subtotal) as total ,sum(barang.stok) as stok from penjualan join barang on barang.id_barang = penjualan.id_barang');
        $result = $query->getResultArray();
            return $result;
        }
        public function getretur(){
            $db = db_connect();
            $query   = $db->query('SELECT sum(subtotal) as subtotal');
            $result = $query->getResultArray();
                return $result;
        }
        public function getbarang(){
            $db = db_connect();
            $query   = $db->query('Select sum(stok) as jumlah from barang');
            $result = $query->getResultArray();
                return $result;
        }
       



}