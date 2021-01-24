<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_visualisasi extends CI_Model
{
    public function segmentasiPasar()
    {
        $this->db->select('fd.id_fact_donatur, fd.nilai_donasi, count(fd.id_fact_donatur) as jumlah_donasi, sum(fd.nilai_donasi) as total_donasi, dw.bulan, dw.tahun');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->group_by('dw.tahun');
        return $this->db->get()->result();
    }

    public function segmentasiPasarByTahun($tahun)
    {
        $this->db->select('fd.id_fact_donatur, fd.nilai_donasi, count(fd.id_fact_donatur) as jumlah_donasi, sum(fd.nilai_donasi) as total_donasi, dw.bulan, dw.tahun');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->group_by('dw.bulan');
        $this->db->where('dw.tahun', $tahun);
        return $this->db->get()->result();
    }

    public function getBulanByDataSegmentasi($tahun)
    {
        $this->db->select('dw.bulan, count(fd.id_donatur) as jlh_donatur');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->group_by('dw.bulan');
        $this->db->where('dw.tahun', $tahun);
        return $this->db->get()->result();
    }

    public function perkembanganDonaturBySegmentasi($bulan)
    {
        $this->db->select('dd.nama_donatur, dd.segmentasi_pasar, dw.bulan, dw.tahun, count(fd.id_fact_donatur) as jumlah_segmentasi');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->join('dim_donatur dd', 'dd.id_donatur = fd.id_donatur', 'left');
        $this->db->group_by('dd.segmentasi_pasar');
        $this->db->where('dw.bulan', $bulan);
        return $this->db->get()->result();
    }

    public function getDataPenerimaManfaatPerbulan($bulan, $tahun, $jenis_kelamin, $kategori_umur, $kriteria_penerima)
    {
        $this->db->select('count(fp.id_penerima) as jlh_penerima, dw.bulan, dl.kecamatan');
        $this->db->from('fact_penerima fp');
        $this->db->join('dim_lokasi dl', 'dl.id_lokasi = fp.id_lokasi', 'left');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fp.id_waktu', 'left');
        $this->db->join('dim_penerima dp', 'dp.id_penerima = fp.id_penerima', 'left');
        $this->db->where('dw.bulan', $bulan);
        $this->db->where('dw.tahun', $tahun);
        if (!empty($jenis_kelamin)) {
            $this->db->where('dp.jenis_kelamin', $jenis_kelamin);
        } else if (!empty($kategori_umur)) {
            $this->db->where('dp.kategori_umur', $kategori_umur);
        } else if (!empty($kriteria_penerima)) {
            $this->db->where('dp.kriteria_penerima', $kriteria_penerima);
        } else {
        }
        $this->db->group_by('dl.kecamatan');
        return $this->db->get()->result();
    }
}

/* End of file M_visualisasi.php */
