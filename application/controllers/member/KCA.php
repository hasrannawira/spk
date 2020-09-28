<?php
    
    /**
     * 
     */

class KCA extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->check_login();
        if ($this->session->userdata('id_role') != "2" ) {
            redirect('', 'refresh');
        }
    }

    public function index(){

        if ($this->session->userdata('id_satker') != "6" ) {

        $data = konfigurasi('Dashboard');
        $id_user = $this->session->userdata('id');
        $where = array ('id_user' => $id_user);
        $data['buku'] = $this->m_kca->edit_data_buku($where)->result();
        $where2 = array ('id_instansi' => $this->session->userdata('id_instansi'));
        $data['kec'] = $this->m_kca->edit_kec($where2)->result();
        $this->template->load('layouts/member/template', 'member/master_kca_buku', $data);

        } else{

        $data = konfigurasi('Dashboard');
        $where = array ('id_role' => "2");        
        $data['user'] = $this->m_user->tampil_member($where)->result();
        $where2 = array ('id_instansi' => $this->session->userdata('id_instansi'));
        $data['kec'] = $this->m_kca->edit_kec($where2)->result();
        $data['buku'] = $this->m_kca->edit_data_buku($where2)->result();
        $this->template->load('layouts/member/template', 'member/master_kca_buku', $data);
        }
    }

    public function tambah_buku(){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
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
                'id_instansi'            =>  $this->session->userdata('id_instansi'),
                'id_user'           =>  $id_user

            );            
        $this->m_kca->input_data_buku($data);
        $aktivitas = array(
                'username'          =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Menambahkan Buku '.$nama_buku,
        );
        $this->session->set_flashdata('flash','Data Buku Berhasil Ditambahkan');
        $this->m_aktivitas->input_data($aktivitas);
            redirect('member/KCA');
        } else{
            redirect('member/KCA');            
        }
    }

    //hanya admin
    public function hapus_buku($id_buku){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $where = array ('id_buku' => $id_buku);
        $this->m_kca->hapus_data_buku($where);
        redirect ('member/KCA');
    }

    public function master_tabel(){

        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $data = konfigurasi('Dashboard');
        $data['nama_judul_baris'] = $this->m_kca->tampil_judul_baris()->result();
        $data['nama_karakteristik'] = $this->m_kca->tampil_karakteristik()->result();
        $where2 = array ('id_instansi' => $this->session->userdata('id_instansi'));
        $data['kec'] = $this->m_kca->edit_kec($where2)->result();
        $this->template->load('layouts/member/template', 'member/master_tabel', $data);
    }

    public function master_tabel_isi($isi){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $where = array ('id_kec' =>$isi);
        $data['tabel'] = $this->m_kca->edit_tabel($where)->result();
        $this->load->view('member/master_tabel_isi', $data);
    }
        
    public function tambah_tabel(){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $this->form_validation->set_rules('id_kec','Kecamatan', 'trim|required');
        $this->form_validation->set_rules('kode_tabel','Kode Tabel', 'trim|required');
        $this->form_validation->set_rules('nama_tabel','Nama Tabel', 'trim|required');
        $this->form_validation->set_rules('jenis_tabel','Jenis Tabel', 'trim|required');
        $this->form_validation->set_rules('type_endrow','Tipe Baris Akhir', 'trim|required');
        // $this->form_validation->set_rules('id_nama_judul_bariss','Judul Baris', 'trim|required');
        // $this->form_validation->set_rules('id_nama_karakteristik','Karakteristik', 'trim|required');


        if($this->form_validation->run() == TRUE){
            $data = array(
                'id_kec'         =>  $this->input->post('id_kec'),
                'kode_tabel'         =>  $this->input->post('kode_tabel'),
                'nama_tabel'         =>  $this->input->post('nama_tabel'),
                'jenis_tabel'         =>  $this->input->post('jenis_tabel'),
                'id_nama_judul_baris'         =>  $this->input->post('id_nama_judul_baris'),
                'type_endrow'         =>  $this->input->post('type_endrow'),
                'id_nama_karakteristik'         =>  $this->input->post('id_nama_karakteristik'),
                'sumber_data'         =>  $this->input->post('sumber_data'),
                'keterangan'             =>  $this->input->post('keterangan')

            );            
        $this->m_kca->input_data_tabel($data);
        $aktivitas = array(
                'username'          =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Menambahkan Tabel '.$kode_tabel,
        );
        $this->session->set_flashdata('flash','Tabel Berhasil Ditambahkan');
        $this->m_aktivitas->input_data($aktivitas);
            redirect('member/KCA/master_tabel');
        } else{
            redirect('member/KCA/master_tabel');            
        }
    }

    //hanya admin
    public function hapus_tabel($id_tabel){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $where = array ('id_tabel' => $id_tabel);
        $data['isi'] = $this->m_kca->tampil_data_isi($where)->result();
        if (empty($data['isi'])) {
            $this->m_kca->hapus_tabel($where);
            redirect ('member/KCA/master_tabel');
        } else{
            print_r('Pastikan Data tidak ada di Tabel');
        }
    }

    public function edit_tabel($id_tabel){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $data = konfigurasi('Dashboard');
        $where = array ('id_tabel' => $id_tabel);
        $data['nama_judul_baris'] = $this->m_kca->tampil_judul_baris()->result();
        $data['nama_karakteristik'] = $this->m_kca->tampil_karakteristik()->result();
        $data['tabel'] = $this->m_kca->edit_tabel($where)->result();
        $this->template->load('layouts/member/template', 'member/edit_tabel_kca', $data);        
    }

    public function update_tabel(){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $id_tabel = $this->input->post('id_tabel');
        $kode_tabel = $this->input->post('kode_tabel');

        $this->form_validation->set_rules('kode_tabel','Kode Tabel', 'trim|required');
        // $this->form_validation->set_rules('judul_baris','Judul Baris', 'trim|required');
        // $this->form_validation->set_rules('karakteristik','Karakteristik', 'trim|required');

        if($this->form_validation->run() == TRUE){

        $data = array(
                'kode_tabel' =>  $kode_tabel,
                'nama_tabel' =>  $this->input->post('nama_tabel'),
                'jenis_tabel' =>  $this->input->post('jenis_tabel'),
                'type_endrow' =>  $this->input->post('type_endrow'),
                'id_nama_judul_baris' =>  $this->input->post('id_nama_judul_baris'),
                'id_nama_karakteristik' =>  $this->input->post('id_nama_karakteristik'),
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
        redirect('member/KCA/master_tabel');
        } else{
        $data = konfigurasi('Dashboard');
        $where = array ('id_tabel' => $id_tabel);
        $data['tabel'] = $this->m_kca->edit_tabel($where)->result();
        $this->template->load('layouts/member/template', 'member/edit_tabel_kca', $data);             
        }
    }

    public function master_judul_baris(){

        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $data = konfigurasi('Dashboard');
        $data['judul_baris'] = $this->m_kca->tampil_judul_baris()->result();
        $this->template->load('layouts/member/template', 'member/master_judul_baris', $data);
    }

    public function tambah_judul_baris(){

        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $data = konfigurasi('Dashboard');
        $this->form_validation->set_rules('jBaris','Jumlah Baris', 'trim|required|is_natural');
        if($this->form_validation->run() == TRUE){
            $data['nama_judul_baris'] = $this->input->post('nama_judul_baris');
            $data['jBaris'] = $this->input->post('jBaris');
            $this->template->load('layouts/member/template', 'member/tambah_judul_baris', $data);
        } else{
        redirect ('member/KCA/master_judul_baris');
        }
    }

    public function insert_judul_baris(){

        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
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
        $this->session->set_flashdata('flash','Menambahkan Judul Baris Berhasil');
        redirect ('member/KCA/master_judul_baris');
    }
    //hanya admin
    public function hapus_judul_baris($id_nama_judul_baris){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $where = array ('id_nama_judul_baris' => $id_nama_judul_baris);
        $this->m_kca->hapus_judul_baris($where);
        redirect ('member/KCA/master_judul_baris');
    }

    public function edit_judul_baris($id_nama_judul_baris){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $data = konfigurasi('Dashboard');
        $where = array ('id_nama_judul_baris' => $id_nama_judul_baris);
        $data['nama_judul_baris'] = $this->m_kca->tampil_nama_judul_baris($where)->result();
        $data['judul_baris'] = $this->m_kca->edit_judul_baris($where)->result();
        $this->template->load('layouts/member/template', 'member/edit_judul_baris', $data);        
    }
    
    public function update_judul_baris(){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $id_nama_judul_baris = $this->input->post('id_nama_judul_baris');
        $nama_judul_baris = $this->input->post('nama_judul_baris');
        $jBaris = $this->input->post('jBaris');

        $this->form_validation->set_rules('nama_judul_baris','Nama Judul Baris', 'trim|required');
        // $this->form_validation->set_rules('judul_baris','Judul Baris', 'trim|required');
        // $this->form_validation->set_rules('karakteristik','Karakteristik', 'trim|required');

        if($this->form_validation->run() == TRUE){

            $data = array(
                    'nama_judul_baris' =>  $nama_judul_baris
            );
            $where = array(
                'id_nama_judul_baris' => $id_nama_judul_baris
            );
            $this->m_kca->update_nama_judul_baris($where,$data);
            for ($baris=1; $baris < $jBaris+1 ; $baris++) { 
                $data = array(
                    'nama_baris'             =>  $this->input->post('nama_baris'.$baris)
                );
                $where = array(
                    'no'             =>  $this->input->post('no'.$baris),
                    'id_nama_judul_baris' => $id_nama_judul_baris
                );               
                $this->m_kca->update_judul_baris($where,$data);
                    
            }
            $aktivitas = array(
                    'username'           =>  $this->session->userdata('username'),
                    'aktivitas'         =>  'Mengupdate Judul Baris '.$nama_judul_baris
            );
            $this->session->set_flashdata('flash','Mengupdate Judul Baris Berhasil');
            $this->m_aktivitas->input_data($aktivitas);
            redirect('member/KCA/master_judul_baris');
        }else{
            $data = konfigurasi('Dashboard');
            $where = array ('id_nama_judul_baris' => $id_nama_judul_baris);
            $data['nama_judul_baris'] = $this->m_kca->tampil_nama_judul_baris($where)->result();
            $data['judul_baris'] = $this->m_kca->edit_judul_baris($where)->result();
            $this->template->load('layouts/member/template', 'member/edit_judul_baris', $data);       
        } 
    }
   
    public function master_karakteristik(){

        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $data = konfigurasi('Dashboard');
        $data['karakteristik'] = $this->m_kca->tampil_karakteristik()->result();
        $this->template->load('layouts/member/template', 'member/master_karakteristik', $data);
    }

    public function tambah_karakteristik(){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $data = konfigurasi('Dashboard');
        $this->form_validation->set_rules('jKarakteristik','Jumlah Karakteristik', 'trim|required|is_natural');
        if($this->form_validation->run() == TRUE){
            $data['nama_karakteristik'] = $this->input->post('nama_karakteristik');
            $data['jKarakteristik'] = $this->input->post('jKarakteristik');
            $this->template->load('layouts/member/template', 'member/tambah_karakteristik', $data);
        } else{
        redirect ('member/KCA/master_karakteristik');
        }
    }

    public function insert_karakteristik(){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
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
        $this->session->set_flashdata('flash','Menambahkan Karakteristik Berhasil');
        redirect ('member/KCA/master_karakteristik');
    }    
    //hanya admin
    public function hapus_karakteristik($id_nama_karakteristik){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $where = array ('id_nama_karakteristik' => $id_nama_karakteristik);
        $this->m_kca->hapus_karakteristik($where);
        redirect ('member/KCA/master_karakteristik');
    }

    public function edit_karakteristik($id_nama_karakteristik){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $data = konfigurasi('Dashboard');
        $where = array ('id_nama_karakteristik' => $id_nama_karakteristik);
        $data['nama_karakteristik'] = $this->m_kca->tampil_nama_karakteristik($where)->result();
        $data['karakteristik'] = $this->m_kca->edit_karakteristik($where)->result();
        $this->template->load('layouts/member/template', 'member/edit_karakteristik', $data);        
    }
    
    public function update_karakteristik(){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $id_nama_karakteristik = $this->input->post('id_nama_karakteristik');
        $nama_karakteristik = $this->input->post('nama_karakteristik');
        $jKolom = $this->input->post('jKolom');

        $this->form_validation->set_rules('nama_karakteristik','Karakteristik', 'trim|required');
        // $this->form_validation->set_rules('judul_baris','Judul Baris', 'trim|required');
        // $this->form_validation->set_rules('karakteristik','Karakteristik', 'trim|required');

        if($this->form_validation->run() == TRUE){

            $data = array(
                    'nama_karakteristik' =>  $nama_karakteristik
            );
            $where = array(
                'id_nama_karakteristik' => $id_nama_karakteristik
            );
            $this->m_kca->update_nama_karakteristik($where,$data);

            for ($kolom=1; $kolom < $jKolom+1 ; $kolom++) { 
                $data = array(
                    'nama_karakteristik'             =>  $this->input->post('nama_karakteristik'.$kolom)
                );
                $where = array(
                    'no'             =>  $this->input->post('no'.$kolom),
                    'id_nama_karakteristik' => $id_nama_karakteristik
                );               
                $this->m_kca->update_karakteristik($where,$data);
                    
            }
            $aktivitas = array(
                    'username'           =>  $this->session->userdata('username'),
                    'aktivitas'         =>  'Mengupdate Karakteristik'.$nama_karakteristik
            );
            $this->session->set_flashdata('flash','Mengupdate Karakteristik Berhasil');
            $this->m_aktivitas->input_data($aktivitas);
            redirect('member/KCA/master_karakteristik');
        }else{
            $data = konfigurasi('Dashboard');
            $where = array ('id_nama_karakteristik' => $id_nama_karakteristik);
            $data['nama_karakteristik'] = $this->m_kca->tampil_nama_karakteristik($where)->result();
            $data['karakteristik'] = $this->m_kca->edit_karakteristik($where)->result();
            $this->template->load('layouts/member/template', 'member/edit_karakteristik', $data);       
        } 
    }
    public function input_tabel(){

        if ($this->session->userdata('id_satker') != "6" ) {
            $id_user = $this->session->userdata('id');
            $where = array ('id_user' => $id_user);
            $data['buku'] = $this->m_kca->edit_data_buku($where)->result();
        }
        $data = konfigurasi('Dashboard');
        if (empty($data['buku'])){
            $data['buku'] = $this->m_kca->tampil_data_buku()->result();
        }
        $this->template->load('layouts/member/template', 'member/input_tabel', $data);
    }

    public function input_tabel_isi($isi){

        $data = konfigurasi('Dashboard');
        $where = array ('id_buku' => $isi);
        $a = $this->m_kca->edit_data_buku($where)->result();
        $where2 = array ('id_kec' =>$a[0]->id_kec);
        $data['tabel'] = $this->m_kca->edit_tabel($where2)->result();
        $this->load->view('member/input_tabel_isi', $data);
    }
    //hanya admin
    public function hapus_data_tabel($id_tabel){
        $where = array ('id_tabel' => $id_tabel);
        $this->m_kca->hapus_data_isi($where);
        redirect ('member/KCA/input_tabel');
    }

    public function input_data_tabel(){
        $id_tabel = $this->uri->segment(4);
        $id_buku = $this->uri->segment(5);
        $where = array ('id_tabel' => $id_tabel, 'id_buku'=>$id_buku);
        $where2 = array ( 'id_buku'=>$id_buku);
        $data = konfigurasi('Dashboard');
        $data['buku'] = $id_buku;
        $data['isi'] = $this->m_kca->tampil_data_isi($where)->result();
        $where3 = array ('id_tabel' => $id_tabel);
        $data['tabel'] = $this->m_kca->edit_tabel($where3)->result();
        $a = $this->m_kca->edit_data_buku($where2)->result();
        $where4 = array ('id_kec' =>$a[0]->id_kec);
        $data['kec'] = $this->m_kca->edit_kec($where4)->result();
        foreach ($data['tabel'] as $tbl) {
        $where5 = array ('id_nama_judul_baris' => $tbl->id_nama_judul_baris);
        $where6 = array ('id_nama_karakteristik' => $tbl->id_nama_karakteristik);
        }
        $data['judul_baris'] = $this->m_kca->edit_judul_baris($where5)->result();
        $data['karakteristik'] = $this->m_kca->edit_karakteristik($where6)->result();
        if (empty($data['isi']) ){
            $this->template->load('layouts/template', 'member/input_data_tabel', $data);
        } else{
            $this->template->load('layouts/template', 'member/edit_data_tabel', $data);
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
        $type_endrow = $this->input->post('type_endrow');
        if ($type_endrow == 1) {
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
        } elseif ($type_endrow == 2) {
            for ($kolom=1; $kolom < $jkolom+1; $kolom++) { 

                    $data = array(
                        'id_tabel'         =>  $id_tabel,
                        'id_buku'         =>  $id_buku,
                        'baris'         =>  '98',
                        'kolom'             =>  $kolom,
                        'data'             =>  $this->input->post('b98k'.$kolom)

                    );            
                $this->m_kca->input_data_isi($data);
                
            }        
        }
        $this->session->set_flashdata('flash','Mengentry Data Tabel Berhasil');
        redirect ('member/KCA/input_tabel');

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
        $type_endrow = $this->input->post('type_endrow');
        if ($type_endrow == 1) {
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
        }elseif ($type_endrow == 2) {
            for ($kolom=1; $kolom < $jkolom+1; $kolom++) { 
                    $where = array(
                        'id_buku' => $id_buku,
                        'id_tabel' => $id_tabel,
                        'baris'         =>  '98',
                        'kolom'             =>  $kolom
                    );
                    $data = array(
                        'data'             =>  $this->input->post('b98k'.$kolom)
                    );            
                $this->m_kca->update_data_isi($where,$data);
                
            }
        }
        $this->session->set_flashdata('flash','Mengupdate Data Tabel Berhasil');
        redirect ('member/KCA/input_tabel');

    }

    public function master_kab(){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $id_instansi = $this->session->userdata('id_instansi');
        $where = array(
            'id_instansi' => $id_instansi
                    );
        $data = konfigurasi('Dashboard');
        $data['kab'] = $this->m_kca->edit_kab($where)->result();
        $this->template->load('layouts/member/template', 'member/master_kab', $data);
    }

    public function master_kab_tambah(){

        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $this->form_validation->set_rules('id_kab','Kode Kabupaten', 'trim|required');
        if($this->form_validation->run() == TRUE){
            $nama_kab = $this->input->post('nama_kab');
            $data = array(
                'id_kab'         =>  $this->input->post('id_kab'),
                'nama_kab'         =>  $nama_kab,
                'id_instansi'             =>  $this->session->userdata('id_instansi')
                );            
            $this->m_kca->input_kab($data);
            $aktivitas = array(
                    'username'          =>  $this->session->userdata('username'),
                    'aktivitas'         =>  'Menambahkan Master Kabupaten '.$nama_kab,
            );
            $this->session->set_flashdata('flash','Master Kabupaten Berhasil Ditambahkan');
            $this->m_aktivitas->input_data($aktivitas);
            redirect('member/KCA/master_kab');
        } else{
            redirect('member/KCA/master_kab');            
        }
    }

    //hanya admin
    public function master_kab_hapus($id_kab){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $where = array ('id_kab' => $id_kab);
        $this->m_kca->hapus_kab($where);
        redirect ('member/KCA/master_kab');
    }

    // public function master_kab_edit(){
    //     if ($this->session->userdata('id_satker') != "6" ) {
    //         redirect('', 'refresh');
    //     }
    //     $id_instansi = $this->session->userdata('id_instansi');
    //     $where = array(
    //         'id_instansi' => $id_instansi
    //                 );
    //     $data = konfigurasi('Dashboard');
    //     $data['kab'] = $this->m_kca->edit_kab($where)->result();
    //     $this->template->load('layouts/member/template', 'member/edit_master_kab', $data);
    // }

    public function master_kec(){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $id_instansi = $this->session->userdata('id_instansi');
        $where = array(
            'id_instansi' => $id_instansi
                    );
        $data = konfigurasi('Dashboard');
        $data['kab'] = $this->m_kca->edit_kab($where)->result();
        $data['kec'] = $this->m_kca->edit_kec($where)->result();
        $this->template->load('layouts/member/template', 'member/master_kec', $data);
    }

    public function master_kec_isi($id_kab){

        $data = konfigurasi('Dashboard');
        $id_instansi = $this->session->userdata('id_instansi');
        $where = array(
            'id_kab' => $id_kab,
            'id_instansi' => $id_instansi
                    );
        $data['kec'] = $this->m_kca->edit_kec($where)->result();
        $this->load->view('member/master_kec_isi', $data);
    }

    public function master_kec_tambah(){

        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $this->form_validation->set_rules('id_kec','Kode Kecamatan', 'trim|required');
        if($this->form_validation->run() == TRUE){
            $nama_kec = $this->input->post('nama_kec');
            $id_kab = $this->input->post('id_kab');
            $id_kec = $id_kab.$this->input->post('id_kec');

            $data = array(
                'id_kec'         =>  $id_kec,
                'id_kab'         =>  $id_kab,
                'nama_kec'         =>  $nama_kec,
                'id_instansi'             =>  $this->session->userdata('id_instansi')
                );            
            $this->m_kca->input_kec($data);
            $aktivitas = array(
                    'username'          =>  $this->session->userdata('username'),
                    'aktivitas'         =>  'Menambahkan Master Kecamatan '.$nama_kec,
            );
            $this->session->set_flashdata('flash','Master Kecamatan Berhasil Ditambahkan');
            $this->m_aktivitas->input_data($aktivitas);
            redirect('member/KCA/master_kec');
        } else{
            redirect('member/KCA/master_kec');            
        }
    }

    //hanya admin
    public function master_kec_hapus($id_kec){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $where = array ('id_kec' => $id_kec);
        $this->m_kca->hapus_kec($where);
        redirect ('member/KCA/master_kec');
    }

    public function master_kec_edit($id_kec){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $id_instansi = $this->session->userdata('id_instansi');
        $where = array(
            'id_instansi' => $id_instansi,
            'id_kec' => $id_kec
                    );
        $data = konfigurasi('Dashboard');
        $data['kec'] = $this->m_kca->edit_kec($where)->result();
        $this->template->load('layouts/member/template', 'member/edit_master_kec', $data);
    }
    
    public function master_kec_update(){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $nama_kec = $this->input->post('nama_kec');
        $id_kab = $this->input->post('id_kab');
        $id_kec = $this->input->post('id_kec');

        $this->form_validation->set_rules('nama_kec','Nama Judul Baris', 'trim|required');
        // $this->form_validation->set_rules('judul_baris','Judul Baris', 'trim|required');
        // $this->form_validation->set_rules('karakteristik','Karakteristik', 'trim|required');

        if($this->form_validation->run() == TRUE){

            $data = array(
                    'nama_kec' =>  $nama_kec
            );
            $where = array(
                'id_kab' => $id_kab,
                'id_kec' => $id_kec
            );
            $this->m_kca->update_kec($where,$data);

            $aktivitas = array(
                    'username'           =>  $this->session->userdata('username'),
                    'aktivitas'         =>  'Mengupdate Master Kecamatan '.$nama_kec
            );
            $this->session->set_flashdata('flash','Mengupdate Master Kecamatan Berhasil');
            $this->m_aktivitas->input_data($aktivitas);
            redirect('member/KCA/master_kec');
        }else{
            redirect('member/KCA/master_kec');       
        } 
    }

    public function manajemen(){
        if ($this->session->userdata('id_satker') != "6" ) {
            redirect('', 'refresh');
        }
        $id_kec = '9105';
        $where = array(
            'id_kec' => $id_kec
                    );
        $data['kab'] = $this->m_kca->getKabByIdInstansi();
        var_dump($data['kab']);
    }
}

?>