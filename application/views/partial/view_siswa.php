<div class="col s12 filler">
	<form action="<?php echo site_url("data/siswa/") ?>" method="POST">
	<div class="row">
		<div class="col s12 l3">
			<label>Kelas</label>
		    <select class="browser-default" name="kelas">
		      <option value="" disabled >Pilih Kelas</option>
		      <?php foreach ($datakelas as $kls): ?>
		      	<option value="<?php echo base64_encode($kls->id) ?>" <?php echo $kls->id == $kls_now?"selected":"" ?>><?php echo $kls->nama_kelas ?></option>
		      <?php endforeach ?>	      
		    </select>
		</div>
		<div class="col s12 l9">
			<button class="btn indigo darken-1" style="margin-top:20px">Terapkan</button>
			<a class="btn red darken-1 modal-trigger" href="#form" style="margin-top:20px">Import Data</a>			
		</div>
	</div>
	</form>
	<blockquote class="border-blue"><h5><?php echo $table_title ?></h5></blockquote>
	<table class="basic_table striped">
		<tr>
			<th>No</th>
		<?php foreach ($fields as $f): ?>
			<?php if(!isset($fcaption[$f])) continue;?>
			<?php if (strlen($fcaption[$f]) > 0): ?>
				<th><?php echo $fcaption[$f] ?></th>
			<?php endif ?>
		<?php endforeach ?>
		</tr>
		<?php $i=0;foreach ($data as $d): ?>
			<tr>
			<td><?php echo ++$i ?></td>
				<?php foreach ($fields as $f): ?>	
					<?php if(!isset($fcaption[$f])) continue;?>		
					 <?php if (strlen($fcaption[$f]) < 1) continue; ?>														
					<?php if ($f == "action" && isset($d->$f) ): ?>
						<td>
						<?php foreach ($d->$f as $act): ?>
							<a class="tdaction" href="<?php echo $act['link'] ?>"><?php echo $act['link_caption'] ?></a>
						<?php endforeach;continue; ?>
						</td>
					<?php endif ?>

					<?php if (isset($d->$f)): ?>
						<td><?php echo $d->$f ?></td>
					<?php else: ?>
						<td>-</td>
					<?php endif ?>

					
				<?php endforeach ?>
			</tr>
		<?php endforeach ?>
	</table>
</div>
<div class="modal" id="form" style="padding:10px">
	<div class="modal-content">
		<blockquote style="border-color:#304ffe"><h5>Import Data Siswa</h5></blockquote>
		<form action="<?php echo site_url("actions/importkelas/") ?>" method="POST" enctype="multipart/form-data">			
			<input type="hidden" name="is_input" value="true">
			<input type="hidden" name="kelas" value="<?php echo $kelas_id ?>">
			<table>
				<tr>
					<td>Kelas</td>
					<td>:</td>
					<td><b><?php echo $kelas_now ?></b></td>
				</tr>
				<tr>
					<td>Tahun Masuk</td>
					<td>:</td>
					<td>
						<select name="tahun_masuk" required class="browser-default">
							<option value="" disabled="true">Pilih tahun masuk</option>
							<?php for ($i = intval(date("Y"))-3;$i < intval(date("Y"))+3;$i++ ): ?>
								<option value="<?php echo $i ?>"><?php echo $i ?></option>
							<?php endfor ?>
						</select>
					</td>
				</tr>
			</table>
			
				<div class="file-field input-field">
			      <input class="file-path validate" type="text"/>
			      <div class="btn indigo">
			        <span>Select File (.xlsx ONLY)</span>
			        <input type="file" name="doc" />
			      </div>
			    </div>
			    <br>
			    <br>
				<button class="right btn red darken-3">Upload</button>		
		</form>
		<h5>Petunjuk upload data siswa</h5>
		<div id="upload-siswa-hint-wrapper">
			<ol>
				<li>Format file yang dapat digunakan adalah file Excel format 2007 keatas dengan extensi <b>.xlsx</b></li>
				<li>Data siswa yang di upload harus berada pada sheet 1/sheet pertama</li>
				<li>
					Kolom dalam file <b>xlsx</b> harus sesuai dengan urutan berikut yaitu <b><i>NIS</i> - <i>Nama</i> - <i>Jenis Kelamin</i></b><br>
					<b>TANPA HEADER/JUDUL KOLOM</b><br>
					<img style="width:100%;height:auto" src="<?php echo base_url("assets/images/content/help-upload.png") ?>" alt="">
				</li>
			</ol>

		</div>
	</div>
</div>