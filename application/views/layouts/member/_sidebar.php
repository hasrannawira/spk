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
      <li class="header">UMUM</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="active"><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li><a href="<?=base_url('member\link')?>"><i class="fa fa-link"></i> <span>Link</span></a></li>
      <li><a href="<?=base_url('member\surat_masuk')?>"><i class="glyphicon glyphicon-envelope"></i> <span>Surat Masuk</span></a></li>
     <li class="treeview" style="height: auto;">
          <a href="#">
            <i class="fa glyphicon-envelope"></i> <span>Nomor Surat Keluar</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <?php if($this->session->userdata('id_satker') =="0"){
                  echo '<li><a href="'.base_url().'member/surat_kepala"><i class="fa fa-circle-o"></i> Nomor Surat Kepala</a></li>';}?>
            <li class="treeview" style="height: auto;">
              <a href="#"><i class="fa fa-circle-o"></i> Nomor Surat Seksi
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="<?=base_url('member\surat_tu')?>"><i class="fa fa-circle-o"></i> Seksi TU </a></li>
                <?php if($this->session->userdata('id_satker') =="2"){
                  echo '<li><a href="'.base_url().'member/surat_sosial"><i class="fa fa-circle-o"></i> Seksi Stat. Sosial</a></li>';}?>
                <?php if($this->session->userdata('id_satker') =="3"){
                  echo '<li><a href="'.base_url().'member/surat_produksi"><i class="fa fa-circle-o"></i> Seksi Stat. Produksi</a></li>';}?>
                <?php if($this->session->userdata('id_satker') =="4"){
                  echo '<li><a href="'.base_url().'member/surat_distribusi"><i class="fa fa-circle-o"></i> Seksi Stat. Distribusi</a></li>';}?>
                <?php if($this->session->userdata('id_satker') =="5"){
                  echo '<li><a href="'.base_url().'member/surat_nerwilis"><i class="fa fa-circle-o"></i> Seksi Nerwilis</a></li>';}?>
                <?php if($this->session->userdata('id_satker') =="6"){
                  echo '<li><a href="'.base_url().'member/surat_ipds"><i class="fa fa-circle-o"></i> Seksi IPDS</a></li>';}?>
              </ul>
            </li>
            <li><a href="<?=base_url('member\surat_sp2020')?>"><i class="fa fa-circle-o"></i> Nomor Surat Sekretariat SP2020</a></li>
            </ul>      
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
                  <li><a href="<?=base_url('member\KCA')?>"><i class="fa fa-circle-o"></i> Master Buku </a></li>
                  <?php if($this->session->userdata('id_satker') =="6"){
                  echo '<li><a href="'.base_url().'member/KCA/master_tabel"><i class="fa fa-circle-o"></i> Master Tabel</a></li>';}?>
                  <?php if($this->session->userdata('id_satker') =="6"){
                  echo '<li><a href="'.base_url().'member/KCA/master_judul_baris"><i class="fa fa-circle-o"></i> Master Judul Baris</a></li>';}?>
                  <?php if($this->session->userdata('id_satker') =="6"){
                  echo '<li><a href="'.base_url().'member/KCA/master_karakteristik"><i class="fa fa-circle-o"></i> Master Karakteristik</a></li>';}?>
                </ul>
              </li>
                <li><a href="<?=base_url('member\KCA\input_tabel')?>"><i class="fa fa-circle-o"></i> Input Tabel</a></li>
                  <?php if($this->session->userdata('id_satker') =="6"){
                  echo '<li><a href="#"><i class="fa fa-circle-o"></i> Manajemen</a></li>';}?>
            </ul>
            </li>

        </li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
