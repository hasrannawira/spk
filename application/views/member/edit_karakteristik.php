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
        <li class="active">Master Karakteristik</li>
      </ol>
    </section>
	<section class="content">

		<form action="<?php echo base_url().'member/KCA/update_karakteristik'; ?>" method="post">
		<?php foreach ($nama_karakteristik as $nm) :  ?>			 
			<div class="form-group">
			 	<label>Nama Karakteristik</label>
			 	<input type="hidden" name="id_nama_karakteristik" class="form-control" value="<?php echo $nm->id_nama_karakteristik?>">
			 	<input type="text" name="nama_karakteristik" class="form-control" value="<?php echo $nm->nama_karakteristik ?>">
			 	<span class="error"><?php echo form_error('nama_karakteristik'); ?></span>
			</div>
		<?php endforeach;  ?>
		<?php foreach ($karakteristik as $kr) :  ?>
			<div class="form-group">
			 	<label>No</label>
			 	<input type="hidden" name="id_karakteristik" class="form-control" value="<?php echo $kr->id_karakteristik ?>">
    			<?php echo '<input type="hidden" name="no'.$kr->no.'" class="form-control" value="'.$kr->no.'">';?>
    			<?php echo '<span class="input-group-text" id="no'.$kr->no.'"><br>'.$kr->no.'</span>';?>
			 	<span class="error"><?php echo form_error('no'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Nama Karakteristik</label>
			 	<?php echo'<input type="text" name="nama_karakteristik'.$kr->no.'" class="form-control" value="'.$kr->nama_karakteristik.'">' ?>
			 	<span class="error"><?php echo form_error('nama_karakteristik'); ?></span>
			</div>
		<?php endforeach;  ?>
			<input type="hidden" name="jKolom" class="form-control" value="<?php echo count($karakteristik); ?>">
			<button type="reset" class ="btn btn-danger">Reset</button>
			<button type="submit" class ="btn btn-primary">Simpan</button>

		</form>
	</section>
	

</div>