<div class="content-wrapper">
	<section class="content-header">
      <h1>
        KCA
        <small>Edit Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">KCA</a></li>
        <li><a href="#">Master KCA</a></li>
        <li class="active">Master Judul Baris</li>
      </ol>
    </section>
	<section class="content">

		<form action="<?php echo base_url().'member/KCA/update_judul_baris'; ?>" method="post">
		<?php foreach ($nama_judul_baris as $nm) :  ?>			 
			<div class="form-group">
			 	<label>Nama Judul Baris</label>
			 	<input type="hidden" name="id_nama_judul_baris" class="form-control" value="<?php echo $nm->id_nama_judul_baris ?>">
			 	<input type="text" name="nama_judul_baris" class="form-control" value="<?php echo $nm->nama_judul_baris ?>">
			 	<span class="error"><?php echo form_error('nama_judul_baris'); ?></span>
			</div>
		<?php endforeach;  ?>
		<?php foreach ($judul_baris as $jdl) :  ?>
			<div class="form-group">
			 	<label>No</label>
			 	<input type="hidden" name="id_judul_baris" class="form-control" value="<?php echo $jdl->id_judul_baris ?>">
    			<?php echo '<input type="hidden" name="no'.$jdl->no.'" class="form-control" value="'.$jdl->no.'">';?>
    			<?php echo '<span class="input-group-text" id="no'.$jdl->no.'"><br>'.$jdl->no.'</span>';?>
			 	<span class="error"><?php echo form_error('no'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Nama Baris</label>
			 	<?php echo'<input type="text" name="nama_baris'.$jdl->no.'" class="form-control" value="'.$jdl->nama_baris.'">' ?>
			 	<span class="error"><?php echo form_error('nama_baris'); ?></span>
			</div>
		<?php endforeach;  ?>
			<input type="hidden" name="jBaris" class="form-control" value="<?php echo count($judul_baris); ?>">
			<button type="reset" class ="btn btn-danger">Reset</button>
			<button type="submit" class ="btn btn-primary">Simpan</button>

		</form>
	</section>
	

</div>