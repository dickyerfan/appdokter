<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_dashboard extends CI_Model
{

    public function getJam()
    {
        $this->db->select('*');
        $this->db->from('jam_periksa');
        $this->db->order_by('jam', 'ASC');
        return $this->db->get()->result();
    }

    public function getPasien()
    {
        $tgl = date('d');
        $bulan = date('m');
        $tahun = date('Y');

        $this->db->select('*');
        $this->db->from('jadwal_periksa');
        $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
        $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
        $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
        $this->db->where('DAY(tanggal)', $tgl);
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->order_by('jam_periksa.jam');
        return $this->db->get()->result();
    }

    public function tambahDataJam()
    {
        $data = [
            'jam' => $this->input->post('jam', true),
            'ket_jam' => $this->input->post('ket_jam', true)
        ];
        $this->db->insert('jam_periksa', $data);
    }

    public function editDataJam()
    {
        $data = [
            'jam' => $this->input->post('jam', true),
            'ket_jam' => $this->input->post('ket_jam', true)
        ];
        $this->db->where('id_jam', $_POST['id_jam']);
        $this->db->update('jam_periksa', $data);
    }

    public function editStatus()
    {
        $data = [
            'status_pasien' => $this->input->post('status_pasien', true),
        ];
        $this->db->where('id_jadwal', $_POST['id_jadwal']);
        return $this->db->update('jadwal_periksa', $data);
    }


    public function updateTindakanPasien()
    {
        $data = [
            'id_jadwal' => $_POST['id_jadwal'],
        ];
        $this->db->insert('kunjungan_pasien', $data);
    }

    public function deleteJadwalPasien()
    {
        $id_jadwal = $_POST['id_jadwal'];

        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->delete('jadwal_periksa');
    }
}
