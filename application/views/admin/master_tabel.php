<div class="conten-wrapper">
	    <section class="content-header">
      <h1>
        KCA
        <small>Master KCA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">KCA</a></li>
        <li><a href="#">Master KCA</a></li>
        <li class="active">Master Tabel</li>
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
              <h3 class="box-title">Master Tabel KCA</h3><br><br>
              <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>Tambah Tabel</button><br><br>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <label>Kecamatan:</label>
              <select id="mySelect" class="form-control">
              <option value="" selected disabled hidden>Choose here</option>
              <?php  foreach ($kec as $kc) : ?>
              <?php if ($kc->id_kec == $id_kec){
                echo '<option value="'.$kc->id_kec.'" selected >'.$kc->nama_kec.'</option>' ;
                }
                else{
                echo '<option value="'.$kc->id_kec.'">'.$kc->nama_kec.'</option>';                  
                } ?>
              
              <?php endforeach; ?>
              </select>
              <div class="table-responsive" id="isi">

                
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
        <h4 class="modal-title" id="exampleModalLabel" align="center"><b>FORM INPUT DATA TABEL</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <?php echo form_open_multipart('admin/KCA/tambah_tabel'); ?>
    <div class="form-group">
      <label>Kode Tabel</label>
      <input type="text" name="kode_tabel" class="form-control">    
    </div>
    <div class="form-group">
      <label>Nama Tabel</label>
      <input type="text" name="nama_tabel" class="form-control">    
    </div>
		<div class="form-group">
			<label>Jenis Tabel</label>
			<select name="jenis_tabel" class="form-control">
        <option value="" selected disabled hidden>Choose here</option>
        <option value="1">Tabel Inti</option>
        <option value="2">Tabel Tambahan</option>
      </select>	
		</div>
    <div class="form-group">
      <label>Judul Baris</label>
      <input type="text" name="judul_baris" class="form-control">    
    </div>
    <div class="form-group">
      <label>Karakteristik</label>
      <input type="text" name="karakteristik" class="form-control">    
    </div>
    <div class="form-group">
      <label>Sumber Data</label>
      <input type="text" name="sumber_data" class="form-control">    
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

<script>


  $('#mySelect').on('change', function() {
    $('#isi').load('master_tabel_isi/'+ this.value);
    // $.get('input_tabel_isi/'+ this.value, function(){
    //   $('.wrapper');
    // });
    //alert( this.value );
  });


</script>