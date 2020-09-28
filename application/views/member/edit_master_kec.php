<div class="content-wrapper">
	<section class="content-header">
      <h1>
        Master Wilayah Kecamatan
        <small>Edit Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">KCA</a></li>
        <li class="active">Master Kecamatan</li>
      </ol>
    </section>
	<section class="content">
		<?php foreach ($kec as $kc) :  ?>

		<form action="<?php echo base_url().'member/KCA/master_kec_update'; ?>" method="post">			 

			<div class="form-group">
			 	<label>Kode Kabupaten</label>
    			<span class="input-group-text" id="id_kab"><br><?php echo $kc->id_kab ?></span>
        		<input type="hidden" name="id_kab" class="form-control" value="<?php echo $kc->id_kab ?>">
			 	<span class="error"><?php echo form_error('id_kab'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Kode Kecamatan</label>
    			<span class="input-group-text" id="id_kec"><br><?php echo substr($kc->id_kec,4); ?></span>
        		<input type="hidden" name="id_kec" class="form-control" value="<?php echo $kc->id_kec ?>">
			 	<span class="error"><?php echo form_error('id_kec'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Nama Kecamatan</label>
			 	<input type="text" name="nama_kec" class="form-control" value="<?php echo $kc->nama_kec ?>">
			 	<span class="error"><?php echo form_error('nama_kec'); ?></span>
			</div>
			<button type="reset" class ="btn btn-danger">Reset</button>
			<button type="submit" class ="btn btn-primary">Simpan</button>

		</form>
		<?php endforeach;  ?>
	</section>
	

</div>