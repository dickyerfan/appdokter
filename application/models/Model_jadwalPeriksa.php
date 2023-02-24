<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_jadwalPeriksa extends CI_Model
{

    public function getAllJadwalPeriksa()
    {
        if (isset($_GET['pilihWaktu'])) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }

        $this->db->select('*');
        $this->db->from('tanggal_pasien');
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->order_by('tanggal');
        return $this->db->get()->result();
    }

    public function tambahData()
    {
        $data = [
            'tanggal' => $this->input->post('tanggal', true),
        ];
        $this->db->insert('tanggal_pasien', $data);
    }

    public function editData()
    {
        $data = [
            'tanggal' => $this->input->post('tanggal', true),
            'ket_tanggal' => $this->input->post('ket_tanggal', true)
        ];
        $this->db->where('id_tanggal', $_POST['id_tanggal']);
        $this->db->update('tanggal_pasien', $data);
    }

    public function getJadwalPasien($id_tanggal)
    {
        $this->db->select('*');
        $this->db->from('jadwal_periksa');
        $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
        $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
        $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
        $this->db->where('jadwal_periksa.id_tanggal', $id_tanggal);
        $this->db->order_by('jam_periksa.jam');
        return $this->db->get()->result();
    }

    public function getPasien()
    {
        $this->db->select('*');
        $this->db->from('jadwal_periksa');
        $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
        $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
        $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
        $this->db->order_by('jam_periksa.jam');
        return $this->db->get()->result();
    }

    public function tambahJadwalPasien()
    {
        $data = [
            'id_pasien' => $this->input->post('id_pasien', true),
            'id_jam' => $this->input->post('id_jam', true),
            'id_tanggal' => $this->input->post('id_tanggal', true)
        ];
        $this->db->insert('jadwal_periksa', $data);
    }

    public function inputJadwalPasien()
    {
        $data = [
            'id_pasien' => $this->input->post('id_pasien', true),
            'id_jam' => $this->input->post('id_jam', true),
            'id_tanggal' => $this->input->post('id_tanggal', true)
            // 'id_tanggal' => $this->uri->segment(3)
        ];
        $this->db->insert('jadwal_periksa', $data);
    }

    // public function hapusData($id)
    // {
    //     $this->db->where('id_pasien', $id);
    //     $this->db->delete('data_pasien');
    // }
}
