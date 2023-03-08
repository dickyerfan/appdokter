<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_daftarPasien extends CI_Model
{

    public function getAllPasien()
    {
        return $this->db->get('data_pasien')->result();
    }

    // public function getPasien()
    // {

    //     if (isset($_GET['add_post'])){
    //         $tgl = $_GET['tanggal'];
    //         $bulan = $_GET['bulan'];
    //         $tahun = $_GET['tahun'];
    //     }else{
    //         $tgl = date('d');
    //         $bulan = date('m');
    //         $tahun = date('Y');
    //     }

    //     $this->db->select('*');
    //     $this->db->from('tanggal_pasien');
    //     $this->db->join('data_pasien','tanggal_pasien.id_pasien = data_pasien.id_pasien');
    //     $this->db->join('jam_periksa','tanggal_pasien.id_jam = jam_periksa.id_jam');
    //     $this->db->where('DAY(tanggal)', $tgl);
    //     $this->db->where('MONTH(tanggal)', $bulan);
    //     $this->db->where('YEAR(tanggal)', $tahun);
    //     $this->db->order_by('jam_periksa.jam');
    //     return $this->db->get()->result();
    // }

    public function tambahData()
    {
        $data = [
            'nama_pasien' => $this->input->post('nama_pasien', true),
            'alamat_pasien' => $this->input->post('alamat_pasien', true),
            'telepon_pasien' => $this->input->post('telepon_pasien', true),
            'jenkel_pasien' => $this->input->post('jenkel_pasien', true),
            'no_ktp' => $this->input->post('no_ktp', true),
            'tgl_lahir' => $this->input->post('tgl_lahir', true),
            'bpjs' => $this->input->post('bpjs', true),
            'keterangan' => $this->input->post('keterangan', true),
        ];
        $this->db->insert('data_pasien', $data);
    }


    public function getIdPasien($id)
    {
        return $this->db->get_where('data_pasien', ['id_pasien' => $id])->row();
    }


    public function updateData()
    {
        $data = [
            'nama_pasien' => $this->input->post('nama_pasien', true),
            'alamat_pasien' => $this->input->post('alamat_pasien', true),
            'telepon_pasien' => $this->input->post('telepon_pasien', true),
            'jenkel_pasien' => $this->input->post('jenkel_pasien', true),
            'no_ktp' => $this->input->post('no_ktp', true),
            'tgl_lahir' => $this->input->post('tgl_lahir', true),
            'bpjs' => $this->input->post('bpjs', true),
            'keterangan' => $this->input->post('keterangan', true),
        ];
        $this->db->where('id_pasien', $this->input->post('id_pasien'));
        $this->db->update('data_pasien', $data);
    }

    public function hapusData($id)
    {
        $this->db->where('id_pasien', $id);
        $this->db->delete('data_pasien');
    }

    public function getDetailPasien($id)
    {
        $this->db->select('*');
        $this->db->from('kunjungan_pasien');
        $this->db->join('jadwal_periksa', 'jadwal_periksa.id_jadwal = kunjungan_pasien.id_jadwal');
        $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
        $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
        $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
        $this->db->join('tindakan', 'tindakan.id_tindakan = kunjungan_pasien.id_tindakan');
        $this->db->join('tindakan2', 'tindakan2.id_tindakan2 = kunjungan_pasien.id_tindakan2', 'left');
        $this->db->where('jadwal_periksa.id_pasien', $id);
        $this->db->order_by('jadwal_periksa.id_tanggal', 'DESC');
        return $this->db->get()->result();
    }
    public function getPasienDetail($id)
    {
        $this->db->select('*');
        $this->db->from('kunjungan_pasien');
        $this->db->join('jadwal_periksa', 'jadwal_periksa.id_jadwal = kunjungan_pasien.id_jadwal');
        $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
        $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
        $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
        $this->db->join('tindakan', 'tindakan.id_tindakan = kunjungan_pasien.id_tindakan');
        $this->db->where('jadwal_periksa.id_pasien', $id);
        $this->db->limit(1);
        $this->db->order_by('jadwal_periksa.id_tanggal');
        return $this->db->get()->result();
    }
}
