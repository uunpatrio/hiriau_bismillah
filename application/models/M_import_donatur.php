<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_import_donatur extends CI_Model
{

    public function uploadDimDonatur($iddonatur, $namadonatur, $segmentasi)
    {
        $this->db->distinct();
        $dimDonatur = array('id_donatur' => $iddonatur, 'nama_donatur' => $namadonatur, 'segmentasi_pasar' => $segmentasi);
        $this->db->replace('dim_donatur', $dimDonatur);
    }

    public function importDimMarketer($marketer)
    {
        $this->db->distinct();
        $dimMarketer = array('nama_marketer' => $marketer);
        $this->db->replace('dim_marketer', $dimMarketer);
    }
    public function importDimProduk($namaproduk)
    {
        $this->db->distinct();
        $dimProduk = array('nama_produk' => $namaproduk);
        $this->db->replace('dim_produk', $dimProduk);
    }

    public function importFactDonasi($iddonatur, $produkFact, $waktudonasi, $marketerfect, $nilaiDonasi)
    {
        $factDonatur = array('id_donatur' => $iddonatur, 'id_produk' => $produkFact, 'id_waktu' => $waktudonasi, 'id_marketer' => $marketerfect, 'nilai_donasi' => $nilaiDonasi);

        $this->db->replace('fact_donatur', $factDonatur);
    }
}
