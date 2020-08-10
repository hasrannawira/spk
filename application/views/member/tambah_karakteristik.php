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
        <li class="active">Master Karakteristik</li>
      </ol>
    </section>
  <section class="content">

    <form action="<?php echo base_url().'member/KCA/insert_karakteristik'; ?>" method="post">      
    <div class="form-group">
      <label>Nama Karakteristik</label>
      <span class="input-group-text" id="nama_karakteristik"><br><?php echo $nama_karakteristik ?></span>
      <input type="hidden" name="jKarakteristik" class="form-control" value="<?php echo $jKarakteristik?>">
      <input type="hidden" name="nama_karakteristik" class="form-control" value="<?php echo $nama_karakteristik ?>">    
    </div>
    <div class="form-group">
      <?php for ($i=1; $i < $jKarakteristik+1 ; $i++) { 
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