<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_daftarPasienAjax extends CI_Model
{

    public function getAllPasien()
    {
        return $this->db->get('data_pasien')->result();
    }


    public function tambahData($data)
    {
        return $this->db->insert('data_pasien', $data);
    }

    // public function tambahData()
    // {
    //     $data = [
    //         'nama_pasien' => $this->input->post('nama_pasien', true),
    //         'alamat_pasien' => $this->input->post('alamat_pasien', true),
    //         'telepon_pasien' => $this->input->post('telepon_pasien', true),
    //         'jenkel_pasien' => $this->input->post('jenkel_pasien', true),
    //         'no_ktp' => $this->input->post('no_ktp', true),
    //         'tgl_lahir' => $this->input->post('tgl_lahir', true),
    //         'bpjs' => $this->input->post('bpjs', true),
    //         'keterangan' => $this->input->post('keterangan', true),
    //     ];
    //     return $this->db->insert('data_pasien', $data);
    // }

    public function getIdPasien($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function cekNamaPasien($nama_pasien)
    {
        $query = $this->db->get_where('data_pasien', array('nama_pasien' => $nama_pasien));
        return $query->num_rows();
    }

    public function cekDuplikatData($no_ktp)
    {
        $query = $this->db->query("SELECT COUNT(*) AS jml_data FROM data_pasien WHERE no_ktp = '$no_ktp'");
        $result = $query->row_array();
        return $result['jml_data'];
    }

    public function updateData($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapusData($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
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
    // public function getPasienDetail($id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('kunjungan_pasien');
    //     $this->db->join('jadwal_periksa', 'jadwal_periksa.id_jadwal = kunjungan_pasien.id_jadwal');
    //     $this->db->join('data_pasien', 'jadwal_periksa.id_pasien = data_pasien.id_pasien');
    //     $this->db->join('jam_periksa', 'jadwal_periksa.id_jam = jam_periksa.id_jam');
    //     $this->db->join('tanggal_pasien', 'jadwal_periksa.id_tanggal = tanggal_pasien.id_tanggal');
    //     $this->db->join('tindakan', 'tindakan.id_tindakan = kunjungan_pasien.id_tindakan');
    //     $this->db->where('jadwal_periksa.id_pasien', $id);
    //     $this->db->limit(1);
    //     $this->db->order_by('jadwal_periksa.id_tanggal');
    //     return $this->db->get()->result();
    // }

    public function getPasienDetail($table, $where)
    {
        return $this->db->get_where($table, $where);
    }
}
