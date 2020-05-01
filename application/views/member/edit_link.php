<div class="content-wrapper">
	<section class="content-header">
      <h1>
        Link
        <small>Edit Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Link</li>
      </ol>
    </section>
	<section class="content">
		<?php foreach ($link as $srt) :  ?>

		<form action="<?php echo base_url().'member/link/update'; ?>" method="post">
			 
			<div class="form-group">
			 	<label>Nama Link</label>
			 	<input type="hidden" name="id_link" class="form-control" value="<?php echo $srt->id_link ?>">
			 	<input type="text" name="nama_link" class="form-control" value="<?php echo $srt->nama_link ?>">
			 	<span class="error"><?php echo form_error('nama_link'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Link</label>
			 	<input type="text" name="link" class="form-control" value="<?php echo $srt->link ?>">
			 	<span class="error"><?php echo form_error('link'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Keterangan</label>
			 	<input type="text" name="keterangan" class="form-control" value="<?php echo $srt->keterangan ?>">
			 	<span class="error"><?php echo form_error('keterangan'); ?></span>
			</div>
			<button type="reset" class ="btn btn-danger">Reset</button>
			<button type="submit" class ="btn btn-primary">Simpan</button>

		</form>
		<?php endforeach;  ?>
	</section>
	

</div>