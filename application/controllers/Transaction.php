<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('Transaction_model');
		$this->load->model('No_urut');
        $this->load->library('form_validation');
    }
	
	public function index()
	{
		if ($this->session->userdata('level') == "") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'home',
            'judul' => 'Dashboard',
		);
		$this->load->view('v_index', $data);
	}

	public function pesanan_supplier()
	{
		$data = array(
			'konten' => 'data_pesanan',
			'judul' => 'Data Pemesanan',
		);
		$this->load->view('v_index',$data);
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

	public function tambah_transaksi()
	{
		$data = array(
			'konten' => 'form_transaksi',
			'judul' => 'Tambah Transaksi',
			'kodeurut' => $this->No_urut->buat_kode_transaksi(),
		);
		$this->load->view('v_index',$data);
	}

	public function hapus_transaksi($kode_transaksi)
	{
		
        $this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->delete('transaksi');
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->delete('detail_transaksi');
		?>
		<script type="text/javascript">
			alert('Berhapus Hapus Data');
			window.location='<?php echo base_url('transaction/pesanan_supplier') ?>';
		</script>
		<?php
	}

	public function cetak_transaksi($kode_transaksi)
	{
		
        $data = array(
			'data' => $this->db->query("SELECT * FROM transaksi where kode_transaksi='$kode_transaksi'"),
		);
		$this->load->view('cetak_transaksi', $data);
	}

	public function detail_transaksi($kode_transaksi)
	{
		$data = array(
			'konten' => 'detail_transaksi',
			'judul' => 'Detail Transaksi',
			'data' => $this->db->query("SELECT * FROM transaksi where kode_transaksi='$kode_transaksi'"),
		);
		$this->load->view('v_index',$data);
	}

	public function simpan_transaksi()
	{
        $kode_transaksi = $this->input->post('kode_transaksi');
        $total_harga = $this->input->post('total_harga');
        $tgl_transaksi = $this->input->post('tgl_transaksi');

		foreach ($this->cart->contents() as $items) {
			$kode_barang = $items['id'];
			$kode_supplier = $items['kode_supplier'];
			$qty = $items['qty'];
			$subtotal = $this->input->post('total_harga');

			// Insert data ke tabel detail_transaksi
			$d = array(
				'kode_transaksi' => $kode_transaksi,
				'kode_barang' => $kode_barang,
				'kode_supplier' => $kode_supplier,
				'qty' => $qty,
				'subtotal' => $subtotal,
			);
			$this->db->insert('detail_transaksi', $d);

			// Insert data ke tabel stok_update
			$p = array(
				'kode_barang' => $kode_barang,
				'stok_baru' => $qty,
			);
			$this->db->insert('stok_update', $p);
        }

		// Insert data ke tabel transaksi
        $data = array(
            'kode_transaksi'=> $kode_transaksi,
            'total_harga'=> $total_harga,
            'tgl_transaksi'=> $tgl_transaksi,
        );
        $this->db->insert('transaksi', $data);
        $this->cart->destroy();
        redirect('transaction/pesanan_supplier');
	}

	public function simpan_cart()
	{
		
        $data = array(
            'id'    => $this->input->post('kode_barang'),
            'kode_supplier' => $this->input->post('kode_supplier'),
            'qty'   => $this->input->post('jumlah'),
            'price' => $this->input->post('harga'),
            'name'  => $this->input->post('nabar'),
        );
        $this->cart->insert($data);
        redirect('transaction/tambah_transaksi');
	}

	public function hapus_cart($id)
	{
		
        $data = array(
            'rowid'    => $id,
            'qty'   => 0,
        );
        $this->cart->update($data);
        redirect('transaction/tambah_transaksi');
	}
	
	public function pembayaran($kode_transaksi)
	{
		$data = array(
			'konten' => 'pembayaran',
			'judul' => 'Pembayaran',
			'data' => $this->db->query("SELECT * FROM transaksi where kode_transaksi='$kode_transaksi'"),
		);
		$this->load->view('v_index',$data);
	}

	public function konfirmasi($id)
    {
        $row = $this->Transaction_model->get_by_id($id);

        if ($row) {
            $data = array(
                'action' => 'transaction/konfirmasi_action',
                'konten' => 'pembayaran_form',
                'judul' => 'Konfirmasi Pesanan',
                'button' => 'Submit',

                'id_transaksi' => set_value('id_transaksi', $row->id_transaksi),
                'kode_transaksi' => set_value('kode_transaksi', $row->kode_transaksi),
                'tgl_transaksi' => set_value('tgl_transaksi', $row->tgl_transaksi),
                'total_harga' => set_value('total_harga', $row->total_harga),
                'keterangan' => set_value('keterangan', $row->keterangan),
			);
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaction/pesanan_supplier'));
        }
    }

    public function konfirmasi_action() 
    {
		$nmfile = "bukti_".time();
        $config['upload_path'] = './image/bukti';
        $config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
        $config['max_size'] = 1024;
        $config['file_name'] = $nmfile;
        // load library upload
        $this->load->library('upload', $config);
        // upload gambar 1
        $this->upload->do_upload('bukti_tf');
        $result1 = $this->upload->data();
        $result = array('gambar'=>$result1);
        $dfile = $result['gambar']['file_name'];
		
        $data = array(
			'id_transaksi' => $this->input->post('id_transaksi',TRUE),
            'kode_transaksi' => $this->input->post('kode_transaksi',TRUE),
            'tgl_transaksi' => $this->input->post('tgl_transaksi',TRUE),
            'total_harga' => $this->input->post('total_harga',TRUE),
            'bukti_tf' => $dfile,
            'keterangan' => $this->input->post('keterangan',TRUE),
        );
		
        $this->Transaction_model->konfirmasi($this->input->post('id_transaksi', TRUE), $data);
        $this->session->set_flashdata('message', 'Pembayaran Success');
        redirect(site_url('transaction/pesanan_supplier')); 
    }
}
