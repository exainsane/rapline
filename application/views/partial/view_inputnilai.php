<div class="col s12 filler">
	<form action="<?php echo site_url("data/inputnilai/") ?>" method="POST">
	<div class="row">
		<div class="col s12 l3">
			<label>Kelas &amp; Mata Pelajaran</label>
		    <select class="browser-default" name="kelas">
		      <option value="" disabled >Pilih Mata Pelajaran &amp; Kelas</option>
		      <?php foreach ($datakelas as $kls): ?>
		      	<option value="<?php echo base64_encode($kls->id) ?>" <?php echo $kls->id == $input_selection?"selected":"" ?>><?php echo $kls->nama_mata_pelajaran." - ".getTingkat($kls->nama_kelas,$kls->tahun_masuk)." Semester ".$kls->nomor_semester ?></option>
		      <?php endforeach ?>	      
		    </select>
		</div>
		<div class="col s12 l9">
			<button class="btn indigo darken-1" style="margin-top:20px">Terapkan</button>			
			<a class="btn green darken-1" href="#" onclick="$('#frm').submit()" style="margin-top:20px">Simpan Nilai</a>		
		</div>
	</div>
	</form>
	<blockquote class="border-blue"><h5><?php echo $table_title ?></h5></blockquote>
	<form action="<?php echo site_url("actions/inputnilai") ?>" method="POST" id="frm">
		<input type="hidden" name="ins" value="<?php echo base64_encode($input_selection) ?>">
		<table class="basic_table striped">
			<tr>
				<th>No</th>
			<?php foreach ($fields as $f): ?>
				<?php if(!isset($fcaption[$f])) continue; ?>
				<?php if (strlen($fcaption[$f]) > 0): ?>
					<th><?php echo $fcaption[$f] ?></th>
				<?php endif ?>
			<?php endforeach ?>
			</tr>
			<?php $i=0;foreach ($data as $d): ?>
				<tr class="tbrow">
				<td><?php echo ++$i ?></td>
					<?php foreach ($fields as $f): ?>		
						<?php if(!isset($fcaption[$f])) continue; ?>	
						 <?php if (strlen($fcaption[$f]) < 1) continue; ?>		
						<?php if ($f == "nilai" && isset($d->$f)): ?>
							<td>
								<div class="input-field">
									<input type="number" class="nilai-numberinput" name="nid_<?php echo $d->id_nilai ?>" value="<?php echo $d->$f ?>">
									<label for="">Nilai Akademik</label>
								</div>
							</td>									
						<?php continue;endif ?>		
						<?php if ($f == "deskripsi_nilai" && isset($d->$f)): ?>		
							<td>															
								<div class="input-field">									
									<input type="text" data-multiline="true" name="desd_<?php echo $d->id_nilai ?>" value="<?php echo $d->$f ?>">
									<label for="">Deskripsi</label>
								</div>
							</td>								
						<?php continue;endif ?>		
						<?php if ($f == "nilai_keterampilan" && isset($d->$f)): ?>		
							<td>															
								<div class="input-field">
									<input type="number" class="nilai-numberinput" name="nik_<?php echo $d->id_nilai ?>" value="<?php echo $d->$f ?>">
									<label for="">Nilai Keterampilan</label>
								</div>							
							</td>								
						<?php continue;endif ?>		
						<?php if ($f == "deskripsi_nilai_keterampilan" && isset($d->$f)): ?>		
							<td>															
								<div class="input-field">									
									<input type="text" data-multiline="true" name="desk_<?php echo $d->id_nilai ?>" value="<?php echo $d->$f ?>">
									<label for="">Deskripsi</label>
								</div>
							</td>								
						<?php continue;endif ?>		

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
	</form>
</div>
<div class="modal" id="form" style="padding:10px">
	<div class="modal-content">
		<blockquote style="border-color:#304ffe"><h5>Import Data Siswa</h5></blockquote>
		<table>
			<tr>
				<td>Kelas</td>
				<td>:</td>
				<td><b><?php echo $kelas_now ?></b></td>
			</tr>
		</table>
		<form action="<?php echo site_url("actions/importkelas/") ?>" method="POST" enctype="multipart/form-data">			
			<input type="hidden" name="is_input" value="true">
			<input type="hidden" name="kelas" value="<?php echo $kelas_id ?>">
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
	</div>
</div>