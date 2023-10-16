<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang_keluar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_keluar_model');
    }

    public function index()
    {
        $barang_keluar = $this->Barang_keluar_model->get_all();

        $data = array(
            'konten' => 'barang_keluar/barang_keluar_list',
            'judul' => 'Data Barang Keluar',

            'barang_keluar_data' => $barang_keluar
        );
        $this->load->view('v_index', $data);
    }

    public function print()
    {
		$data['barang_keluar'] = $this->Barang_keluar_model->get_all();
		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan-barang-keluar.pdf";
		$this->pdf->load_view('barang_keluar/print_laporan_barang_keluar', $data);
    }

}