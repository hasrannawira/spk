<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends MY_Controller
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
        $data['surat'] = $this->m_surat_ipds->tampil_data()->result();
        $this->template->load('layouts/template', 'admin/surat_ipds', $data);
    }


}
