<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $list_barang = $this->Customer_model->get_all();
        $data = array(
            'konten' => 'customer/data_barang',
            'judul' => 'List Barang',
            'barang' => $list_barang,
            'id_barang' => $row->id_barang,
            'kode_barang' => $row->kode_barang,
            'nama_barang' => $row->nama_barang,
            'merk_barang' => $row->merk_barang,
            'harga' => $row->harga,
            'stok' => $row->stok,
        );
        $this->load->view('v_index', $data);
    }

    public function data_pembelian()
    {
		$data = array(
			'konten' => 'customer/data_pembelian',
			'judul' => 'Data Pembelian',
		);
		$this->load->view('v_index',$data);
    }

    public function tambah_pembelian()
	{
		$this->load->model('No_urut');

		$data = array(
			'konten' => 'customer/form_pembelian',
			'judul' => 'Tambah Pembelian',
			'kodeurut' => $this->No_urut->buat_kode_pembelian(),
		);
		$this->load->view('v_index',$data);
	}

    public function simpan_pembelian()
	{
        $kode_beli = $this->input->post('kode_beli');
        $tgl_beli = $this->input->post('tgl_beli');
        $total_harga = $this->input->post('total_harga');

        foreach ($this->cart->contents() as $items) {
            $kode_barang = $items['id'];
            $pelanggan = $this->input->post('pelanggan');
            $qty = $items['qty'];
            $subtotal = $items['subtotal'];
            $d = array(
                'kode_beli' => $kode_beli,
                'kode_barang' => $kode_barang,
                'pelanggan' => $pelanggan,
                'qty' => $qty,
                'subtotal' => $subtotal
            );
            $this->db->insert('detail_beli', $d);
        }

        $data = array(
            'kode_beli'=> $kode_beli,
            'tgl_beli'=> $tgl_beli,
            'total_harga'=> $total_harga,
        );
        $this->db->insert('pembelian', $data);
        $this->cart->destroy();
        redirect('customer/data_pembelian');
	}

    public function cek_barang()
	{
        $kode_barang = $this->input->post('kode_barang');
        $cek = $this->db->query("SELECT * FROM barang WHERE kode_barang='$kode_barang'")->row();
		$data = array(
			'stok' => $cek->stok,
			'harga' => $cek->harga,
			'kode_barang' => $cek->kode_barang,
			'nama_barang' => $cek->nama_barang,
		);
		echo json_encode($data);
	}

    public function tambah_cart()
	{
		
        $data = array(
            'id'    => $this->input->post('kode_barang'),
            'qty'   => $this->input->post('jumlah'),
            'price' => $this->input->post('harga'),
            'name'  => $this->input->post('nabar'),
        );
        $this->cart->insert($data);
        redirect('customer/tambah_pembelian');
	}

	public function hapus_cart($id)
	{
		
        $data = array(
            'rowid'    => $id,
            'qty'   => 0,
        );
        $this->cart->update($data);
        redirect('customer/tambah_pembelian');
	}

	public function hapus_pembelian($kode_beli)
	{
		
        $this->db->where('kode_beli', $kode_beli);
		$this->db->delete('pembelian');
		$this->db->where('kode_beli', $kode_beli);
		$this->db->delete('detail_beli');
		?>
		<script type="text/javascript">
			alert('Berhapus Hapus Data');
			window.location='<?php echo base_url('customer/data_pembelian') ?>';
		</script>
		<?php
	}

    public function detail_pembelian($kode_beli)
	{
		$data = array(
			'konten' => 'customer/detail_pembelian',
			'judul' => 'Detail Pembelian',
			'data' => $this->db->query("SELECT * FROM pembelian where kode_beli='$kode_beli'"),
		);
		$this->load->view('v_index',$data);
	}

    public function konfirmasi($id)
    {
        $row = $this->Customer_model->get_by_id($id);

        if ($row) {
            $data = array(
                'action' => 'customer/konfirmasi_action',
                'konten' => 'customer/proses_pembelian',
                'judul' => 'Konfirmasi Pembelian',
                'button' => 'Submit',

                'id_beli' => set_value('id_beli', $row->id_beli),
                'kode_beli' => set_value('kode_beli', $row->kode_beli),
                'tgl_beli' => set_value('tgl_beli', $row->tgl_beli),
                'total_harga' => set_value('total_harga', $row->total_harga),
                'keterangan' => set_value('keterangan', $row->keterangan),
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('customer/data_pembelian'));
        }
    }

    public function konfirmasi_action() 
    {
        $data = array(
            'id_beli' => $this->input->post('id_beli',TRUE),
            'kode_beli' => $this->input->post('kode_beli',TRUE),
            'tgl_beli' => $this->input->post('tgl_beli',TRUE),
            'total_harga' => $this->input->post('total_harga',TRUE),
            'keterangan' => $this->input->post('keterangan',TRUE),
        );

        $sql = $this->db->query("SELECT * FROM detail_beli");
        foreach ($sql->result() as $row) {
            if ($row->kode_beli == $this->input->post('kode_beli')) {
                $kode_barang = $row->kode_barang;
                $qty = $row->qty;
                $this->Customer_model->penguranganStok($kode_barang, $qty);
            }
        }

        $this->Customer_model->barang_keluar();
        $this->Customer_model->konfirmasi($this->input->post('id_beli', TRUE), $data);
        $this->session->set_flashdata('message', 'Konfirmasi Success');
        redirect(site_url('customer/data_pembelian'));
    }
}