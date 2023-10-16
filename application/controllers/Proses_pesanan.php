<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Proses_pesanan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Proses_pesanan_model');
        $this->load->model('Barang_model');
        $this->load->library('form_validation');
    }

    public function konfirmasi($id)
    {
        $row = $this->Proses_pesanan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'action' => 'proses_pesanan/konfirmasi_action',
                'konten' => 'proses_pesanan',
                'judul' => 'Konfirmasi Pesanan',
                'button' => 'Submit',

                'id_transaksi' => set_value('id_transaksi', $row->id_transaksi),
                'kode_transaksi' => set_value('kode_transaksi', $row->kode_transaksi),
                'tgl_transaksi' => set_value('tgl_transaksi', $row->tgl_transaksi),
                'total_harga' => set_value('total_harga', $row->total_harga),
                'bukti_tf' => set_value('bukti_tf', $row->bukti_tf),
                'keterangan' => set_value('keterangan', $row->keterangan),
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('supplier/pesanan'));
        }
    }

    public function konfirmasi_action() 
    {
        $data = array(
            'id_transaksi' => $this->input->post('id_transaksi',TRUE),
            'kode_transaksi' => $this->input->post('kode_transaksi',TRUE),
            'tgl_transaksi' => $this->input->post('tgl_transaksi',TRUE),
            'total_harga' => $this->input->post('total_harga',TRUE),
            'bukti_tf' => $this->input->post('bukti_tf',TRUE),
            'keterangan' => $this->input->post('keterangan',TRUE),
        );

        $this->Barang_model->update_stok();
        $this->Proses_pesanan_model->barang_masuk();
        $this->Proses_pesanan_model->konfirmasi($this->input->post('id_transaksi', TRUE), $data);
        $this->session->set_flashdata('message', 'Konfirmasi Success');
        redirect(site_url('supplier/pesanan')); 
    }
}
