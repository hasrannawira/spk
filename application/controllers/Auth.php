<?php 

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * |==============================================================|
 * | Please DO NOT modify this information :                      |
 * |--------------------------------------------------------------|
 * | Author          : Susantokun
 * | Email           : admin@susantokun.com
 * | Filename        : Auth.php
 * | Instagram       : @susantokun
 * | Blog            : http://www.susantokun.com
 * | Info            : http://info.susantokun.com
 * | Demo            : http://demo.susantokun.com
 * | Youtube         : http://youtube.com/susantokun
 * | File Created    : Friday, 13th March 2020 3:37:45 am
 * | Last Modified   : Friday, 13th March 2020 3:40:47 am
 * |==============================================================|
 */

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Auth_model');
    }

    public function check_account()
    {
        //validasi login
        $username      = $this->input->post('username');
        $password   = $this->input->post('password');
        // $communitybps = new CommunityBPS($username, $password);

        //ambil data dari database untuk validasi login
        $query = $this->Auth_model->check_account($username);

        if ($query === 1) {
            $this->session->set_flashdata('alert', '<p class="box-msg">
        			<div class="info-box alert-danger">
        			<div class="info-box-icon">
        			<i class="fa fa-warning"></i>
        			</div>
        			<div class="info-box-content" style="font-size:14">
        			<b style="font-size: 20px">GAGAL</b><br>Email Community yang Anda masukkan tidak terdaftar.</div>
        			</div>
        			</p>
            ');
        } elseif ($query === 2) {
            $this->session->set_flashdata('alert', '<p class="box-msg">
              <div class="info-box alert-info">
              <div class="info-box-icon">
              <i class="fa fa-info-circle"></i>
              </div>
              <div class="info-box-content" style="font-size:14">
              <b style="font-size: 20px">GAGAL</b><br>Akun yang Anda masukkan tidak aktif, silakan hubungi Administrator.</div>
              </div>
              </p>'
            );
        } elseif ($query === 3) {
            $this->session->set_flashdata('alert', '<p class="box-msg">
        			<div class="info-box alert-danger">
        			<div class="info-box-icon">
        			<i class="fa fa-warning"></i>
        			</div>
        			<div class="info-box-content" style="font-size:14">
        			<b style="font-size: 20px">GAGAL</b><br>Password yang Anda masukkan salah.</div>
        			</div>
        			</p>
              ');
        } else {
            //membuat session dengan nama userData yang artinya nanti data ini bisa di ambil sesuai dengan data yang login
            $userdata = array(
              'is_login'    => true,
              'id'          => $query->id,
              'password'    => $query->password,
              'id_role'     => $query->id_role,
              'username'    => $query->username,
              'first_name'  => $query->first_name,
              'last_name'   => $query->last_name,
              'email'       => $query->email,
              'phone'       => $query->phone,
              'photo'       => $query->photo,
              'created_at'  => $query->created_at,
              'id_satker'   => $query->id_satker,
              'last_login'  => $query->last_login
            );
            $this->session->set_userdata($userdata);
            return true;
        }
    }
    public function login()
    {      
        // load the library
        require "login.php";

        // make an instance
        $sso = new LoginSSO();

        // set client_id and client_secret
        $sso->setCredential("19105-spk-4r1", "fbe2606f-b543-41db-98db-a19f13229932");

        // protocol https it's default, if you wanna change to http:// :
        // $sso->setCredential("<client_id>", "<client_secret>", "http://");

        // by default, redirect uri goes to current uri, if you wanna change it :
        $sso->setRedirectUri('http://localhost/spk');

        try{
            // get token, user information, and logout url
            $login_sso = $sso->getLogin();
            $access_token = $login_sso['token'];
            $user = $login_sso['user'];
            $logout_url = $login_sso['logout_url'];

            // if you prefer to print the output to JSON, use this:
            $sso->getLoginAsJSON();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
?>
