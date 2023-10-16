<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class No_urut extends CI_Model
{

    function buat_kode_barang()  {    
        $this->db->select('RIGHT(barang.id_barang,4) as kode', FALSE);
        $this->db->order_by('id_barang','DESC');    
        $this->db->limit(1);     
        $query = $this->db->get('barang'); //cek dulu apakah ada sudah ada kode di tabel.    
        if($query->num_rows() <> 0){       
            //jika kode ternyata sudah ada.      
            $data = $query->row();      
            $kode = intval($data->kode) + 1;     
        } else {       
            //jika kode belum ada      
            $kode = 1;     
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);    
        $kodejadi = "BRG".$kodemax;     
        return $kodejadi;  
    }

    function buat_kode_transaksi() {    
        $this->db->select('RIGHT(transaksi.id_transaksi,5) as kode', FALSE);
        $this->db->order_by('id_transaksi','DESC');    
        $this->db->limit(1);     
        $query = $this->db->get('transaksi'); //cek dulu apakah ada sudah ada kode di tabel.    
        if($query->num_rows() <> 0){       
        //jika kode ternyata sudah ada.      
        $data = $query->row();      
        $kode = intval($data->kode) + 1;     
        }
        else{       
        //jika kode belum ada      
        $kode = 1;     
        }
        $kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT);    
        $kodejadi = "TR".$kodemax;     
        return $kodejadi;  
    }

    function buat_kode_supplier()  {    
        $this->db->select('RIGHT(supplier.id_supplier,6) as kode', FALSE);
        $this->db->order_by('id_supplier','DESC');    
        $this->db->limit(1);     
        $query = $this->db->get('supplier'); //cek dulu apakah ada sudah ada kode di tabel.    
        if($query->num_rows() <> 0){       
            //jika kode ternyata sudah ada.      
            $data = $query->row();      
            $kode = intval($data->kode) + 1;     
        } else {       
            //jika kode belum ada      
            $kode = 1;     
        }
        $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT);    
        $kodejadi = "SP".$kodemax;     
        return $kodejadi;  
    }

    function buat_kode_pembelian()  {    
        $this->db->select('RIGHT(pembelian.id_beli,6) as kode', FALSE);
        $this->db->order_by('id_beli','DESC');    
        $this->db->limit(1);     
        $query = $this->db->get('pembelian'); //cek dulu apakah ada sudah ada kode di tabel.    
        if($query->num_rows() <> 0){       
            //jika kode ternyata sudah ada.      
            $data = $query->row();      
            $kode = intval($data->kode) + 1;     
        } else {       
            //jika kode belum ada      
            $kode = 1;     
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);    
        $kodejadi = "P".$kodemax;     
        return $kodejadi;  
    }
}
