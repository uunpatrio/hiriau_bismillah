<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Dim_waktu_model extends CI_Model
{

    public function getWaktuDonasi($waktuDonasi)
    {
        $pecah = explode("-", $waktuDonasi);

        $tahun = $pecah[0];
        $bulan = $pecah[1];
        $tanggal = $pecah[2];

        $array = array('waktuFull' => $waktuDonasi, 'tahun' => $tahun, 'bulan' => $bulan, 'tanggal' => $tanggal);
        $this->db->replace('dim_waktu', $array);
    }

    public function getWaktuPenerima($waktuPenerima)
    {
        $pecah = explode("-", $waktuPenerima);

        $tahun = $pecah[0];
        $bulan = $pecah[1];
        $tanggal = $pecah[2];

        $array = array('waktuFull' => $waktuPenerima, 'tahun' => $tahun, 'bulan' => $bulan, 'tanggal' => $tanggal);
        $this->db->replace('dim_waktu', $array);
    }

    public function getWaktu($group_by)
    {
        $this->db->select('*');
        $this->db->from('dim_waktu');
        if (empty($group_by)) {
        } else {
            $this->db->group_by($group_by);
        }
        $this->db->order_by('id_waktu', 'asc');
        return $this->db->get()->result();
    }
}
