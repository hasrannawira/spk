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
        $data['link'] = $this->m_link->tampil_data()->result();
        $this->template->load('layouts/template', 'admin/link', $data);
    }
    
    public function input_table(){

        $data = konfigurasi('Dashboard');
        $data['link'] = $this->m_link->tampil_data()->result();
        $this->template->load('layouts/template', 'admin/link', $data);
    }

    public function manajemen(){

        $data = konfigurasi('Dashboard');
        $data['link'] = $this->m_link->tampil_data()->result();
        $this->template->load('layouts/template', 'admin/link', $data);
    }
}

?>