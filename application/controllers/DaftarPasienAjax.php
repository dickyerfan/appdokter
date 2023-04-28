<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarPasienAjax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_daftarPasienAjax');
        $this->load->library('form_validation');

        if (!$this->session->userdata('level')) {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf,</strong> Anda harus login... 
                      </div>'
            );
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Daftar Semua Pasien';

        if ($this->session->userdata('level') == 'Dokter') {
            $this->load->view('templateDokter/header', $data);
            $this->load->view('templateDokter/navbar');
            $this->load->view('templateDokter/sidebar');
            $this->load->view('daftarPasien/daftarPasienAjax', $data);
            $this->load->view('templateDokter/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('daftarPasien/daftarPasien', $data);
            $this->load->view('templates/footer');
        }
    }

    public function tampilPasien()
    {
        $data = $this->Model_daftarPasienAjax->getAllPasien();
        echo json_encode($data);
    }

    public function inputPasien()
    {
        $nama_pasien = $this->input->post('nama_pasien', true);
        $alamat_pasien = $this->input->post('alamat_pasien', true);
        $telepon_pasien = $this->input->post('telepon_pasien', true);
        $jenkel_pasien = $this->input->post('jenkel_pasien', true);
        $no_ktp = $this->input->post('no_ktp', true);
        $tgl_lahir = $this->input->post('tgl_lahir', true);
        $bpjs = $this->input->post('bpjs', true);
        $keterangan = $this->input->post('keterangan', true);

        // cek apakah no_ktp dan nama sudah digunakan sebelumnya
        $cek_data = $this->Model_daftarPasienAjax->cekDuplikatData($no_ktp);
        $cek_nama = $this->Model_daftarPasienAjax->cekNamaPasien($nama_pasien);
        if ($cek_data > 0) {
            $result['pesan'] = "No KTP tidak boleh sama";
        } elseif ($nama_pasien == '') {
            $result['pesan'] = "Nama Pasien harus di isi";
        } elseif ($cek_nama > 0) {
            $result['pesan'] = "Nama Pasien sudah terdaftar";
        } elseif ($alamat_pasien == '') {
            $result['pesan'] = "Alamat Pasien harus di isi";
        } elseif ($telepon_pasien == '') {
            $result['pesan'] = "Telepon Pasien harus di isi";
        } elseif ($jenkel_pasien == '') {
            $result['pesan'] = "Jenis Kelamin Pasien harus di isi";
        } elseif ($no_ktp == '') {
            $result['pesan'] = "No KTP Pasien harus di isi";
        } elseif ($tgl_lahir == '') {
            $result['pesan'] = "Tanggal Lahir Pasien harus di isi";
        } else {
            $result['pesan'] = "";
            $data = array(
                'nama_pasien' => $nama_pasien,
                'alamat_pasien' => $alamat_pasien,
                'telepon_pasien' => $telepon_pasien,
                'jenkel_pasien' => $jenkel_pasien,
                'no_ktp' => $no_ktp,
                'tgl_lahir' => $tgl_lahir,
                'bpjs' => $bpjs,
                'keterangan' => $keterangan
            );
            $this->Model_daftarPasienAjax->tambahData($data);
        }
        echo json_encode($result);
    }

    // public function inputPasien()
    // {
    //     $nama_pasien = $this->input->post('nama_pasien', true);
    //     $alamat_pasien = $this->input->post('alamat_pasien', true);
    //     $telepon_pasien = $this->input->post('telepon_pasien', true);
    //     $jenkel_pasien = $this->input->post('jenkel_pasien', true);
    //     $no_ktp = $this->input->post('no_ktp', true);
    //     $tgl_lahir = $this->input->post('tgl_lahir', true);
    //     $bpjs = $this->input->post('bpjs', true);
    //     $keterangan = $this->input->post('keterangan', true);

    //     if ($nama_pasien == '') {
    //         $result['pesan'] = "Nama Pasien harus di isi";
    //     } elseif ($alamat_pasien == '') {
    //         $result['pesan'] = "Alamat Pasien harus di isi";
    //     } elseif ($telepon_pasien == '') {
    //         $result['pesan'] = "Telepon Pasien harus di isi";
    //     } elseif ($jenkel_pasien == '') {
    //         $result['pesan'] = "Jenis Kelamin Pasien harus di isi";
    //     } elseif ($no_ktp == '') {
    //         $result['pesan'] = "No KTP Pasien harus di isi";
    //     } elseif ($tgl_lahir == '') {
    //         $result['pesan'] = "Tanggal Lahir Pasien harus di isi";
    //     } else {
    //         $result['pesan'] = "";
    //         $data = array(
    //             'nama_pasien' => $nama_pasien,
    //             'alamat_pasien' => $alamat_pasien,
    //             'telepon_pasien' => $telepon_pasien,
    //             'jenkel_pasien' => $jenkel_pasien,
    //             'no_ktp' => $no_ktp,
    //             'tgl_lahir' => $tgl_lahir,
    //             'bpjs' => $bpjs,
    //             'keterangan' => $keterangan
    //         );
    //         $this->Model_daftarPasienAjax->tambahData($data);
    //     }
    //     echo json_encode($result);
    // }

    // public function inputPasien()
    // {
    //     $nama_pasien = $this->input->post('nama_pasien', true);
    //     $alamat_pasien = $this->input->post('alamat_pasien', true);
    //     $telepon_pasien = $this->input->post('telepon_pasien', true);
    //     $jenkel_pasien = $this->input->post('jenkel_pasien', true);
    //     $no_ktp = $this->input->post('no_ktp', true);
    //     $tgl_lahir = $this->input->post('tgl_lahir', true);
    //     $bpjs = $this->input->post('bpjs', true);
    //     $keterangan = $this->input->post('keterangan', true);

    //     if ($nama_pasien == '') {
    //         $result['pesan'] = "Nama Pasien harus di isi";
    //     } elseif ($alamat_pasien == '') {
    //         $result['pesan'] = "Alamat Pasien harus di isi";
    //     } elseif ($telepon_pasien == '') {
    //         $result['pesan'] = "Telepon Pasien harus di isi";
    //     } elseif ($jenkel_pasien == '') {
    //         $result['pesan'] = "Jenis Kelamin Pasien harus di isi";
    //     } elseif ($no_ktp == '') {
    //         $result['pesan'] = "No KTP Pasien harus di isi";
    //     } elseif ($tgl_lahir == '') {
    //         $result['pesan'] = "Tanggal Lahir Pasien harus di isi";
    //     } else {
    //         // Cek apakah ada nama pasien yang sama
    //         $cek_nama_pasien = $this->Model_daftarPasienAjax->cekNamaPasien($nama_pasien);
    //         if ($cek_nama_pasien > 0) {
    //             $result['pesan'] = "Nama Pasien sudah terdaftar";
    //         } else {
    //             $result['pesan'] = "";
    //             $data = array(
    //                 'nama_pasien' => $nama_pasien,
    //                 'alamat_pasien' => $alamat_pasien,
    //                 'telepon_pasien' => $telepon_pasien,
    //                 'jenkel_pasien' => $jenkel_pasien,
    //                 'no_ktp' => $no_ktp,
    //                 'tgl_lahir' => $tgl_lahir,
    //                 'bpjs' => $bpjs,
    //                 'keterangan' => $keterangan
    //             );
    //             $this->Model_daftarPasienAjax->tambahData($data);
    //         }
    //     }
    //     echo json_encode($result);
    // }

    // public function inputPasien()
    // {
    //     $data = $this->Model_daftarPasienAjax->tambahData();
    //     echo json_encode($data);
    // }

    function ambilIdPasien()
    {
        $id = $this->input->post('id_pasien');
        $where = array('id_pasien' => $id);
        $dataPasien = $this->Model_daftarPasienAjax->getIdPasien('data_pasien', $where)->result();
        echo json_encode($dataPasien);
    }

    public function updatePasien()
    {
        $id_pasien = $this->input->post('id_pasien', true);
        $nama_pasien = $this->input->post('nama_pasien', true);
        $alamat_pasien = $this->input->post('alamat_pasien', true);
        $telepon_pasien = $this->input->post('telepon_pasien', true);
        $jenkel_pasien = $this->input->post('jenkel_pasien', true);
        $no_ktp = $this->input->post('no_ktp', true);
        $tgl_lahir = $this->input->post('tgl_lahir', true);
        $bpjs = $this->input->post('bpjs', true);
        $keterangan = $this->input->post('keterangan', true);

        // cek apakah no_ktp dan nama sudah digunakan sebelumnya

        if ($nama_pasien == '') {
            $result['pesan'] = "Nama Pasien harus di isi";
        } elseif ($alamat_pasien == '') {
            $result['pesan'] = "Alamat Pasien harus di isi";
        } elseif ($telepon_pasien == '') {
            $result['pesan'] = "Telepon Pasien harus di isi";
        } elseif ($jenkel_pasien == '') {
            $result['pesan'] = "Jenis Kelamin Pasien harus di isi";
        } elseif ($no_ktp == '') {
            $result['pesan'] = "No KTP Pasien harus di isi";
        } elseif ($tgl_lahir == '') {
            $result['pesan'] = "Tanggal Lahir Pasien harus di isi";
        } else {
            $result['pesan'] = "";
            $where = array('id_pasien' => $id_pasien);
            $data = array(
                'nama_pasien' => $nama_pasien,
                'alamat_pasien' => $alamat_pasien,
                'telepon_pasien' => $telepon_pasien,
                'jenkel_pasien' => $jenkel_pasien,
                'no_ktp' => $no_ktp,
                'tgl_lahir' => $tgl_lahir,
                'bpjs' => $bpjs,
                'keterangan' => $keterangan
            );
            $this->Model_daftarPasienAjax->updateData($where, $data, 'data_pasien');
        }
        echo json_encode($result);
    }

    public function hapusPasien()
    {
        $id = $this->input->post('id_pasien');
        $where = array('id_pasien' => $id);
        $this->Model_daftarPasienAjax->hapusData($where, 'data_pasien');
        // $this->session->set_flashdata(
        //     'info',
        //     '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //             <strong>Sukses,</strong> Data Pasien berhasil di Hapus
        //             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        //             </button>
        //           </div>'
        // );
    }

    public function detailPasien()
    {
        $data['title'] = 'Riwayat Kunjungan Pasien';
        $id = $this->input->post('id_pasien');
        $where = array('id_pasien' => $id);
        $dataPasienDetail = $this->Model_daftarPasienAjax->getPasienDetail('data_pasien', $where)->result();
        // $dataAllPasien = $this->Model_daftarPasien->getDetailPasien();

        echo json_encode($dataPasienDetail);
        // echo json_encode($dataAllPasien);

        // if ($this->session->userdata('level') == 'Dokter') {
        //     $this->load->view('templateDokter/header', $data);
        //     $this->load->view('templateDokter/navbar');
        //     $this->load->view('templateDokter/sidebar');
        //     $this->load->view('daftarPasien/daftarPasienDetailAjax', $data);
        //     $this->load->view('templateDokter/footer');
        // } else {
        //     $this->load->view('templates/header', $data);
        //     $this->load->view('templates/navbar');
        //     $this->load->view('templates/sidebar');
        //     $this->load->view('daftarPasien/daftarPasienDetailAjax', $data);
        //     $this->load->view('templates/footer');
        // }
    }
}
