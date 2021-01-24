<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/AutoLoader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Import_donatur extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_import_donatur');
        $this->load->model('Dim_waktu_model');
    }
    public function index()
    {
        $data['title'] = 'Data Donatur Masuk';
        // $data['semuaBahanBaku'] = $this->model->getDataBahanBaku();
        // $data['factBahanBaku'] = $this->model->getDataBahanBakuFact();

        $this->load->view('vimport_donatur', $data);
    }

    public function uploaddata()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'donatur' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('importexcel')) {
            $file = $this->upload->data();
            $reader = ReaderEntityFactory::createXLSXReader();
            $reader->setShouldFormatDates(true);

            $reader->open('uploads/' . $file['file_name']);
            foreach ($reader->getSheetIterator() as $sheet) {
                $numRow = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numRow > 1) {
                        //import data dim donatur
                        $iddonatur =  $row->getCellAtIndex(2);
                        $namadonatur = $row->getCellAtIndex(4);
                        $segmentasi = $row->getCellAtIndex(3);
                        $this->M_import_donatur->uploadDimDonatur($iddonatur, $namadonatur, $segmentasi);

                        //import data dim marketer
                        $marketer =  $row->getCellAtIndex(15);
                        $this->M_import_donatur->importDimMarketer($marketer);
                        $query2 = $this->db->query("SELECT * FROM dim_marketer;");
                        $this->db->where('id_marketer', $marketer);
                        foreach ($query2->result() as $marketer) {
                            $marketerfect = $marketer->id_marketer;
                        }

                        //dim waktu donasi
                        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
                        $now = date('Y-m-d H:i:s');
                        $waktuDonasi = $row->getCellAtIndex(1);
                        $this->Dim_waktu_model->getWaktuDonasi($waktuDonasi);
                        $pecah = explode("-", $waktuDonasi);
                        $tahun = $pecah[0];
                        $bulan = $pecah[1];
                        $tanggal = $pecah[2];
                        $query3 = $this->db->query("SELECT * FROM dim_waktu;");
                        $this->db->where('tahun', $tahun);
                        $this->db->where('bulan', $bulan);
                        $this->db->where('tanggal', $tanggal);
                        foreach ($query3->result() as $waktu) {
                            $waktudonasi = $waktu->id_waktu;
                        }
                        //import data produk
                        $namaproduk =  $row->getCellAtIndex(6);
                        $this->M_import_donatur->importDimProduk($namaproduk);
                        $query1 = $this->db->query("SELECT * FROM dim_produk;");
                        $this->db->where('id_produk', $namaproduk);
                        foreach ($query1->result() as $produk) {
                            $produkFact = $produk->id_produk;
                        }

                        //fact donatur
                        $nilaiDonasi =  $row->getCellAtIndex(9);
                        $this->M_import_donatur->importFactDonasi($iddonatur, $produkFact, $waktudonasi, $marketerfect, $nilaiDonasi);
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_name']);
                $this->session->set_flashdata('pesan', 'Import Data Berhasil');
                redirect('home');
            }
        } else {
            echo "Error:" . $this->upload->display_error();
        };
    }
}
