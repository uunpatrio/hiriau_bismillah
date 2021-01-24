<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/AutoLoader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Import_penerima extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_import_penerima');
        $this->load->model('Dim_waktu_model');
    }
    public function index()
    {
        $data['title'] = 'Data Penerima Manfaat';
        $this->load->view('vimport_penerima', $data);
    }

    public function uploaddata_penerima()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'penerima_manfaat' . time();
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
                        //import data dim penerima
                        $jeniskelamin =  $row->getCellAtIndex(3);
                        $kriteria = $row->getCellAtIndex(7);
                        $kategoriumur = $row->getCellAtIndex(9);

                        $this->M_import_penerima->uploadDimPenerima($jeniskelamin, $kriteria, $kategoriumur);
                        $query0 = $this->db->query("SELECT * FROM dim_penerima;");
                        $this->db->where('id_penerima', $jeniskelamin);
                        foreach ($query0->result() as $penerima) {
                            $penerimaFact = $penerima->id_penerima;
                        }

                        //import data lokasi
                        $namajalan =  $row->getCellAtIndex(11);
                        $rt =  $row->getCellAtIndex(12);
                        $rw =  $row->getCellAtIndex(13);
                        $kelurahan =  $row->getCellAtIndex(14);
                        $kecamatan =  $row->getCellAtIndex(15);
                        $kota =  $row->getCellAtIndex(16);
                        $this->M_import_penerima->importDimLokasi($namajalan, $rt, $rw, $kelurahan, $kecamatan, $kota);
                        $query1 = $this->db->query("SELECT * FROM dim_lokasi;");
                        $this->db->where('id_lokasi', $namajalan);
                        foreach ($query1->result() as $lokasi) {
                            $lokasiFact = $lokasi->id_lokasi;
                        }

                        //dim waktu penerima
                        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
                        $now = date('Y-m-d H:i:s');
                        $waktuPenerima = $row->getCellAtIndex(1);
                        $this->Dim_waktu_model->getWaktuPenerima($waktuPenerima);

                        $pecah = explode("-", $waktuPenerima);
                        $tahun = $pecah[0];
                        $bulan = $pecah[1];
                        $tanggal = $pecah[2];
                        $query = $this->db->query("SELECT * FROM dim_waktu;");
                        $this->db->where('tahun', $tahun);
                        $this->db->where('bulan', $bulan);
                        $this->db->where('tanggal', $tanggal);

                        foreach ($query->result() as $waktupenerima) {
                            $waktuPenerimaFact = $waktupenerima->id_waktu;
                        }

                        //import data produk
                        $namaproduk =  $row->getCellAtIndex(5);
                        $this->M_import_penerima->importDimProduk($namaproduk);
                        $query1 = $this->db->query("SELECT * FROM dim_produk;");
                        $this->db->where('id_produk', $namaproduk);
                        foreach ($query1->result() as $produk) {
                            $produkFact = $produk->id_produk;
                        }

                        //fact Penerima 
                        $donasiditerima =  $row->getCellAtIndex(6);
                        $this->M_import_penerima->importFactPenerima($penerimaFact, $lokasiFact, $waktuPenerimaFact, $donasiditerima, $produkFact);
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_name']);
                $this->session->set_flashdata('pesan', 'Import Data Penerima Berhasil');
                redirect('home');
            }
        } else {
            echo "Error:" . $this->upload->display_error();
        };
    }
}
