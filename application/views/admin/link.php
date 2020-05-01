<div class="conten-wrapper">
	    <section class="content-header">
      <h1>
        Data User
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data User</li>
      </ol>
    </section>
    <section class="content">
   	<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>Tambah Data Link</button><br><br>
    <div class="flash-data" data-flashdata="<?php if($this->session->flashdata('flash')){
      echo $this->session->flashdata('flash');}
      else{
        echo 'kosong';
      }; ?>">
    </div>
    <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Link</h3>

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
                    <th>Nama Link</th>
                    <th>Keterangan</th>
                    <th>Link</th>
          			<th colspan="2">Aksi</th> 
                  </tr>
                  </thead>
                  <tbody>
    		<?php 

    		$no = 1;
    		foreach ($link as $lk) : ?>

                  <tr>
                    <td><?php echo $no++ ?></a></td>
    				<td><?php echo $lk->nama_link ?></td>
    				<td><?php echo $lk->keterangan ?></td>
            <td><a href="<?php echo $lk->link ?>"><?php echo $lk->link ?></td>
            <td><a class="tombol_hapus" href="<?php echo 'link/hapus/'.$lk->id_link ?>"><div class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></div></a></td>
 		           <td><?php echo anchor('admin/link/edit/'.$lk->id_link,'<div class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></div>') ?></td>
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
        <h4 class="modal-title" id="exampleModalLabel" align="center"><b>FORM INPUT DATA LINK</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <?php echo form_open_multipart('admin/link/tambah_link'); ?>
		<div class="form-group">
			<label>Nama Link</label>
			<input type="text" name="nama_link" class="form-control" placeholder="Misal: Link Laporan Harian WFH">		
		</div>
		<div class="form-group">
			<label>Link</label>
			<input type="text" name="link" class="form-control" placeholder="Misal: http://monitoring.bps.go.id">		
		</div>
		<div class="form-group">
			<label>Keterangan</label>
			<input type="text" name="keterangan" class="form-control">		
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

