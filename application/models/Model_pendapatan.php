<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_pendapatan extends CI_Model
{
    public function getPendapatanPerbulan()
    {
        if (isset($_GET['pilihWaktu'])) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }
        $this->db->select('*');
        $this->db->from('jadwal_periksa');
        $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
        $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
        $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
        $this->db->join('kunjungan_pasien', 'jadwal_periksa.id_jadwal = kunjungan_pasien.id_jadwal', 'left');
        $this->db->join('tindakan', 'tindakan.id_tindakan = kunjungan_pasien.id_tindakan', 'left');
        $this->db->join('tindakan2', 'tindakan2.id_tindakan2 = kunjungan_pasien.id_tindakan2', 'left');
        // $this->db->where('DAY(tanggal)', $tgl);
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('status_pasien', 3);
        $this->db->order_by('tanggal_pasien.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function totalBulan()
    {
        if (isset($_GET['pilihWaktu'])) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }
        $this->db->select_sum('tagihan');
        $this->db->from('jadwal_periksa');
        $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
        $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
        $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
        $this->db->join('kunjungan_pasien', 'jadwal_periksa.id_jadwal = kunjungan_pasien.id_jadwal', 'left');
        $this->db->join('tindakan', 'tindakan.id_tindakan = kunjungan_pasien.id_tindakan', 'left');
        $this->db->join('tindakan2', 'tindakan2.id_tindakan2 = kunjungan_pasien.id_tindakan2', 'left');
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('status_pasien', 3);
        $this->db->order_by('jam_periksa.jam');
        return $this->db->get()->result();
    }

    // public function getPendapatanPerbulan()
    // {
    //     if (isset($_GET['pilihWaktu'])) {
    //         $bulan = $_GET['bulan'];
    //         $tahun = $_GET['tahun'];
    //     } else {
    //         $bulan = date('m');
    //         $tahun = date('Y');
    //     }

    //     if (isset($_GET['pilihTanggal'])) {
    //         $tgl = $_GET['tanggal'];
    //         $tglArray = explode("-", $tgl);
    //         $tgl = $tglArray[2];
    //         $bulan = $tglArray[1];
    //         $tahun = $tglArray[0];
    //     } else {
    //         $tgl = date('d');
    //         $bulan = date('m');
    //         $tahun = date('Y');
    //     }

    //     $this->db->select('*');
    //     $this->db->from('jadwal_periksa');
    //     $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
    //     $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
    //     $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
    //     $this->db->join('kunjungan_pasien', 'jadwal_periksa.id_jadwal = kunjungan_pasien.id_jadwal', 'left');
    //     $this->db->join('tindakan', 'tindakan.id_tindakan = kunjungan_pasien.id_tindakan', 'left');
    //     $this->db->join('tindakan2', 'tindakan2.id_tindakan2 = kunjungan_pasien.id_tindakan2', 'left');
    //     // $this->db->where('DAY(tanggal)', $tgl);
    //     $this->db->where('MONTH(tanggal)', $bulan);
    //     $this->db->where('YEAR(tanggal)', $tahun);
    //     $this->db->where('status_pasien', 3);
    //     $this->db->order_by('tanggal_pasien.tanggal', 'DESC');
    //     return $this->db->get()->result();
    // }
}
