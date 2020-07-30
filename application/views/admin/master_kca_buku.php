<div class="conten-wrapper">
	    <section class="content-header">
      <h1>
        KCA
        <small>Master KCA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Link</li>
      </ol>
    </section>
    <section class="content">

    <div class="flash-data" data-flashdata="<?php if($this->session->flashdata('flash')){
      echo $this->session->flashdata('flash');}
      else{
        echo 'kosong';
      }; ?>">
    </div>
    <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Master Buku</h3><br><br>
              <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>Tambah Buku</button><br><br>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Buku</th>
                    <th>Kecamatan</th>
                    <th>Tahun</th>
          			<th colspan="2">Aksi</th> 
                  </tr>
                  </thead>
                  <tbody>
    		<?php 

    		$no = 1;
    		foreach ($buku as $bk) : ?>

                  <tr>
                    <td><?php echo $no++ ?></a></td>
            				<td><?php echo $bk->nama_buku ?></td>
            				<td><?php echo $bk->kecamatan ?></td>
                    <td><?php echo $bk->tahun ?></td>            
                    <td><a class="tombol_hapus" href="<?php echo 'KCA/hapus_buku/'.$bk->id_buku ?>"><div class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></div></a></td>          
                    <td><?php echo anchor('admin/export_doc/export_kca/'.$bk->id_buku,'<div class="btn btn-primary btn-sm"> <i class="fa fa-download"></i></div>') ?></td>
                  </tr>
    		 <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel" align="center"><b>FORM INPUT DATA BUKU</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <?php echo form_open_multipart('admin/KCA/tambah_buku'); ?>
		<div class="form-group">
			<label>Master Kecamatan</label>
			<select name="master_kecamatan" class="form-control">
        <option value="" selected disabled hidden>Choose here</option>
        <option value="Distrik Manokwari Barat">Distrik Manokwari Barat</option>
        <option value="Distrik Manokwari Timur">Distrik Manokwari Timur</option>
        <option value="Distrik Manokwari Selatan">Distrik Manokwari Selatan</option>
        <option value="Distrik Manokwari Utara">Distrik Manokwari Utara</option>
        <option value="Distrik Warmare">Distrik Warmare</option>
        <option value="Distrik Masni">Distrik Masni</option>
        <option value="Distrik Sidey">Distrik Sidey</option>
        <option value="Distrik Prafi">Distrik Prafi</option>
        <option value="Distrik Tanah Rubuh">Distrik Tanah Rubuh</option>
      </select>	
		</div>
		<div class="form-group">
			<label>Tahun</label>
      <select name="tahun" class="form-control">
        <option value="" selected disabled hidden>Choose here</option>
        <option value="2020">2020</option>
      </select> 
		</div>
    <div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      <button type="submit" class="btn btn-primary">Simpan</button>
	  </div>

    <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
</div>

