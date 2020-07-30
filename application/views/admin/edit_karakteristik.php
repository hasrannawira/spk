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

		<?php foreach ($karakteristik as $jdl) :  ?>

		<form action="<?php echo base_url().'admin/KCA/update_karakteristik'; ?>" method="post">
			 
			<div class="form-group">
			 	<label>Nama Karakteristik</label>
			 	<input type="hidden" name="id_tabel" class="form-control" value="<?php echo $jdl->id_karakteristik ?>">
			 	<input type="text" name="id_nama_karakteristik" class="form-control" value="<?php echo $jdl->id_nama_karakteristik ?>">
			 	<span class="error"><?php echo form_error('id_nama_karakteristik'); ?></span>
			</div>

			<div class="form-group">
			 	<label>No</label>
    			<span class="input-group-text" id="no"><br><?php echo $jdl->no ?></span>
			 	<span class="error"><?php echo form_error('no'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Nama Karakteristik</label>
			 	<input type="text" name="nama_karakteristik" class="form-control" value="<?php echo $jdl->nama_karakteristik ?>">
			 	<span class="error"><?php echo form_error('nama_karakteristik'); ?></span>
			</div>
		<?php endforeach;  ?>
			<button type="reset" class ="btn btn-danger">Reset</button>
			<button type="submit" class ="btn btn-primary">Simpan</button>

		</form>
	</section>
	

</div>