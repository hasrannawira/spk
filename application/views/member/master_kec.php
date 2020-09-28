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
        <li class="active">Master Kecamatan</li>
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
              <h3 class="box-title">Master Wilayah Kecamatan</h3><br><br>
              <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>Tambah Master</button><br><br>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">              
              <label>Kabupaten:</label>
              <select id="mySelect" class="form-control">
              <option value="" selected disabled hidden>Choose here</option>
              <?php  foreach ($kab as $kb) : ?>
              <?php echo '<option value="'.$kb->id_kab.'">'.$kb->nama_kab.'</option>'; ?>              
              <?php endforeach; ?>
              </select>

              <div class="table-responsive" id="isi">
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

    <?php echo form_open_multipart('member/KCA/master_kec_tambah'); ?>

    <div class="form-group">              
      <label>Kabupaten:</label>
      <select name="id_kab" class="form-control">
      <option value="" selected disabled hidden>Choose here</option>
      <?php  foreach ($kab as $kb) : ?>
      <?php echo '<option value="'.$kb->id_kab.'">'.$kb->nama_kab.'</option>'; ?>              
      <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label>Kode Kecamatan</label>
      <input type="text" name="id_kec" class="form-control" placeholder="Contoh: 010, 141">  
    </div>
    <div class="form-group">
      <label>Nama Kecamatan</label>
      <input type="text" name="nama_kec" class="form-control">  
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

    <?php echo form_close(); ?>
      </div>
    </div>
  </div>
<script>
$(document).ready(function(){
  $('#mySelect').on('change', function() {
    $('#isi').load('master_kec_isi/'+ this.value);
    // $.get('input_tabel_isi/'+ this.value, function(){
    //   $('.wrapper');
    // });
    //alert( this.value );
  });
});

</script>