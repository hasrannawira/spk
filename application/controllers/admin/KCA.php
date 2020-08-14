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
        $where = array ('id_role' => "2");        
        $data['user'] = $this->m_user->tampil_member($where)->result();
        $data['kec'] = $this->m_kca->tampil_kec()->result();
        $data['buku'] = $this->m_kca->tampil_data_buku()->result();
        $this->template->load('layouts/template', 'admin/master_kca_buku', $data);
    }

    public function tambah_buku(){
        $this->form_validation->set_rules('id_kecamatan','Master Kecamatan', 'trim|required');
        $this->form_validation->set_rules('tahun','Tahun', 'trim|required');
        $kecamatan = $this->input->post('id_kecamatan');
        $id_kec = substr($kecamatan,0,7);
        $nama_kec = substr($kecamatan, 7);
        $tahun = $this->input->post('tahun');
        $id_user = $this->input->post('id_user');
        //$nama_buku = 'Kecamatan '.$nama_kec.' Dalam Angka '.$tahun;
        $nama_buku = 'Distrik '.$nama_kec.' Dalam Angka '.$tahun;
        if($this->form_validation->run() == TRUE){
            $data = array(
                'nama_buku'         =>  $nama_buku,
                'id_kec'            =>  $id_kec,
                'tahun'             =>  $tahun,
                'id_user'           =>  $id_user

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
        $this->m_kca->hapus_data_buku($where);
        redirect ('admin/KCA');
    }

    public function master_tabel(){

        $data = konfigurasi('Dashboard');
        $data['kec'] = $this->m_kca->tampil_kec()->result();
        $this->template->load('layouts/template', 'admin/master_tabel', $data);
    }
    public function master_tabel_isi($isi){
        $where = array ('id_kec' =>$isi);
        $data['tabel'] = $this->m_kca->edit_tabel($where)->result();
        $this->load->view('admin/master_tabel_isi', $data);
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
        $data['nama_judul_baris'] = $this->m_kca->tampil_judul_baris()->result();
        $data['nama_karakteristik'] = $this->m_kca->tampil_karakteristik()->result();
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

    public function tambah_judul_baris(){

        $data = konfigurasi('Dashboard');
        $this->form_validation->set_rules('jBaris','Jumlah Baris', 'trim|required|is_natural');
        if($this->form_validation->run() == TRUE){
            $data['nama_judul_baris'] = $this->input->post('nama_judul_baris');
            $data['jBaris'] = $this->input->post('jBaris');
            $this->template->load('layouts/template', 'admin/tambah_judul_baris', $data);
        } else{
        redirect ('admin/KCA/master_judul_baris');
        }
    }

    public function insert_judul_baris(){

        $data = konfigurasi('Dashboard');
        $nama_judul_baris= $this->input->post('nama_judul_baris');
        $data = array(
            'nama_judul_baris'           =>  $nama_judul_baris
                );
        $this->m_kca->tambah_nama_judul_baris($data); 
        $where = array ('nama_judul_baris' => $nama_judul_baris);
        $data2 = $this->m_kca->tampil_nama_judul_baris($where)->result();
        $id_nama_judul_baris = $data2[0]->id_nama_judul_baris;
        $jBaris= $this->input->post('jBaris');
        for ($i=1; $i < $jBaris+1; $i++) { 
            $baris = $this->input->post($i);
            $data = array(
                'id_nama_judul_baris'           =>  $id_nama_judul_baris,
                'no'                            =>  $i,
                'nama_baris'                    =>  $baris
                    );
            $this->m_kca->tambah_judul_baris($data); 
        }
        redirect ('admin/KCA/master_judul_baris');
    }
    //hanya admin
    public function hapus_judul_baris($id_nama_judul_baris){
        $where = array ('id_nama_judul_baris' => $id_nama_judul_baris);
        $this->m_kca->hapus_judul_baris($where);
        redirect ('admin/KCA/master_judul_baris');
    }

    public function edit_judul_baris($id_nama_judul_baris){
        // $id_surat = $this->uri->segment(4);
        // $nama_judul_baris= $this->uri->segment(5);
        $data = konfigurasi('Dashboard');
        $where = array ('id_nama_judul_baris' => $id_nama_judul_baris);
        $data['nama_judul_baris'] = $this->m_kca->tampil_nama_judul_baris($where)->result();
        $data['judul_baris'] = $this->m_kca->edit_judul_baris($where)->result();
        $this->template->load('layouts/template', 'admin/edit_judul_baris', $data);        
    }
    
    public function master_karakteristik(){

        $data = konfigurasi('Dashboard');
        $data['karakteristik'] = $this->m_kca->tampil_karakteristik()->result();
        $this->template->load('layouts/template', 'admin/master_karakteristik', $data);
    }

    public function tambah_karakteristik(){

        $data = konfigurasi('Dashboard');
        $this->form_validation->set_rules('jKarakteristik','Jumlah Karakteristik', 'trim|required|is_natural');
        if($this->form_validation->run() == TRUE){
            $data['nama_karakteristik'] = $this->input->post('nama_karakteristik');
            $data['jKarakteristik'] = $this->input->post('jKarakteristik');
            $this->template->load('layouts/template', 'admin/tambah_karakteristik', $data);
        } else{
        redirect ('admin/KCA/master_karakteristik');
        }
    }

    public function insert_karakteristik(){

        $data = konfigurasi('Dashboard');
        $nama_karakteristik= $this->input->post('nama_karakteristik');
        $data = array(
            'nama_karakteristik'           =>  $nama_karakteristik
                );
        $this->m_kca->tambah_nama_karakteristik($data); 
        $where = array ('nama_karakteristik' => $nama_karakteristik);
        $data2 = $this->m_kca->tampil_nama_karakteristik($where)->result();
        $id_nama_karakteristik = $data2[0]->id_nama_karakteristik;
        $jKarakteristik= $this->input->post('jKarakteristik');
        for ($i=1; $i < $jKarakteristik+1; $i++) { 
            $karakteristik = $this->input->post($i);
            $data = array(
                'id_nama_karakteristik'           =>  $id_nama_karakteristik,
                'no'                            =>  $i,
                'nama_karakteristik'                    =>  $karakteristik
                    );
            $this->m_kca->tambah_karakteristik($data); 
        }
        redirect ('admin/KCA/master_karakteristik');
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
        $data['nama_karakteristik'] = $this->m_kca->tampil_nama_karakteristik($where)->result();
        $data['karakteristik'] = $this->m_kca->edit_karakteristik($where)->result();
        $this->template->load('layouts/template', 'admin/edit_karakteristik', $data);        
    }

    public function input_tabel(){

        $data = konfigurasi('Dashboard');
        $data['buku'] = $this->m_kca->tampil_data_buku()->result();
        $this->template->load('layouts/template', 'admin/input_tabel', $data);
    }

    public function input_tabel_isi($isi){

        $data = konfigurasi('Dashboard');
        $where = array ('id_buku' => $isi);
        $a = $this->m_kca->edit_data_buku($where)->result();
        $where2 = array ('id_kec' =>$a[0]->id_kec);
        $data['tabel'] = $this->m_kca->edit_tabel($where2)->result();
        $this->load->view('admin/input_tabel_isi', $data);
    }


    //hanya admin
    public function hapus_data_tabel($id_tabel){
        $where = array ('id_tabel' => $id_tabel);
        $this->m_kca->hapus_data_isi($where);
        redirect ('admin/KCA/input_tabel');
    }

    public function input_data_tabel(){
        $id_tabel = $this->uri->segment(4);
        $id_buku = $this->uri->segment(5);
        $where = array ('id_tabel' => $id_tabel, 'id_buku'=>$id_buku);
        $data = konfigurasi('Dashboard');
        $data['buku'] = $id_buku;
        $data['isi'] = $this->m_kca->tampil_data_isi($where)->result();
        if (empty($data['isi']) ){
            $where = array ('id_tabel' => $id_tabel);
            $data['tabel'] = $this->m_kca->edit_tabel($where)->result();
            foreach ($data['tabel'] as $tbl) {
            $where2 = array ('id_nama_judul_baris' => $tbl->id_nama_judul_baris);
            $where3 = array ('id_nama_karakteristik' => $tbl->id_nama_karakteristik);
            }
            $data['judul_baris'] = $this->m_kca->edit_judul_baris($where2)->result();
            $data['karakteristik'] = $this->m_kca->edit_karakteristik($where3)->result();
            $this->template->load('layouts/template', 'admin/input_data_tabel', $data);
        } else{
            $where = array ('id_tabel' => $id_tabel);
            $data['tabel'] = $this->m_kca->edit_tabel($where)->result();
            foreach ($data['tabel'] as $tbl) {
            $where2 = array ('id_nama_judul_baris' => $tbl->id_nama_judul_baris);
            $where3 = array ('id_nama_karakteristik' => $tbl->id_nama_karakteristik);
            }
            $data['judul_baris'] = $this->m_kca->edit_judul_baris($where2)->result();
            $data['karakteristik'] = $this->m_kca->edit_karakteristik($where3)->result();
            $this->template->load('layouts/template', 'admin/edit_data_tabel', $data);
        }
    }

    public function tambah_data_isi(){
        // $this->form_validation->set_rules('jbaris','jbaris', 'trim|required');
        // $this->form_validation->set_rules('jkolom','jkolom', 'trim|required');
        $id_tabel = $this->input->post('id_tabel');
        $id_buku = $this->input->post('id_buku');
        $jbaris = $this->input->post('jbaris');
        $jkolom = $this->input->post('jkolom');
        for ($baris=1; $baris < $jbaris+1 ; $baris++) { 
            for ($kolom=1; $kolom < $jkolom+1; $kolom++) { 

                    $data = array(
                        'id_tabel'         =>  $id_tabel,
                        'id_buku'         =>  $id_buku,
                        'baris'         =>  $baris,
                        'kolom'             =>  $kolom,
                        'data'             =>  $this->input->post('b'.$baris.'k'.$kolom)

                    );            
                $this->m_kca->input_data_isi($data);
                
            }
        }
            for ($kolom=1; $kolom < $jkolom+1; $kolom++) { 

                    $data = array(
                        'id_tabel'         =>  $id_tabel,
                        'id_buku'         =>  $id_buku,
                        'baris'         =>  '99',
                        'kolom'             =>  $kolom,
                        'data'             =>  $this->input->post('b99k'.$kolom)

                    );            
                $this->m_kca->input_data_isi($data);
                
            }
        redirect ('admin/KCA/input_tabel');

    }

    public function update_data_isi(){
        // $this->form_validation->set_rules('jbaris','jbaris', 'trim|required');
        // $this->form_validation->set_rules('jkolom','jkolom', 'trim|required');
        $id_buku = $this->input->post('id_buku');
        $id_tabel = $this->input->post('id_tabel');
        $jbaris = $this->input->post('jbaris');
        $jkolom = $this->input->post('jkolom');
        for ($baris=1; $baris < $jbaris+1 ; $baris++) { 
            for ($kolom=1; $kolom < $jkolom+1; $kolom++) { 
                    $where = array(
                        'id_buku' => $id_buku,
                        'id_tabel' => $id_tabel,
                        'baris'         =>  $baris,
                        'kolom'             =>  $kolom
                    );
                    $data = array(
                        'data'             =>  $this->input->post('b'.$baris.'k'.$kolom)
                    );            
                $this->m_kca->update_data_isi($where,$data);
                
            }
        }
            for ($kolom=1; $kolom < $jkolom+1; $kolom++) { 
                    $where = array(
                        'id_buku' => $id_buku,
                        'id_tabel' => $id_tabel,
                        'baris'         =>  '99',
                        'kolom'             =>  $kolom
                    );
                    $data = array(
                        'data'             =>  $this->input->post('b99k'.$kolom)
                    );            
                $this->m_kca->update_data_isi($where,$data);
                
            }
        redirect ('admin/KCA/input_tabel');

    }


    public function manajemen(){
        $data = konfigurasi('Dashboard');
        $data['buku'] = $this->m_kca->tampil_data_buku()->result();
        $this->template->load('layouts/template', 'admin/master_kca_buku', $data);
    }
}

?>