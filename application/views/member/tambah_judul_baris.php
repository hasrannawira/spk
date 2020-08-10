<div class="conten-wrapper">
      <section class="content-header">
      <h1>
        KCA
        <small>Master KCA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">KCA</a></li>
        <li><a href="#">Master KCA</a></li>
        <li class="active">Master Judul Baris</li>
      </ol>
    </section>
  <section class="content">

    <form action="<?php echo base_url().'member/KCA/insert_judul_baris'; ?>" method="post">      
    <div class="form-group">
      <label>Nama Judul Baris</label>
      <span class="input-group-text" id="nama_judul_baris"><br><?php echo $nama_judul_baris ?></span>
      <input type="hidden" name="jBaris" class="form-control" value="<?php echo $jBaris?>">
      <input type="hidden" name="nama_judul_baris" class="form-control" value="<?php echo $nama_judul_baris?>">    
    </div>
    <div class="form-group">
      <?php for ($i=1; $i < $jBaris+1 ; $i++) { 
      echo '<label>No '.$i.'</label>
      <input type="text" name="'.$i.'" class="form-control">';
      } ?>
    </div>
    <div class="modal-footer">
      <button type="reset" class ="btn btn-danger">Reset</button>
      <button type="submit" class ="btn btn-primary">Simpan</button>
    </div>
    </form>
  </section>
</div>