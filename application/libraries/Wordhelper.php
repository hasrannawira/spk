<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wordhelper {

	private $phpword;
    
    public function __construct()
    {	
        $this->phpword = new \PhpOffice\PhpWord\PhpWord();
    }

    function getWord(){
        return $this->phpword;
    }


    function getData($idbuku, $notabel, $idkec){
    	$CI = get_instance();

        $CI->load->model('WilayahModel');  
        $CI->load->model('MetaModel');  
        $CI->load->model('TabelModel');

        $kec = $CI->WilayahModel->getKecById($idkec);
        $idtabel = $CI->TabelModel->getIdTabelByNonIdKec($notabel,$idkec)->id_tabel; 

        $meta = $CI->MetaModel->getMetaById($idtabel);
        $relasi = $CI->TabelModel->getBarisKarByIdTabel($idtabel);

        $idnamabaris = $relasi->id_nama_baris;
        $idnamakolom = $relasi->id_nama_kolom;
        $baris = $CI->TabelModel->getBarisByIdNamaBaris($idnamabaris);
        $kolom = $CI->TabelModel->getKolomByIdNamaKolom($idnamakolom);
        $judulbaris = $CI->TabelModel->getJudulBarisByIdNamaBaris($idnamabaris);
        $data = $CI->TabelModel->getDataByBukunTabel($idbuku, $idtabel);
        if ($meta->type_endrow != 0){
            $endrow = $CI->TabelModel->getEndRowByBukunTabel($idbuku, $idtabel, $meta->type_endrow);
        }else{
            $endrow = [];
        }

        $j_endrow =NULL;
        switch ($meta->type_endrow) {
            case 1:
                $j_endrow = 'Jumlah';
                break;
            
            case 2:
                $j_endrow = 'Rata - rata';
                break;
        }
        
        $cdata = array(
            "id" => $meta->id_tabel,
            "nomor" => $meta->kode_tabel,
            "kecamatan" => $kec->nama_kec,
            "kabupaten" => $kec->nama_kab,
            "judul" => $meta->nama_tabel,
            "sumber" => $meta->sumber_data,
            "keterangan" => $meta->keterangan,
            "type_endrow" => $meta->type_endrow,
            "judul_endrow" => $j_endrow,
            "judul_baris" => $judulbaris->nama_judul_baris,
            "baris" => $baris,
            "kolom" => $kolom,
            "data" => $data,
            "endrow" => $endrow

        );
        return $cdata;
    }

    function getExactData($data_tabel, $baris, $kolom){
        foreach ($data_tabel AS $data){
            if (($data['baris'] == $baris) && ($data['kolom'] = $kolom)){
                return $data;
            }
        }
        return NULL;
    }

    function getAllMetaTabel($bab, $idkec){
        $judulbab = "";
        switch ($bab) {
            case 1:
                $judulbab = '1. Geografi dan Iklim';
                break;
            case 2:
                $judulbab = '2. Pemerintahan';
                break;
            case 3:
                $judulbab = '3. Kependudukan';
                break;
            case 4:
                $judulbab = '4. Sosial dan Kesejahteraan';
                break;
            case 5:
                $judulbab = '5. Pertanian';
                break;
            case 6:
                $judulbab = '6. Industri dan Energi';
                break;
            case 7:
                $judulbab = '7. Transportasi dan Komunikasi';
                break;
            case 8:
                $judulbab = '8. Keuangan dan Harga';
                break;
        }

        $CI = get_instance();
        $CI->load->model('MetaModel');  
        $kec = $CI->WilayahModel->getKecById($idkec);
        $data = $CI->MetaModel->getAllTabelByBab($bab, '9105141');

        $datac = array();
        foreach ($data as $tabel) {
            $temp = array(
                'no' => $tabel['kode_tabel'],
                'judul' => $tabel['nama_tabel'].$kec->nama_kec
            );
            array_push($datac, $temp);
        }
        return array(
            'judul_bab' => $judulbab,
            'data' => $datac
        );
    }

    function getAllGambar($kecname){
        //allgambar
        $datac = array();
        $temp = array(
            'no'=>1,
            'judul'=>'Luas Wilayah Menurut Desa/Kelurahan di Kecamatan '.$kecname
        );
        array_push($datac, $temp);
        $temp = array(
            'no'=>2,
            'judul'=>'Klasifikasi Desa/Kelurahan menurut Tingkat Perkembangan di Kecamatan '.$kecname
        );
        array_push($datac, $temp);
        $temp = array(
            'no'=>3,
            'judul'=>'Rasio Jenis Kelamin di Kecamatan '.$kecname
        );
        array_push($datac, $temp);
        $temp = array(
            'no'=>4,
            'judul'=>'Jumlah Sekolah Formal Menurut Jenjang Pendidikan di Kecamatan '.$kecname
        );
        array_push($datac, $temp);
        $temp = array(
            'no'=>5,
            'judul'=>'Luas Panen Komoditas Palawija di Kecamatan '.$kecname
        );
        array_push($datac, $temp);
        $temp = array(
            'no'=>6,
            'judul'=>'Jumlah Pelanggan Listrik PLN Menurut Jenis di Kabupatenn '.$kecname
        );
        array_push($datac, $temp);
        $temp = array(
            'no'=>7,
            'judul'=>'Jumlah Menara BTS di Kecamatan '.$kecname
        );
        array_push($datac, $temp);
        $temp = array(
            'no'=>8,
            'judul'=>'Banyaknya Sarana Ekonomi di Kecamatan '.$kecname
        );
        array_push($datac, $temp);

        return $datac;
    }

    function addDefaultTable($section, $datac){
        
        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Tabel', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText($datac['nomor'], array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText($datac['judul'].$datac['kecamatan'], array('bold'=>TRUE) , array('spaceAfter'=> 0,'alignment'=>'both'));
        
        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));
        // $t = $datac['nomor'].'\t'.$datac['judul'].$datac['kecamatan'];
        // $section->addTitle($t, 2);

        // isi Tabel
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $data_baris = $datac['baris'];
        $data_tabel = $datac['data'];
        $endrow = $datac['endrow'];
        $kecname = $datac['kecamatan'];
        $type_endrow = $datac['type_endrow'];
        $judul_endrow = $datac['judul_endrow'];

        $table = $section->addTable(
            array(
                'borderTopSize' => 10,
                'borderBottomSize'=>10,
                'borderColor' => '000000',
                'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10.8),
                'unit' => 'dxa'
            )            
        );
        $cellstyle = array('borderBottomSize' => 10,'borderBottomColor' => '000000');
        $textHeaderStyle = array('alignment'=>'center','spaceAfter'=> 100, 'spaceBefore'=>100);
        
        $rowheader = $table->addRow();
        $rowheader->addCell(NULL, $cellstyle)
                  ->addText($datac['judul_baris'], array('bold'=>TRUE), $textHeaderStyle);
        foreach ($datac['kolom'] as $kolom){
            $rowheader->addCell(NULL, $cellstyle)
                      ->addText($kolom['nama_kolom'], array('bold'=>TRUE), $textHeaderStyle);
        };
        $row = $table->addRow();
        for ($i = 0; $i <= $nkolom; $i++) {
            $no = $i+1;
            $row->addCell(NULL, $cellstyle)->addText('('.$no.')',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
        }; 

        // isi data tabel
        $no = 0;
        for ($b = 0; $b < $nbaris; $b++){
            $row = $table->addRow();
            for ($k = 0; $k <= $nkolom; $k++){
                if ($k == 0){
                    $row->addCell()->addText($data_baris[$b]['no'].'. '.htmlspecialchars($data_baris[$b]['nama_baris']), NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                }else{
                    if (empty($data_tabel)||empty($data_tabel[$no])){
                        $row->addCell()->addText('', NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    } else {
                        $row->addCell()->addText($data_tabel[$no]['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                        // $row->addCell()->addText($data_tabel[$no]['baris'].'.'.$data_tabel[$no]['kolom'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    }
                    $no++;                          
                }
               
            }
        }
        //jumlah
        if ($type_endrow != 0){
            $cellstylejumlah = array('borderTopSize' => 10,'borderTopColor' => '000000');
            $rowjum = $table->addRow();
            for ($k = 0; $k <= $nkolom; $k++){
                if ($k == 0){
                    $rowjum->addCell(NULL,$cellstylejumlah)->addText($kecname, array('bold'=> TRUE), array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40));
                } else {
                    if (empty($endrow)||empty($endrow[$k])){
                        $rowjum->addCell(NULL, $cellstylejumlah)->addText('NA.'.$k, NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    } else {
                        $rowjum->addCell(NULL, $cellstylejumlah)->addText($endrow[$k]['data'], array('bold'=> TRUE), array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    }
                }
            }
        }
        

        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));
        // untuk sumber dan keterangan
        
        $tabelmeta = $section->addTable();
        
        if (($datac['keterangan'] != NULL) && ($datac['keterangan'] != '') && ($datac['keterangan'] != ' ')) {
            $rowmeta1 = $tabelmeta->addRow();
            $rowmeta1->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2))->addText('Keterangan');
            $rowmeta1->addCell()->addText(':'.$datac['keterangan']);
        }

        $rowmeta2 = $tabelmeta->addRow();
        $rowmeta2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2))->addText('Sumber');
        $rowmeta2->addCell()->addText(':'.$datac['sumber']);

    }


    function addSplitRowTable($split, $section, $datac){   
        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Tabel', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText($datac['nomor'], array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText($datac['judul'].$datac['kecamatan'], array('bold'=>TRUE) , array('spaceAfter'=> 0,'alignment'=>'both'));
        
        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));

        
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $data_baris = $datac['baris'];
        $data_tabel = $datac['data'];
        $endrow = $datac['endrow'];
        $kecname = $datac['kecamatan'];
        $type_endrow = $datac['type_endrow'];
        $judul_endrow = $datac['judul_endrow'];

        // header tabel
        $table = $section->addTable(
            array(
                'borderTopSize' => 10,
                'borderBottomSize'=>10,
                'borderColor' => '000000',
                'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10.8),
                'unit' => 'dxa'
            )            
        );
        $cellstyle = array('borderBottomSize' => 10,'borderBottomColor' => '000000');
        $textHeaderStyle = array('alignment'=>'center','spaceAfter'=> 100, 'spaceBefore'=>100);
        
        $rowheader = $table->addRow();
        $rowheader->addCell(NULL, $cellstyle)
                  ->addText($datac['judul_baris'], array('bold'=>TRUE), $textHeaderStyle);
        foreach ($datac['kolom'] as $kolom){
            $rowheader->addCell(NULL, $cellstyle)
                      ->addText($kolom['nama_kolom'], array('bold'=>TRUE), $textHeaderStyle);
        };
        $row = $table->addRow();
        for ($i = 0; $i <= $nkolom; $i++) {
            $no = $i+1;
            $row->addCell(NULL, $cellstyle)->addText('('.$no.')',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
        }; 

        // isi data tabel
        $no = 0;
        for ($b = 0; $b < $split; $b++){
            $row = $table->addRow();
            for ($k = 0; $k <= $nkolom; $k++){
                if ($k == 0){
                    $row->addCell()->addText($data_baris[$b]['no'].'. '.htmlspecialchars($data_baris[$b]['nama_baris']), NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                }else{
                    if (empty($data_tabel)||empty($data_tabel[$no])){
                        $row->addCell()->addText('', NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    } else {
                        $row->addCell()->addText($data_tabel[$no]['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                        // $row->addCell()->addText($data_tabel[$no]['baris'].'.'.$data_tabel[$no]['kolom'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    }
                    $no++;                          
                }
               
            }
        }

        //Second Split Row
        $section->addPageBreak();
        $section->addTextBreak(1);
        $section->addText('Lanjutan Tabel '.$datac['nomor']);
        $tabletitle = $section->addTable();

        $table = $section->addTable(
            array(
                'borderTopSize' => 10,
                'borderBottomSize'=>10,
                'borderColor' => '000000',
                'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10.8),
                'unit' => 'dxa'
            )            
        );
        $cellstyle = array('borderBottomSize' => 10,'borderBottomColor' => '000000');
        $textHeaderStyle = array('alignment'=>'center','spaceAfter'=> 100, 'spaceBefore'=>100);
        
        $rowheader = $table->addRow();
        $rowheader->addCell(NULL, $cellstyle)
                  ->addText($datac['judul_baris'], array('bold'=>TRUE), $textHeaderStyle);
        foreach ($datac['kolom'] as $kolom){
            $rowheader->addCell(NULL, $cellstyle)
                      ->addText($kolom['nama_kolom'], array('bold'=>TRUE), $textHeaderStyle);
        };
        $row = $table->addRow();
        for ($i = 0; $i <= $nkolom; $i++) {
            $noo = $i+1;
            $row->addCell(NULL, $cellstyle)->addText('('.$noo.')',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
        }; 

        // isi data tabel
        for ($b = $split; $b < $nbaris; $b++){
            $row = $table->addRow();
            for ($k = 0; $k <= $nkolom; $k++){
                if ($k == 0){
                    $row->addCell()->addText($data_baris[$b]['no'].'. '.htmlspecialchars($data_baris[$b]['nama_baris']), NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                }else{
                    if (empty($data_tabel)||empty($data_tabel[$no])){
                        $row->addCell()->addText('', NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    } else {
                        $row->addCell()->addText($data_tabel[$no]['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                        // $row->addCell()->addText($data_tabel[$no]['baris'].'.'.$data_tabel[$no]['kolom'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    }
                    $no++;                          
                }
               
            }
        }
        //jumlah
        if($type_endrow != 0){
            $cellstylejumlah = array('borderTopSize' => 10,'borderTopColor' => '000000');
            $rowjum = $table->addRow();
            for ($k = 0; $k <= $nkolom; $k++){
                if ($k == 0){
                    $rowjum->addCell(NULL,$cellstylejumlah)->addText($kecname, array('bold'=> TRUE), array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40));
                } else {
                    if (empty($endrow)||empty($endrow[$k])){
                        $rowjum->addCell(NULL, $cellstylejumlah)->addText('NA.'.$k, NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    } else {
                        $rowjum->addCell(NULL, $cellstylejumlah)->addText($endrow[$k]['data'], array('bold'=> TRUE), array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    }
                }
            }
        }
        

        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));
        // untuk sumber dan keterangan
        
        $tabelmeta = $section->addTable();
        
        if (($datac['keterangan'] != NULL) && ($datac['keterangan'] != '') && ($datac['keterangan'] != ' ')) {
            $rowmeta1 = $tabelmeta->addRow();
            $rowmeta1->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2))->addText('Keterangan');
            $rowmeta1->addCell()->addText(':'.$datac['keterangan']);
        }

        $rowmeta2 = $tabelmeta->addRow();
        $rowmeta2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2))->addText('Sumber');
        $rowmeta2->addCell()->addText(':'.$datac['sumber']);

    }

    function addSplitRownColumn($splitrow, $splitcolumn, $section, $datac){
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $data_baris = $datac['baris'];
        $data_tabel = $datac['data'];
        $data_kolom = $datac['kolom'];
        $endrow = $datac['endrow'];
        $kecname = $datac['kecamatan'];
        $type_endrow = $datac['type_endrow'];
        $judul_endrow = $datac['judul_endrow'];
        $typerow = 99;

        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Tabel', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText($datac['nomor'], array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText($datac['judul'].$datac['kecamatan'], array('bold'=>TRUE) , array('spaceAfter'=> 0,'alignment'=>'both'));
        
        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));        
        

        // header tabel
        $table = $section->addTable(
            array(
                'borderTopSize' => 10,
                'borderBottomSize'=>10,
                'borderColor' => '000000',
                'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10.8),
                'unit' => 'dxa'
            )            
        );
        $cellstyle = array('borderBottomSize' => 10,'borderBottomColor' => '000000');
        $textHeaderStyle = array('alignment'=>'center','spaceAfter'=> 100, 'spaceBefore'=>100);
        
        $rowheader = $table->addRow();
        $row = $table->addRow();
        $rowheader->addCell(NULL, $cellstyle)
                  ->addText($datac['judul_baris'], array('bold'=>TRUE), $textHeaderStyle);
        $no = 1;
        $row->addCell(NULL, $cellstyle)->addText('('.$no.')',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
        // loop jumlah table per 1 split baris
        $nodata = 0;
        $mulai = 0;
        $akhir = $splitcolumn;
        for($i = 0; $i < $nkolom; $i++){
            if (($i+1) % $splitcolumn == 0){
                $no++;
                $rowheader->addCell(NULL, $cellstyle)
                          ->addText($data_kolom[$i]['nama_kolom'], array('bold'=>TRUE), $textHeaderStyle);
                $row->addCell(NULL, $cellstyle)->addText('('.$no.')',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
              
                // Insert Data
                for ($b = 0; $b < $splitrow; $b++){
                    $rowd = $table->addRow();
                    $first = TRUE;
                    for ($k = $mulai; $k <= $i; $k++){
                        if ($first){
                            $rowd->addCell()->addText($data_baris[$b]['no'].'. '.htmlspecialchars($data_baris[$b]['nama_baris']), NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                            $first = FALSE;
                        }
                        if (empty($data_tabel)){
                            $rowd->addCell()->addText($nodata, NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                        } else {
                            $bar = $b+1;
                            $kol = $k+1;
                            $datrow = $this->getExactData($data_tabel, $bar, $kol);
                            if ($datrow!= NULL){
                                $rowd->addCell()->addText($datrow['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                            }else{
                                $rowd->addCell()->addText('', NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                            }
                        }
                        $nodata++;                                           
                    }
                }
                $mulai = $i+1;
                // End Insert Data
                if ($mulai != $nkolom){
                    $section->addPageBreak();
                    $section->addTextBreak(1);
                    $section->addText('Lanjutan Tabel '.$datac['nomor']);
                    $table = $section->addTable(
                        array(
                            'borderTopSize' => 10,
                            'borderBottomSize'=>10,
                            'borderColor' => '000000',
                            'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10.8),
                            'unit' => 'dxa'
                        )            
                    );
                    $cellstyle = array('borderBottomSize' => 10,'borderBottomColor' => '000000');
                    $textHeaderStyle = array('alignment'=>'center','spaceAfter'=> 100, 'spaceBefore'=>100);
                    
                    $rowheader = $table->addRow();
                    $row = $table->addRow();
                    $rowheader->addCell(NULL, $cellstyle)
                            ->addText($datac['judul_baris'], array('bold'=>TRUE), $textHeaderStyle);
                    $row->addCell(NULL, $cellstyle)->addText('(1)',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
                }
            }else{
                $akhir = $i;
                $no++;
                $rowheader->addCell(NULL, $cellstyle)
                          ->addText($data_kolom[$i]['nama_kolom'], array('bold'=>TRUE), $textHeaderStyle);
                $row->addCell(NULL, $cellstyle)->addText('('.$no.')',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
            }           
        };

        if ($nkolom % $splitcolumn != 0){
            for ($b = 0; $b < $splitrow; $b++){
                $rowd = $table->addRow();
                $first = TRUE;
                for ($k = $mulai; $k <= $akhir; $k++){
                    if ($first){
                        $rowd->addCell()->addText($data_baris[$b]['no'].'. '.htmlspecialchars($data_baris[$b]['nama_baris']), NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                        $first = FALSE;
                    }
                        if (empty($data_tabel)){
                            $rowd->addCell()->addText($nodata, NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                        } else {
                            $bar = $b+1;
                            $kol = $k+1;
                            $datrow = $this->getExactData($data_tabel, $bar, $kol);
                            if ($datrow!= NULL){
                                $rowd->addCell()->addText($datrow['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                            }else{
                                $rowd->addCell()->addText('', NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                            }
                        }
                        $nodata++;                    
                }
            }
        }

        //split row
        // header tabel
        $section->addPageBreak();
        $section->addTextBreak(1);
        $section->addText('Lanjutan Tabel '.$datac['nomor']);
        $table = $section->addTable(
            array(
                'borderTopSize' => 10,
                'borderBottomSize'=>10,
                'borderColor' => '000000',
                'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10.8),
                'unit' => 'dxa'
            )            
        );
        $cellstyle = array('borderBottomSize' => 10,'borderBottomColor' => '000000');
        $textHeaderStyle = array('alignment'=>'center','spaceAfter'=> 100, 'spaceBefore'=>100);
        
        $rowheader = $table->addRow();
        $row = $table->addRow();
        $rowheader->addCell(NULL, $cellstyle)
                  ->addText($datac['judul_baris'], array('bold'=>TRUE), $textHeaderStyle);
        $no = 1;
        $row->addCell(NULL, $cellstyle)->addText('('.$no.')',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
        // loop jumlah table per 1 split baris
        $mulai = 0;
        $akhir = $splitcolumn;
        for($i = 0; $i < $nkolom; $i++){
            if (($i+1) % $splitcolumn == 0){
                $no++;
                $rowheader->addCell(NULL, $cellstyle)
                          ->addText($data_kolom[$i]['nama_kolom'], array('bold'=>TRUE), $textHeaderStyle);
                $row->addCell(NULL, $cellstyle)->addText('('.$no.')',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
              
                // Insert Data
                for ($b = $splitrow; $b < $nbaris; $b++){
                    $rowd = $table->addRow();
                    $first = TRUE;
                    for ($k = $mulai; $k <= $i; $k++){
                        if ($first){
                            $rowd->addCell()->addText($data_baris[$b]['no'].'. '.htmlspecialchars($data_baris[$b]['nama_baris']), NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                            $first = FALSE;
                        }
                        if (empty($data_tabel)){
                            $rowd->addCell()->addText($nodata, NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                        } else {
                            $bar = $b+1;
                            $kol = $k+1;
                            $datrow = $this->getExactData($data_tabel, $bar, $kol);
                            if ($datrow!= NULL){
                                $rowd->addCell()->addText($datrow['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                            }else{
                                $rowd->addCell()->addText('', NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                            }
                        }
                        $nodata++;                                           
                    }
                }
                //Jumlah
                if ($type_endrow != 0){
                    if ($type_endrow = 2){
                        $typerow = 98;
                    }
                    $cellstylejumlah = array('borderTopSize' => 10,'borderTopColor' => '000000');
                    $rowjum = $table->addRow();
                    $firstk = TRUE;
                    for ($kj = $mulai; $kj <= $i; $kj++){
                        if ($firstk){
                            $rowjum->addCell(NULL,$cellstylejumlah)->addText($kecname, array('bold'=> TRUE), array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40));
                            $firstk = FALSE;
                        }
                        $kol = $kj+1;
                        $datrowjum = $this->getExactData($endrow, $typerow, $kol);
                        if (empty($endrow)||empty($datrowjum)){
                            $rowjum->addCell(NULL, $cellstylejumlah)->addText('NA.'.$kol, NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                        } else if($datrowjum != NULL){                            
                            $rowjum->addCell(NULL, $cellstylejumlah)->addText($datrowjum['data'], array('bold'=> TRUE), array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                        }   
                        
                    }
                }
                
                //end Jumlah
                $mulai = $i+1;
                // End Insert Data
                if(($mulai) != $nkolom){
                    $section->addPageBreak();
                    $section->addTextBreak(1);
                    $section->addText('Lanjutan Tabel '.$datac['nomor']);
                    $table = $section->addTable(
                        array(
                            'borderTopSize' => 10,
                            'borderBottomSize'=>10,
                            'borderColor' => '000000',
                            'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10.8),
                            'unit' => 'dxa'
                        )            
                    );
                    $cellstyle = array('borderBottomSize' => 10,'borderBottomColor' => '000000');
                    $textHeaderStyle = array('alignment'=>'center','spaceAfter'=> 100, 'spaceBefore'=>100);
                    
                    $rowheader = $table->addRow();
                    $row = $table->addRow();
                    $rowheader->addCell(NULL, $cellstyle)
                            ->addText($datac['judul_baris'], array('bold'=>TRUE), $textHeaderStyle);
                    $row->addCell(NULL, $cellstyle)->addText('(1)',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
                }
            }else{
                $akhir = $i;
                $no++;
                $rowheader->addCell(NULL, $cellstyle)
                          ->addText($data_kolom[$i]['nama_kolom'], array('bold'=>TRUE), $textHeaderStyle);
                $row->addCell(NULL, $cellstyle)->addText('('.$no.')',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
            }           
        };

        if ($nkolom % $splitcolumn != 0){
            for ($b = $splitrow; $b < $nbaris; $b++){
                $rowd = $table->addRow();
                $first = TRUE;
                for ($k = $mulai; $k <= $akhir; $k++){
                    if ($first){
                        $rowd->addCell()->addText($data_baris[$b]['no'].'. '.htmlspecialchars($data_baris[$b]['nama_baris']), NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                        $first = FALSE;
                    }
                        if (empty($data_tabel)){
                            $rowd->addCell()->addText($nodata, NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                        } else {
                            $bar = $b+1;
                            $kol = $k+1;
                            $datrow = $this->getExactData($data_tabel, $bar, $kol);
                            if ($datrow!= NULL){
                                $rowd->addCell()->addText($datrow['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                            }else{
                                $rowd->addCell()->addText('', NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                            }
                        }
                        $nodata++;                    
                }
            }

            //Jumlah
            if ($type_endrow != 0){
                if ($type_endrow = 2){
                    $typerow = 98;
                }
                $cellstylejumlah = array('borderTopSize' => 10,'borderTopColor' => '000000');
                $rowjum = $table->addRow();
                $firstk = TRUE;
                for ($kj = $mulai; $kj <= $akhir; $kj++){
                    if ($firstk){
                        $rowjum->addCell(NULL,$cellstylejumlah)->addText($kecname, array('bold'=> TRUE), array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40));
                        $firstk = FALSE;
                    }
                    $kol = $kj+1;
                    $datrowjum = $this->getExactData($endrow, $typerow, $kol);
                    if (empty($endrow)||empty($datrowjum)){
                        $rowjum->addCell(NULL, $cellstylejumlah)->addText('NA.'.$kol, NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    } else if($datrowjum != NULL){                            
                        $rowjum->addCell(NULL, $cellstylejumlah)->addText($datrowjum['data'], array('bold'=> TRUE), array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    }                       
                }
            }
        }
        
        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));
        // untuk sumber dan keterangan
        
        $tabelmeta = $section->addTable();
        
        if (($datac['keterangan'] != NULL) && ($datac['keterangan'] != '') && ($datac['keterangan'] != ' ')) {
            $rowmeta1 = $tabelmeta->addRow();
            $rowmeta1->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2))->addText('Keterangan');
            $rowmeta1->addCell()->addText(':'.$datac['keterangan']);
        }

        $rowmeta2 = $tabelmeta->addRow();
        $rowmeta2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2))->addText('Sumber');
        $rowmeta2->addCell()->addText(':'.$datac['sumber']);
    }

    function addSplitColumn($splitcolumn, $section, $datac){
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $data_baris = $datac['baris'];
        $data_tabel = $datac['data'];
        $data_kolom = $datac['kolom'];
        $endrow = $datac['endrow'];
        $kecname = $datac['kecamatan'];
        $type_endrow = $datac['type_endrow'];
        $judul_endrow = $datac['judul_endrow'];
        $typerow = 99;


        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Tabel', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText($datac['nomor'], array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText($datac['judul'].$datac['kecamatan'], array('bold'=>TRUE) , array('spaceAfter'=> 0,'alignment'=>'both'));
        
        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));        
        

        // header tabel
        $table = $section->addTable(
            array(
                'borderTopSize' => 10,
                'borderBottomSize'=>10,
                'borderColor' => '000000',
                'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10.8),
                'unit' => 'dxa'
            )            
        );
        $cellstyle = array('borderBottomSize' => 10,'borderBottomColor' => '000000');
        $textHeaderStyle = array('alignment'=>'center','spaceAfter'=> 100, 'spaceBefore'=>100);
        
        $rowheader = $table->addRow();
        $row = $table->addRow();
        $rowheader->addCell(NULL, $cellstyle)
                  ->addText($datac['judul_baris'], array('bold'=>TRUE), $textHeaderStyle);
        $no = 1;
        $row->addCell(NULL, $cellstyle)->addText('('.$no.')',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
        // loop jumlah table per 1 split baris
        $nodata = 0;
        $mulai = 0;
        $akhir = $splitcolumn;
        for($i = 0; $i < $nkolom; $i++){
            if (($i+1) % $splitcolumn == 0){
                $no++;
                $rowheader->addCell(NULL, $cellstyle)
                          ->addText($data_kolom[$i]['nama_kolom'], array('bold'=>TRUE), $textHeaderStyle);
                $row->addCell(NULL, $cellstyle)->addText('('.$no.')',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
              
                // Insert Data
                for ($b = 0; $b < $nbaris; $b++){
                    $rowd = $table->addRow();
                    $first = TRUE;
                    for ($k = $mulai; $k <= $i; $k++){
                        if ($first){
                            $rowd->addCell()->addText($data_baris[$b]['no'].'. '.htmlspecialchars($data_baris[$b]['nama_baris']), NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                            $first = FALSE;
                        }
                        if (empty($data_tabel)){
                            $rowd->addCell()->addText($nodata, NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                        } else {
                            // $rowd->addCell()->addText($data_tabel[$nodata]['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                            $bar = $b+1;
                            $kol = $k+1;
                            $datrow = $this->getExactData($data_tabel, $bar, $kol);
                            if ($datrow!= NULL){
                                $rowd->addCell()->addText($datrow['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                            }else{
                                $rowd->addCell()->addText('', NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                            }
                        }
                        $nodata++;                                           
                    }
                }
                
                // End Insert Data

                //Jumlah
                if ($type_endrow != 0){
                    if ($type_endrow = 2){
                        $typerow = 98;
                    }
                    $cellstylejumlah = array('borderTopSize' => 10,'borderTopColor' => '000000');
                    $rowjum = $table->addRow();
                    $firstk = TRUE;
                    for ($kj = $mulai; $kj <= $i; $kj++){
                        if ($firstk){
                            $rowjum->addCell(NULL,$cellstylejumlah)->addText($kecname, array('bold'=> TRUE), array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40));
                            $firstk = FALSE;
                        }
                        $kol = $kj+1;
                        $datrowjum = $this->getExactData($endrow, $typerow, $kol);
                        if (empty($endrow)||empty($datrowjum)){
                            $rowjum->addCell(NULL, $cellstylejumlah)->addText('NA.'.$kol, NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                        } else if($datrowjum != NULL){                            
                            $rowjum->addCell(NULL, $cellstylejumlah)->addText($datrowjum['data'], array('bold'=> TRUE), array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                        }                           
                    }
                }
                
                //end jumlah
                $mulai = $i+1;

                if(($mulai) != $nkolom){
                    $section->addPageBreak();
                    $section->addTextBreak(1);
                    $section->addText('Lanjutan Tabel '.$datac['nomor']);
                    $table = $section->addTable(
                        array(
                            'borderTopSize' => 10,
                            'borderBottomSize'=>10,
                            'borderColor' => '000000',
                            'width' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10.8),
                            'unit' => 'dxa'
                        )            
                    );
                    $cellstyle = array('borderBottomSize' => 10,'borderBottomColor' => '000000');
                    $textHeaderStyle = array('alignment'=>'center','spaceAfter'=> 100, 'spaceBefore'=>100);
                    
                    $rowheader = $table->addRow();
                    $row = $table->addRow();
                    $rowheader->addCell(NULL, $cellstyle)
                            ->addText($datac['judul_baris'], array('bold'=>TRUE), $textHeaderStyle);
                    $row->addCell(NULL, $cellstyle)->addText('(1)',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
                }
                
            }else{
                $akhir = $i;
                $no++;
                $rowheader->addCell(NULL, $cellstyle)
                          ->addText($data_kolom[$i]['nama_kolom'], array('bold'=>TRUE), $textHeaderStyle);
                $row->addCell(NULL, $cellstyle)->addText('('.$no.')',NULL, array('alignment'=>'center', 'spaceAfter'=>10,'spaceBefore'=>10));
            }           
        };

        if ($nkolom % $splitcolumn != 0){
            for ($b = 0; $b < $nbaris; $b++){
                $rowd = $table->addRow();
                $first = TRUE;
                for ($k = $mulai; $k <= $akhir; $k++){
                    if ($first){
                        $rowd->addCell()->addText($data_baris[$b]['no'].'. '.htmlspecialchars($data_baris[$b]['nama_baris']), NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                        $first = FALSE;
                    }
                        if (empty($data_tabel)){
                            $rowd->addCell()->addText($nodata, NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                        } else {
                            // $rowd->addCell()->addText($data_tabel[$nodata]['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                            $bar = $b+1;
                            $kol = $k+1;
                            $datrow = $this->getExactData($data_tabel, $bar, $kol);
                            if ($datrow!= NULL){
                                $rowd->addCell()->addText($datrow['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                            }else{
                                $rowd->addCell()->addText('', NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                            }
                        }
                        $nodata++;                    
                }
            }
            
            //Jumlah
            if ($type_endrow != 0){
                if ($type_endrow = 2){
                    $typerow = 98;
                }
                $cellstylejumlah = array('borderTopSize' => 10,'borderTopColor' => '000000');
                $rowjum = $table->addRow();
                $firstk = TRUE;
                for ($k = $mulai; $k <= $akhir; $k++){
                    if ($firstk){
                        $rowjum->addCell(NULL,$cellstylejumlah)->addText($kecname, array('bold'=> TRUE), array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40));
                        $firstk = FALSE;
                    }
                    $kol = $k+1;
                    $datrowjum = $this->getExactData($endrow, $typerow, $kol);
                    if (empty($endrow)||empty($datrowjum)){
                        $rowjum->addCell(NULL, $cellstylejumlah)->addText('NA.'.$kol, NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    } else if($datrowjum != NULL){                            
                        $rowjum->addCell(NULL, $cellstylejumlah)->addText($datrowjum['data'], array('bold'=> TRUE), array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    }   
                    
                }
            }
            
            // end Jumlah

        }
        

        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));
        // untuk sumber dan keterangan
        
        $tabelmeta = $section->addTable();
        
        if (($datac['keterangan'] != NULL) && ($datac['keterangan'] != '') && ($datac['keterangan'] != ' ')) {
            $rowmeta1 = $tabelmeta->addRow();
            $rowmeta1->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2))->addText('Keterangan');
            $rowmeta1->addCell()->addText(':'.$datac['keterangan']);
        }

        $rowmeta2 = $tabelmeta->addRow();
        $rowmeta2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2))->addText('Sumber');
        $rowmeta2->addCell()->addText(':'.$datac['sumber']);
    }

    function addTable($section, $datac){
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);

        if (($nbaris <= 21) && ($nkolom <= 4)){
            $this->addDefaultTable($section, $datac);
        } else if (($nbaris <= 21) && ($nkolom > 4)){
            $this->addSplitColumn(4, $section, $datac);
        } else if (($nbaris > 21) && ($nkolom <= 4)){
            $this->addSplitRowTable(21, $section, $datac);
        } else if (($nbaris > 21) && ($nkolom > 4)){
            $this->addSplitRownColumn(21, 4, $section, $datac);
        }
    }
    



    public function bab1indo($phpword, $idbuku, $idkec){
        $notabel = '1.1.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $kecname = $datac['kecamatan'];

        // $section = $phpword->addSection(["paperSize" => "A5"]);
        $section = $phpword->addSection();
        $sectionStylePT = $section->getStyle();
        $sectionStylePT->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setPaperSize('A5');
        $sectionStylePT->setPageNumberingStart(1);
        
        // set header even page    
        $phpword->getSettings()->setEvenAndOddHeaders(true);        
        
        $header = $section->addHeader('even');        
        $textrun = $header->addTextRun(array('alignment'=>'start'));
        $textrun->addText('Geografi dan iklim', array('allCaps'=> TRUE, 'bold'=> TRUE));
        
        //set header odd page
        $header = $section->addHeader();        
        $textrun = $header->addTextRun(array('alignment'=>'end'));
        $textrun->addText('Geografi dan iklim', array('allCaps'=> TRUE, 'bold'=> TRUE));
        

        //table style for footer
        $TableStyle = array('borderTopSize' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0.5), 'borderTopColor' => 'B9D9EB');
        $TableStyleName = 'Footer Table';
        $phpword->addTableStyle($TableStyleName, $TableStyle);
    
        //set footer even page
        $footer = $section->addFooter('even');
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'start', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
       

        
        //set footer odd page
        $footer = $section->addFooter();
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'end', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        

        //paragraph
        $firstlineindent = \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1);
        $pstylename = 'Paragragh Default';
        $phpword->addParagraphStyle(
            $pstylename,
            array('alignment'=>'both', 'indentation' => array('firstLine' => $firstlineindent))
        );

        $phpword->setDefaultFontName('Calibri');
        $phpword->setDefaultFontSize(9);
        $phpword->getSettings()->setMirrorMargins(true);

        // ----------------------------------------------------------------
        // ---------------------Set Nama dan Judul Bab---------------------
        // ----------------------------------------------------------------
        $section->addTitle('1. Geografi dan Iklim', 1);
        $section->addPageBreak();

        $section->addText("Penjelasan Teknis", array('bold'=> TRUE, 'allCaps'=> TRUE,'size'=>11), array('alignment'=>'center', 'spaceAfter' => 240));
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Koordinat', array('bold'=> TRUE));
        $textrun->addText(' adalah suatu titik yang didapatkan dari hasil perpotongan dari garis latitude (lintang) dengan garis bujur (longitude) sehingga akan menunjukan lokasi pada suatu daerah.');
        
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Kelurahan', array('bold'=> TRUE));
        $textrun->addText(' adalah daerah pemerintahan yg paling bawah yang dipimpin oleh seorang lurah.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Desa/Kelurahan Tepi Laut', array('bold'=> TRUE));
        $textrun->addText(' adalah desa/kelurahan yang sebagian atau seluruh wilayahnya bersinggungan langsung dengan laut, baik berupa pantai, hutan mangrove maupun tebing karang');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Desa/Kelurahan Lereng/Puncak', array('bold'=> TRUE));
        $textrun->addText(' adalah desa/kelurahan yang sebagian besar wilayahnya berada di puncak gunung/pegunungan atau terletak di antara puncak sampai lembah');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Desa/Kelurahan lembah', array('bold'=> TRUE));
        $textrun->addText(' adalah desa/kelurahan yang wilayahnya sebagian besar merupakan daerah rendah yang terletak di antara dua gunung/pegunungan atau daerah yang kedudukannya lebih rendah dibandingkan daerah sekitarnya.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Desa/Kelurahan Dataran', array('bold'=> TRUE));
        $textrun->addText(' adalah desa/kelurahan yang sebagian besar wilayahnya tampak datar, rata, dan membentang.');

        $section->addPageBreak();
       
        // Judul Gambar
        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Gambar', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText(1, array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText('Luas Wilayah Menurut Desa/Kelurahan di Kecamatan '.$kecname, array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'both'));
        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));
        $section->addPageBreak();

        //Table 1.1.1
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel

        //Table 1.1.2
        $notabel = '1.1.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel
        

        // Judul Table 1.1.4
        $notabel = '1.1.4';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        // end of tabel      
                
        return $phpword;
    }





    public function bab2indo($phpword, $idbuku, $idkec){
        $notabel = '2.1.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $kecname = $datac['kecamatan'];   
        // $section = $phpword->addSection(["paperSize" => "A5"]);
        $section = $phpword->addSection();
        $sectionStylePT = $section->getStyle();
        $sectionStylePT->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setPaperSize('A5');

        // set header even page    
        $phpword->getSettings()->setEvenAndOddHeaders(true); 
        
        
        $header = $section->addHeader('even');        
        $textrun = $header->addTextRun(array('alignment'=>'start'));
        $textrun->addText('pemerintahan', array('allCaps'=> TRUE, 'bold'=> TRUE));
        
        //set header odd page
        $header = $section->addHeader();        
        $textrun = $header->addTextRun(array('alignment'=>'end'));
        $textrun->addText('pemerintahan', array('allCaps'=> TRUE, 'bold'=> TRUE));
        

        //table style for footer
        $TableStyle = array('borderTopSize' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0.5), 'borderTopColor' => 'B9D9EB');
        $TableStyleName = 'Footer Table';
        $phpword->addTableStyle($TableStyleName, $TableStyle);
    
        //set footer even page
        $footer = $section->addFooter('even');
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'start', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
       
        //set footer odd page
        $footer = $section->addFooter();
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'end', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        

        //paragraph
        $firstlineindent = \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1);
        $pstylename = 'Paragragh Default';
        $phpword->addParagraphStyle(
            $pstylename,
            array('alignment'=>'both', 'indentation' => array('firstLine' => $firstlineindent))
        );

        $phpword->setDefaultFontName('Calibri');
        $phpword->setDefaultFontSize(9);
        $phpword->getSettings()->setMirrorMargins(true);

        // ----------------------------------------------------------------
        // ---------------------Set Nama dan Judul Bab---------------------
        // ----------------------------------------------------------------

        $section->addTitle('2. Pemerintahan',1);
        $section->addPageBreak();

        $section->addText("Penjelasan Teknis", array('bold'=> TRUE, 'allCaps'=> TRUE,'size'=>11), array('alignment'=>'center', 'spaceAfter' => 240));
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Satuan Lingkungan Setempat (SLS)', array('bold'=> TRUE));
        $textrun->addText(' adalah satuan wilayah di bawah desa/kelurahan. Tingkatan dan nama SLS bisa berbeda antar daerah, seperti Rukun Tetangga (RT), Rukun Warga (RW), jorong, dusun, dan lingkungan');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Perangkat Desa', array('bold'=> TRUE));
        $textrun->addText(' adalah unsur staf yang membantu Kepala Des adalam penyusunan kebijakan dan koordinasi yang diwadahi dalam Sekretariat Desa, dan unsur pendukung tugas Kepala Desa dalam pelaksanaan kebijakan yang diwadahi dalam bentuk pelaksana teknis dan unsur kewilayahan.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Desa Swadaya', array('bold'=> TRUE));
        $textrun->addText(
            ' adalah desa yang memiliki potensi tertentu tetapi dikelola dengan sebaik-baiknya, dengan ciri: '.
            'daerahnya terisolir dengan daerah lainnya, '.
            'penduduknya jarang, '.
            'mata pencaharian homogen yang bersifat agraris, '.
            'bersifat tertutup, '.
            'masyarakat memegang teguh adat. '.
            'teknologi masih rendah, '.
            'sarana dan prasarana sangat kurang, '.
            'hubungan antarmanusia sangat erat, '.
            'pengawasan sosial dilakukan oleh keluarga.'
        );

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Desa Swakarya', array('bold'=> TRUE));
        $textrun->addText(
            ' adalah peralihan atau transisi dari desa swadaya menuju desa swasembada. Ciri-ciri desa swakarya adalah: '.
            'kebiasaan atau adat istiadat sudah tidak mengikat penuh, '.
            'sudah mulai mempergunakan alat-alat dan teknologi, '.
            'desa swakarya sudah tidak terisolasi lagi walau letaknya jauh dari pusat perekonomian, '.
            'telah memiliki tingkat perekonomian, pendidikan, jalur lalu lintas dan prasarana lain, '.
            'jalur lalu lintas antara desa dan kota sudah agak lancar.'
        );

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Desa Swasembada', array('bold'=> TRUE));
        $textrun->addText(
            ' adalah desa yang masyarakatnya telah mampu memanfaatkan dan mengembangkan sumber daya alam dan potensinya sesuai dengan kegiatan pembangunan regional. Ciri-ciri desa swasembada yaitu: '.
            'kebanyakan berlokasi di ibu kota kecamatan, '.
            'tingkat kepadatan penduduk tergolong tinggi, '.
            'tidak terikat dengan adat istiadat, '.
            'telah memiliki fasilitas-fasilitas yang memadai dan lebih maju dari desa lain, '.
            'partisipasi masyarakatnya sudah lebih efektif.'
        );

        // Judul Gambar
        $section->addPageBreak();
        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Gambar', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText(2, array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText('Klasifikasi Desa/Kelurahan menurut Tingkat Perkembangan di Kecamatan '.$kecname, array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'both'));
        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));
        $section->addPageBreak();


        // Judul Table 2.1.1
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel

        // Judul Table 2.1.2
        $notabel = '2.1.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of table


        // Judul Table 2.1.3
        $notabel = '2.1.3';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of table

        // Judul Table 2.1.4
        $notabel = '2.1.4';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of table

        // Judul Table 2.1.5
        $notabel = '2.1.5';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        // end of table      

        return $phpword;
    }





    public function bab3indo($phpword, $idbuku, $idkec){
        $notabel = '3.1.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $kecname = $datac['kecamatan'];   

        $section = $phpword->addSection();
        $sectionStylePT = $section->getStyle();
        $sectionStylePT->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setPaperSize('A5');

        // set header even page    
        $phpword->getSettings()->setEvenAndOddHeaders(true); 
        
        
        $header = $section->addHeader('even');        
        $textrun = $header->addTextRun(array('alignment'=>'start'));
        $textrun->addText('kependudukan', array('allCaps'=> TRUE, 'bold'=> TRUE));
        
        //set header odd page
        $header = $section->addHeader();        
        $textrun = $header->addTextRun(array('alignment'=>'end'));
        $textrun->addText('kependudukan', array('allCaps'=> TRUE, 'bold'=> TRUE));
        

        //table style for footer
        $TableStyle = array('borderTopSize' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0.5), 'borderTopColor' => 'B9D9EB');
        $TableStyleName = 'Footer Table';
        $phpword->addTableStyle($TableStyleName, $TableStyle);
    
        //set footer even page
        $footer = $section->addFooter('even');
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'start', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
       

        
        //set footer odd page
        $footer = $section->addFooter();
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'end', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        

        //paragraph
        $firstlineindent = \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1);
        $pstylename = 'Paragragh Default';
        $phpword->addParagraphStyle(
            $pstylename,
            array('alignment'=>'both', 'indentation' => array('firstLine' => $firstlineindent))
        );

        $phpword->setDefaultFontName('Calibri');
        $phpword->setDefaultFontSize(9);
        $phpword->getSettings()->setMirrorMargins(true);

        // ----------------------------------------------------------------
        // ---------------------Set Nama dan Judul Bab---------------------
        // ----------------------------------------------------------------


        $section->addTitle('3. Kependudukan',1);
        $section->addPageBreak();

        $section->addText("Penjelasan Teknis", array('bold'=> TRUE, 'allCaps'=> TRUE,'size'=>11), array('alignment'=>'center', 'spaceAfter' => 240));
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Penduduk Indonesia', array('bold'=> TRUE));
        $textrun->addText(' adalah semua orang yang berdomisili di wilayah teritorial Indonesia'
                            .'selama 6 bulan atau lebih dan atau mereka yang berdomisili kurang'
                            .' dari 6 bulan tetapi bertujuan menetap.');
        
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Laju Pertumbuhan Penduduk', array('bold'=> TRUE));
        $textrun->addText(' adalah angka yang menunjukkan persentase pertambahan penduduk dalam jangka waktu tertentu.');
        
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Distribusi Penduduk', array('bold'=> TRUE));
        $textrun->addText(' adalah pola persebaran penduduk di suatu wilayah, baik berdasarkan'
                            .'batas-batas geografis maupun berdasarkan batas-batas administrasi pemerintahan.');
        
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Kepadatan Penduduk', array('bold'=> TRUE));
        $textrun->addText(' adalah perbandingan antara jumlah penduduk dan luas daerah yang ditempati. Kepadatan'
                            .'penduduk menggunakan satuan penduduk jiwa per kilometer persegi.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Rasio Jenis Kelamin', array('bold'=> TRUE));
        $textrun->addText(' adalah perbandingan antara penduduk laki-laki dan penduduk perempuan' 
                            .'pada suatu wilayah dan waktu tertentu. Biasanya dinyatakan dengan banyaknya penduduk laki-laki untuk 100 penduduk perempuan.');
        
        // Judul Gambar
        $section->addPageBreak();
        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                ->addText('Gambar', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                ->addText(3, array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                ->addText('Rasio Jenis Kelamin di Kecamatan '.$kecname, array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'both'));
        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));
        $section->addPageBreak();


        // Judul Table 3.1.1
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel


        // Judul Table 3.1.2
        $notabel = '3.1.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of table     
        
        // Judul Table 3.1.3
        $notabel = '3.1.3';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        // end of table   
        
        return $phpword;
    }





    public function bab4indo($phpword, $idbuku, $idkec){
        $notabel = '4.1.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $kecname = $datac['kecamatan'];   

        $section = $phpword->addSection();
        $sectionStylePT = $section->getStyle();
        $sectionStylePT->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setPaperSize('A5');

        // set header even page    
        $phpword->getSettings()->setEvenAndOddHeaders(true); 
        
        
        $header = $section->addHeader('even');        
        $textrun = $header->addTextRun(array('alignment'=>'start'));
        $textrun->addText('Sosial dan Kesejahteraan', array('allCaps'=> TRUE, 'bold'=> TRUE));
        
        //set header odd page
        $header = $section->addHeader();        
        $textrun = $header->addTextRun(array('alignment'=>'end'));
        $textrun->addText('Sosial dan Kesejahteraan', array('allCaps'=> TRUE, 'bold'=> TRUE));
        

        //table style for footer
        $TableStyle = array('borderTopSize' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0.5), 'borderTopColor' => 'B9D9EB');
        $TableStyleName = 'Footer Table';
        $phpword->addTableStyle($TableStyleName, $TableStyle);
    
        //set footer even page
        $footer = $section->addFooter('even');
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'start', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
       

        
        //set footer odd page
        $footer = $section->addFooter();
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'end', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        

        //paragraph
        $firstlineindent = \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1);
        $pstylename = 'Paragragh Default';
        $phpword->addParagraphStyle(
            $pstylename,
            array('alignment'=>'both', 'indentation' => array('firstLine' => $firstlineindent))
        );

        $phpword->setDefaultFontName('Calibri');
        $phpword->setDefaultFontSize(9);
        $phpword->getSettings()->setMirrorMargins(true);

        // ----------------------------------------------------------------
        // ---------------------Set Nama dan Judul Bab---------------------
        // ----------------------------------------------------------------


        $section->addTitle('4. Sosial dan Kesejahteraan',1);
        $section->addPageBreak();

        $section->addText("Penjelasan Teknis", array('bold'=> TRUE, 'allCaps'=> TRUE,'size'=>11), array('alignment'=>'center', 'spaceAfter' => 240));
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Jenjang Pendidikan Formal', array('bold'=> TRUE));
        $textrun->addText(' terdiri atas pendidikan dasar, pendidikan menengah, dan pendidikan tinggi. '
                          .'Jenis pendidikan yang diajarkan mencakup pendidikan umum, kejuruan, akademik, profesi, vokasi, keagamaan, dan khusus.');
        
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Pendidikan Dasar', array('bold'=> TRUE));
        $textrun->addText(' berbentuk Sekolah Dasar (SD) dan Madrasah Ibtidaiyah (MI) atau bentuk lain yang '
                          .'sederajat serta Sekolah Menengah Pertama (SMP) dan Madrasah Tsanawiyah (MTs), atau bentuk lain yang sederajat.');
        
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Pendidikan Menengah', array('bold'=> TRUE));
        $textrun->addText(' berbentuk Sekolah Menengah Atas (SMA), Madrasah Aliyah (MA), Sekolah Menengah '
                          .'Kejuruan (SMK), dan Madrasah Aliyah Kejuruan (MAK), atau bentuk lain yang sederajat.');
        
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Pendidikan Tinggi', array('bold'=> TRUE));
        $textrun->addText(' merupakan jenjang pendidikan setelah pendidikan menengah yang mencakup program pendidikan '
                          .'diploma, sarjana, magister, spesialis, dan doktor yang diselenggarakan oleh perguruan tinggi. ' 
                          .'Perguruan tinggi dapat berbentuk akademi, politeknik, sekolah tinggi, institut, atau universitas.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Rumah Sakit', array('bold'=> TRUE));
        $textrun->addText(' adalah tempat pemeriksaan dan perawatan kesehatan, biasanya berada di bawah pengawasan '
                         .'dokter/tenaga medis, yang melayani penderita yang sakit untuk berobat rawat jalan atau rawat inap.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Rumah Sakit Bersalin', array('bold'=> TRUE));
        $textrun->addText(' adalah rumah sakit khusus untuk persalinan, dilengkapi pelayanan spesialis pemeriksaan kehamilan, '
                         .'persalinan, rawat inap dan rawat jalan ibu dan anak yang berada di bawah pengawasan dokter spesialis kandungan.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Rumah Bersalin', array('bold'=> TRUE));
        $textrun->addText(' adalah sarana pelayanan kesehatan dengan izin sebagai rumah bersalin, dilengkapi pelayanan '
                         .'pemeriksaan kehamilan, persalinan serta pemeriksaan ibu dan anak yang berada di bawah pengawasan bidan senior.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Poliklinik', array('bold'=> TRUE));
        $textrun->addText(' adalah sarana kesehatan yang dipakai untuk pelayanan berobat jalan, biasanya berada dibawah pengawasan dokter/tenaga medis.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Puskesmas (Pusat Kesehatan Masyarakat)', array('bold'=> TRUE));
        $textrun->addText(' adalah unit pelaksana teknis dinas kesehatan kabupaten/ kota yang mempunyai fungsi utama sebagai '
                         .'penyelenggara pelayanan kesehatan tingkat pertama. Wilayah kerja puskesmas maksimal adalah satu '
                         .'Distrik dan untuk dapat menjangkau wilayah kerjanya, puskesmas mempunyai jaringan pelayanan yang '
                         .'meliputi unit Puskesmas Pembantu (Pustu), unit Puskesmas Keliling (Puskel) dan unit bidan desa.');
        
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Apotek', array('bold'=> TRUE));
        $textrun->addText(' adalah suatu tempat tertentu yang digunakan untuk melakukan pekerjaan kefarmasian, dan '
                         .'penyaluran/penjualan obat atau bahan farmasi dan perbekalan kesehatan lainnya kepada masyarakat yang dikelola oleh tenaga apoteker.');                

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Bencana Alam', array('bold'=> TRUE));
        $textrun->addText(' adalah peristiwa atau serangkaian peristiwa yang mengancam dan mengganggu kehidupan/penghidupan '
                         .'masyarakat yang disebabkan oleh faktor alam antara lain berupa gempa bumi, tsunami, gunung meletus, '
                         .'banjir, kekeringan, angin topan, dan tanah longsor sehingga mengakibatkan kerugian materi maupun non-materi.');             
        
        // Judul Gambar
        $section->addPageBreak();
        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Gambar', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText(4, array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText('Jumlah Sekolah Formal Menurut Jenjang Pendidikan di Kecamatan '.$kecname, array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'both'));
        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));
        $section->addPageBreak();

        // Judul Table 4.1.1
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel

        //Table 4.1.2
        $notabel = '4.1.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 4.1.3
        $notabel = '4.1.3';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 4.1.4
        $notabel = '4.1.4';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 4.1.5
        $notabel = '4.1.5';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 4.1.6
        $notabel = '4.1.6';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 4.1.7
        $notabel = '4.1.7';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 4.1.8
        $notabel = '4.1.8';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 4.1.9
        $notabel = '4.1.9';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 4.1.10
        $notabel = '4.1.10';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 4.1.11
        $notabel = '4.1.11';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 4.2.1
        $notabel = '4.2.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 4.2.2
        $notabel = '4.2.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 4.2.3
        $notabel = '4.2.3';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 4.3.1
        $notabel = '4.3.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table
        
        //Table 4.3.2
        $notabel = '4.3.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 4.3.3
        $notabel = '4.3.3';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        //end of table

        return $phpword;
    }




    public function bab5indo($phpword, $idbuku, $idkec){
        $notabel = '5.1.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $kecname = $datac['kecamatan'];   

        $section = $phpword->addSection();
        $sectionStylePT = $section->getStyle();
        $sectionStylePT->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setPaperSize('A5');

        // set header even page    
        $phpword->getSettings()->setEvenAndOddHeaders(true); 
        
        
        $header = $section->addHeader('even');        
        $textrun = $header->addTextRun(array('alignment'=>'start'));
        $textrun->addText('Pertanian', array('allCaps'=> TRUE, 'bold'=> TRUE));
        
        //set header odd page
        $header = $section->addHeader();        
        $textrun = $header->addTextRun(array('alignment'=>'end'));
        $textrun->addText('Pertanian', array('allCaps'=> TRUE, 'bold'=> TRUE));
        

        //table style for footer
        $TableStyle = array('borderTopSize' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0.5), 'borderTopColor' => 'B9D9EB');
        $TableStyleName = 'Footer Table';
        $phpword->addTableStyle($TableStyleName, $TableStyle);
    
        //set footer even page
        $footer = $section->addFooter('even');
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'start', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
       

        
        //set footer odd page
        $footer = $section->addFooter();
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'end', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        

        //paragraph
        $firstlineindent = \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1);
        $pstylename = 'Paragragh Default';
        $phpword->addParagraphStyle(
            $pstylename,
            array('alignment'=>'both', 'indentation' => array('firstLine' => $firstlineindent))
        );

        $phpword->setDefaultFontName('Calibri');
        $phpword->setDefaultFontSize(9);
        $phpword->getSettings()->setMirrorMargins(true);

        // ----------------------------------------------------------------
        // ---------------------Set Nama dan Judul Bab---------------------
        // ----------------------------------------------------------------


        $section->addTitle('5. Pertanian', 1);
        $section->addPageBreak();

        $section->addText("Penjelasan Teknis", array('bold'=> TRUE, 'allCaps'=> TRUE,'size'=>11), array('alignment'=>'center', 'spaceAfter' => 240));
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Padi', array('bold'=> TRUE));
        $textrun->addText(' terdiri dari padi sawah dan padi ladang.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Padi Sawah', array('bold'=> TRUE));
        $textrun->addText(' adalah padi yang ditanam di lahan sawah.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Lahan Sawah', array('bold'=> TRUE));
        $textrun->addText(' adalah lahan pertanian yang berpetak-petak dan dibatasi oleh pematang (galengan), '
                         .'saluran untuk menahan/menyalurkan air, yang biasanya ditanami padi sawah tanpa memandang '
                         .'dari mana diperolehnya atau status lahan tersebut. Termasuk disini lahan yang terdaftar '
                         .'di Pajak Hasil Bumi, Iuran Pembangunan Daerah, lahan bengkok, lahan serobotan, lahan rawa '
                         .'yang ditanami padi dan lahan-lahan bukaan baru. Lahan sawah mencakup sawah pengairan, tadah '
                         .'hujan, sawah pasang surut, rembesan, lebak dan lain sebagainya');
        
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Padi Ladang', array('bold'=> TRUE));
        $textrun->addText(' adalah padi yang ditanam di tegal/kebun/ladang atau huma.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Embung', array('bold'=> TRUE));
        $textrun->addText(' adalah bangunan yang berfungsi menampung kelebihan air yang terjadi pada musim hujan untuk persediaan suatu desa di musim kering.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Tanaman Hias', array('bold'=> TRUE));
        $textrun->addText(' adalah tanaman yang mempunyai nilai keindahan baik bentuk, warna daun, '
                         .'tajuk maupun bunganya, sering digunakan untuk penghias pekarangan dan lain sebagainya.');
        
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Tanaman Biofarma', array('bold'=> TRUE));
        $textrun->addText(' adalah tanaman yang bermanfaat untuk obat-obatan, kosmetik, dan kesehatan'
                         .'yang dikonsumsi atau digunakan dari bagian-bagian tanaman seperti daun, batang, buah, umbi (rimpang) ataupun akar.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Rumah Tangga Perikanan Tangkap', array('bold'=> TRUE));
        $textrun->addText(' adalah rumah tangga yang melakukan kegiatan penangkapan ikan/binatang air '
                         .'lainnya/tanaman air dengan tujuan sebagian/seluruh hasilnya untuk dijual.');
    
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Rumah Tangga Perikanan Budidaya', array('bold'=> TRUE));
        $textrun->addText(' adalah rumah tangga yang melakukan kegiatan budidaya ikan/binatang air '
                         .'lainnya/tanaman air dengan tujuan sebagian/seluruh hasilnya untuk dijual.');

        //Gambar
        $section->addPageBreak();
        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Gambar', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText(5, array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText('Luas Panen Komoditas Palawija di Kecamatan '.$kecname, array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'both'));
        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));
        $section->addPageBreak();

        // Judul Table 5.1.1
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel

        //Table 5.1.2
        $notabel = '5.1.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.1.3
        $notabel = '5.1.3';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.1.4
        $notabel = '5.1.4';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.1.5
        $notabel = '5.1.5';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.1.6
        $notabel = '5.1.6';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.1.7
        $notabel = '5.1.7';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.1.8
        $notabel = '5.1.8';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table
        
        //Table 5.1.9
        $notabel = '5.1.9';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.1.10
        $notabel = '5.1.10';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.1.11
        $notabel = '5.1.11';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.1.12
        $notabel = '5.1.12';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.1.13
        $notabel = '5.1.13';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.1.14
        $notabel = '5.1.14';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.1.15
        $notabel = '5.1.15';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.1.16
        $notabel = '5.1.16';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.1.17
        $notabel = '5.1.17';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.2.1
        $notabel = '5.2.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.2.2
        $notabel = '5.2.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.3.1
        $notabel = '5.3.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.3.2
        $notabel = '5.3.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.3.3
        $notabel = '5.3.3';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.4.1
        $notabel = '5.4.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.4.2
        $notabel = '5.4.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        //end of table

        //Table 5.4.3
        $notabel = '5.4.3';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        //end of table

        return $phpword;
    }




    public function bab6indo($phpword, $idbuku, $idkec){
        $notabel = '6.1.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $kecname = $datac['kecamatan'];
        $kabname = $datac['kabupaten'];   

        $section = $phpword->addSection();
        $sectionStylePT = $section->getStyle();
        $sectionStylePT->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setPaperSize('A5');

        // set header even page    
        $phpword->getSettings()->setEvenAndOddHeaders(true); 
        
        
        $header = $section->addHeader('even');        
        $textrun = $header->addTextRun(array('alignment'=>'start'));
        $textrun->addText('Industri dan energi', array('allCaps'=> TRUE, 'bold'=> TRUE));
        
        //set header odd page
        $header = $section->addHeader();        
        $textrun = $header->addTextRun(array('alignment'=>'end'));
        $textrun->addText('industri dan energi', array('allCaps'=> TRUE, 'bold'=> TRUE));
        

        //table style for footer
        $TableStyle = array('borderTopSize' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0.5), 'borderTopColor' => 'B9D9EB');
        $TableStyleName = 'Footer Table';
        $phpword->addTableStyle($TableStyleName, $TableStyle);
    
        //set footer even page
        $footer = $section->addFooter('even');
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'start', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
       

        
        //set footer odd page
        $footer = $section->addFooter();
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'end', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        

        //paragraph
        $firstlineindent = \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1);
        $pstylename = 'Paragragh Default';
        $phpword->addParagraphStyle(
            $pstylename,
            array('alignment'=>'both', 'indentation' => array('firstLine' => $firstlineindent))
        );

        $phpword->setDefaultFontName('Calibri');
        $phpword->setDefaultFontSize(9);
        $phpword->getSettings()->setMirrorMargins(true);

        // ----------------------------------------------------------------
        // ---------------------Set Nama dan Judul Bab---------------------
        // ----------------------------------------------------------------


        $section->addTitle('6. Industri dan Energi',1);
        $section->addPageBreak();

        $section->addText("Penjelasan Teknis", array('bold'=> TRUE, 'allCaps'=> TRUE,'size'=>11), array('alignment'=>'center', 'spaceAfter' => 240));
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Pelanggan', array('bold'=> TRUE));
        $textrun->addText(' adalah individu atau kelompok, baik rumah tangga, perusahaan atau '
                         .'institusi non profit yang membeli air bersih dari perusahaan air bersih.');
                         
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Air Kemasan', array('bold'=> TRUE));
        $textrun->addText(' adalah air yang diproduksi oleh suatu perusahaan melalui proses yang higienis dan terdaftar di kementerian kesehatan.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Ledeng dengan meteran (PAM/PDAM)', array('bold'=> TRUE));
        $textrun->addText(' adalah air yang diproduksi melalui penjernihan dan penyehatan sebelum dialirkan '
                         .'kepada konsumen melalui suatu instalasi berupa saluran air. Sumber air ini diusahakan '
                         .'oleh Perusahaan Air Minum (PAM), Perusahaan Daerah Air Minum (PDAM), atau Badan Pengelola '
                         .'Air Minum (BPAM), baik dikelola oleh pemerintah maupunswasta.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Ledeng tanpa meteran', array('bold'=> TRUE));
        $textrun->addText(' adalah air yang diproduksi melalui proses penjernihan dan penyehatan (air PAM) namun '
                        .'disalurkan ke konsumen melalui pedagang air keliling/pikulan.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Sumur bor/pompa', array('bold'=> TRUE));
        $textrun->addText(' adalah air tanah yang cara pengambilannya dengan pompa tangan, pompa listrik, atau kincir angin, termasuk sumur artesis (sumur pantek)');
        
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Sumur', array('bold'=> TRUE));
        $textrun->addText(' adalah air dalam tanah yang cara pengambilannya dengan menggunakan gayung atau ember, '
        .'baik dengan menggunakan katrol maupun tidak. Air sumur dikelompokkan menjadi 2 kategori, yaitu sumur terlindung dan tidak terlindung.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Mata Air', array('bold'=> TRUE));
        $textrun->addText(' adalah sumber air permukaan tanah di mana air timbul dengan sendirinya (alami). Mata air dikelompokkan menjadi 2 kategori, yaitu mata air terlindung dan tidak terlindung.');


        //Gambar
        $section->addPageBreak();
        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Gambar', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText(6, array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText('Jumlah Pelanggan Listrik PLN Menurut Jenis di Kabupaten '.$kabname, array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'both'));
        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));
        $section->addPageBreak();

        // Judul Table 6.1.1
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel

        // Judul Table 6.1.2
        $notabel = '6.1.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel

        // Judul Table 6.1.3
        $notabel = '6.1.3';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel

        // Judul Table 6.1.4
        $notabel = '6.1.4';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel


        // Judul Table 6.2.1
        $notabel = '6.2.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel

        // Judul Table 6.2.2
        $notabel = '6.2.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        // end of tabel

        return $phpword;
    }






    public function bab7indo($phpword, $idbuku, $idkec){
        $notabel = '7.1.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $kecname = $datac['kecamatan'];
        $kabname = $datac['kabupaten'];   

        $section = $phpword->addSection();
        $sectionStylePT = $section->getStyle();
        $sectionStylePT->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setPaperSize('A5');

        // set header even page    
        $phpword->getSettings()->setEvenAndOddHeaders(true); 
        
        
        $header = $section->addHeader('even');        
        $textrun = $header->addTextRun(array('alignment'=>'start'));
        $textrun->addText('Transportasi dan Komunikasi', array('allCaps'=> TRUE, 'bold'=> TRUE));
        
        //set header odd page
        $header = $section->addHeader();        
        $textrun = $header->addTextRun(array('alignment'=>'end'));
        $textrun->addText('Transportasi dan Komunikasi', array('allCaps'=> TRUE, 'bold'=> TRUE));
        

        //table style for footer
        $TableStyle = array('borderTopSize' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0.5), 'borderTopColor' => 'B9D9EB');
        $TableStyleName = 'Footer Table';
        $phpword->addTableStyle($TableStyleName, $TableStyle);
    
        //set footer even page
        $footer = $section->addFooter('even');
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'start', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
       

        
        //set footer odd page
        $footer = $section->addFooter();
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'end', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        

        //paragraph
        $firstlineindent = \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1);
        $pstylename = 'Paragragh Default';
        $phpword->addParagraphStyle(
            $pstylename,
            array('alignment'=>'both', 'indentation' => array('firstLine' => $firstlineindent))
        );

        $phpword->setDefaultFontName('Calibri');
        $phpword->setDefaultFontSize(9);
        $phpword->getSettings()->setMirrorMargins(true);

        // ----------------------------------------------------------------
        // ---------------------Set Nama dan Judul Bab---------------------
        // ----------------------------------------------------------------


        $section->addTitle('7. Transportasi dan Komunikasi',1);
        $section->addPageBreak();

        $section->addText("Penjelasan Teknis", array('bold'=> TRUE, 'allCaps'=> TRUE,'size'=>11), array('alignment'=>'center', 'spaceAfter' => 240));
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('BTS', array('bold'=> TRUE));
        $textrun->addText(' adalah alat yang berfungsi sebagai pengirim dan penerima (transceiver) sinyal komunikasi '
        .'seluler. BTS ditandai adanya menara/tower yang dilengkapi antena sebagai perangkat transceiver. Masyarakat '
        .'umum sering menyebutnya sebagai tower telepon seluler/handphone. BTS memfasilitasi komunikasi nirkabel antara '
        .'piranti komunikasi dan jaringan operator. Piranti komunikasi penerima sinyal BTS bisa telepon, telepon seluler, '
        .'jaringan nirkabel sementara operator jaringan yaitu GSM, CDMA, atau platform TDMA');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Operator layanan komunikasi telepon seluler', array('bold'=> TRUE));
        $textrun->addText(' adalah operator yang mengusahakan jaringan layanan komunikasi telepon seluler/handphone. '
        .'Operator selulerditandai adanya signal yang digunakan dalam telepon seluler.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Sinyal telepon seluler', array('bold'=> TRUE));
        $textrun->addText(' adalah besaran elektromagnetik yang berubah dalam ruang dan waktu dengan membawa informasi '
        .'yang memberikan konfirmasi bahwa layanan telepon seluler sudah tersedia. Telepon seluler yang dimaksud tidak '
        .'termasuk mobile phone satelit.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Sinyal internet telepon seluler', array('bold'=> TRUE));
        $textrun->addText(' merupakan jaringan sistem data paket internetdengan kecepatan transfer data tertentu. Paket '
        .'data disini biasanya digunakan dalam melakukan akses internet. Protokol transfer data ini mengalami beberapa '
        .'perubahan mulai dari GPRS, Edge, 3G, HSPA, kemudian 4G.');

        
        //Gambar
        $section->addPageBreak();
        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Gambar', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText(7, array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText('Jumlah Menara BTS di Kecamatan '.$kecname, array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'both'));
        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));
        $section->addPageBreak();

        // Judul Table 7.1.1
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel

        // Judul Table 7.1.2
        $notabel = '7.1.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel

        // Judul Table 7.2.1
        $notabel = '7.2.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel

        // Judul Table 7.2.2
        $notabel = '7.2.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        // end of tabel

        return $phpword;
    }





    public function bab8indo($phpword, $idbuku, $idkec){
        $notabel = '8.1.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $kecname = $datac['kecamatan'];
        $kabname = $datac['kabupaten'];   

        $section = $phpword->addSection();
        $sectionStylePT = $section->getStyle();
        $sectionStylePT->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setPaperSize('A5');

        // set header even page    
        $phpword->getSettings()->setEvenAndOddHeaders(true); 
        
        
        $header = $section->addHeader('even');        
        $textrun = $header->addTextRun(array('alignment'=>'start'));
        $textrun->addText('Keuangan dan Harga', array('allCaps'=> TRUE, 'bold'=> TRUE));
        
        //set header odd page
        $header = $section->addHeader();        
        $textrun = $header->addTextRun(array('alignment'=>'end'));
        $textrun->addText('Keuangan dan Hargai', array('allCaps'=> TRUE, 'bold'=> TRUE));
        

        //table style for footer
        $TableStyle = array('borderTopSize' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0.5), 'borderTopColor' => 'B9D9EB');
        $TableStyleName = 'Footer Table';
        $phpword->addTableStyle($TableStyleName, $TableStyle);
    
        //set footer even page
        $footer = $section->addFooter('even');
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'start', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
       
        
        //set footer odd page
        $footer = $section->addFooter();
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'end', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addPreserveText('{PAGE}', array('size'=>8 ), array('alignment'=>'center','spaceAfter'=> 0));
        

        //paragraph
        $firstlineindent = \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1);
        $pstylename = 'Paragragh Default';
        $phpword->addParagraphStyle(
            $pstylename,
            array('alignment'=>'both', 'indentation' => array('firstLine' => $firstlineindent))
        );

        $phpword->setDefaultFontName('Calibri');
        $phpword->setDefaultFontSize(9);
        $phpword->getSettings()->setMirrorMargins(true);

        // ----------------------------------------------------------------
        // ---------------------Set Nama dan Judul Bab---------------------
        // ----------------------------------------------------------------


        $section->addTitle('8. Keuangan dan Harga',1);
        $section->addPageBreak();

        $section->addText("Penjelasan Teknis", array('bold'=> TRUE, 'allCaps'=> TRUE,'size'=>11), array('alignment'=>'center', 'spaceAfter' => 240));
        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Kelompok pertokoan', array('bold'=> TRUE));
        $textrun->addText(' adalah sejumlah toko yang terdiri dari minimal 10 toko dan mengelompok dalam satu lokasi. '
        .'Dalam satu kelompok pertokoan, jumlah bangunan fisiknya bisa lebih dari satu.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Pasar', array('bold'=> TRUE));
        $textrun->addText(' adalah tempat pertemuan antara penjual dan pembeli barang dan jasa. Pasar bisa menggunakan '
        .'bangunan yang bersifat permanen atau semi permanen ataupun tanpa bangunan.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Pasar dengan bangunan permanen', array('bold'=> TRUE));
        $textrun->addText(' adalah pasar pada bangunan tetap, yang memliki lantai, atap, dan dinding permanen.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Pasar dengan bangunan semi permanen', array('bold'=> TRUE));
        $textrun->addText(' adalah pasar pada bangunan tetap, yang memiliki lantai dan atap, tetapi tanpa dinding.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Pasar tanpa bangunan', array('bold'=> TRUE));
        $textrun->addText(' adalah pasar yang tidak berada dalam bangunan termasuk pasar terapung, pasar subuh.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Minimarket', array('bold'=> TRUE));
        $textrun->addText(' adalah sistem pelayanan mandiri, menjual berbagai jenis barang secara eceran, dan semua '
        .'barang memiliki label harga, dengan luas bangunan kurang dari 400 meter persegi.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Toko/warung kelontong', array('bold'=> TRUE));
        $textrun->addText(' adalah bangunan yang berfungsi sebagai tempat usaha di bangunan tetap untuk menjual barang '
        .'keperluan sehari-hari secara eceran, tidak mempunyai sistem pelayanan mandiri dikelola oleh satu penjual.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Restoran', array('bold'=> TRUE));
        $textrun->addText(' adalah suatu jenis usaha yang mempergunakan seluruh bangunan secara permanen untuk menyediakan '
        .'jasa pangan yang pengolahan dan penyajiannya secara langsung di tempat sesuai dengan keinginan para pengguna jasa '
        .'yang mempunyai ciri pembeli biasanya dikenakan pajak. Izin restoran dan kualifikasinya diberikan oleh Ditjen '
        .'Pariwisata/Kanwil Parpostel setempat.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Rumah makan', array('bold'=> TRUE));
        $textrun->addText(' adalah jenis usaha yang menyediakan jasa pangan yang pengolahan makanannya bisa dilakukan '
        .'diluar rumah makan, yang mempunyai ciri pembeli biasanya dikenakan pajak. Izin rumah makan diberikan oleh '
        .'Diparda (pada kabupaten/kota). Di wilayah yang ada Dinas Pariwisata, biasanya pemberian izin ditangani oleh '
        .'Direktorat Perekonomian/Bagian Perekonomian Pemda setempat.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Koperasi Unit Desa (KUD)', array('bold'=> TRUE));
        $textrun->addText(' adalah suatu organisasi ekonomi yang berwatak sosial merupakan wadah bagi pengembangan '
        .'berbagai kegiatan ekonomi masyarakat perdesaan yang diselenggarakan oleh dan untuk masyarakat itu sendiri.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Koperasi Industri Kecil dan Kerajinan Rakyat (Kopinkra)', array('bold'=> TRUE));
        $textrun->addText(' merupakan koperasi yang beranggotakan industri-industri kecil dan kerajinan rakyat '
        .'yang ada di wilayah desa/kelurahan.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Koperasi Simpan Pinjam (Kospin)', array('bold'=> TRUE));
        $textrun->addText(' adalah koperasi yang bergerak di bidang simpanan dan pinjaman');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Bank Umum', array('bold'=> TRUE));
        $textrun->addText(' adalah bank yang dapat memberikan jasa dalam lalu lintas pembayaran. Usaha dari bank umum '
        .'adalah menghimpun dana masyarakat dalam bentuk giro, deposito berjangka, sertifikat deposito dan tabungan '
        .'serta menyalurkan kredit. Bank umum mencakup bank umum pemerintah maupun swasta.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Yang termasuk bank umum pemerintah', array('bold'=> TRUE));
        $textrun->addText(' meliputi Bank Rakyat Indonesia (BRI), Bank Negara Indonesia (BNI), Bank Mandiri, dan Bank Pembangunan Daerah.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Yang termasuk bank umum swasta', array('bold'=> TRUE));
        $textrun->addText(' meliputi Bank Danamon, Bank Central Asia (BCA), Bank Mutiara, Rabo Bank, dsb.');

        $textrun = $section->addTextRun($pstylename);
        $textrun->addText('Bank Perkreditan Rakyat (BPR)', array('bold'=> TRUE));
        $textrun->addText(' adalah bank yang menerima simpanan dalam bentuk deposito berjangka, tabungan '
        .'atau bentuk lain yang disamakan dengan itu, menyalurkan dana dalam bentuk kredit kepada masyarakat '
        .'yang membutuhkan. BPR dapat menempatkan dananya dalam bentuk Sertifikat BI (SBI), deposito berjangka, atau tabungan pada bank lain');

   
        //Gambar
        $section->addPageBreak();
        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                ->addText('Gambar', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                ->addText(8, array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                ->addText('Banyaknya Sarana Ekonomi di Kecamatan '.$kecname, array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'both'));
        $section->addTextBreak(1, NULL,array('spaceAfter'=>40,'spaceBefore'=>40));
        $section->addPageBreak();

        // Judul Table 8.1.1
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel

        // Judul Table 8.1.2
        $notabel = '8.1.2';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        $section->addPageBreak();
        // end of tabel

        // Judul Table 8.1.3
        $notabel = '8.1.3';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $this->addTable($section, $datac);
        // end of tabel

        $section->addPageBreak();
        $section->addText('Cover Belakang');


        return $phpword;
    }



    public function halamandepan($phpword, $idbuku, $idkec){
        $notabel = '1.1.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $kecname = $datac['kecamatan'];
        $kabname = $datac['kabupaten'];   

        $section = $phpword->addSection();
        $sectionStylePT = $section->getStyle();
        $sectionStylePT->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setPaperSize('A5');

        // set header even page    
        $phpword->getSettings()->setEvenAndOddHeaders(true);
        
        $phpword->addTitleStyle(1, array('size' => 9, 'bold'=> TRUE, 'allCaps'=>TRUE), array('alignment'=> 'center','spaceAfter' => 0));
        $phpword->addTitleStyle(
            2, 
            array(
                'size' => 9, 
                'hidden' => TRUE
            ),
            array(
                'hanging' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1),
                'tabs' =>  new \PhpOffice\PhpWord\Style\Tab('left', \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1))
            )

        );

        $section->addText('Cover Depan');
        $section->addPageBreak();
        $section->addText('Cover Perancis');
        
        $section->addPageBreak();
        $section->addText('Kecamatan '.$kecname.' Dalam Angka', array('bold'=> TRUE,'size'=>12), array('spaceAfter' => 0));
        $section->addText('2020', array('bold'=> TRUE,'size'=>12),NULL, array('spaceAfter' => 0));
        $section->addTextBreak(1);
        $section->addText('No. Publikasi:', array('bold'=> TRUE), array('spaceAfter' => 0));
        $section->addText('Katalog:', array('bold'=> TRUE),NULL, array('spaceAfter' => 0));
        $section->addTextBreak(1);
        $textrun = $section->addTextRun(array('spaceAfter' => 0));
        $textrun->addText('Ukuran Buku:', array('bold'=> TRUE));
        $textrun->addText(' 14,8 cm x 21 cm');
        $section->addText('Jumlah Halaman: ', array('bold'=> TRUE),NULL, array('spaceAfter' => 0));
        $section->addTextBreak(1);
        $section->addText('Naskah:', array('bold'=> TRUE), array('spaceAfter' => 0));
        $section->addText('Badan Pusat Statistik Kabupaten Manokwari',NULL, array('spaceAfter' => 0));
        $section->addTextBreak(1);
        $section->addText('Gambar Kover Oleh:', array('bold'=> TRUE), array('spaceAfter' => 0));
        $section->addText('Badan Pusat Statistik Kabupaten Manokwari',NULL, array('spaceAfter' => 0));
        $section->addTextBreak(1);
        $section->addText('Ilustrasi Kover:', array('bold'=> TRUE), array('spaceAfter' => 0));
        $section->addText('Kecamatan '.$kecname,NULL, array('spaceAfter' => 0));
        $section->addTextBreak(1);
        $section->addText('Diterbitkan Oleh:', array('bold'=> TRUE), array('spaceAfter' => 0));
        $section->addText(htmlspecialchars('© BPS Kabupaten Manokwari'),NULL, array('spaceAfter' => 0));
        $section->addTextBreak(1);
        $section->addText('Dicetak Oleh:', array('bold'=> TRUE), array('spaceAfter' => 0));
        $section->addText('CV. KREATIFO',NULL, array('spaceAfter' => 0));
        $section->addTextBreak(1);
        $section->addText('Dilarang mengumumkan, mendistribusikan, mengomunikasikan, dan/atau menggandakan '
        .'sebagian atau seluruh isi buku ini untuk tujuan komersial tanpa izin tertulis dari Badan Pusat Statistik '
        .'Kabupaten Manokwari.',
        array('bold'=> TRUE), array('alignment'=>'both', 'spaceAfter' => 0));
        

        $section->addPageBreak();
        $section->addText('Tim Penyusun:', array('bold'=> TRUE,'size'=>12), array('spaceAfter' => 0));
        $section->addTextBreak();
        $section->addText('Pengarah:', array('bold'=> TRUE), array('spaceAfter' => 0));
        $section->addText('Kepala Badan Pusat Statistik Kabupaten Manokwari',NULL, array('spaceAfter' => 0));
        $section->addTextBreak(1);
        $section->addText('Editor:', array('bold'=> TRUE), array('spaceAfter' => 0));
        $section->addText('Eka Kristanto, S.Si.',NULL, array('spaceAfter' => 0));
        $section->addtextBreak(1);
        $section->addText('Pengolah Data:', array('bold'=> TRUE), array('spaceAfter' => 0));
        $section->addText('Eka Kristanto, S.Si',NULL, array('spaceAfter' => 0));
        $section->addText('Arif Wicaksono, S.ST',NULL, array('spaceAfter' => 0));
        $section->addTextBreak(1);
        $section->addText('Penulis:', array('bold'=> TRUE), array('spaceAfter' => 0));
        $section->addText('@ nama KSK',NULL, array('spaceAfter' => 0));
        $section->addTextBreak(1);
        $section->addText('Layout:', array('bold'=> TRUE), array('spaceAfter' => 0));
        $section->addText('Nur Imron Suyuti, S.Tr.Stat',NULL, array('spaceAfter' => 0));
        $section->addTextBreak(1);
        $section->addText('Pembuat Draft:', array('bold'=> TRUE), array('spaceAfter' => 0));
        $section->addText('Arif Wicaksono, S. ST',NULL, array('spaceAfter' => 0));
        $section->addText('Nur Imron Suyuti, S.Tr.Stat',NULL, array('spaceAfter' => 0));


        $section->addPageBreak();
        $section->addText('peta kabupaten '.$kabname, array('bold'=> TRUE, 'allCaps'=> TRUE), array('alignment'=> 'center','spaceAfter' => 80));
        $imagepeta = $_SERVER['DOCUMENT_ROOT']."/assets/image/peta_".str_replace(' ','',$kabname).".png";
        $section->addImage(
            $imagepeta,
            array(
                'width' => \PhpOffice\PhpWord\Shared\Converter::cmToPoint(10.8),
                'height' => \PhpOffice\PhpWord\Shared\Converter::cmToPoint(7.64),
                'alignment' => 'center'
            )
        );

        $section->addPageBreak();
        $section->addText('kepala bps kabupaten manokwari', array('bold'=> TRUE, 'allCaps'=> TRUE), array('alignment'=> 'center','spaceAfter' => 80));
        $imagekepala = $_SERVER['DOCUMENT_ROOT'].'/assets/image/kepalabps.png';
        $section->addImage(
            $imagekepala,
            array(
                'height' => \PhpOffice\PhpWord\Shared\Converter::cmToPoint(10.8),
                'weight'=> \PhpOffice\PhpWord\Shared\Converter::cmToPoint(7.32),
                'alignment' => 'center'
            )
        );
        $section->addText('Mustamir, S.E, M.M', ['bold'=>TRUE], ['alignment'=>'center']);

        return $phpword;
    }

    public function kpdandaftarisi($phpword, $idbuku, $idkec){
        $notabel = '1.1.1';
        $datac = $this->getData($idbuku, $notabel, $idkec);
        $kecname = $datac['kecamatan'];
        $kabname = $datac['kabupaten'];   

        $section = $phpword->addSection();
        $sectionStylePT = $section->getStyle();
        $sectionStylePT->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setPaperSize('A5');
        $sectionStylePT->setPageNumberingStart(6);
        // set header even page    
        $phpword->getSettings()->setEvenAndOddHeaders(true);
        
        //table style for footer
        $TableStyle = array('borderTopSize' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0.5), 'borderTopColor' => 'B9D9EB');
        $TableStyleName = 'Footer Table';
        $phpword->addTableStyle($TableStyleName, $TableStyle);
        
        //set footer even page
        $footer = $section->addFooter('even');
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addTextRun(array('alignment'=>'center','spaceAfter'=> 0))
              ->addField('PAGE', array('format' => 'roman'));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'start', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
       
        
        //set footer odd page
        $footer = $section->addFooter();
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'end', 'spaceAfter' => 0));
        $textrun->addText('Kecamatan '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.1));
        $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.17),array('bgColor'=>'B9D9EB', 'valign'=>'center'))
              ->addTextRun(array('alignment'=>'center','spaceAfter'=> 0))
              ->addField('PAGE', array('format' => 'roman'));

        $firstlineindent = \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1);
        $pstylename = 'Paragragh Kata Pengantar';
        $phpword->addParagraphStyle(
            $pstylename,
            array('spaceAfter'=>0,'alignment'=>'both', 'indentation' => array('firstLine' => $firstlineindent))
        );
        $imagelogobps = $_SERVER['DOCUMENT_ROOT'].'/assets/image/logobps.png';
        $textrun = $section->addTextRun(array('spaceAfter' => 0, 'alignment' => 'center',));
        $textrun->addImage(
            $imagelogobps,
            array(
                'width' => \PhpOffice\PhpWord\Shared\Converter::cmToPoint(1.33),
                'height' => \PhpOffice\PhpWord\Shared\Converter::cmToPoint(1.06),
            )
        );       
        $section->addTitle('Kata Pengantar',1);
        $section->addTextBreak(1);
        $section->addText('Publikasi “Kecamatan '.$kecname.' dalam Angka 2020” merupakan serial dari publikasi tahun sebelumnya yang '
        .'diterbitkan oleh Badan Pusat Statistik Kabupaten Manokwari. Publikasi ini merupakan edisi tahun 2020 dan sebagian besar data '
        .'yang disajikan adalah data sekunder yang diperoleh dari berbagai instansi pemerintah dan swasta di Kabupaten '.$kabname.'. '
        .'Selain itu, publikasi ini dilengkapi pula dengan data hasil sensus dan survei yang dilaksanakan oleh BPS Kabupaten Manokwari.',NULL, $pstylename);
        $section->addText('Publikasi ini diterbitkan secara berkala dimaksudkan untuk memenuhi permintaan para konsumen data dan sekaligus '
        .'sebagai media informasi kuantitatif tentang perkembangan pembangunan yang dilaksanakan oleh pemerintah bersama masyarakat.',NULL, $pstylename);
        $section->addText('Kepada semua pihak yang telah memberikan bantuan dan dukungan dalam upaya penyusunan publikasi ini, kami '
        .'sampaikan terima kasih yang setinggi - tingginya.',NULL, $pstylename);
        $section->addText('Semoga publikasi ini bermanfaat bagi kita semua dalam menyusun perencanaan dan melaksanakan pembangunan.',NULL, $pstylename);
        
        $section->addTextBreak(1);
        $imagettd = $_SERVER['DOCUMENT_ROOT'].'/assets/image/ttdkepalabps.png';
        $tablettd = $section->addTable();
        $tablettd->addRow();
        $tablettd->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(6.5),array( 'valign' => 'center'));
        $cellttd = $tablettd->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(4.3),array( 'valign' => 'center'));
        $cellttd->addText('Manokwari, Agustus 2020', NULL , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $cellttd->addText('Kepala BPS', NULL , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $cellttd->addText('Kabupaten Manokwari', NULL , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $textrun = $cellttd->addTextRun(array('alignment'=>'center'));
        $textrun->addImage(
            $imagettd,
            array(
                'width' => \PhpOffice\PhpWord\Shared\Converter::cmToPoint(3.63),
                'height' => \PhpOffice\PhpWord\Shared\Converter::cmToPoint(3.71),
                'alignment' => 'end',
                'wrappingStyle' => 'behind',
                'position'=>'absolute',
            )
        );     
        $textrun->addText('Mustamir, S.E, M.M', array('bold'=>TRUE), array('spaceAfter'=> 0 ,'alignment'=>'center'));

        // TOC Style
        $section->addPageBreak();
        $tocstyledf = array('size' => 9);

        $section->addTitle('Daftar Isi',1);
        $section->addText('Halaman', NULL, array('spaceAfter'=>0, 'alignment'=>'end'));

        $toc = $section->addTOC(
            array('size'=>9),
            array('tabPos'=> \PhpOffice\PhpWord\Shared\Converter::cmToTwip(10.5))
        );
        $toc->setMinDepth(1);
        $toc->setMaxDepth(1);

        $section->addPageBreak();
        $section->addTitle('Daftar Tabel',1);
        $tabeldt = $section->addTable();
        $tabeldt->addRow(NULL, ['tblHeader'=>TRUE])->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(10.8), array('gridSpan'=>3))->addText('Halaman',NULL, array('spaceAfter'=> 80, 'alignment'=>'end'));
        for ($i = 1; $i <= 8; $i++){
            $data = $this->getAllMetaTabel($i, $idkec);
            $judul_bab = $data['judul_bab'];
            $rowb = $tabeldt->addRow();
            $rowb->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.8), array('gridSpan'=> 2, 'vMerge'=>'restart'))
                ->addText(
                    $judul_bab."\t",
                    array(
                        'bold' => TRUE
                    ),
                    array(
                        'alignment' => 'both',
                        'tabs' => array(
                            new \PhpOffice\PhpWord\Style\Tab('left', \PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.73), 'dot')
                        )
                    )    
                );
            $rowb->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1), ['valign'=>'bottom'])->addText('NA', ['bold'=>TRUE], ['alignment'=>'end']);
            foreach($data['data'] AS $tabel){
                $row = $tabeldt->addRow();
                $row->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1))->addText($tabel['no']);
                $row->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(8.8))
                    ->addText(
                        $tabel['judul']."\t",
                        NULL,
                        array(
                            'alignment' => 'both',
                            'tabs' => array(
                                new \PhpOffice\PhpWord\Style\Tab('left', \PhpOffice\PhpWord\Shared\Converter::cmToTwip(8.74), 'dot')
                            )
                        )                        
                    );
                $row->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1), ['valign'=>'bottom', 'tblHeader'=>TRUE])->addText('NA', NULL, ['alignment'=>'end']);
            };
        }

        $section->addPageBreak();
        $section->addTitle('Daftar Gambar',1);
        $tabeldg = $section->addTable();
        $tabeldg->addRow(NULL, ['tblHeader'=>TRUE])->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(10.8), array('gridSpan'=>3))->addText('Halaman',NULL, array('spaceAfter'=> 80, 'alignment'=>'end'));
        $datagambar = $this->getAllGambar($kecname);

        foreach($datagambar AS $gambar){
            $row = $tabeldg->addRow();
            $row->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1))->addText($gambar['no']);
            $row->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(8.8))
                ->addText(
                    $gambar['judul']."\t",
                    NULL,
                    array(
                        'alignment' => 'both',
                        'tabs' => array(
                            new \PhpOffice\PhpWord\Style\Tab('left', \PhpOffice\PhpWord\Shared\Converter::cmToTwip(8.74), 'dot')
                        )
                    )                        
                );
            $row->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1), ['valign'=>'bottom', 'tblHeader'=>TRUE])->addText('NA', NULL, ['alignment'=>'end']);
        };

        return $phpword;
    }

}

?>