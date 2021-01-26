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
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $jenis_kelamin = $this->input->post();
        $kategori_umur = $this->input->post();
        $kriteria = $this->input->post();

        if (empty($bulan) && empty($tahun)) {
            $view['getDataPenerimaManfaatPerbulan'] = $this->M_visualisasi->getDataPenerimaManfaatPerbulan(date('n'), date('Y'));
            $view['getPenerimaByKategoriUmur'] = $this->M_visualisasi->getPenerimaByKategoriUmur(date('n'), date('Y'));
            $view['getPenerimaByKriteria'] = $this->M_visualisasi->getPenerimaByKriteria(date('n'), date('Y'));
            $view['getPenerimaByJenisKelamin'] = $this->M_visualisasi->getPenerimaByJenisKelamin(date('n'), date('Y'));
        } else {
            $view['getDataPenerimaManfaatPerbulan'] = $this->M_visualisasi->getDataPenerimaManfaatPerbulan($bulan, $tahun);
            $view['getPenerimaByKategoriUmur'] = $this->M_visualisasi->getPenerimaByKategoriUmur($bulan, $tahun);
            $view['getPenerimaByKriteria'] = $this->M_visualisasi->getPenerimaByKriteria($bulan, $tahun);
            $view['getPenerimaByJenisKelamin'] = $this->M_visualisasi->getPenerimaByJenisKelamin($bulan, $tahun);
        }
        $view['getBln'] = $this->Dim_waktu_model->getWaktu('bulan');
        $view['getThn'] = $this->Dim_waktu_model->getWaktu('tahun');
        $view['bulan'] = $bulan;
        $view['tahun'] = $tahun;

        $this->load->view('templates/header', $view);
        $this->load->view('templates/sidebar');
        $this->load->view('vPenerimaManfaat');
        $this->load->view('templates/footer');
    }
}
