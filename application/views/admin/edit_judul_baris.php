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

		<?php foreach ($judul_baris as $jdl) :  ?>

		<form action="<?php echo base_url().'admin/KCA/update_judul_baris'; ?>" method="post">
			 
			<div class="form-group">
			 	<label>Nama Judul Baris</label>
			 	<input type="hidden" name="id_tabel" class="form-control" value="<?php echo $jdl->id_judul_baris ?>">
			 	<input type="text" name="id_nama_judul_baris" class="form-control" value="<?php echo $jdl->id_nama_judul_baris ?>">
			 	<span class="error"><?php echo form_error('id_nama_judul_baris'); ?></span>
			</div>

			<div class="form-group">
			 	<label>No</label>
    			<span class="input-group-text" id="no"><br><?php echo $jdl->no ?></span>
			 	<span class="error"><?php echo form_error('no'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Nama Baris</label>
			 	<input type="text" name="nama_baris" class="form-control" value="<?php echo $jdl->nama_baris ?>">
			 	<span class="error"><?php echo form_error('nama_baris'); ?></span>
			</div>
		<?php endforeach;  ?>
			<button type="reset" class ="btn btn-danger">Reset</button>
			<button type="submit" class ="btn btn-primary">Simpan</button>

		</form>
	</section>
	

</div>