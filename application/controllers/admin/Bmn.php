<?php
	
	/**
	 * 
	 */

class Bmn extends MY_Controller{
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
		$data['bmn'] = $this->m_BMN->tampil_data()->result();
		$this->template->load('layouts/template', 'admin/bmn', $data);
	}
}

?>