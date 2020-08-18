<div class="content-wrapper">
  <section class="content-header">
      <h1>
        KCA
        <small>Edit Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">KCA</a></li>
        <li class="active">Input Tabel</li>
      </ol>
    </section>
  <section class="content">

    <form action="<?php echo base_url().'member/KCA/update_data_isi'; ?>" method="post">
    <?php echo '<input type="hidden" name="id_buku" class="form-control" value="'.$buku.'">'  ?>
    <?php foreach ($tabel as $tbl) :  ?>       
      <div class="form-group">
        <label>Kode Tabel</label>
        <input type="hidden" name="id_tabel" class="form-control" value="<?php echo $tbl->id_tabel ?>">
        <input type="hidden" name="type_endrow" class="form-control" value="<?php echo $tbl->type_endrow ?>">
        <span class="input-group-text" id="nama_tabel"><br><?php echo $tbl->kode_tabel ?></span>
        <span class="error"><?php echo form_error('kode_tabel'); ?></span>
      </div>
      <div class="form-group">
        <label>Nama Tabel</label>
        <span class="input-group-text" id="nama_tabel"><br><?php echo $tbl->nama_tabel ?></span>
        <span class="error"><?php echo form_error('nama_tabel'); ?></span>
      </div>      
    <?php endforeach;  ?>       
    <table class="table no-margin"> 
      <tr>
        <td></td>
    <?php foreach ($karakteristik as $krt) :  ?>                
        <th scope="col"><?php echo $krt->nama_karakteristik ?></th>
    <?php endforeach;  ?>  
      </tr>
    <?php $i=0; $baris=0; foreach ($judul_baris as $jdl) :  ?>
      <tr>
        <th scope="row"><?php echo $jdl->nama_baris; $baris++; ?></th>
        <?php  for ($kolom=1; $kolom < count($karakteristik)+1 ; $kolom++) {

          echo '<td><input type="text" name="b'.$baris.'k'.$kolom.'" value = "'.$isi[$i]->data.'" class="form-control"></td>';$i++;
        }
        ?>
    <?php endforeach;  ?>
      </tr>
      <tr>
    <?php foreach ($tabel as $tbl) :  ?>
      <?php if ($tbl->type_endrow == 1){
        echo '<th scope="row">'.$kec[0]->nama_kec.'</th>';
        $baris_jumlah=99; for ($kolom=1; $kolom < count($karakteristik)+1 ; $kolom++) { 
        echo '<td><input type="text" name="b'.$baris_jumlah.'k'.$kolom.'" value = "'.$isi[$i]->data.'" class="form-control"></td>';$i++;}
        }
        elseif ($tbl->type_endrow == 2 ) {
        echo '<th scope="row">Rata-Rata</th>';
        $baris_jumlah=98; for ($kolom=1; $kolom < count($karakteristik)+1 ; $kolom++) { 
        echo '<td><input type="text" name="b'.$baris_jumlah.'k'.$kolom.'" value = "'.$isi[$i]->data.'" class="form-control"></td>';$i++;}
        }
      ?>
    <?php endforeach;  ?>   
 
      </tr>   
        <input type="hidden" name="jbaris" class="form-control" value="<?php echo $baris ?>">
        <input type="hidden" name="jkolom" class="form-control" value="<?php echo $kolom-1 ?>">

    </table>

      <button type="reset" class ="btn btn-danger">Reset</button>
      <button type="submit" class ="btn btn-primary">Simpan</button>

    </form>

  </section>
  

</div>