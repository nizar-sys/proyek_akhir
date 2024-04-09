<?php

namespace App\Models;

use CodeIgniter\Model;

class pembelianmodel extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'pembelian';
    // atribut yang diijinkan untuk diinput menggunakan query builder
    protected $allowedFields = ['id_transaksi','status','total', 'tanggal'];

    // method untuk mendapatkan seluruh data pada tabel kos
    public function getpembelian(){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM pembelian where status=1
                ');
        $results = $query->getResult();
        return $results;
    }
    public function getdatabasedonid() {
        $db = db_connect();
        $query = $db->query('SELECT id_barang,nama_barang,harga_barang FROM `barang`');
        $result = $query->getResult();
        return $result;
    }
    public function getbarangnotin($id) {
        $db = db_connect();
        $query = $db->query('SELECT id_barang,nama_barang,harga_barang FROM `barang` WHERE barang.id_barang NOT IN (SELECT id_barang FROM detail_pembelian WHERE id_transaksi = ? )', array($id));
        $result = $query->getResult();
        return $result;
    }
    public function lastid() {
        $db = db_connect();
        $query = $db->query('SELECT id_transaksi FROM `pembelian` ORDER BY id_transaksi DESC LIMIT 1');
        $result = $query->getResult();
        return $result;
    }
    public function lastidcek() {
        $db = db_connect();
        $query = $db->query('SELECT * FROM `pembelian` ORDER BY id_transaksi DESC LIMIT 1 ');
        $result = $query->getResult();
        return $result;
    }
    public function getsupplier() {
        $db = db_connect();
        $query = $db->query('SELECT id_supplier,nama_supplier FROM `supplier`');
        $result = $query->getResult();
        return $result;
    }
  

    public function showPembelian($id_transaksi)
    {
        $query = $this->db->query("SELECT * FROM pembelian join detail_pembelian on pembelian.id_transaksi = detail_pembelian.id_transaksi join barang on barang.id_barang = detail_pembelian.id_barang join supplier on supplier.id_supplier = detail_pembelian.id_supplier WHERE pembelian.id_transaksi = ?", array($id_transaksi));
        return $query;
    }
    public function printInvoice($id_pembelian)
    {
        $query = $this->db->query("SELECT * FROM pembelian join detail_pembelian on pembelian.id_transaksi = detail_pembelian.id_transaksi join barang on barang.id_barang = detail_pembelian.id_barang join supplier on supplier.id_supplier = detail_pembelian.id_supplier WHERE pembelian.id_transaksi = ?", array($id_transaksi));
        return $query;
    }
    function laporan_periode($tanggal1,$tanggal2)
    {
        $db = db_connect();
        $query=$db->query("SELECT * FROM pembelian
        JOIN barang on barang.id_barang = pembelian.id_barang
        Join supplier on supplier.id_supplier = pembelian.id_supplier
        WHERE tgl_pembelian between '$tanggal1' and '$tanggal2'
        group by id_pembelian");
        $result = $query->getresult('array');
        return $result;
    }
    function laporan_default()
    {
        $db = db_connect();
        $query=$db->query('SELECT * FROM pembelian
        JOIN barang on barang.id_barang = pembelian.id_barang
        Join supplier on supplier.id_supplier = pembelian.id_supplier
        group by id_pembelian');
        $result = $query->getresult('array');
        return $result;
    }
}


    
