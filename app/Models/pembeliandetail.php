<?php

namespace App\Models;

use CodeIgniter\Model;

class pembeliandetail extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'detail_pembelian';
    // atribut yang diijinkan untuk diinput menggunakan query builder
    protected $allowedFields = ['id_transaksi','id_barang','jumlah','subtotal','id_supplier'];


    public function getAllById($id){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM detail_pembelian JOIN barang on detail_pembelian.id_barang = barang.id_barang JOIN supplier on detail_pembelian.id_supplier = supplier.id_supplier  WHERE id_transaksi = ? ', array($id));
        $results = $query->getResult();
        return $results;
    }
    public function GetTotalTransaksi($id)
    {
        $query = $this->db->table('detail_pembelian')
                     ->where('id_transaksi', $id)
                     ->selectSum('subtotal')
                     ->get();
        return $query->getRow()->subtotal;
    }
    public function SelesaiBelanja($id)
    {
        $total_transaksi = $this->GetTotalTransaksi($id);
        
        $this->db->table('pembelian')
             ->set('tanggal', date('y-m-d'))
             ->set('total', $total_transaksi)
             ->set('status', 1)
             ->where('id_transaksi', $id)
             ->update();
    }
        
}
?>