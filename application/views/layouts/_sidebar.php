<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
				<img src="<?php echo base_url('assets/uploads/images/foto_profil/'.$userdata->photo); ?>" class="img-circle">
			</div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('username')?></p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Umum</li>
      <!-- Optionally, you can add icons to the links -->
      <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li><a href="<?=base_url('admin\link')?>"><i class="fa fa-link"></i> <span>Link</span></a></li>
      <li><a href="<?=base_url('admin\surat_masuk')?>"><i class="glyphicon glyphicon-envelope"></i> <span>Surat Masuk</span></a></li>
     <li class="treeview" style="height: auto;">
          <a href="#">
            <i class="fa glyphicon glyphicon-envelope"></i> <span>Nomor Surat Keluar</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?=base_url('admin\surat_kepala')?>"><i class="fa fa-circle-o"></i> Nomor Surat Kepala </a></li>
            <li class="treeview" style="height: auto;">
              <a href="#"><i class="fa fa-circle-o"></i> Nomor Surat Seksi
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="<?=base_url('admin\surat_tu')?>"><i class="fa fa-circle-o"></i> Seksi TU </a></li>
                <li><a href="<?=base_url('admin\surat_sosial')?>"><i class="fa fa-circle-o"></i> Seksi Stat. Sosial</a></li>
                <li><a href="<?=base_url('admin\surat_produksi')?>"><i class="fa fa-circle-o"></i> Seksi Stat. Produksi</a></li>
                <li><a href="<?=base_url('admin\surat_distribusi')?>"><i class="fa fa-circle-o"></i> Seksi Stat. Distribusi</a></li>
                <li><a href="<?=base_url('admin\surat_nerwilis')?>"><i class="fa fa-circle-o"></i> Seksi Nerwilis</a></li>
                <li><a href="<?=base_url('admin\surat_ipds')?>"><i class="fa fa-circle-o"></i> Seksi IPDS</a></li>
              </ul>
            </li>
            <li><a href="<?=base_url('admin\surat_sp2020')?>"><i class="fa fa-circle-o"></i> Nomor Surat Sekretariat SP2020</a></li>
          </ul>
      </li>
      <li class="header">Seksi IPDS</li>
      <li class="treeview" style="height: auto;">
        <a href="#">
          <i class="fa fa-book"></i> <span>KCA</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
      <ul class="treeview-menu" style="display: none;">
        <li class="treeview" style="height: auto;">
        <a href="#">
          <i class="fa fa-circle-o"></i> Master KCA
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?=base_url('admin\KCA')?>"><i class="fa fa-circle-o"></i> Master Buku </a></li>
            <li><a href="<?=base_url('admin\KCA\master_tabel')?>"><i class="fa fa-circle-o"></i> Master Tabel </a></li>
            <li><a href="<?=base_url('admin\KCA\master_judul_baris')?>"><i class="fa fa-circle-o"></i> Master Judul Baris</a></li>
            <li><a href="<?=base_url('admin\KCA\master_karakteristik')?>"><i class="fa fa-circle-o"></i> Master Karakteristik</a></li>>
          </ul>
        </li>
          <li><a href="<?=base_url('admin\KCA\input_tabel')?>"><i class="fa fa-circle-o"></i> Input Tabel</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Manajemen</a></li>
      </ul>
      </li>
      <li class="header">Pengelola Anggaran</li>
      <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> <span>BMN</span></a></li>
      <li class="header">ADMIN</li>
        <li><a href="<?=base_url('admin\user')?>"><i class="glyphicon glyphicon-user"></i> <span>User</span></a></li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
