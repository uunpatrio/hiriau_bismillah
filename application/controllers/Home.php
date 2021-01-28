<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') == NULL || "") {
			redirect('C_admin');
		}
		$this->load->model('M_perkembangan');
		$this->load->model('M_visualisasi');
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($tahun = '')
	{


		date_default_timezone_set('Asia/Jakarta');
		if (empty($this->input->post('filter')) && empty($this->input->post('ftahun'))) {
			$data = array(
				'getdataperkembangan' => $this->M_perkembangan->grafik_perkembangan_donatur(date('m'), date('Y'))
			);
		} else {
			$data = array(
				'getdataperkembangan' => $this->M_perkembangan->grafik_perkembangan_donatur($this->input->post('filter'), $this->input->post('ftahun'))
			);
		}

		if (empty($tahun)) {
			$tahun = date('Y');
		}
		$data['getTop10DonaturTertinggi'] = $this->M_visualisasi->getTop10DonaturTertinggi($tahun);
		$data['getTop10MarketerTertinggi'] = $this->M_visualisasi->getTop10MarketerTertinggi($tahun);
		$data['countDonatur'] = $this->M_visualisasi->countDonatur();
		$data['countPenerimaDonasi'] = $this->M_visualisasi->countPenerimaDonasi();
		$data['countMarketer'] = $this->M_visualisasi->countMarketer();
		$data['countProduk'] = $this->M_visualisasi->countProduk();
		$data['countDonasi'] = $this->M_visualisasi->countDonasi();

		$data['tahun'] = $tahun;

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('home');
		$this->load->view('templates/footer');
	}
}
