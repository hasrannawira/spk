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
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Tabel</th>
                    <th>Nama Tabel</th>
                    <th>Jenis Tabel</th>
                   <th colspan="2">Aksi</th> 
                  </tr>
                  </thead>
                  <tbody>
        <?php 

        $no = 1;
        foreach ($tabel as $tbl) : ?>

                  <tr>
                    <td><?php echo $no++ ?></a></td>
                    <td><?php echo $tbl->kode_tabel ?></td>
                    <td><?php echo $tbl->nama_tabel ?></td>
                    <td><?php if ($tbl->jenis_tabel = 1) {
                      echo 'Tabel Inti';
                    } elseif ($tbl->jenis_tabel = 2) {
                      echo 'Tabel Tambahan';
                    }  ?></td>           
                    <td><a class="tombol_hapus" href="<?php echo 'hapus_data_tabel/'.$tbl->id_tabel ?>"><div class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></div></a></td>          
                    <td><?php echo anchor('admin/KCA/input_data_tabel/'.$tbl->id_tabel,'<div class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></div>') ?></td>
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
</div>
