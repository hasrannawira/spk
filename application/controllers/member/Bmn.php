<?php
	
	/**
	 * 
	 */

class Bmn extends MY_Controller{
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
		$data['user'] = $this->m_user->tampil_data()->result();
		$this->template->load('layouts/member/template', 'member/bmn', $data);
	}
}

?>