<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_import_penerima extends CI_Model
{

    public function uploadDimPenerima($jeniskelamin, $kriteria, $kategoriumur)
    {
        $dimPenerima = array('jenis_kelamin' => $jeniskelamin, 'kriteria_penerima' => $kriteria, 'kategori_umur' => $kategoriumur);
        $this->db->replace('dim_penerima', $dimPenerima);
    }

    public function importDimLokasi($namajalan, $rt, $rw, $kelurahan, $kecamatan, $kota)
    {
        $dimLokasi = array('nama_jalan' => $namajalan, 'rt' => $rt, 'rw' => $rw, 'kelurahan' => $kelurahan, 'kecamatan' => $kecamatan, 'kota' => $kota);
        $this->db->replace('dim_lokasi', $dimLokasi);
    }
    public function importDimProduk($namaproduk)
    {
        $dimProduk = array('nama_produk' => $namaproduk);
        $this->db->replace('dim_produk', $dimProduk);
    }

    public function importFactPenerima($penerimaFact, $lokasiFact, $waktuPenerimaFact, $donasiditerima, $produkFact)
    {
        $factPenerima = array('id_penerima' => $penerimaFact, 'id_lokasi' => $lokasiFact, 'id_waktu' => $waktuPenerimaFact, 'donasi_diterima' => $donasiditerima, 'id_produk' => $produkFact);
        $this->db->replace('fact_penerima', $factPenerima);
    }
}
