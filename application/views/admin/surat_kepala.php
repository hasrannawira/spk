<div class="conten-wrapper">
      <section class="content-header">
      <h1>
        Surat Kepala
        <small>Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Surat Kepala</li>
      </ol>
    </section>
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
        <tr>
          <th>No.</th>
          <th>Nomor Surat</th>
          <th>Tanggal</th>
          <th>Perihal</th>
          <th>Instansi Tujuan</th>
          <th>Keterangan</th>
          <th>Hapus</th>
          <th>Edit</th>
          <th>Template</th>
          <th>Upload/Download</th>            
        </tr>
        <?php 

        $no = 1;
        foreach ($surat as $srt) : ?>
          <tr>
            <td><?php echo $no++ ?></td> 
            <td><?php echo 'B-'.$srt->no_urut.'/'.$srt->id_instansi.$srt->kode_satker.'/'.$srt->instansi_asal.'/'.$srt->id_bulan.'/'.$srt->tahun ?></td>
            <td><?php echo $srt->tanggal ?></td>
            <td><?php echo $srt->perihal ?></td>
            <td><?php echo $srt->instansi_tujuan ?></td>
            <td><?php echo $srt->keterangan ?></td>
            <td><a class="tombol_hapus" href="<?php echo 'surat_kepala/hapus/'.$srt->id_surat ?>"><div class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></div></a></td>
            <td><?php echo anchor('admin/surat_kepala/edit/'.$srt->id_surat,'<div class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></div>') ?></td>
            <td><?php echo anchor('admin/export_doc/export_nomor_surat_kepala/'.$srt->id_surat,'<div class="btn btn-primary btn-sm"> <i class="fa fa-file"></i></div>') ?></td>
            <td>
              <?php if($srt->is_upload=='0'){
              echo form_open_multipart("admin/surat_kepala/upload_file");             
              echo '<input type="file" name="file" >
              <input type="hidden" name="id_surat" value="'.$srt->id_surat.'">
              <button type="submit" class ="btn btn-primary btn-sm">Upload</button>';
              echo form_close();
              } else{
                echo '<a class="tombol_unduh" href="'.base_url().'assets/uploads/surat_kepala/'.$srt->file.'"><div class="btn btn-primary btn-sm"> <i class="fa fa-cloud-download"></i></div></a>';
              }?>

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
        <h4 class="modal-title" id="exampleModalLabel" align="center"><b>FORM INPUT SURAT KEPALA</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <?php echo form_open_multipart('admin/surat_kepala/tambah_surat'); ?>
    <div class="form-group">
      <label>Nomor Urut</label>
      <input type="text" name="no_urut" class="form-control" placeholder="Contoh : 001,002,...">    
    </div>
    <div class="form-group">
      <label>Kode Instansi</label>
      <input type="text" name="id_instansi" class="form-control" value="9105">    
    </div>
    <div class="form-group">
      <label>Instansi Asal</label>
      <input type="text" name="instansi_asal" class="form-control" value="BPS">   
    </div>      
    <div class="form-group">
      <label>Unit Kerja</label>
      <select name="kode_satker" class="form-control">
        <option value="0" selected>Kepala BPS Kabupaten/Kota</option>
      </select>    
    </div>   
    <div class="form-group">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control">   
    </div>
    <div class="form-group">
      <label>Perihal</label>
      <input type="text" name="perihal" class="form-control">   
    </div>
    <div class="form-group">
      <label>Instansi Tujuan</label>
      <input type="text" name="instansi_tujuan" class="form-control">   
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