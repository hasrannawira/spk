<div class="conten-wrapper">
      <section class="content-header">
      <h1>
        Dashboard
        <small>Monitoring</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
          <div class="col-md-6">
              <!-- USERS LIST -->
            <div class="box box-danger">
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" align="center">
                <h4 align="text-center">Barang BMN Masuk</h4>
                <table class="table">
                  <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Tanggal Masuk</th>
                    <th>Keterangan</th>
                    <th>Hapus</th>
                    <th>Edit</th>
                    <th>BAST</th>            
                  </tr>
                  <?php 

                  $no = 1;
                  foreach ($bmn as $bmn1) : ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $bmn1->nama_barang ?></td>
                      <td><?php echo $bmn1->jenis_barang ?></td>
                      <td><?php echo $bmn1->tanggal_masuk ?></td>
                      <td><?php echo $bmn1->keterangan ?></td> 


                      </td>

                    </tr>
                  
                   <?php endforeach; ?>
                </table>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                </div>
                <!-- /.box-footer -->
            </div>
              <!--/.box -->
          </div>
            <!-- /.col -->

          <div class="col-md-6">
              <!-- USERS LIST -->
            <div class="box box-danger">
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" align="center">
                <h4 align="text-center">Status Barang BMN</h4>      
                <table class="table">
                  <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Tanggal Masuk</th>
                    <th>Hapus</th>
                    <th>Edit</th>
                    <th>Foto</th>            
                  </tr>
                  <?php 

                  $no2 = 1;
                  foreach ($bmn as $bmn2) : ?>
                    <tr>
                      <td><?php echo $no2++ ?></td> 

                      </td>

                    </tr>
                  
                   <?php endforeach; ?>
                </table>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                </div>
                <!-- /.box-footer -->
            </div>
            <!--/.box -->
          </div>
          <!-- /.col -->   
    </section>

</div>