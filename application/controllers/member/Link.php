<?php
    
    /**
     * 
     */

class Link extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->check_login();
        if ($this->session->userdata('id_role') != "2") {
            redirect('', 'refresh');
        }
    }

    public function index(){

        $data = konfigurasi('Dashboard');
        $data['link'] = $this->m_link->tampil_data()->result();
        $this->template->load('layouts/member/template', 'member/link', $data);
    }

    public function tambah_link(){
        $this->form_validation->set_rules('nama_link','Nama Link', 'trim|required');
        $this->form_validation->set_rules('link','Link', 'trim|required');
        if($this->form_validation->run() == TRUE){
            $data = array(
                'nama_link'         =>  $this->input->post('nama_link'),
                'link'              =>  $this->input->post('link'),
                'keterangan'        =>  $this->input->post('keterangan'),

            );            
        $this->m_link->input_data($data);
        $aktivitas = array(
                'username'          =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Menambahkan Link',
        );
        $this->session->set_flashdata('flash','Data Link Berhasil Ditambahkan');
        $this->m_aktivitas->input_data($aktivitas);
            redirect('member/link');
        } else{
            redirect('member/link');            
        }
    }

    public function hapus($id_link){
        $where = array ('id_link' => $id_link);
        $this->m_link->hapus_data($where);
        $aktivitas = array(
                'username'           =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Menghapus Link',
        );
        $this->m_aktivitas->input_data($aktivitas);
        redirect ('member/link');
    }

    public function edit($id_link){
        $data = konfigurasi('Dashboard');
        $where = array ('id_link' => $id_link);
        $data['link'] = $this->m_link->edit_data($where,'tbl_link')->result();
        $this->template->load('layouts/member/template', 'member/edit_link', $data);        
    }
    
    public function update(){
        $id_link = $this->input->post('id_link');

        $this->form_validation->set_rules('nama_link','Nama Link', 'trim|required');
        $this->form_validation->set_rules('link','Link', 'trim|required');

        if($this->form_validation->run() == TRUE){
            $data = array(
                'nama_link'         =>  $this->input->post('nama_link'),
                'link'              =>  $this->input->post('link'),
                'keterangan'        =>  $this->input->post('keterangan'),

            );

        $where = array(
            'id_link' => $id_link
        );
        $this->m_link->update_data($where,$data);
        $aktivitas = array(
                'username'           =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Mengupdate Link',
        );
        $this->session->set_flashdata('flash','Data Link Berhasil Ditambahkan');
        $this->m_aktivitas->input_data($aktivitas);
        redirect('member/link');
        } else{
        $data = konfigurasi('Dashboard');
        $where = array ('id_link' => $id_link);
        $data['link'] = $this->m_link->edit_data($where)->result();
        $this->template->load('layouts/member/template', 'member/edit_link', $data);             
        }
    }


}

?>