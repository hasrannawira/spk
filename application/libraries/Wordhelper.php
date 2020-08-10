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
        
        $cdata = array(
            "id" => $meta->id_tabel,
            "nomor" => $meta->kode_tabel,
            "kecamatan" =>$kec->nama_kec,
            "judul" => $meta->nama_tabel,
            "sumber" => $meta->sumber_data,
            "keterangan" => $meta->keterangan,
            "judul_baris" => $judulbaris->nama_judul_baris,
            "baris" => $baris,
            "kolom" => $kolom,
            "data" => $data,

        );
        return $cdata;
    }


    public function bab1indo($phpword){
        $notabel = '1.1.1';
        $idbuku = 1;
        $idkec = '9105141';
        $datac = $this->getData($idbuku, $notabel, $idkec);

        $kecname = $datac['kecamatan'];   
        // $section = $phpword->addSection(["paperSize" => "A5"]);
        $section = $phpword->addSection();
        $sectionStylePT = $section->getStyle();
        $sectionStylePT->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        $sectionStylePT->setPaperSize('A5');
        // $sectionStylePT->setColsNum(2);
        
        // $style = $section->getStyle()->setPaperSize('A5');
        // $section->setStyle($style);

        // $fontstylename = "MyriadPro"; 
        // $phpword->addFontStyle(
        //     $fontstylename,
        //     array('name'=>'Myriad Pro', 'size'=>11)
        // );

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
        $textrun->addText('Distrik '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
       

        
        //set footer odd page
        $footer = $section->addFooter();
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'end', 'spaceAfter' => 0));
        $textrun->addText('Distrik '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
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
        $section->addText('1. Geografi dan Iklim');
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
        // $section = $phpword->addSection();
        // $sectionStylePT = $section->getStyle();
        // $sectionStylePT->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        // $sectionStylePT->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        // $sectionStylePT->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        // $sectionStylePT->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
        // $sectionStylePT->setPaperSize('A5');

        // Judul Gambar
        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Gambar', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText(1, array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText('Luas Wilayah Menurut Desa/Kelurahan di Kecamatan '.$kecname, array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'both'));
        $section->addTextBreak(1);
        $section->addPageBreak();

        // Judul Table 1.1.1
        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Tabel', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText($datac['nomor'], array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText($datac['judul'].$datac['kecamatan'], array('bold'=>TRUE) , array('spaceAfter'=> 0,'alignment'=>'both'));
        
        $section->addTextBreak(1);

        // isi Tabel
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $data_baris = $datac['baris'];
        $data_tabel = $datac['data'];

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
                    $row->addCell()->addText($data_baris[$b]['no'].'. '.$data_baris[$b]['nama_baris'], NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                }else{
                    $row->addCell()->addText($data_tabel[$no]['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    $no++;                            
                }
               
            }
        }        
        $section->addTextBreak(1);
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

        // end of tabel
        $section->addPageBreak();

        // Judul Table 1.1.2
        $notabel = '1.1.2';
        $idbuku = 1;
        $idkec = '9105141';
        $datac = $this->getData($idbuku, $notabel, $idkec);

        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Tabel', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText($datac['nomor'], array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText($datac['judul'].$datac['kecamatan'], array('bold'=>TRUE) , array('spaceAfter'=> 0,'alignment'=>'both'));
        
        $section->addTextBreak(1);

        // isi Tabel
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $data_baris = $datac['baris'];
        $data_tabel = $datac['data'];

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
                    $row->addCell()->addText($data_baris[$b]['no'].'. '.$data_baris[$b]['nama_baris'], NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                }else{
                    $row->addCell()->addText($data_tabel[$no]['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    $no++;                            
                }
               
            }
        }        
        $section->addTextBreak(1);
        // untuk sumber dan keterangan
        
        $tabelmeta = $section->addTable();
        $tabelmeta = $section->addTable();
        
        if (($datac['keterangan'] != NULL) && ($datac['keterangan'] != '') && ($datac['keterangan'] != ' ')) {
            $rowmeta1 = $tabelmeta->addRow();
            $rowmeta1->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2))->addText('Keterangan');
            $rowmeta1->addCell()->addText(':'.$datac['keterangan']);
        }

        $rowmeta2 = $tabelmeta->addRow();
        $rowmeta2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2))->addText('Sumber');
        $rowmeta2->addCell()->addText(':'.$datac['sumber']);


        // end of tabel
        $section->addPageBreak();

        // Judul Table 1.1.4
        $notabel = '1.1.4';
        $idbuku = 1;
        $idkec = '9105141';
        $datac = $this->getData($idbuku, $notabel, $idkec);

        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Tabel', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText($datac['nomor'], array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText($datac['judul'].$datac['kecamatan'], array('bold'=>TRUE) , array('spaceAfter'=> 0,'alignment'=>'both'));
        
        $section->addTextBreak(1);

        // isi Tabel
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $data_baris = $datac['baris'];
        $data_tabel = $datac['data'];

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
                    $row->addCell()->addText($data_baris[$b]['no'].'. '.$data_baris[$b]['nama_baris'], NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                }else{
                    $row->addCell()->addText($data_tabel[$no]['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    $no++;                            
                }
               
            }
        }    
        $section->addTextBreak(1);
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
          
                
        return $phpword;
    }


    public function bab2indo($phpword){
        $notabel = '2.1.1';
        $idbuku = 1;
        $idkec = '9105141';
        $datac = $this->getData($idbuku, $notabel, $idkec);

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
        $textrun->addText('Distrik '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
       

        
        //set footer odd page
        $footer = $section->addFooter();
        $table = $footer->addTable($TableStyleName)->addRow(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.34));
        $textrun = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(9.63),array('valign'=>'center'))
                         ->addTextRun(array('alignment'=>'end', 'spaceAfter' => 0));
        $textrun->addText('Distrik '.$kecname.' dalam Angka 2020', array('bold'=> TRUE, 'size'=>8 ));
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


        //must check odd or even page
        // if (odd_page()){
        //     $section->addText('Sengaja Dikosongkan');
        //     $section->addPageBreak();
        // }
        $section->addText('2. Pemerintahan');
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
        $section->addTextBreak(1);
        $section->addPageBreak();


        // Judul Table 2.1.1
        
        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Tabel', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText($datac['nomor'], array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText($datac['judul'].$datac['kecamatan'], array('bold'=>TRUE) , array('spaceAfter'=> 0,'alignment'=>'both'));
        
        $section->addTextBreak(1);

        // isi Tabel
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $data_baris = $datac['baris'];
        $data_tabel = $datac['data'];

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
                    $row->addCell()->addText($data_baris[$b]['no'].'. '.$data_baris[$b]['nama_baris'], NULL, array('indent'=>0.25, 'spaceAfter'=>40,'spaceBefore'=>40) );
                }else{
                    $row->addCell()->addText($data_tabel[$no]['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    $no++;                            
                }
               
            }
        }        
        $section->addTextBreak(1);
        // untuk sumber dan keterangan
        
        $tabelmeta = $section->addTable();
        $tabelmeta = $section->addTable();
        
        if (($datac['keterangan'] != NULL) && ($datac['keterangan'] != '') && ($datac['keterangan'] != ' ')) {
            $rowmeta1 = $tabelmeta->addRow();
            $rowmeta1->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2))->addText('Keterangan');
            $rowmeta1->addCell()->addText(':'.$datac['keterangan']);
        }

        $rowmeta2 = $tabelmeta->addRow();
        $rowmeta2->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2))->addText('Sumber');
        $rowmeta2->addCell()->addText(':'.$datac['sumber']);
        
        // end of tabel
        $section->addPageBreak();

        // Judul Table 2.1.2
        $notabel = '2.1.2';
        $idbuku = 1;
        $idkec = '9105141';
        $datac = $this->getData($idbuku, $notabel, $idkec);

        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Tabel', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText($datac['nomor'], array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText($datac['judul'].$datac['kecamatan'], array('bold'=>TRUE) , array('spaceAfter'=> 0,'alignment'=>'both'));
        
        $section->addTextBreak(1);

        // isi Tabel
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $data_baris = $datac['baris'];
        $data_tabel = $datac['data'];

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
                    $row->addCell()->addText($data_baris[$b]['no'].'. '.$data_baris[$b]['nama_baris'], NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                }else{
                    $row->addCell()->addText($data_tabel[$no]['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    $no++;                            
                }
               
            }
        }    
        $section->addTextBreak(1);
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
        
        // end of table


        $section->addPageBreak();

        // Judul Table 2.1.3
        $notabel = '2.1.3';
        $idbuku = 1;
        $idkec = '9105141';
        $datac = $this->getData($idbuku, $notabel, $idkec);

        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Tabel', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText($datac['nomor'], array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText($datac['judul'].$datac['kecamatan'], array('bold'=>TRUE) , array('spaceAfter'=> 0,'alignment'=>'both'));
        
        $section->addTextBreak(1);

        // isi Tabel
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $data_baris = $datac['baris'];
        $data_tabel = $datac['data'];

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
                    $row->addCell()->addText($data_baris[$b]['no'].'. '.$data_baris[$b]['nama_baris'], NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                }else{
                    $row->addCell()->addText($data_tabel[$no]['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    $no++;                            
                }
               
            }
        }    
        $section->addTextBreak(1);
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
        
        // end of table

        $section->addPageBreak();

        // Judul Table 2.1.4
        $notabel = '2.1.4';
        $idbuku = 1;
        $idkec = '9105141';
        $datac = $this->getData($idbuku, $notabel, $idkec);

        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Tabel', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText($datac['nomor'], array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText($datac['judul'].$datac['kecamatan'], array('bold'=>TRUE) , array('spaceAfter'=> 0,'alignment'=>'both'));
        
        $section->addTextBreak(1);

        // isi Tabel
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $data_baris = $datac['baris'];
        $data_tabel = $datac['data'];

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
                    $row->addCell()->addText($data_baris[$b]['nama_baris'], NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                }else{
                    $row->addCell()->addText($data_tabel[$no]['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    $no++;                            
                }
               
            }
        }    
        $section->addTextBreak(1);
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
        
        // end of table

        $section->addPageBreak();

        // Judul Table 2.1.5
        $notabel = '2.1.5';
        $idbuku = 1;
        $idkec = '9105141';
        $datac = $this->getData($idbuku, $notabel, $idkec);

        $tabletitle = $section->addTable();
        $tabletitle->addRow();
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.2),array( 'valign' => 'center'))
                   ->addText('Tabel', array('bold'=>TRUE) , array('spaceAfter'=> 0, 'alignment'=>'center'));
        $tabletitle->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),array( 'valign' => 'center'))
                   ->addText($datac['nomor'], array('size'=> 14,'bold'=>TRUE) , array('spaceAfter'=> 0 ,'alignment'=>'center'));
        $tabletitle->addCell(NULL, array( 'valign' => 'center'))
                   ->addText($datac['judul'].$datac['kecamatan'], array('bold'=>TRUE) , array('spaceAfter'=> 0,'alignment'=>'both'));
        
        $section->addTextBreak(1);

        // isi Tabel
        $nbaris = count($datac['baris']);
        $nkolom = count($datac['kolom']);
        $data_baris = $datac['baris'];
        $data_tabel = $datac['data'];

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
                    $row->addCell()->addText(htmlspecialchars($data_baris[$b]['nama_baris']), NULL, array('indent'=>0.25,'spaceAfter'=>40,'spaceBefore'=>40) );
                }else{
                    $row->addCell()->addText($data_tabel[$no]['data'], NULL, array('alignment'=>'end','spaceAfter'=>40,'spaceBefore'=>40));
                    $no++;                            
                }
               
            }
        }    
        $section->addTextBreak(1);
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
        // end of table      

        return $phpword;
    }

}

?>