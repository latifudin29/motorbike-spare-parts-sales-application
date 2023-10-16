<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang_masuk_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $this->db->select('*');
        $this->db->from('barang_masuk');
        $this->db->join('barang', 'barang_masuk.kode_barang=barang.kode_barang');
        $this->db->join('supplier', 'barang_masuk.kode_supplier=supplier.kode_supplier');
        return $this->db->get()->result();
    }
}