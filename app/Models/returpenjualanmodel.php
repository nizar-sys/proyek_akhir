<?php

namespace App\Models;

use CodeIgniter\Model;

class returpenjualanmodel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'retur_penjualan';
    protected $primaryKey = 'id_retur_penjualan';
    // atribut yang diijinkan untuk diinput menggunakan query builder
    protected $allowedFields = ['id_barang','tanggal_retur','jumlah_barang', 'subtotal', 'id_karyawan','id_penjualan'];



    // method untuk mendapatkan seluruh data pada tabel kos
    public function getreturpenjualan(){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM retur_penjualan
        JOIN barang on barang.id_barang = retur_penjualan.id_barang   
        JOIN karyawan on karyawan.id_karyawan = retur_penjualan.id_karyawan
        JOIN penjualan on penjualan.id_penjualan = retur_penjualan.id_penjualan
                ');
        $results = $query->getResult();
        return $results;
    }
    public function getbarang() {
        $db = db_connect();
        $query = $db->query('SELECT id_barang, nama_barang, harga_barang FROM `barang`');
        $result = $query->getResult();
        return $result;
    }
    public function getpenjualan() {
        $db = db_connect();
        $query = $db->query('SELECT * FROM `penjualan`');
        $result = $query->getResult();
        return $result;
    }
    public function getkaryawan() {
        $db = db_connect();
        $query = $db->query('SELECT id_karyawan, nama_karyawan FROM `karyawan`');
        $result = $query->getResult();
        return $result;
    }
    public function showReturpenjualan($id_retur_penjualan)
    {
        $query = $this->db->query("SELECT * FROM retur_penjualan join barang on barang.id_barang = retur_penjualan.id_barang
        JOIN penjualan on penjualan.id_penjualan = retur_penjualan.id_penjualan
        join karyawan on karyawan.id_karyawan = retur_penjualan.id_karyawan
        WHERE id_retur_penjualan = ?", array($id_retur_penjualan));
        return $query;
    }
    public function printInvoice($id_retur_penjualan)
    {
        $query = $this->db->query("SELECT * FROM retur_penjualan join barang on barang.id_barang = retur_penjualan.id_barang
        JOIN penjualan on penjualan.id_penjualan = retur_penjualan.id_penjualan
        join karyawan on karyawan.id_karyawan = retur_penjualan.id_karyawan
        WHERE id_retur_penjualan = ?", array($id_retur_penjualan));
        return $query;
    }
    function laporan_periode($tanggal1,$tanggal2)
    {
        $db = db_connect();
        $query=$db->query("SELECT * FROM retur_penjualan
        JOIN barang on barang.id_barang = retur_penjualan.id_barang
        JOIN penjualan on penjualan.id_penjualan = retur_penjualan.id_penjualan
        Join karyawan on karyawan.id_karyawan = retur_penjualan.id_karyawan
        WHERE tanggal_retur between '$tanggal1' and '$tanggal2'
        group by id_retur_penjualan");
        $result = $query->getresult('array');
        return $result;
    }
    function laporan_default()
    {
        $db = db_connect();
        $query=$db->query('SELECT * FROM retur_penjualan
        JOIN barang on barang.id_barang = retur_penjualan.id_barang
        JOIN penjualan on penjualan.id_penjualan = retur_penjualan.id_penjualan
        Join karyawan on karyawan.id_karyawan = retur_penjualan.id_karyawan
        group by id_retur_penjualan');
        $result = $query->getresult('array');
        return $result;
    }
}


    
