<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Surat_distribusi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->check_login();
        if ($this->session->userdata('id_role') != "1") {
            redirect('', 'refresh');
        }
    }

    public function index()
    {
        $data = konfigurasi('Dashboard');
        $data['surat'] = $this->m_surat_distribusi->tampil_data()->result();
        $this->template->load('layouts/template', 'admin/surat_distribusi', $data);
    }

    public function tambah_surat(){
        $this->form_validation->set_rules('no_urut','Nomor Urut', 'trim|required');
        $this->form_validation->set_rules('id_instansi','Kode Instansi', 'trim|required');
        $this->form_validation->set_rules('instansi_asal','Instansi Asal', 'trim|required');
        $this->form_validation->set_rules('kode_satker','Kode Satker', 'trim|required');
        $this->form_validation->set_rules('tanggal','Tanggal', 'trim|required');
        $this->form_validation->set_rules('perihal','Perihal', 'trim|required');
        $this->form_validation->set_rules('instansi_tujuan','Instansi Tujuan', 'trim|required');

        if($this->form_validation->run() == TRUE){

        $instansi_asal = 'BPS';
        $id_instansi = '9105';
        $kode_satker ='4';
        $tanggal = $this->input->post('tanggal');
        $id_bulan = substr($tanggal,5,2);
        $tahun = substr($tanggal,0,4);
        $no_urut = $this->input->post('no_urut');
        $nomor_surat = 'B-'.$no_urut.'/'.$id_instansi.$kode_satker.'/'.$instansi_asal.'/'.$id_bulan.'/'.$tahun;

            $data = array(
                'no_urut'           =>  $no_urut,
                'id_instansi'       =>  $id_instansi,
                'instansi_asal'     =>  $instansi_asal,
                'kode_satker'       =>  $kode_satker,
                'id_bulan'          =>  $id_bulan,
                'tahun'             =>  $tahun,
                'tanggal'           =>  $tanggal,
                'perihal'           =>  $this->input->post('perihal'),
                'instansi_tujuan'   =>  $this->input->post('instansi_tujuan'),
                'keterangan'        =>  $this->input->post('keterangan')

            );

            $this->m_surat_distribusi->input_data($data);

        $aktivitas = array(
                'username'           =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Menambahkan Surat Seksi Stat. Distribusi '.$nomor_surat,
        );
        $this->session->set_flashdata('flash','Surat Distribusi Berhasil Ditambahkan');
        $this->m_aktivitas->input_data($aktivitas);

            redirect('admin/surat_distribusi');
        } else{
            redirect('admin/surat_distribusi');            
        }
    }

    public function hapus(){
        $id_surat = $this->uri->segment(4);
        $no_urut = $this->uri->segment(5);
        $id_instansi_satker = $this->uri->segment(6);
        $instansi_asal = $this->uri->segment(7);
        $id_bulan = $this->uri->segment(8);
        $tahun = $this->uri->segment(9);
        $nomor_surat = $no_urut.'/'.$id_instansi_satker.'/'.$instansi_asal.'/'.$id_bulan.'/'.$tahun;
        $where = array ('id_surat' => $id_surat);
        $this->m_surat_distribusi->hapus_data($where,'tbl_surat_distribusi');
        $aktivitas = array(
                'username'          =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Menghapus Surat Seksi Stat. Distribusi '.$nomor_surat,
        );
        $this->m_aktivitas->input_data($aktivitas);
        redirect ('admin/surat_distribusi');
    }


    public function edit($id_surat){
        $data = konfigurasi('Dashboard');
        $where = array ('id_surat' => $id_surat);
        $data['surat'] = $this->m_surat_distribusi->edit_data($where)->result();
        $this->template->load('layouts/template', 'admin/edit_surat_distribusi', $data);        
    }
    
    public function update(){
        $id_surat = $this->input->post('id_surat');

        $this->form_validation->set_rules('no_urut','Nomor Urut', 'trim|required');
        $this->form_validation->set_rules('id_instansi','Kode Instansi', 'trim|required');
        $this->form_validation->set_rules('instansi_asal','Instansi Asal', 'trim|required');
        $this->form_validation->set_rules('kode_satker','Kode Satker', 'trim|required');
        $this->form_validation->set_rules('tanggal','Tanggal', 'trim|required');
        $this->form_validation->set_rules('perihal','Perihal', 'trim|required');
        $this->form_validation->set_rules('instansi_tujuan','Instansi Tujuan', 'trim|required');

        if($this->form_validation->run() == TRUE){

        $instansi_asal = 'BPS';
        $id_instansi = '9105';
        $kode_satker ='4';
        $tanggal = $this->input->post('tanggal');
        $id_bulan = substr($tanggal,5,2);
        $tahun = substr($tanggal,0,4);
        $no_urut = $this->input->post('no_urut');
        $nomor_surat = 'B-'.$no_urut.'/'.$id_instansi.$kode_satker.'/'.$instansi_asal.'/'.$id_bulan.'/'.$tahun;

        $data = array(
                'no_urut'           =>  $no_urut,
                'id_instansi'       =>  $id_instansi,
                'instansi_asal'     =>  $instansi_asal,
                'kode_satker'       =>  $kode_satker,
                'id_bulan'          =>  $id_bulan,
                'tahun'             =>  $tahun,
                'tanggal'           =>  $tanggal,
                'perihal'           =>  $this->input->post('perihal'),
                'instansi_tujuan'   =>  $this->input->post('instansi_tujuan'),
                'keterangan'        =>  $this->input->post('keterangan')

        );

        $where = array(
            'id_surat' => $id_surat
        );

        $this->m_surat_distribusi->update_data($where,$data);
        $aktivitas = array(
                'username'           =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Mengupdate Surat Seksi Stat. Distribusi '.$nomor_surat,
        );
        $this->session->set_flashdata('flash','Surat Distribusi Berhasil Diupdate');
        $this->m_aktivitas->input_data($aktivitas);
        redirect('admin/surat_distribusi');
        } else{
        $data = konfigurasi('Dashboard');
        $where = array ('id_surat' => $id_surat);
        $data['surat'] = $this->m_surat_distribusi->edit_data($where)->result();
        $this->template->load('layouts/template', 'admin/edit_surat_distribusi', $data);             
        }
    }
    public function upload_file(){
        $id_surat = $this->input->post('id_surat');
        $is_upload = 1;
        $file = $_FILES['file'];
        if ($file=''){

        } else{
                $config['upload_path']          = './assets/uploads/surat_distribusi/';
                $config['allowed_types']        = 'pdf';
                
                $this->load->library('upload');
                $this->upload->initialize($config);
                
                if(!$this->upload->do_upload('file')){
                    echo  $this->upload->display_errors(); die();
                } else{
                    $data = array('upload_data' => $this->upload->data());
                    $file = $this->upload->data('file_name');
                }
            }       
        $data = array(
            'is_upload'     => $is_upload,
            'file'          => $file
        );

        $where = array(
            'id_surat' => $id_surat
        );
        $aktivitas = array(
                'username'           =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Mengunggah Surat Seksi Stat. Distribusi',
        );
        $this->session->set_flashdata('flash','Surat Distribusi Berhasil Diunggah');
        $this->m_surat_distribusi->update_data($where,$data);
        $this->m_aktivitas->input_data($aktivitas);
        redirect('admin/surat_distribusi');
    }

}
