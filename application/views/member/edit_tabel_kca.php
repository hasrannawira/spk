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
        <li class="active">Master Tabel</li>
      </ol>
    </section>
	<section class="content">
		<?php foreach ($tabel as $tbl) :  ?>

		<form action="<?php echo base_url().'member/KCA/update_tabel'; ?>" method="post">
			 
			<div class="form-group">
			 	<label>Kode Tabel</label>
			 	<input type="hidden" name="id_tabel" class="form-control" value="<?php echo $tbl->id_tabel ?>">
			 	<input type="text" name="kode_tabel" class="form-control" value="<?php echo $tbl->kode_tabel ?>">
			 	<span class="error"><?php echo form_error('kode_tabel'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Nama Tabel</label>
    			<span class="input-group-text" id="nama_tabel"><br><?php echo $tbl->nama_tabel ?></span>
			 	<input type="hidden" name="nama_tabel" class="form-control" value="<?php echo $tbl->nama_tabel ?>">
			 	<span class="error"><?php echo form_error('instansi_asal'); ?></span>
			</div>
		    <div class="form-group">
		      <label>Jenis Tabel</label>
		      <select name="jenis_tabel" class="form-control">
		        <option value="1" <?php if ($tbl->jenis_tabel == "1") echo 'selected'; ?>>Tabel Inti</option>
		        <option value="2" <?php if ($tbl->jenis_tabel == "2") echo 'selected'; ?>>Tabel Tambahan</option>
		      </select>
		 	<span class="error"><?php echo form_error('jenis_tabel'); ?></span>       
		    </div>
			<div class="form-group">
			 	<label>Judul Baris</label>
			      <select name="id_nama_judul_baris" class="form-control">			      	
			      	<?php foreach ($nama_judul_baris as $nm) :  ?>
			        <?php echo '<option value="'.$nm->id_nama_judul_baris.'">'.$nm->nama_judul_baris.'</option>' ; ?>
					<?php endforeach;  ?>
			      </select>
			 	<span class="error"><?php echo form_error('judul_baris'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Karakteristik</label>
			      <select name="id_nama_judul_baris" class="form-control">
			      	<?php foreach ($nama_karakteristik as $nm) :  ?>
			        <?php echo '<option value="'.$nm->id_nama_karakteristik.'">'.$nm->nama_karakteristik.'</option>' ; ?>
					<?php endforeach;  ?>
			      </select>
			 	<span class="error"><?php echo form_error('karakteristik'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Sumber Data</label>
			 	<input type="text" name="sumber_data" class="form-control" value="<?php echo $tbl->sumber_data ?>">
			 	<span class="error"><?php echo form_error('sumber_data'); ?></span>
			</div>
			<div class="form-group">
			 	<label>Keterangan</label>
			 	<input type="text" name="keterangan" class="form-control" value="<?php echo $tbl->keterangan ?>">
			 	<span class="error"><?php echo form_error('keterangan'); ?></span>
			</div>
<!-- 			<div class="form-group">
			 	<label>Photo</label>
			 	<input type="file" name="photo" class="form-control" value="<?php echo $tbl->photo ?>" accept="image/png, image/jpeg">
			</div> -->

			<button type="reset" class ="btn btn-danger">Reset</button>
			<button type="submit" class ="btn btn-primary">Simpan</button>

		</form>
		<?php endforeach;  ?>
	</section>
	

</div>