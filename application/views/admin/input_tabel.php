<div class="conten-wrapper">
      <section class="content-header">
      <h1>
        KCA
        <small>Master KCA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">KCA</a></li>
        <li class="active">Input Tabel</li>
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
              <h3 class="box-title">Input Data Tabel</h3><br><br>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <label>Buku:</label>
              <select id="mySelect" class="form-control">
              <option value="" selected disabled hidden>Choose here</option>
              <?php  foreach ($buku as $bk) : ?>
              <?php if ($bk->id_buku == $id_buku){
                echo '<option value="'.$bk->id_buku.'" selected >'.$bk->nama_buku.'</option>' ;
                }
                else{
                echo '<option value="'.$bk->id_buku.'">'.$bk->nama_buku.'</option>';                  
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
</div>

<script>
$(document).ready(function(){
  $('#mySelect').on('change', function() {
    $('#isi').load('input_tabel_isi/'+ this.value);
    // $.get('input_tabel_isi/'+ this.value, function(){
    //   $('.wrapper');
    // });
    //alert( this.value );
  });
});

</script>