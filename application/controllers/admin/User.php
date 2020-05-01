<?php
	
	/**
	 * 
	 */

class User extends MY_Controller{
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
		$data['user'] = $this->m_user->tampil_data()->result();
		$this->template->load('layouts/template', 'admin/user', $data);
	}

	public function tambah_user(){
			$password = $this->input->post('password');
			$password_hash = password_hash($password, PASSWORD_DEFAULT);
			$photo = $_FILES['photo'];
			if ($photo=''){
				$photo='default.png';
			} else{
                $config['upload_path']          = './assets/uploads/images/foto_profil/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;


			$this->load->library('upload');
			$this->upload->initialize($config);

				if(!$this->upload->do_upload('photo')){
					echo  $this->upload->display_errors(); die();
				} else{
					$data = array('upload_data' => $this->upload->data());
					$photo=$this->upload->data('file_name');
				}
			}

			$data = array(
				'username'		=>	$this->input->post('username'),
				'password'		=>	$password_hash,
				'first_name'	=>	$this->input->post('first_name'),
				'last_name'		=> 	$this->input->post('last_name'),
				'phone'			=>	$this->input->post('phone'),
				'email'			=>	$this->input->post('email'),
				'id_role'		=> 2,
				'id_satker'		=> $this->input->post('id_satker'),
				'activated'		=> 1,
				'photo'			=> $photo

			);

			$this->m_user->input_user($data);
        	$this->session->set_flashdata('flash','Data User Berhasil Ditambahkan');
			redirect('admin/user');
	}

	public function hapus($id){
		$where = array ('id' => $id);
		$this->m_user->hapus_data($where,'tbl_user');
		redirect ('admin/user');
	}

	public function edit($id){
		$data = konfigurasi('Dashboard');
		$where = array ('id' => $id);
		$data['user'] = $this->m_user->edit_data($where,'tbl_user')->result();
		$this->template->load('layouts/template', 'admin/edit_user', $data);		
	}
	
	public function update(){
		$id = $this->input->post('id');
			$photo = $_FILES['photo'];
			if ($photo=''){
				$photo='default.png';
			} else{
				
                $config['upload_path']          = './assets/uploads/images/foto_profil/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
				
				$this->load->library('upload');
				$this->upload->initialize($config);
				
				if(!$this->upload->do_upload('photo')){
					echo  $this->upload->display_errors(); die();
				} else{
					$data = array('upload_data' => $this->upload->data());
					$photo=$this->upload->data('file_name');
				}
			}		
		$data = array(
			'username' 		=> $this->input->post('username'),
			'first_name' 	=> $this->input->post('first_name'),
			'last_name' 	=> $this->input->post('last_name'),
			'email' 		=> $this->input->post('email'),
			'phone'			=> $this->input->post('phone'),
			'id_satker'		=> $this->input->post('id_satker'),
			'photo' 		=> $photo
		);

		$where = array(
			'id' => $id
		);

        $this->session->set_flashdata('flash','Data User Berhasil Diupdate');
		$this->m_user->update_data($where,$data,'tbl_user');
		redirect('admin/user');
	}


	
}

?>