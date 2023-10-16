<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang_model extends CI_Model
{

    public $table = 'barang';
    public $id = 'id_barang';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_barang', $q);
        $this->db->or_like('kode_barang', $q);
        $this->db->or_like('nama_barang', $q);
        $this->db->or_like('merk_barang', $q);
        $this->db->or_like('harga', $q);
        $this->db->or_like('stok', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_barang', $q);
        $this->db->or_like('kode_barang', $q);
        $this->db->or_like('nama_barang', $q);
        $this->db->or_like('merk_barang', $q);
        $this->db->or_like('harga', $q);
        $this->db->or_like('stok', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    } 
    
    // update stok
    public function update_stok()
    {
        // Ambil data pembaruan stok dari tabel stock_updates
        $stock_updates = $this->db->get('stok_update')->result();

        // Loop setiap pembaruan dan perbarui stok barang yang sesuai
        foreach ($stock_updates as $update) {
            $kode_barang = $update->kode_barang;
            $stok_baru = $update->stok_baru;

            // Ambil stok barang saat ini dari tabel barang
            $barang = $this->db->get_where('barang', array('kode_barang' => $kode_barang))->row();
            if ($barang) {
                // Update stok barang di tabel barang
                $update_stock = $barang->stok + $stok_baru;

                $this->db->where('kode_barang', $kode_barang);
                $this->db->update('Barang', array('stok' => $update_stock));
                $this->db->empty_table('stok_update');
            }
        }
    }

}