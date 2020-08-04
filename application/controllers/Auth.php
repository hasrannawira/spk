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

    public function login()
    {
    //var_dump(file_exists(base_url('application/controllers/vendor/').'autoload'));

    // session_start();
    require $_SERVER['DOCUMENT_ROOT'].'/assets/vendor/autoload.php';
    require $_SERVER['DOCUMENT_ROOT'].'/assets/vendor/src/Provider/Keycloak.php';   
    $provider = new IrsadArief\OAuth2\Client\Provider\Keycloak([
        'authServerUrl'         => 'https://sso.bps.go.id',
        'realm'                 => 'pegawai-bps',
        'clientId'              => '19105-spk-4r1',
        'clientSecret'          => 'fbe2606f-b543-41db-98db-a19f13229932',
        'redirectUri'           => 'https://webapps.bps.go.id/manokwarikab/'
    ]);

    if (!isset($_GET['code'])) {

        // Untuk mendapatkan authorization code
        $authUrl = $provider->getAuthorizationUrl();
        $_SESSION['oauth2state'] = $provider->getState();
        header('Location: '.$authUrl);
        exit;

    // Mengecek state yang disimpan saat ini untuk memitigasi serangan CSRF
    } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

        unset($_SESSION['oauth2state']);
        exit('Invalid state');

    } else {

        try {
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);
        } catch (Exception $e) {
            exit('Gagal mendapatkan akses token : '.$e->getMessage());
        }

        // Opsional: Setelah mendapatkan token, anda dapat melihat data profil pengguna
        try {

            $user = $provider->getResourceOwner($token);
             //var_dump( $user->toArray());
                echo "Nama : ".$user->getName();
                echo "E-Mail : ". $user->getEmail();
                echo "Username : ". $user->getUsername();
                echo "NIP : ". $user->getNip();
                echo "NIP Baru : ". $user->getNipBaru();
                echo "Kode Organisasi : ". $user->getKodeOrganisasi();
                echo "Kode Provinsi : ". $user->getProvinsi();
                echo "Kode Kabupaten : ". $user->getKabupaten();
                echo "Alamat Kantor : ". $user->getAlamatKantor();
                echo "Provinsi : ". $user->getProvinsi();
                echo "Kabupaten : ". $user->getKabupaten();
                echo "Golongan : ". $user->getGolongan();
                echo "Jabatan : ". $user->getJabatan();
                echo "Foto : ". $user->getUrlFoto();
                echo "Eselon : ". $user->getEselon();

            $username = $user->getUsername();
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

                if ($query->id_role == '1') {
                    redirect('admin/home');
                } elseif ($query->id_role == '2') {
                    redirect('member/home');
                }
            }
        } catch (Exception $e) {
            exit('Gagal Mendapatkan Data Pengguna: '.$e->getMessage());
        }

        // Gunakan token ini untuk berinteraksi dengan API di sisi pengguna
        echo $token->getToken();
        }
    }
    public function logout()
    {

    require $_SERVER['DOCUMENT_ROOT'].'/spk/application/controllers/vendor/autoload.php';
    require $_SERVER['DOCUMENT_ROOT'].'/spk/application/controllers/src/Provider/Keycloak.php';
    $provider = new IrsadArief\OAuth2\Client\Provider\Keycloak([
        'authServerUrl'         => 'https://sso.bps.go.id',
        'realm'                 => 'pegawai-bps',
        'clientId'              => '19105-spk-4r1',
        'clientSecret'          => 'fbe2606f-b543-41db-98db-a19f13229932',
        'redirectUri'           => 'http://localhost/spk'
    ]);

        $this->session->sess_destroy();
        redirect($provider->getLogoutUrl());
    }
}
?>
