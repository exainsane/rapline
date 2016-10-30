<html>
  <head>
    
    <!--    Style declarations-->
    <link href="<?php echo base_url("assets/ui/css/materialize.min.css") ?>" rel="stylesheet"/>
    <link href="<?php echo base_url("assets/ui/css/app.css") ?>" rel="stylesheet"/>
    
    <!--    Script declarations-->
    <script src="<?php echo base_url("assets/ui/js/jquery.js")?>"></script>
    <script src="<?php echo base_url("assets/ui/js/materialize.js")?>"></script>
    <script src="<?php echo base_url("assets/ui/js/script.js")?>"></script>

  </head>
  <body>
  	<div class="row container" style="margin-top:10px">
		<div class="col s12 l4 imglogo-header">
			<img src="<?php echo base_url("assets/images/content/logo.png")?>" alt="">
		</div>
		<div class="col s12 l8 captiontop-header">			
			<div class="centervertical">
				<h4>Rapot Online SMK Negeri 1 Cibinong</h4>
				<small class="right">Ver. 0.0.1</small>
			</div>
		</div>
	</div>	
	<nav class="indigo darken-1" id="header">
	    <div class="nav-wrapper container">
	    	<a href="#rapline-logo">Rapot Online SMK Negeri 1 Cibinong</a>    
	    	<ul class="right">
	    		<li><a href="<?php echo site_url("home") ?>">Home</a></li>
	    		<li><a href="#user-modal" class="modal-trigger">User Information</a></li>	    		
	    	</ul>	
	    </div>
	</nav>
	<div class="row container">
		<div class="col s12">
			<ul class="upper-menu" id="upper-menu">
				<?php if (!isUserLoggedIn()): ?>
					<li><a href="<?php echo site_url("home") ?>">Login</a></li>
				<?php endif ?>
				<?php if (isUser(SUPERADMIN_LEVEL)): ?>
					<li><a href="<?php echo site_url("home/getpassword") ?>">Dapatkan Password</a></li>							
					<li><a href="<?php echo site_url("data/siswa") ?>">Data Siswa</a></li>
					<li><a href="<?php echo site_url("data/guru") ?>">Data Guru</a></li>
					<li><a href="<?php echo site_url("data/kelas") ?>">Data Kelas</a></li>
					<li><a href="<?php echo site_url("data/semester") ?>">Data Semester</a></li>
					<li><a href="<?php echo site_url("data/matapelajaran") ?>">Data Mata Pelajaran</a></li>
					<li><a href="<?php echo site_url("admin/datasekolah") ?>">Data Sekolah</a></li>
					<li><a href="<?php echo site_url("admin/guru_wali") ?>">Data Guru Wali</a></li>
				<?php endif ?>
				<?php if (isUser(FIELD_CODE_SISWA)): ?>
					<li><a href="<?php echo site_url("rapor/show") ?>">Rapot Siswa</a></li>
					<li><a href="<?php echo site_url("siswa/biodata") ?>">Biodata Siswa</a></li>
				<?php endif ?>
				<?php if (minUser(FIELD_CODE_GURU)): ?>					
					<li><a href="<?php echo site_url("data/inputnilai") ?>">Pengisian Nilai (Guru)</a></li>				
				<?php endif ?>
				<?php if (isUser(FIELD_CODE_GURU_WALI)): ?>					
					<li><a href="<?php echo site_url("data/assignkelas") ?>">Pengisian Jadwal Pengajaran</a></li>					
					<li><a href="<?php echo site_url("rapor/raporkelas") ?>">Rapor Kelas Perwalian</a></li>					
					<li><a href="<?php echo site_url("rapor/catatan_siswa") ?>">Catatan Siswa</a></li>	
					<li><a href="<?php echo site_url("data/prakerin") ?>">Data PRAKERIN</a></li>	
					<li><a href="<?php echo site_url("data/eskul") ?>">Data Kegiatan Ekstrakurikuler</a></li>
					<li><a href="<?php echo site_url("data/prestasi") ?>">Data Prestasi</a></li>
				<?php endif ?>
			</ul>
		</div>
	</div>
	<div class="row <?php echo isset($contain)?"container":"" ?>">
	<div id="user-modal" class="modal">
		<div class="modal-content">
			
		</div>
	</div>

