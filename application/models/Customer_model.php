<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    public $table = 'pembelian';
    public $id = 'id_beli';

    function get_all()
    {
        $this->db->order_by('id_barang', 'DESC');
        return $this->db->get('barang')->result();
    }

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

    function penguranganStok($kode_barang, $qty) {
        $this->db->where('kode_barang', $kode_barang);
        $this->db->set('stok', 'stok - ' . $qty, FALSE);
        $this->db->update('barang');
    }

    function barang_keluar() {
        $query = $this->db->query("INSERT INTO barang_keluar(kode_barang, pelanggan, jumlah, subtotal) SELECT kode_barang, pelanggan, qty, subtotal FROM detail_beli");
        return $query;
    }
}