

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_perkembangan_donatur extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_perkembangan');
        $this->load->model('M_visualisasi');
        $this->load->model('Dim_waktu_model');

        $this->load->helper('my_function_helper');
    }

    public function index()
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
        $data['grafikPerkembanganDonaturPertahun'] = $this->M_perkembangan->grafikPerkembanganDonaturPertahun();
        $data['segmentasiPasar'] = $this->M_visualisasi->segmentasiPasar();
        $data['getBulan'] = $this->Dim_waktu_model->getWaktu('bulan');
        $data['getTahun'] = $this->Dim_waktu_model->getWaktu('tahun');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('vperkembangan_donatur');
        $this->load->view('templates/footer');
    }


    public function donasi($tahun = '')
    {
        date_default_timezone_set('Asia/Jakarta');
        if (empty($tahun)) {
            $tahun = date('Y');
        }

        $data['tahun'] = $tahun;
        $data = array(
            'getdataperkembangan' => $this->M_perkembangan->grafik_perkembangan_donasi(1)
        );
        $data['grafikPerkembanganDonaturPertahun'] = $this->M_perkembangan->grafikPerkembanganDonaturPertahun();
        $data['segmentasiPasar'] = $this->M_visualisasi->segmentasiPasar();
        $data['getBulanByDataSegmentasi'] = $this->M_visualisasi->getBulanByDataSegmentasi($tahun);

        $data['getBulan'] = $this->Dim_waktu_model->getWaktu('bulan');
        $data['getTahun'] = $this->Dim_waktu_model->getWaktu('tahun');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('vperkembangan_donasi');
        $this->load->view('templates/footer');
    }

    public function marketer()
    {
        $data = array(
            'getdatamarketer' => $this->M_perkembangan->grafik_marketer(2)
        );
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('vperkembangan_marketer');
        $this->load->view('templates/footer');
    }
}
