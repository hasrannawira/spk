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
              <!-- DIRECT CHAT -->
              <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Aktivitas</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
    		<?php 

    		$no = 1;
    		foreach ($aktivitas as $act) : ?>
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left"><?php echo $act->username ?></span>
                        <span class="direct-chat-timestamp pull-right"><?php echo $act->waktu ?></span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="<?php echo base_url().'assets\uploads\images\foto_profil\default.png' ; ?>" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
						<?php echo $act->aktivitas ?>

                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->
    		 <?php endforeach; ?>

                  </div>

                  <!-- /.direct-chat-pane -->
                </div>

            </div>
            
          </div>
          <!-- /.col -->

          <div class="col-md-6">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" align="center">

                <h4 id="WIT" align="text-center">Waktu</h4>
                  <ul class="users-list clearfix">
                    <li>
                    </li>
                  </ul>
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