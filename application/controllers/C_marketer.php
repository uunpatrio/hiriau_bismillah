<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_marketer extends CI_Controller
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
        if (empty($tahun)) {
            $tahun = date('Y');
        }

        $data['getMarketer'] = $this->M_visualisasi->getMarketer($tahun);
        $data['getMarketer1'] = $this->M_visualisasi->getMarketer($tahun);

        $data['tahun'] = $tahun;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('vperkembangan_marketer');
        $this->load->view('templates/footer');
    }
}
