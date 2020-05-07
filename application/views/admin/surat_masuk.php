<div class="conten-wrapper">
      <section class="content-header">
      <h1>
        Surat Masuk
        <small>Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Surat Seksi Masuk</li>
      </ol>
    </section>
      <?php echo validation_errors('<div class="alert alert-danger">','</div>') ?>
    <section class="content">
      <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>Tambah Surat</button>
    <div class="flash-data" data-flashdata="<?php if($this->session->flashdata('flash')){
      echo $this->session->flashdata('flash');}
      else{
        echo 'kosong';
      }; ?>">
    </div>
    <div class="table-responsive">
      <table class="table">
        <thead class="thead-dark">
        <tr>
          <th>No.</th>
          <th>Nomor Surat</th>
          <th>Tanggal</th>
          <th>Instansi Asal</th>
          <th>Perihal</th>
          <th>Keterangan</th>
          <th colspan="3">Aksi</th>           
        </tr>
        </thead>

        <?php 

        $no = 1;
        foreach ($surat as $srt) : ?>
          <tr>
            <td><?php echo $no++ ?></td> 
            <td><?php echo $srt->nomor_surat ?></td>
            <td><?php echo $srt->tanggal ?></td>
            <td><?php echo $srt->instansi_asal ?></td>
            <td><?php echo $srt->perihal ?></td>
            <td><?php echo $srt->keterangan ?></td>
            <td><a class="tombol_hapus" href="<?php echo 'surat_masuk/hapus/'.$srt->id_surat ?>"><div class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></div></a></td>
            <td><?php echo anchor('admin/surat_masuk/edit/'.$srt->id_surat,'<div class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></div>') ?></td>
            <td><a href="#lightbox<?= $srt->id_surat?>"><div class="btn btn-primary btn-sm"> <i class="fa fa-image"></i></div>
            <div class="overlayLightBox" id="lightbox<?= $srt->id_surat?>" >
            <a href="#" class="close">x close</a>
            <img src="<?= base_url('assets/uploads/surat_masuk/').$srt->photo ?>" alt="Foto Surat Masuk">
            </div>
            </td>
          </tr>

        
         <?php endforeach; ?>
      </table>
    </div>
    </section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel" align="center"><b>FORM INPUT SURAT TU</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <?php echo form_open_multipart('admin/surat_masuk/tambah_surat'); ?>

    <div class="form-group">
      <label>Nomor Surat</label>
      <input type="text" name="nomor_surat" class="form-control">   
    </div>
    <div class="form-group">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control">   
    </div>
    <div class="form-group">
      <label>Instansi Asal</label>
      <input type="text" name="instansi_asal" class="form-control">   
    </div>      
    <div class="form-group">
      <label>Perihal</label>
      <input type="text" name="perihal" class="form-control">   
    </div>    
    <div class="form-group">
      <label>Instansi Tujuan</label>
      <input type="text" name="instansi_tujuan" class="form-control" value="BPS Kabupaten Manokwari">   
    </div>
    <div class="form-group">
      <label>Keterangan</label>
      <input type="text" name="keterangan" class="form-control">    
    </div>
<!--     <div class="form-group">
      <label>Upload Foto</label>
      <input type="file" name="photo" class="form-control">    
    </div> -->
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