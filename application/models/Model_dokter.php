<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_dokter extends CI_Model
{
    public function getPasienDokter()
    {
        $tgl = date('d');
        $bulan = date('m');
        $tahun = date('Y');
        $this->db->select('*');
        $this->db->from('jadwal_periksa');
        $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
        $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
        $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
        $this->db->join('kunjungan_pasien', 'jadwal_periksa.id_jadwal = kunjungan_pasien.id_jadwal', 'left');
        $this->db->join('tindakan', 'tindakan.id_tindakan = kunjungan_pasien.id_tindakan', 'left');
        $this->db->where('DAY(tanggal)', $tgl);
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->order_by('jam_periksa.jam');
        return $this->db->get()->result();
    }

    // public function getPasienDokter()
    // {
    //     $tgl = date('d');
    //     $bulan = date('m');
    //     $tahun = date('Y');
    //     $this->db->select('*');
    //     $this->db->from('kunjungan_pasien');
    //     $this->db->join('jadwal_periksa', 'jadwal_periksa.id_jadwal = kunjungan_pasien.id_jadwal');
    //     $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
    //     $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
    //     $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
    //     $this->db->join('tindakan', 'tindakan.id_tindakan = kunjungan_pasien.id_tindakan');
    //     $this->db->where('DAY(tanggal)', $tgl);
    //     $this->db->where('MONTH(tanggal)', $bulan);
    //     $this->db->where('YEAR(tanggal)', $tahun);
    //     $this->db->order_by('jam_periksa.jam');
    //     return $this->db->get()->result();
    // }




    // public function inputTindakan()
    // {
    //     $id_jadwal = $this->uri->segment(3);
    //     $jumlah = $this->input->post('jumlah');
    //     $tagihan = $this->input->post('tagihan');
    //     $totalTagihan = $jumlah * $tagihan;

    //     $data = [
    //         'id_tindakan' => $this->input->post('id_tindakan', true),
    //         'keluhan' => $this->input->post('keluhan', true),
    //         'jumlah' => $this->input->post('jumlah', true),
    //         'tagihan' => $totalTagihan,
    //         'ket_kunjungan' => $this->input->post('ket_kunjungan', true),
    //     ];
    //     $this->db->where('id_jadwal', $id_jadwal);
    //     $this->db->update('kunjungan_pasien', $data);

    //     $data = [
    //         'status_pasien' => 3,
    //     ];

    //     $this->db->where('id_jadwal', $id_jadwal);
    //     $this->db->update('jadwal_periksa', $data);
    // }

    public function inputTindakan()
    {
        $id_jadwal = $this->uri->segment(3);
        $jumlah = $this->input->post('jumlah');
        $tagihan = $this->input->post('tagihan');
        $totalTagihan = $jumlah * $tagihan;

        $data = [
            'id_tindakan' => $this->input->post('id_tindakan', true),
            'keluhan' => $this->input->post('keluhan', true),
            'jumlah' => $this->input->post('jumlah', true),
            'tagihan' => $totalTagihan,
            'ket_kunjungan' => $this->input->post('ket_kunjungan', true),
        ];
        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->update('kunjungan_pasien', $data);

        $data = [
            'status_pasien' => 3,
        ];

        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->update('jadwal_periksa', $data);
    }

    // public function getTindakan()
    // {
    //     $this->db->select('*');
    //     $this->db->from('kunjungan_pasien');
    //     $this->db->join('jadwal_periksa', 'kunjungan_pasien.id_jadwal = jadwal_periksa.id_jadwal');
    //     $this->db->join('penanganan', 'kunjungan_pasien.id_penanganan = penanganan.id_penanganan');
    //     return $this->db->get()->result();
    // }

    // public function tambahDataJam()
    // {
    //     $data = [
    //         'jam' => $this->input->post('jam', true),
    //         'ket_jam' => $this->input->post('ket_jam', true)
    //     ];
    //     $this->db->insert('jam_periksa', $data);
    // }

    // public function editDataJam()
    // {
    //     $data = [
    //         'jam' => $this->input->post('jam', true),
    //         'ket_jam' => $this->input->post('ket_jam', true)
    //     ];
    //     $this->db->where('id_jam', $_POST['id_jam']);
    //     $this->db->update('jam_periksa', $data);
    // }

    // public function editStatus()
    // {
    //     $data = [
    //         'status_pasien' => $this->input->post('status_pasien', true),
    //     ];
    //     $this->db->where('id_jadwal', $_POST['id_jadwal']);
    //     $this->db->update('jadwal_periksa', $data);
    // }

    // public function getJam()
    // {
    //     $this->db->select('*');
    //     $this->db->from('jam_periksa');
    //     $this->db->order_by('jam', 'ASC');
    //     return $this->db->get()->result();
    // }


}
