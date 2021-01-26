<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_perkembangan extends CI_Model
{

    public function grafik_perkembangan_donatur($bulan, $tahun)
    {
        $this->db->select('dw.bulan as bulan,dw.tahun as tahun, dd.segmentasi_pasar, sum(fd.nilai_donasi) as tot_nilai_donasi');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_donatur dd', 'dd.id_donatur = fd.id_donatur', 'left');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->group_by('dd.segmentasi_pasar');
        $this->db->where('dw.bulan =', $bulan);
        $this->db->where('dw.tahun =', $tahun);

        return $this->db->get()->result();
    }

    public function getDonaturByProduk($bulan, $tahun)
    {
        $this->db->select('dw.bulan as bulan, dp.nama_produk, dw.tahun as tahun, dd.segmentasi_pasar, sum(fd.nilai_donasi) as tot_nilai_donasi');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_donatur dd', 'dd.id_donatur = fd.id_donatur', 'left');
        $this->db->join('dim_produk dp', 'dp.id_produk = fd.id_produk', 'left');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->group_by('dp.nama_produk');
        $this->db->where('dw.bulan =', $bulan);
        $this->db->where('dw.tahun =', $tahun);

        return $this->db->get()->result();
    }

    public function grafikPerkembanganDonaturPertahun()
    {
        $this->db->select('fd.id_fact_donatur, dw.tahun');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->group_by('dw.tahun');
        return $this->db->get()->result();
    }

    public function grafikPerkembanganDonaturPerbulan($tahun)
    {
        $this->db->select('dw.bulan');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->group_by('dw.bulan');
        return $this->db->get()->result();
    }

    public function grafik_perkembangan_donasi($bulan)
    {
        $this->db->select('DATE_FORMAT(dw.waktuFull, "%M") as bulan, dd.segmentasi_pasar, sum(fd.nilai_donasi) as tot_nilai_donasi');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_donatur dd', 'dd.id_donatur = fd.id_donatur', 'left');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->group_by('dw.bulan');
        $this->db->group_by('dd.segmentasi_pasar');
        $this->db->where('dw.bulan =', $bulan);
        return $this->db->get()->result();
    }

    public function grafik_marketer($bulan)
    {
        $this->db->select('dp.nama_produk, COUNT(dp.nama_produk) as totalproduk , SUM(fd.nilai_donasi)as jumlahdonasi ');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_produk dp', 'dp.id_produk = fd.id_produk', 'left');
        $this->db->join('dim_waktu dw', 'dw.id_Waktu = fd.id_waktu', 'left');
        $this->db->group_by('dp.nama_produk');
        $this->db->where('dw.bulan =', $bulan);
        return $this->db->get()->result();
    }
}
