# PHP Plugin BPS Community

Untuk teman-teman programmer yang mau buat aplikasi dengan menggunakan account BPS Community tetapi tidak bisa mengakses databasenya langsung, bisa pakai plugin ini. Plugin ini TIDAK HARUS dipasang pada web hosting dengan domain bps.go.id, jadi kalau teman-teman ada aplikasi diluar hosting bps.go.id, plugin ini tetap berfungsi.

## Fitur-Fitur

Beberapa fitur yang bisa didapatkan jika menggunakan plugin ini, yaitu:

1. Dapat digunakan untuk aplikasi yang membutuhkan user login dengan account community
2. Dapat digunakan untuk mengetahui biodata pegawai lain jika diketahui NIP BPS nya
3. Dapat melakukan pencarian berdasarkan nama atau nip dan dengan filter wilayah satker bps (dapat menampilkan maksimal 10 hasil pencarian)
3. Dapat digunakan untuk mendapatkan biodata seluruh pegawai dalam suatu satker BPS Kabupaten/Kota dengan memasukkan kode BPSnya seperti 7206
4. Bisa juga untuk mendapatkan biodata seluruh pegwai dalam suatu satker BPS Provinsi dengan memasukkan kode BPSnya seperti 7200

## Cara Penggunaan

Cantumkan kode ini sebelum memulai menggunakan plugin
```
require "classes/communitybps.php";
```

Kemudian, inisiasi dulu instance $communitybps dengan login community (bisa menggunakan akun kantor)
Inisiasi ini juga dapat digunakan untuk pengecekkan login community, jika gagal akan muncul error, gunakan try catch untuk pengecekkan.
```
$communitybps = new CommunityBPS($username,$password);
```

<br/><br/><br/>



Setelah itu dapat menggunakan fungsi-fungsi berikut:

* untuk mendapatkan profil pegawai
```
$communitybps->getprofil('340057260');
```
* untuk mendapatkan seluruh profil satu satker BPS Kabupaten/Kota
```
$communitybps->get_list_pegawai_kabkot('7206');
```
* untuk mendapatkan seluruh profil satu satker BPS Provinsi
```
$communitybps->get_list_pegawai_provinsi('7200');
```
* untuk melakukan pencarian berdasarkan nip atau nama
```
$communitybps->pencarian('aditya');
```
<br/>
Untuk lebih jelasnya, silakan buka langsung sintaksnya, semua terdokumentasikan di sana

<br/><br/>

## Kekurangan

Jika digunakan untuk mendapatkan profil di seluruh kabkot atau provinsi, maka mungkin plugin ini akan berjalan lebih lambat, tetapi jika digunakan hanya untuk cek login dan untuk mendapatkan profil pegawai personal tidak ada masalah

## Kelebihan

Biasanya kalau mau buat aplikasi pakai login community BPS, aplikasinya harus dihosting di domain bps.go.id karena permasalahan cookiesnya. Tapi ini bisa dijalankan di domain selain bps.go.id

## Kritik Saran

Jika ada kritik saran atau usulan bahkan pemutakhiran sintaks, silakan email ke aditya.sudyana@bps.go.id.
Silakan teman-teman otak-atik sendiri juga boleh untuk aplikasi yang teman-teman buat.

## Penutup

Semoga plugin ini bisa bermanfaat :)