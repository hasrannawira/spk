<?php
    
    /**
     * 
     */

class KCA extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->check_login();
        if ($this->session->userdata('id_role') != "1") {
            redirect('', 'refresh');
        }
    }

    public function index(){

        $data = konfigurasi('Dashboard');
        $data['buku'] = $this->m_kca->tampil_data_buku()->result();
        $this->template->load('layouts/template', 'admin/master_kca_buku', $data);
    }

    public function tambah_buku(){
        $this->form_validation->set_rules('master_kecamatan','Master Kecamatan', 'trim|required');
        $this->form_validation->set_rules('tahun','Tahun', 'trim|required');
        $master_kecamatan = $this->input->post('master_kecamatan');
        $tahun = $this->input->post('tahun');
        $nama_buku = $master_kecamatan.' Dalam Angka '.$tahun;
        if($this->form_validation->run() == TRUE){
            $data = array(
                'nama_buku'         =>  $nama_buku,
                'kecamatan'         =>  $master_kecamatan,
                'tahun'             =>  $tahun

            );            
        $this->m_kca->input_data_buku($data);
        $aktivitas = array(
                'username'          =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Menambahkan Buku '.$nama_buku,
        );
        $this->session->set_flashdata('flash','Data Buku Berhasil Ditambahkan');
        $this->m_aktivitas->input_data($aktivitas);
            redirect('admin/KCA');
        } else{
            redirect('admin/KCA');            
        }
    }

    //hanya admin
    public function hapus_buku($id_buku){
        $where = array ('id_buku' => $id_buku);
        $this->m_kca->hapus_data($where);
        redirect ('admin/KCA');
    }

    public function master_tabel(){

        $data = konfigurasi('Dashboard');
        $data['tabel'] = $this->m_kca->tampil_master_tabel()->result();
        $this->template->load('layouts/template', 'admin/master_tabel', $data);
    }
    public function tambah_tabel(){
        $this->form_validation->set_rules('kode_tabel','Kode Tabel', 'trim|required');
        $this->form_validation->set_rules('nama_tabel','Nama Tabel', 'trim|required');
        $this->form_validation->set_rules('jenis_tabel','Jenis Tabel', 'trim|required');
        $this->form_validation->set_rules('judul_baris','Judul Baris', 'trim|required');
        $this->form_validation->set_rules('karakteristik','Karakteristik', 'trim|required');
        $kode_tabel = $this->input->post('kode_tabel');
        $nama_tabel = $this->input->post('nama_tabel');
        $jenis_tabel = $this->input->post('jenis_tabel');
        $judul_baris= $this->input->post('judul_baris');
        $karakteristik= $this->input->post('karakteristik');
        $sumber_data= $this->input->post('sumber_data');
        $keterangan= $this->input->post('keterangan');

        if($this->form_validation->run() == TRUE){
            $data = array(
                'kode_tabel'         =>  $kode_tabel,
                'nama_tabel'         =>  $nama_tabel,
                'jenis_tabel'         =>  $jenis_tabel,
                'judul_baris'         =>  $judul_baris,
                'karakteristik'         =>  $karakteristik,
                'sumber_data'         =>  $sumber_data,
                'keterangan'             =>  $keterangan

            );            
        $this->m_kca->input_data_tabel($data);
        $aktivitas = array(
                'username'          =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Menambahkan Tabel '.$kode_tabel,
        );
        $this->session->set_flashdata('flash','Data Tabel Berhasil Ditambahkan');
        $this->m_aktivitas->input_data($aktivitas);
            redirect('admin/KCA/master_tabel');
        } else{
            redirect('admin/KCA/master_tabel');            
        }
    }

    //hanya admin
    public function hapus_tabel($id_tabel){
        $where = array ('id_tabel' => $id_tabel);
        $this->m_kca->hapus_tabel($where);
        redirect ('admin/KCA/master_tabel');
    }

    public function edit_tabel($id_tabel){
        $data = konfigurasi('Dashboard');
        $where = array ('id_tabel' => $id_tabel);
        $data['tabel'] = $this->m_kca->edit_tabel($where)->result();
        $this->template->load('layouts/template', 'admin/edit_tabel_kca', $data);        
    }

    public function update_tabel(){
        $id_tabel = $this->input->post('id_tabel');
        $kode_tabel = $this->input->post('kode_tabel');

        $this->form_validation->set_rules('kode_tabel','Kode Tabel', 'trim|required');
        $this->form_validation->set_rules('judul_baris','Judul Baris', 'trim|required');
        $this->form_validation->set_rules('karakteristik','Karakteristik', 'trim|required');
        $this->form_validation->set_rules('sumber_data','Sumber Data', 'trim|required');
        $this->form_validation->set_rules('keterangan','Keterangan', 'trim|required');

        if($this->form_validation->run() == TRUE){

        $data = array(
                'kode_tabel' =>  $kode_tabel,
                'nama_tabel' =>  $this->input->post('nama_tabel'),
                'jenis_tabel' =>  $this->input->post('jenis_tabel'),
                'judul_baris' =>  $this->input->post('judul_baris'),
                'karakteristik' =>  $this->input->post('karakteristik'),
                'sumber_data' =>  $this->input->post('sumber_data'),
                'keterangan' =>  $this->input->post('keterangan')

        );

        $where = array(
            'id_tabel' => $id_tabel
        );

        $this->m_kca->update_tabel($where,$data);
        $aktivitas = array(
                'username'           =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Mengupdate Tabel'.$kode_tabel,
        );
        $this->session->set_flashdata('flash','Mengupdate Tabel Berhasil');
        $this->m_aktivitas->input_data($aktivitas);
        redirect('admin/KCA/master_tabel');
        } else{
        $data = konfigurasi('Dashboard');
        $where = array ('id_tabel' => $id_tabel);
        $data['tabel'] = $this->m_kca->edit_tabel($where)->result();
        $this->template->load('layouts/template', 'admin/edit_tabel_kca', $data);             
        }
    }

    public function master_judul_baris(){

        $data = konfigurasi('Dashboard');
        $data['judul_baris'] = $this->m_kca->tampil_judul_baris()->result();
        $this->template->load('layouts/template', 'admin/master_judul_baris', $data);
    }

    //hanya admin
    public function hapus_judul_baris($id_nama_judul_baris){
        $where = array ('id_nama_judul_baris' => $id_nama_judul_baris);
        $this->m_kca->hapus_judul_baris($where);
        redirect ('admin/KCA/master_judul_baris');
    }

    public function edit_judul_baris($id_nama_judul_baris){
        $data = konfigurasi('Dashboard');
        $where = array ('id_nama_judul_baris' => $id_nama_judul_baris);
        $data['judul_baris'] = $this->m_kca->edit_judul_baris($where)->result();
        $this->template->load('layouts/template', 'admin/edit_judul_baris', $data);        
    }
    
    public function master_karakteristik(){

        $data = konfigurasi('Dashboard');
        $data['karakteristik'] = $this->m_kca->tampil_karakteristik()->result();
        $this->template->load('layouts/template', 'admin/master_karakteristik', $data);
    }

    //hanya admin
    public function hapus_karakteristik($id_nama_karakteristik){
        $where = array ('id_nama_karakteristik' => $id_nama_karakteristik);
        $this->m_kca->hapus_karakteristik($where);
        redirect ('admin/KCA/master_karakteristik');
    }

    public function edit_karakteristik($id_nama_karakteristik){
        $data = konfigurasi('Dashboard');
        $where = array ('id_nama_karakteristik' => $id_nama_karakteristik);
        $data['karakteristik'] = $this->m_kca->edit_karakteristik($where)->result();
        $this->template->load('layouts/template', 'admin/edit_karakteristik', $data);        
    }

    public function input_tabel(){

        $data = konfigurasi('Dashboard');
        $data['tabel'] = $this->m_kca->tampil_data_isi()->result();
        $this->template->load('layouts/template', 'admin/input_tabel', $data);
    }

    public function manajemen(){

        $data = konfigurasi('Dashboard');
        $data['buku'] = $this->m_kca->tampil_data_buku()->result();
        $this->template->load('layouts/template', 'admin/master_kca', $data);
    }
}

?>