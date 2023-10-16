<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	function __construct()
    {
        parent::__construct();
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

	// Fungsi Regitrasi
	public function registrasi()
	{
		$this->load->view('auth/register');
	}

	public function simpan_reg()
	{
		$nama_user = $this->input->post('nama_user');
		$alamat = $this->input->post('alamat');
		$telepon = $this->input->post('telepon');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = array(
			'nama_user' => $nama_user,
			'alamat' => $alamat,
			'telepon' => $telepon,
			'username' => $username,
			'password' => $password,
			'level' => 'customer',
		);

		$this->db->insert('users', $data);
		?>
		<script type="text/javascript">
			alert('Pendaftaran Berhasil, Silahkan Login');
			window.location = '<?php echo base_url('app/login'); ?>'
		</script>
		<?php
	}

	// Fungsi Login
	public function login()
	{
		if ($this->input->post() == NULL) {
			$this->load->view('auth/login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$cek_user = $this->db->query("SELECT * FROM users WHERE username='$username' and password='$password' ");
			$cek_supplier = $this->db->query("SELECT * FROM supplier WHERE username='$username' and password='$password'");
			if ($cek_user->num_rows() == 1) {
				foreach ($cek_user->result() as $row) {
					$sess_data['id_user'] = $row->id_user;
					$sess_data['nama'] = $row->nama_user;
					$sess_data['username'] = $row->username;
					$sess_data['level'] = $row->level;
					$this->session->set_userdata($sess_data);
				}
				redirect('app');
			}elseif ($cek_supplier->num_rows() == 1) {
				foreach ($cek_supplier->result() as $row) {
					$sess_data['id_user'] = $row->kode_supplier;
					$sess_data['nama'] = $row->nama_supplier;
					$sess_data['kode'] = $row->kode_supplier;
					$sess_data['username'] = $row->username;
					$sess_data['level'] = 'supplier';
					$this->session->set_userdata($sess_data);
				}
				redirect('app');
			} else {
				?>
				<script type="text/javascript">
					alert('Username dan password kamu salah !');
					window.location="<?php echo base_url('app/login'); ?>";
				</script>
				<?php
			}

		}
	}

	// Fungsi logout
	function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('level');
		session_destroy();
		redirect('app/login');
	}
}
