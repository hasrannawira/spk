<div class="content-wrapper">
	<section class="content-header">
      <h1>
        Edit Data User
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data User</li>
      </ol>
    </section>
	<section class="content">
      <?php echo form_open_multipart('admin/user/update'); ?>
      		<?php foreach ($user as $usr) :  ?>			 
			<div class="form-group">
			 	<label>Username</label>
			 	<input type="hidden" name="id" class="form-control" value="<?php echo $usr->id ?>">
			 	<input type="text" name="username" class="form-control" value="<?php echo $usr->username ?>">
			</div>

			<div class="form-group">
			 	<label>First Name</label>
			 	<input type="text" name="first_name" class="form-control" value="<?php echo $usr->first_name ?>">
			</div>
			<div class="form-group">
			 	<label>Last Name</label>
			 	<input type="text" name="last_name" class="form-control" value="<?php echo $usr->last_name ?>">
			</div>
			<div class="form-group">
				<label>Nomor Handphone</label>
				<input type="text" name="phone" class="form-control" value="<?php echo $usr->phone ?>">		
			</div>
			<div class="form-group">
			 	<label>E-mail</label>
			 	<input type="email" name="email" class="form-control" value="<?php echo $usr->email ?>">
			</div>
		    <div class="form-group">
		      <label>Unit Kerja</label>
		      <select name="id_satker" class="form-control">
		        <option value="0" <?php if ($usr->id_satker == "0") echo 'selected'; ?>>Kepala BPS Kabupaten/Kota</option>
		        <option value="1" <?php if ($usr->id_satker == "1") echo 'selected'; ?>>Seksi Tata Usaha</option>
		        <option value="2" <?php if ($usr->id_satker == "2") echo 'selected'; ?>>Seksi Statistik Sosial</option>
		        <option value="3" <?php if ($usr->id_satker == "3") echo 'selected'; ?>>Seksi Statistik Produksi</option>
		        <option value="4" <?php if ($usr->id_satker == "4") echo 'selected'; ?>>Seksi Statistik Distribusi</option>
		        <option value="5" <?php if ($usr->id_satker == "5") echo 'selected'; ?>>Seksi Nerwilis</option>
		        <option value="6" <?php if ($usr->id_satker == "6") echo 'selected'; ?>>Seksi IPDS</option>
		        <option value="7" <?php if ($usr->id_satker == "7") echo 'selected'; ?>>KSK</option>
		      </select>    
		    </div>
			<div class="form-group">
			 	<label>Upload Photo</label>
			 	<input type="file" name="photo" class="form-control" value="<?php echo $usr->photo ?>" accept="image/png, image/jpeg">
			</div>

			<button type="reset" class ="btn btn-danger">Reset</button>
			<button type="submit" class ="btn btn-primary">Simpan</button>


	    <?php echo form_close(); ?>
		<?php endforeach;  ?>
	</section>
	

</div>