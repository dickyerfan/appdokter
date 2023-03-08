<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_tindakan extends CI_Model
{

    public function getTindakan()
    {
        $this->db->select('*');
        $this->db->from('tindakan');
        return $this->db->get()->result();
    }

    public function tambahTindakan()
    {
        $data1 = [
            'nama_tindakan' => $this->input->post('nama_tindakan', true),
            'harga' => $this->input->post('harga', true),
            'ket_tindakan' => $this->input->post('ket_tindakan', true)
        ];
        $data2 = [
            'nama_tindakan2' => $this->input->post('nama_tindakan', true),
            'harga2' => $this->input->post('harga', true),
            'ket_tindakan2' => $this->input->post('ket_tindakan', true)
        ];
        $this->db->insert('tindakan', $data1);
        $this->db->insert('tindakan2', $data2);
    }

    public function editTindakan()
    {
        $data = [
            'nama_tindakan' => $this->input->post('nama_tindakan', true),
            'harga' => $this->input->post('harga', true),
            'ket_tindakan' => $this->input->post('ket_tindakan', true),
            'status' => $this->input->post('status', true)
        ];

        $data2 = [
            'nama_tindakan2' => $this->input->post('nama_tindakan', true),
            'harga2' => $this->input->post('harga', true),
            'ket_tindakan2' => $this->input->post('ket_tindakan', true),
            'status2' => $this->input->post('status', true)
        ];

        $this->db->where('id_tindakan', $_POST['id_tindakan']);
        $this->db->update('tindakan', $data);

        $this->db->where('id_tindakan2', $_POST['id_tindakan']);
        $this->db->update('tindakan2', $data2);
    }

    public function hapusTindakan($id)
    {
        $this->db->where('id_tindakan', $id);
        $this->db->delete('tindakan');

        $this->db->where('id_tindakan2', $id);
        $this->db->delete('tindakan2');
    }

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

    public function getPasienDokter()
    {
        $this->db->select('*');
        $this->db->from('kunjungan_pasien');
        $this->db->join('jadwal_periksa', 'kunjungan_pasien.id_jadwal = jadwal_periksa.id_jadwal');
        $this->db->join('proses', 'kunjungan_pasien.id_proses = proses.id_proses');
        return $this->db->get()->result();
    }
}
