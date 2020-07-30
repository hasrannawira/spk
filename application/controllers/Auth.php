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
    public function login()
    {
    // var_dump(file_exists($_SERVER['DOCUMENT_ROOT'].'spk/application/controllers/vendor/autoload.php'));

    var_dump(file_exists($_SERVER['DOCUMENT_ROOT'].'/application/controllers/vendor/autoload.php'));
    // session_start();
    echo $_SERVER['DOCUMENT_ROOT'].'/application/controllers/vendor/autoload.php';
    require $_SERVER['DOCUMENT_ROOT'].'/application/controllers/vendor/autoload.php';
    require $_SERVER['DOCUMENT_ROOT'].'/application/controllers/src/Provider/Keycloak.php';
    $provider = new JKD\SSO\Client\Provider\Keycloak([
        'authServerUrl'         => 'https://sso.bps.go.id',
        'realm'                 => 'pegawai-bps',
        'clientId'              => '19105-spk-4r1',
        'clientSecret'          => 'fbe2606f-b543-41db-98db-a19f13229932',
        'redirectUri'           => 'https://localhost/spk'
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
                echo "Nama : ".$user->getName();
                echo "E-Mail : ". $user->getEmail();
                echo "Username : ". $user->getUsername();
                echo "NIP : ". $user->getNip();
                echo "NIP Baru : ". $user->getNipBaru();
                echo "Kode Organisasi : ". $user->getKodeOrganisasi();
                echo "Kode Provinsi : ". $user->getKodeProvinsi();
                echo "Kode Kabupaten : ". $user->getKodeKabupaten();
                echo "Alamat Kantor : ". $user->getAlamatKantor();
                echo "Provinsi : ". $user->getProvinsi();
                echo "Kabupaten : ". $user->getKabupaten();
                echo "Golongan : ". $user->getGolongan();
                echo "Jabatan : ". $user->getJabatan();
                echo "Foto : ". $user->getUrlFoto();
                echo "Eselon : ". $user->getEselon();

        } catch (Exception $e) {
            exit('Gagal Mendapatkan Data Pengguna: '.$e->getMessage());
        }

        // Gunakan token ini untuk berinteraksi dengan API di sisi pengguna
        echo $token->getToken();
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
?>
