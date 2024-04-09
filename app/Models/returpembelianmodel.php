<?php

namespace App\Models;

use CodeIgniter\Model;

class returpembelianmodel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'retur_pembelian';
    protected $primaryKey = 'id_retur_pembelian';
    // atribut yang diijinkan untuk diinput menggunakan query builder
    protected $allowedFields = ['id_pembelian','id_barang','id_karyawan','tanggal_retur','jumlah', 'total'];



    // method untuk mendapatkan seluruh data pada tabel kos
    public function getreturpembelian(){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM retur_pembelian
        JOIN pembelian on pembelian.id_pembelian = retur_pembelian.id_pembelian
        JOIN barang on barang.id_barang = retur_pembelian.id_barang
        JOIN karyawan on karyawan.id_karyawan = retur_pembelian.id_karyawan
        JOIN supplier on supplier.id_supplier = pembelian.id_supplier
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
    public function getkaryawan() {
        $db = db_connect();
        $query = $db->query('SELECT id_karyawan, nama_karyawan FROM `barang`');
        $result = $query->getResult();
        return $result;
    }
    public function getsupplier() {
        $db = db_connect();
        $query = $db->query('SELECT id_supplier,nama_supplier FROM `supplier`');
        $result = $query->getResult();
        return $result;
    }
    public function getpembelian() {
        $db = db_connect();
        $query = $db->query('SELECT * FROM `pembelian`');
        $result = $query->getResult();
        return $result;
    }
    public function showReturpembelian($id_retur_pembelian)
    {
        $query = $this->db->query("SELECT * FROM retur_pembelian join barang on barang.id_barang = retur_pembelian.id_barang
        join pembelian on pembelian.id_pembelian = retur_pembelian.id_pembelian
        join karyawan on karyawan.id_karyawan = pembelian.id_karyawan
        join supplier on supplier.id_supplier = pembelian.id_supplier
        WHERE id_retur_pembelian = ?", array($id_retur_pembelian));
        return $query;
    }
    public function printInvoice($id_retur_pembelian)
    {
        $query = $this->db->query("SELECT * FROM retur_pembelian join barang on barang.id_barang = retur_pembelian.id_barang
        join pembelian on pembelian.id_pembelian = retur_pembelian.id_pembelian
        join karyawan on karyawan.id_karyawan = pembelian.id_karyawan
        join supplier on supplier.id_supplier = pembelian.id_supplier
        WHERE id_retur_pembelian = ?", array($id_retur_pembelian));
        return $query;
    }
    function laporan_periode($tanggal1,$tanggal2)
    {
        $db = db_connect();
        $query=$db->query("SELECT * FROM retur_pembelian
        JOIN barang on barang.id_barang = retur_pembelian.id_barang
        Join pembelian on pembelian.id_pembelian = retur_pembelian.id_pembelian
        join karyawan on karyawan.id_karyawan = pembelian.id_karyawan
        Join supplier on supplier.id_supplier = pembelian.id_supplier
        WHERE tanggal_retur between '$tanggal1' and '$tanggal2'
        group by id_retur_pembelian");
        $result = $query->getresult('array');
        return $result;
    }
    function laporan_default()
    {
        $db = db_connect();
        $query=$db->query('SELECT * FROM retur_pembelian
        JOIN barang on barang.id_barang = retur_pembelian.id_barang
        Join pembelian on pembelian.id_pembelian = retur_pembelian.id_pembelian
        join karyawan on karyawan.id_karyawan = pembelian.id_karyawan
        Join supplier on supplier.id_supplier = pembelian.id_supplier
        group by id_retur_pembelian');
        $result = $query->getresult('array');
        return $result;
    }
}


    
