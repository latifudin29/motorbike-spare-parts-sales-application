<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang_masuk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_masuk_model');
    }

    public function index()
    {
        $barang_masuk = $this->Barang_masuk_model->get_all();

        $data = array(
            'konten' => 'barang_masuk/barang_masuk_list',
            'judul' => 'Data Barang Masuk',

            'barang_masuk_data' => $barang_masuk
        );
        $this->load->view('v_index', $data);
    }

    public function print()
    {
		$data['barang_masuk'] = $this->Barang_masuk_model->get_all();
		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan-barang-masuk.pdf";
		$this->pdf->load_view('barang_masuk/print_laporan_barang_masuk', $data);
    }
}