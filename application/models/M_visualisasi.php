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
        $this->db->select('dw.bulan,dw.tahun, count(dd.segmentasi_pasar) as jlh_donatur');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->join('dim_donatur dd', 'dd.id_donatur = fd.id_donatur', 'left');
        $this->db->group_by('dw.bulan');
        $this->db->where('dw.tahun', $tahun);
        return $this->db->get()->result();
    }

    public function perkembanganDonaturBySegmentasi($bulan, $tahun)
    {
        $this->db->select('dd.nama_donatur, dd.segmentasi_pasar, dw.bulan, dw.tahun, count(fd.id_fact_donatur) as jumlah_segmentasi');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->join('dim_donatur dd', 'dd.id_donatur = fd.id_donatur', 'left');
        $this->db->group_by('dd.segmentasi_pasar');
        $this->db->where('dw.bulan', $bulan);
        $this->db->where('dw.tahun', $tahun);
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
        $this->db->select('count(fd.id_marketer) as jlh_marketer, dm.nama_marketer, dw.tahun');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_marketer dm', 'dm.id_marketer = fd.id_marketer', 'left');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->where('dw.tahun', $tahun);
        $this->db->group_by('dm.nama_marketer');
        return $this->db->get()->result();
    }

    public function getDonaturProdukByMarketer($marketer, $tahun)
    {
        $this->db->select('dp.nama_produk, count(fd.id_fact_donatur) as jlh_produk_donatur');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_marketer dm', 'dm.id_marketer = fd.id_marketer', 'left');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->join('dim_produk dp', 'dp.id_produk = fd.id_produk', 'left');
        $this->db->group_by('dp.nama_produk');
        $this->db->where('dm.nama_marketer', $marketer);
        $this->db->where('dw.tahun', $tahun);

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

    public function getPerbandinganDonasiMasukKeluar($tahun)
    {
        $this->db->select('sum(fd.nilai_donasi) as total_donasi_masuk, dw.tahun, count(fd.id_fact_donatur) as jlh_donatur, count(fp.id_fact_penerima) as jlh_penerima, sum(fp.donasi_diterima) as total_donasi_keluar, dw.bulan, dw.tahun');
        $this->db->from('fact_donatur fd, fact_penerima fp');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fp.id_waktu', 'left');
        $this->db->group_by('dw.tanggal');
        $this->db->where('dw.tahun', $tahun);
        return $this->db->get()->result();
    }

    public function getTotalDonasiMasuk($tahun)
    {
        $this->db->select('sum(fd.nilai_donasi) as tot_donasi, dw.tahun, dw.bulan');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->group_by('dw.bulan');
        $this->db->where('dw.tahun', $tahun);
        return $this->db->get()->result();
    }

    public function getTotalDonasiTersalurkan($tahun)
    {
        $this->db->select('sum(fp.donasi_diterima) as tot_donasi, dw.tahun, dw.bulan');
        $this->db->from('fact_penerima fp');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fp.id_waktu', 'left');
        $this->db->group_by('dw.bulan');
        $this->db->where('dw.tahun', $tahun);
        return $this->db->get()->result();
    }

    // Untuk Bagian KPI

    public function getNilaiDonasiPertahun()
    {
        $this->db->select('sum(fd.nilai_donasi) as total_donasi, k.nilai_target, count(fd.id_fact_donatur) as total_donatur, dw.tahun');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->join('kpi_nilai_donasi k', 'k.tahun = dw.tahun', 'left');
        $this->db->group_by('dw.tahun');
        return $this->db->get()->result();
    }

    public function getNilaiDonaturPertahun()
    {
        $this->db->select('sum(fd.nilai_donasi) as total_donasi, k.nilai_target, count(fd.id_fact_donatur) as jlh_donatur, dw.tahun');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->join('kpi_nilai_donatur k', 'k.tahun = dw.tahun', 'left');
        $this->db->group_by('dw.tahun');
        return $this->db->get()->result();
    }

    public function getPenerimaManfaatPertahun()
    {
        $this->db->select('count(fp.id_fact_penerima) as tot_penerima, k.nilai_target, sum(fp.donasi_diterima) as jlh_donasi, dw.tahun ');
        $this->db->from('fact_penerima fp');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fp.id_waktu', 'left');
        $this->db->join('kpi_nilai_penerima_manfaat k', 'k.tahun = dw.tahun', 'left');
        $this->db->group_by('dw.tahun');
        return $this->db->get()->result();
    }

    public function kpiDonasiPertahun($tahun)
    {
        $this->db->select('sum(fd.nilai_donasi) as total_donasi, k.nilai_target, count(fd.id_fact_donatur) as total_donatur, dw.tahun');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->join('kpi_nilai_donasi k', 'k.tahun = dw.tahun', 'left');
        $this->db->group_by('dw.tahun');
        $this->db->where('dw.tahun', $tahun);
        return $this->db->get()->result();
    }

    public function kpiDonaturPertahun($tahun)
    {
        $this->db->select('sum(fd.nilai_donasi) as total_donasi, k.nilai_target, count(fd.id_fact_donatur) as jlh_donatur, dw.tahun');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->join('kpi_nilai_donatur k', 'k.tahun = dw.tahun', 'left');
        $this->db->group_by('dw.tahun');
        $this->db->where('dw.tahun', $tahun);
        return $this->db->get()->result();
    }

    public function kpiPenerimaManfaatPertahun($tahun)
    {
        $this->db->select('count(fp.id_fact_penerima) as tot_penerima, k.nilai_target, sum(fp.donasi_diterima) as jlh_donasi, dw.tahun ');
        $this->db->from('fact_penerima fp');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fp.id_waktu', 'left');
        $this->db->join('kpi_nilai_penerima_manfaat k', 'k.tahun = dw.tahun', 'left');
        $this->db->group_by('dw.tahun');
        $this->db->where('dw.tahun', $tahun);

        return $this->db->get()->result();
    }

    public function addDataKpiDonasi($data)
    {
        $this->db->insert('kpi_nilai_donasi', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function addDataKpiDonatur($data)
    {
        $this->db->insert('kpi_nilai_donatur', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function addDataKpiPenerimaManfaat($data)
    {
        $this->db->insert('kpi_nilai_penerima_manfaat', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('golongan ap', array('ap.id' => $id))->result();
    }


    public function getKpiDonasi()
    {
        $this->db->select('*');
        $this->db->from('kpi_nilai_donasi');
        $this->db->order_by('id_kpi', 'desc');
        return $this->db->get()->result();
    }

    public function getKpiDonatur()
    {
        $this->db->select('*');
        $this->db->from('kpi_nilai_donatur');
        $this->db->order_by('id_kpi', 'desc');
        return $this->db->get()->result();
    }

    public function getKpiPenerimaManfaat()
    {
        $this->db->select('*');
        $this->db->from('kpi_nilai_penerima_manfaat');
        $this->db->order_by('id_kpi', 'desc');
        return $this->db->get()->result();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('jabatan', $data);
        return $this->db->affected_rows();
    }

    function delete_donasi($id)
    {
        $this->db->where('id_kpi', $id);
        $this->db->delete('kpi_nilai_donasi');
    }

    function delete_donatur($id)
    {
        $this->db->where('id_kpi', $id);
        $this->db->delete('kpi_nilai_donatur');
    }

    function delete_penerima_manfaat($id)
    {
        $this->db->where('id_kpi', $id);
        $this->db->delete('kpi_nilai_penerima_manfaat');
    }

    public function getTop10DonaturTertinggi($tahun)
    {
        $this->db->select('dd.nama_donatur, count(dd.nama_donatur) as tot_donatur');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->join('dim_donatur dd', 'dd.id_donatur = fd.id_donatur', 'left');
        $this->db->limit(10);
        $this->db->group_by('dd.nama_donatur');
        $this->db->order_by('tot_donatur', 'desc');
        $this->db->where('dw.tahun', $tahun);
        return $this->db->get()->result();
    }


    public function getTop10MarketerTertinggi($tahun)
    {
        $this->db->select('m.nama_marketer, count(m.nama_marketer) as tot_marketer');
        $this->db->from('fact_donatur fd');
        $this->db->join('dim_waktu dw', 'dw.id_waktu = fd.id_waktu', 'left');
        $this->db->join('dim_marketer m', 'm.id_marketer = fd.id_marketer', 'left');
        $this->db->limit(10);
        $this->db->group_by('m.nama_marketer');
        $this->db->order_by('tot_marketer', 'desc');
        $this->db->where('dw.tahun', $tahun);
        return $this->db->get()->result();
    }

    public function countDonatur()
    {
        $this->db->select('count(id_donatur) as tot_donatur');
        $this->db->from('dim_donatur');
        return $this->db->get()->result();
    }

    public function countPenerimaDonasi()
    {
        $this->db->select('count(id_penerima) as tot_penerima');
        $this->db->from('dim_penerima');
        return $this->db->get()->result();
    }

    public function countMarketer()
    {
        $this->db->select('count(id_marketer) as tot_marketer');
        $this->db->from('dim_marketer');
        $this->db->group_by('nama_marketer');
        return $this->db->get()->result();
    }

    public function countProduk()
    {
        $this->db->select('count(id_produk) as tot_produk');
        $this->db->from('dim_produk');
        $this->db->group_by('nama_produk');
        return $this->db->get()->result();
    }

    public function countDonasi()
    {
        $this->db->select('sum(nilai_donasi) as total_donasi');
        $this->db->from('fact_donatur');
        return $this->db->get()->result();
    }
}

/* End of file M_visualisasi.php */
