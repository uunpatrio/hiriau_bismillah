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

    public function getDataPenerimaManfaatPerbulan($bulan, $tahun)
    {
        $this->db->select('count(fp.id_fact_penerima) as jlh_penerima, dw.bulan, dl.kecamatan');
        $this->db->from('fact_penerima fp');
        $this->db->join('dim_lokasi dl', 'dl.id_lokasi = fp.id_lokasi', 'left');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fp.id_waktu', 'left');
        $this->db->join('dim_penerima dp', 'dp.id_penerima = fp.id_penerima', 'left');
        $this->db->where('dw.bulan', $bulan);
        $this->db->where('dw.tahun', $tahun);
        $this->db->group_by('dl.kecamatan');
        return $this->db->get()->result();
    }

    public function getMarketer($tahun)
    {
        $this->db->select('count(fd.id_marketer) as jlh_marketer, dm.nama_marketer');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_marketer dm', 'dm.id_marketer = fd.id_marketer', 'left');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->where('dw.tahun', $tahun);
        $this->db->group_by('dm.nama_marketer');
        return $this->db->get()->result();
    }

    public function getDonaturProdukByMarketer($marketer)
    {
        $this->db->select('dp.nama_produk, count(fd.id_fact_donatur) as jlh_produk_donatur');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_marketer dm', 'dm.id_marketer = fd.id_marketer', 'left');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->join('dim_produk dp', 'dp.id_produk = fd.id_produk', 'left');
        $this->db->where('dm.nama_marketer', $marketer);
        $this->db->group_by('dp.nama_produk');
        return $this->db->get()->result();
    }

    public function getPenerimaByKategoriUmur($bulan, $tahun)
    {
        $this->db->select('count(fp.id_penerima) as jlh_penerima, dw.bulan, dp.kategori_umur');
        $this->db->from('fact_penerima fp');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fp.id_waktu', 'left');
        $this->db->join('dim_penerima dp', 'dp.id_penerima = fp.id_penerima', 'left');
        $this->db->where('dw.bulan', $bulan);
        $this->db->where('dw.tahun', $tahun);
        $this->db->group_by('dp.kategori_umur');
        return $this->db->get()->result();
    }

    public function getPenerimaByKriteria($bulan, $tahun)
    {
        $this->db->select('count(fp.id_penerima) as jlh_penerima, dw.bulan, dp.kategori_umur, dp.kriteria_penerima, dp.jenis_kelamin');
        $this->db->from('fact_penerima fp');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fp.id_waktu', 'left');
        $this->db->join('dim_penerima dp', 'dp.id_penerima = fp.id_penerima', 'left');
        $this->db->where('dw.bulan', $bulan);
        $this->db->where('dw.tahun', $tahun);
        $this->db->group_by('dp.kriteria_penerima');
        return $this->db->get()->result();
    }
    public function getPenerimaByJenisKelamin($bulan, $tahun)
    {
        $this->db->select('count(fp.id_penerima) as jlh_penerima, dw.bulan, dp.kategori_umur, dp.kriteria_penerima, dp.jenis_kelamin');
        $this->db->from('fact_penerima fp');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fp.id_waktu', 'left');
        $this->db->join('dim_penerima dp', 'dp.id_penerima = fp.id_penerima', 'left');
        $this->db->where('dw.bulan', $bulan);
        $this->db->where('dw.tahun', $tahun);
        $this->db->group_by('dp.jenis_kelamin');
        return $this->db->get()->result();
    }
}

/* End of file M_visualisasi.php */
