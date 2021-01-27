<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_KPI extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_visualisasi');
    }


    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * http:   //example.com/index.php/welcome
     *	- or -
     * http:   //example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https:   //codeigniter.com/user_guide/general/urls.html
     */
    public function index($tahun = '')
    {
        date_default_timezone_set('Asia/Jakarta');
        if (empty($tahun)) {
            $tahun = 2019;
        }

        $data['getMarketer']                = $this->M_visualisasi->getMarketer($tahun);
        $data['tahun']                      = $tahun;
        $data['getNilaiDonasiPertahun']     = $this->M_visualisasi->getNilaiDonasiPertahun();
        $data['getNilaiDonaturPertahun']    = $this->M_visualisasi->getNilaiDonaturPertahun();
        $data['getPenerimaManfaatPertahun'] = $this->M_visualisasi->getPenerimaManfaatPertahun();
        $data['kpiDonasiPertahun']          = $this->M_visualisasi->kpiDonasiPertahun($tahun);
        $data['kpiDonaturPertahun']         = $this->M_visualisasi->kpiDonaturPertahun($tahun);
        $data['kpiPenerimaManfaatPertahun'] = $this->M_visualisasi->kpiPenerimaManfaatPertahun($tahun);
        $data['getKpiDonasi']               = $this->M_visualisasi->getKpiDonasi();
        $data['getKpiDonatur']              = $this->M_visualisasi->getKpiDonatur();
        $data['getKpiPenerimaManfaat']      = $this->M_visualisasi->getKpiPenerimaManfaat();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kpi');
        $this->load->view('templates/footer');
    }

    public function addKPIDonasi()
    {
        $data['nilai_target'] = htmlspecialchars($this->input->post('nilai_target1'));
        $data['tahun']        = htmlspecialchars($this->input->post('tahun1'));

        if ($data['nilai_target'] == '') {
            $this->session->set_flashdata('alert', 'Nilai Target tidak boleh kosong !');
            redirect('C_KPI');
        } else if ($data['tahun'] == '') {
            $this->session->set_flashdata('alert', 'Tahun tidak boleh kosong !');
            redirect('C_KPI');
        } else {
            $this->M_visualisasi->addDataKpiDonasi($data);
            $this->session->set_flashdata('success', 'Berhasil Menambahkan data !');
            redirect('C_KPI');
        }
    }


    public function addKPIDonatur()
    {
        $data['nilai_target'] = htmlspecialchars($this->input->post('nilai_target2'));
        $data['tahun']        = htmlspecialchars($this->input->post('tahun2'));

        if ($data['nilai_target'] == '') {
            $this->session->set_flashdata('error', 'Nilai Target tidak boleh kosong !');
            redirect('C_KPI');
        } else if ($data['tahun'] == '') {
            $this->session->set_flashdata('error', 'Tahun tidak boleh kosong !');
            redirect('C_KPI');
        } else {
            $this->M_visualisasi->addDataKpiDonatur($data);
            $this->session->set_flashdata('success', 'Berhasil Menambahkan data !');
            redirect('C_KPI');
        }
    }

    public function addKPIPenerimaManfaat()
    {
        $data['nilai_target'] = htmlspecialchars($this->input->post('nilai_target3'));
        $data['tahun']        = htmlspecialchars($this->input->post('tahun3'));

        if ($data['nilai_target'] == '') {
            $this->session->set_flashdata('error', 'Nilai Target tidak boleh kosong !');
            redirect('C_KPI');
        } else if ($data['tahun'] == '') {
            $this->session->set_flashdata('error', 'Tahun tidak boleh kosong !');
            redirect('C_KPI');
        } else {
            $this->M_visualisasi->addDataKpiPenerimaManfaat($data);
            $this->session->set_flashdata('success', 'Berhasil Menambahkan data !');
            redirect('C_KPI');
        }
    }

    public function delete_donasi($id)
    {
        $this->M_visualisasi->delete_donasi($id);
        $this->session->set_flashdata('success', 'Berhasil Menghapus data !');
        redirect('C_KPI');
    }

    public function delete_donatur($id)
    {
        $this->M_visualisasi->delete_donatur($id);
        $this->session->set_flashdata('success', 'Berhasil Menghapus data !');
        redirect('C_KPI');
    }
    public function delete_penerima_manfaat($id)
    {
        $this->M_visualisasi->delete_penerima_manfaat($id);
        $this->session->set_flashdata('success', 'Berhasil Menghapus data !');
        redirect('C_KPI');
    }
}
