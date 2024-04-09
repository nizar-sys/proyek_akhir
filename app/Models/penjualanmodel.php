<?php

namespace App\Models;

use CodeIgniter\Model;

class penjualanmodel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    // atribut yang diijinkan untuk diinput menggunakan query builder
    protected $allowedFields = ['id_karyawan','id_barang','id_pelanggan', 'tanggal_jual','jumlah_barang', 'subtotal',];



    // method untuk mendapatkan seluruh data pada tabel kos
    public function getpenjualan(){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM penjualan
        JOIN karyawan on karyawan.id_karyawan = penjualan.id_karyawan
        JOIN pelanggan on pelanggan.id_pelanggan = penjualan.id_pelanggan
        join barang on barang.id_barang = penjualan.id_barang
                ');
        $results = $query->getResult();
        return $results;
    }
    public function getkaryawan() {
        $db = db_connect();
        $query = $db->query('SELECT id_karyawan,nama_karyawan FROM `karyawan`');
        $result = $query->getResult();
        return $result;
    }
    public function getbarang() {
        $db = db_connect();
        $query = $db->query('SELECT id_barang,nama_barang,harga_barang FROM `barang`');
        $result = $query->getResult();
        return $result;
    }
    public function getpelanggan() {
        $db = db_connect();
        $query = $db->query('SELECT id_pelanggan,nama_pelanggan FROM `pelanggan`');
        $result = $query->getResult();
        return $result;
    }
    public function showPenjualan($id_penjualan)
    {
        $query = $this->db->query("SELECT * FROM penjualan join barang on barang.id_barang = penjualan.id_barang
        join pelanggan on pelanggan.id_pelanggan = penjualan.id_pelanggan
        join karyawan on karyawan.id_karyawab = penjualan.id_karyawan
        WHERE id_penjualan = ?", array($id_penjualan));
        return $query;
    }
    public function printInvoice($id_penjualan)
    {
        $query = $this->db->query("SELECT * FROM penjualan join barang on barang.id_barang = penjualan.id_barang
        join pelanggan on pelanggan.id_pelanggan = penjualan.id_pelanggan
        join karyawan on karyawan.id_karyawan = penjualan.id_karyawan
        WHERE id_penjualan = ?", array($id_penjualan));
        return $query;
    }
    function laporan_periode($tanggal1,$tanggal2)
    {
        $db = db_connect();
        $query=$db->query("SELECT * FROM penjualan
        JOIN barang on barang.id_barang = penjualan.id_barang
        Join pelanggan on pelanggan.id_pelanggan = penjualan.id_pelanggan
        Join karyawan on karyawan.id_karyawan = penjualan.id_karyawan
        WHERE tanggal_jual between '$tanggal1' and '$tanggal2'
        group by id_penjualan");
        $result = $query->getresult('array');
        return $result;
    }
    function laporan_default()
    {
        $db = db_connect();
        $query=$db->query('SELECT * FROM penjualan
        JOIN barang on barang.id_barang = penjualan.id_barang
        Join pelanggan on pelanggan.id_pelanggan = penjualan.id_pelanggan
        Join karyawan on karyawan.id_karyawan = penjualan.id_karyawan
        group by id_penjualan');
        $result = $query->getresult('array');
        return $result;
    }
}


    

