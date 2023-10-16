<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang_keluar_model extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $this->db->select('*');
        $this->db->from('barang_keluar');
        $this->db->join('barang', 'barang_keluar.kode_barang=barang.kode_barang');
        return $this->db->get()->result();
    }

}