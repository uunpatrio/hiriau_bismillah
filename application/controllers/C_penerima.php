<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_penerima extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_visualisasi');
        $this->load->model('Dim_waktu_model');
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
    public function index()
    {
        $bulan = $this->input->post();
        $tahun = $this->input->post();
        $jenis_kelamin = $this->input->post();
        $kategori_umur = $this->input->post();
        $kriteria = $this->input->post();

        if (empty($bulan) && empty($tahun) && empty($jenis_kelamin) && empty($kategori_umur) && empty($kriteria)) {
            $view['getDataPenerimaManfaatPerbulan'] = $this->M_visualisasi->getDataPenerimaManfaatPerbulan(date('n'), date('Y'), '', '', '');
        } else {
            $view['getDataPenerimaManfaatPerbulan'] = $this->M_visualisasi->getDataPenerimaManfaatPerbulan($bulan, $tahun, $jenis_kelamin, $kategori_umur, $kriteria);
        }
        $view['getDataPenerimaManfaatPerbulan'] = $this->M_visualisasi->getDataPenerimaManfaatPerbulan(2, 2019, 'Laki-laki', 'Dewasa', 'Yatim');
        $view['getBln'] = $this->Dim_waktu_model->getWaktu('bulan');
        $view['getThn'] = $this->Dim_waktu_model->getWaktu('tahun');

        $this->load->view('templates/header', $view);
        $this->load->view('templates/sidebar');
        $this->load->view('vPenerimaManfaat');
        $this->load->view('templates/footer');
    }
}
