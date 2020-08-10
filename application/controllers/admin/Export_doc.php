<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class Export_doc extends MY_Controller{

    function export_nomor_surat_tu($id_surat){

        //cari datanya
        $data = konfigurasi('Dashboard');
        $where = array ('id_surat' => $id_surat);
        $data['surat'] = $this->m_surat_tu->edit_data($where)->result();
            foreach ($data['surat'] as $srt) : 
  
                    $nomor_surat= 'B-'.$srt->no_urut.'/'.$srt->id_instansi.$srt->kode_satker.'/'.$srt->instansi_asal.'/'.$srt->id_bulan.'/'.$srt->tahun;
                    $tanggal= $srt->tanggal;
                    $perihal= $srt->perihal;
                    $instansi_tujuan= $srt->instansi_tujuan;
                    $keterangan= $srt->keterangan;
                    $kepada= $srt->instansi_tujuan;

            
             endforeach;

        if ($nomor_surat == '') {
            $nomor_surat = '-';
        }
        if ($tanggal == '') {
            $tanggal = date("l, j F Y");
        }
        $data2 = array(
                'nomor_surat'     => $nomor_surat,
                'tanggal'     => $tanggal,
                'instansi_tujuan'     => $instansi_tujuan,
                'perihal'     => $perihal,
                'kepada' => $kepada,
                'keterangan' => $keterangan
            );

            $this->load->view('export/export_to_doc', $data2);
           
    }

    function export_nomor_surat_sosial($id_surat){

        //cari datanya
        $data = konfigurasi('Dashboard');
        $where = array ('id_surat' => $id_surat);
        $data['surat'] = $this->m_surat_sosial->edit_data($where)->result();
            foreach ($data['surat'] as $srt) : 
  
                    $nomor_surat= 'B-'.$srt->no_urut.'/'.$srt->id_instansi.$srt->kode_satker.'/'.$srt->instansi_asal.'/'.$srt->id_bulan.'/'.$srt->tahun;
                    $tanggal= $srt->tanggal;
                    $perihal= $srt->perihal;
                    $instansi_tujuan= $srt->instansi_tujuan;
                    $keterangan= $srt->keterangan;
                    $kepada= $srt->instansi_tujuan;

            
             endforeach;

        if ($nomor_surat == '') {
            $nomor_surat = '-';
        }
        if ($tanggal == '') {
            $tanggal = date("l, j F Y");
        }
        $data2 = array(
                'nomor_surat'     => $nomor_surat,
                'tanggal'     => $tanggal,
                'instansi_tujuan'     => $instansi_tujuan,
                'perihal'     => $perihal,
                'kepada' => $kepada,
                'keterangan' => $keterangan
            );

            $this->load->view('export/export_to_doc', $data2);
           
    }
    function export_nomor_surat_produksi($id_surat){

        //cari datanya
        $data = konfigurasi('Dashboard');
        $where = array ('id_surat' => $id_surat);
        $data['surat'] = $this->m_surat_produksi->edit_data($where)->result();
            foreach ($data['surat'] as $srt) : 
  
                    $nomor_surat= 'B-'.$srt->no_urut.'/'.$srt->id_instansi.$srt->kode_satker.'/'.$srt->instansi_asal.'/'.$srt->id_bulan.'/'.$srt->tahun;
                    $tanggal= $srt->tanggal;
                    $perihal= $srt->perihal;
                    $instansi_tujuan= $srt->instansi_tujuan;
                    $keterangan= $srt->keterangan;
                    $kepada= $srt->instansi_tujuan;

            
             endforeach;

        if ($nomor_surat == '') {
            $nomor_surat = '-';
        }
        if ($tanggal == '') {
            $tanggal = date("l, j F Y");
        }
        $data2 = array(
                'nomor_surat'     => $nomor_surat,
                'tanggal'     => $tanggal,
                'instansi_tujuan'     => $instansi_tujuan,
                'perihal'     => $perihal,
                'kepada' => $kepada,
                'keterangan' => $keterangan
            );

            $this->load->view('export/export_to_doc', $data2);
           
    }
    function export_nomor_surat_distribusi($id_surat){

        //cari datanya
        $data = konfigurasi('Dashboard');
        $where = array ('id_surat' => $id_surat);
        $data['surat'] = $this->m_surat_distribusi->edit_data($where)->result();
            foreach ($data['surat'] as $srt) : 
  
                    $nomor_surat= 'B-'.$srt->no_urut.'/'.$srt->id_instansi.$srt->kode_satker.'/'.$srt->instansi_asal.'/'.$srt->id_bulan.'/'.$srt->tahun;
                    $tanggal= $srt->tanggal;
                    $perihal= $srt->perihal;
                    $instansi_tujuan= $srt->instansi_tujuan;
                    $keterangan= $srt->keterangan;
                    $kepada= $srt->instansi_tujuan;

            
             endforeach;

        if ($nomor_surat == '') {
            $nomor_surat = '-';
        }
        if ($tanggal == '') {
            $tanggal = date("l, j F Y");
        }
        $data2 = array(
                'nomor_surat'     => $nomor_surat,
                'tanggal'     => $tanggal,
                'instansi_tujuan'     => $instansi_tujuan,
                'perihal'     => $perihal,
                'kepada' => $kepada,
                'keterangan' => $keterangan
            );

            $this->load->view('export/export_to_doc', $data2);
           
    }
    function export_nomor_surat_nerwilis($id_surat){

        //cari datanya
        $data = konfigurasi('Dashboard');
        $where = array ('id_surat' => $id_surat);
        $data['surat'] = $this->m_surat_nerwilis->edit_data($where)->result();
            foreach ($data['surat'] as $srt) : 
  
                    $nomor_surat= 'B-'.$srt->no_urut.'/'.$srt->id_instansi.$srt->kode_satker.'/'.$srt->instansi_asal.'/'.$srt->id_bulan.'/'.$srt->tahun;
                    $tanggal= $srt->tanggal;
                    $perihal= $srt->perihal;
                    $instansi_tujuan= $srt->instansi_tujuan;
                    $keterangan= $srt->keterangan;
                    $kepada= $srt->instansi_tujuan;

            
             endforeach;

        if ($nomor_surat == '') {
            $nomor_surat = '-';
        }
        if ($tanggal == '') {
            $tanggal = date("l, j F Y");
        }
        $data2 = array(
                'nomor_surat'     => $nomor_surat,
                'tanggal'     => $tanggal,
                'instansi_tujuan'     => $instansi_tujuan,
                'perihal'     => $perihal,
                'kepada' => $kepada,
                'keterangan' => $keterangan
            );

            $this->load->view('export/export_to_doc', $data2);
           
    }
    function export_nomor_surat_ipds($id_surat){

        //cari datanya
        $data = konfigurasi('Dashboard');
        $where = array ('id_surat' => $id_surat);
        $data['surat'] = $this->m_surat_ipds->edit_data($where)->result();
            foreach ($data['surat'] as $srt) : 
  
                    $nomor_surat= 'B-'.$srt->no_urut.'/'.$srt->id_instansi.$srt->kode_satker.'/'.$srt->instansi_asal.'/'.$srt->id_bulan.'/'.$srt->tahun;
                    $tanggal= $srt->tanggal;
                    $perihal= $srt->perihal;
                    $instansi_tujuan= $srt->instansi_tujuan;
                    $keterangan= $srt->keterangan;
                    $kepada= $srt->instansi_tujuan;

            
             endforeach;

        if ($nomor_surat == '') {
            $nomor_surat = '-';
        }
        if ($tanggal == '') {
            $tanggal = date("l, j F Y");
        }
        $data2 = array(
                'nomor_surat'     => $nomor_surat,
                'tanggal'     => $tanggal,
                'instansi_tujuan'     => $instansi_tujuan,
                'perihal'     => $perihal,
                'kepada' => $kepada,
                'keterangan' => $keterangan
            );

            $this->load->view('export/export_to_doc', $data2);
           
    }
    function export_nomor_surat_kepala($id_surat){

        //cari datanya
        $data = konfigurasi('Dashboard');
        $where = array ('id_surat' => $id_surat);
        $data['surat'] = $this->m_surat_kepala->edit_data($where)->result();
            foreach ($data['surat'] as $srt) : 
  
                    $nomor_surat= 'B-'.$srt->no_urut.'/'.$srt->id_instansi.$srt->kode_satker.'/'.$srt->instansi_asal.'/'.$srt->id_bulan.'/'.$srt->tahun;
                    $tanggal= $srt->tanggal;
                    $perihal= $srt->perihal;
                    $instansi_tujuan= $srt->instansi_tujuan;
                    $keterangan= $srt->keterangan;
                    $kepada= $srt->instansi_tujuan;

            
             endforeach;

        if ($nomor_surat == '') {
            $nomor_surat = '-';
        }
        if ($tanggal == '') {
            $tanggal = date("l, j F Y");
        }
        $data2 = array(
                'nomor_surat'     => $nomor_surat,
                'tanggal'     => $tanggal,
                'instansi_tujuan'     => $instansi_tujuan,
                'perihal'     => $perihal,
                'kepada' => $kepada,
                'keterangan' => $keterangan
            );

            $this->load->view('export/export_to_doc', $data2);
           
    }
    function export_nomor_surat_sp2020($id_surat){

        //cari datanya
        $data = konfigurasi('Dashboard');
        $where = array ('id_surat' => $id_surat);
        $data['surat'] = $this->m_surat_sp2020->edit_data($where)->result();
            foreach ($data['surat'] as $srt) : 
  
                    $nomor_surat= 'B-'.$srt->no_urut.'/'.$srt->instansi_asal.'/'.$srt->id_instansi.'/'.$srt->sensus.'/'.$srt->id_bulan.'/'.$srt->tahun;
                    $tanggal= $srt->tanggal;
                    $perihal= $srt->perihal;
                    $instansi_tujuan= $srt->instansi_tujuan;
                    $keterangan= $srt->keterangan;
                    $kepada= $srt->instansi_tujuan;

            
             endforeach;

        if ($nomor_surat == '') {
            $nomor_surat = '-';
        }
        if ($tanggal == '') {
            $tanggal = date("l, j F Y");
        }
        $data2 = array(
                'nomor_surat'     => $nomor_surat,
                'tanggal'     => $tanggal,
                'instansi_tujuan'     => $instansi_tujuan,
                'perihal'     => $perihal,
                'kepada' => $kepada,
                'keterangan' => $keterangan
            );

            $this->load->view('export/export_to_doc', $data2);
           
    }    

    function export_kca($id_buku){

        //cari datanya
        $data = konfigurasi('Dashboard');
        $where = array ('id_buku' => $id_buku);
        //Judul Buku
        $data['buku'] = $this->m_kca->edit_data_buku($where)->result();
            foreach ($data['buku'] as $bk) : 
  

                    $id_buku = $bk->id_buku;
                    $nama_buku = $bk->nama_buku;
                    $kecamatan = $bk->kecamatan;
                    $tahun = $bk->tahun;

            
             endforeach;
        //Tabel Buku

        $data2 = array(
                'id_buku'     => $id_buku,
                'nama_buku' => $nama_buku,
                'kecamatan' => $kecamatan,
                'tahun' => $tahun
            );

            $this->load->view('export/export_kca_to_doc_html', $data2);
           
    }
}  

?>