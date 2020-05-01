<div class="content-wrapper">
	<section class="content-header">
      <h1>
        Surat Seksi TU
        <small>Edit Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Surat TU</li>
      </ol>
    </section>
	<section class="content">
		<?php foreach ($surat as $srt) :  ?>

		<form action="<?php echo base_url().'admin/surat_tu/update'; ?>" method="post">
			 
			<div class="form-group">
			 	<label>Nomor Urut</label>
			 	<input type="hidden" name="id_surat" class="form-control" value="<?php echo $srt->id_surat ?>">
			 	<input type="text" name="no_urut" class="form-control" value="<?php echo $srt->no_urut ?>">
			 	<span class="error"><?php echo form_error('no_urut'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Instansi Asal</label>
    			<span class="input-group-text" id="kode_satker"><br><?php echo $srt->instansi_asal ?></span>
			 	<input type="hidden" name="id_instansi" class="form-control" value="<?php echo $srt->id_instansi ?>">
			 	<input type="hidden" name="instansi_asal" class="form-control" value="<?php echo $srt->instansi_asal ?>">
			 	<span class="error"><?php echo form_error('instansi_asal'); ?></span>
			</div>
		    <div class="form-group">
		      <label>Unit Kerja</label>
		      <select name="kode_satker" class="form-control">
		        <option value="1" <?php if ($srt->kode_satker == "1") echo 'selected'; ?>>Seksi Tata Usaha</option>
		      </select>
		 	<span class="error"><?php echo form_error('kode_satker'); ?></span>       
		    </div>
			<div class="form-group">
			 	<label>Tanggal</label>
			 	<input type="date" name="tanggal" class="form-control" value="<?php echo $srt->tanggal ?>">
			 	<span class="error"><?php echo form_error('tanggal'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Perihal</label>
			 	<input type="text" name="perihal" class="form-control" value="<?php echo $srt->perihal ?>">
			 	<span class="error"><?php echo form_error('perihal'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Instansi Tujuan</label>
			 	<input type="text" name="instansi_tujuan" class="form-control" value="<?php echo $srt->instansi_tujuan ?>">
			 	<span class="error"><?php echo form_error('instansi_tujuan'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Keterangan</label>
			 	<input type="text" name="keterangan" class="form-control" value="<?php echo $srt->keterangan ?>">
			 	<span class="error"><?php echo form_error('keterangan'); ?></span>
			</div>

<!-- 			<div class="form-group">
			 	<label>Photo</label>
			 	<input type="file" name="photo" class="form-control" value="<?php echo $srt->photo ?>" accept="image/png, image/jpeg">
			</div> -->

			<button type="reset" class ="btn btn-danger">Reset</button>
			<button type="submit" class ="btn btn-primary">Simpan</button>

		</form>
		<?php endforeach;  ?>
	</section>
	

</div>