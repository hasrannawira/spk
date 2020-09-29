<div class="conten-wrapper">
	 <section class="content-header">
      <h1>
        KCA
        <small>Master KCA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">KCA</a></li>
        <li><a href="#">Manajemen</a></li>
        <li class="active">Master Kabupaten</li>
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
              <h3 class="box-title">Master Wilayah Kabupaten</h3><br><br>
              <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>Tambah Master</button><br><br>
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
                    <th>Kode Kabupaten</th>
                    <th>Nama Kabupaten</th>
          			<th colspan="1">Aksi</th> 
                  </tr>
                  </thead>
                  <tbody>
    		<?php 
    		$no = 1;
    		foreach ($kab as $kb) : ?>
                  <tr>
                    <td><?php echo $no++ ?></a></td>
            				<td><?php echo $kb->id_kab ?></td>
                    <td><?php echo $kb->nama_kab ?></td>
                    <?php echo '<td><a class="tombol_hapus" href="master_kab_hapus/'.$kb->id_kab.'"><div class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></div></a></td>';?>     
                  </tr>
    		 <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </section>
</div>
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

    <?php echo form_open_multipart('member/KCA/master_kab_tambah'); ?>

    <div class="form-group">
      <label>Kode Kabupaten</label>
      <input type="text" name="id_kab" class="form-control" placeholder="Contoh: 9105,9111,...">  
    </div>
    <div class="form-group">
      <label>Nama Kabupaten</label>
      <input type="text" name="nama_kab" class="form-control" placeholder="Contoh: Manokwari,Manokwari Selatan,...">  
    </div>
    <div class="form-group">
      <label>Upload Foto Kabupaten</label>
      <input type="file" name="photo" class="form-control">    
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

    <?php echo form_close(); ?>
      </div>
    </div>
  </div>
