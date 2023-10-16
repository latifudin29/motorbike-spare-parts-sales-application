<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Proses_pesanan_model extends CI_Model
{
    public $table = 'transaksi';
    public $id = 'id_transaksi';

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function konfirmasi($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function barang_masuk() {
        $query = $this->db->query("INSERT INTO barang_masuk(kode_barang, kode_supplier, jumlah, subtotal) SELECT kode_barang, kode_supplier, qty, subtotal FROM detail_transaksi");
        return $query;
    }
}