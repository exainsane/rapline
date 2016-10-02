<div class="col s12">
	<form action="<?php echo site_url("data/assignkelas/".$kelas) ?>" method="POST">
	<div class="row">
		<div class="col s12 l3">
			<label>Semester</label>
		    <select class="browser-default" name="for_semester">
		      <option value="" disabled >Pilih Tahun/Semester Kumulatif</option>
		      <?php foreach ($datasmt as $smt): ?>
		      	<option value="<?php echo base64_encode($smt->id) ?>" <?php echo $smt->id == $smt_now?"selected":"" ?>><?php echo $smt->tahun_masuk."/".$smt->nomor_semester ?></option>
		      <?php endforeach ?>	      
		    </select>
		</div>
		<div class="col s12 l4">
			<button class="btn indigo darken-1" style="margin-top:20px">Terapkan</button>
			<a class="btn red darken-1 modal-trigger" href="#form" style="margin-top:20px">Tambah Jadwal</a>			
		</div>
	</div>
	</form>
	<blockquote><h5>Mata Pelajaran <?php echo $kelas_name ?> Semester <?php echo $smt_name ?></h5></blockquote>
	<table>
		<tr>
			<th class="center-align">Jam</th>
			<th class="center-align">Senin</th>
			<th class="center-align">Selasa</th>
			<th class="center-align">Rabu</th>
			<th class="center-align">Kamis</th>
			<th class="center-align">Jumat</th>
		</tr>
		<?php for ($i=1; $i <= 5; $i++) : ?>
			<tr>
				<td><?php echo $i ?></td>			
				<?php for ($ii=1; $ii <= 5; $ii++) :?>
					<td>
					<?php if (isset($datajadwal[$ii][$i])): ?>						
							<div class="center-align jadwal_occupied">
								<a href="<?php echo site_url("data/unassignkelas/".$kelas."?c=".$datajadwal[$ii][$i]["id"]) ?>">Delete</a>
								<strong><?php echo $datajadwal[$ii][$i]["mp"] ?></strong><br>
								<small><?php echo $datajadwal[$ii][$i]["guru"] ?></small>
							</div>						
					<?php endif ?>
					</td>
				<?php endfor ?>
			</tr>
		<?php endfor;?>
		
	</table>
</div>
<div class="modal" id="form" style="padding:10px">
	<div class="modal-content">
		<blockquote style="border-color:#304ffe"><h5>Input data jadwal</h5></blockquote>
		<form action="<?php echo site_url("data/assignkelas/".$kelas) ?>" method="POST">			
			<input type="hidden" name="is_input" value="true">
			<div>
				<label>Mata Pelajaran</label>
			    <select class="browser-default" name="mata_pelajaran">
			      <option value="" disabled >Pilih Mata Pelajaran</option>
			      <?php foreach ($datamapel as $mp): ?>
			      	<option value="<?php echo base64_encode($mp->id) ?>"><?php echo $mp->nama_mata_pelajaran ?></option>
			      <?php endforeach ?>	      
			    </select>
			</div>
			<div>
				<label>Guru Pengampu</label>
			    <select class="browser-default" name="guru_pengampu">
			      <option value="" disabled >Pilih Guru Pengampu</option>
			      <?php foreach ($dataguru as $gr): ?>
			      	<option value="<?php echo base64_encode($gr->id) ?>"><?php echo $gr->nama_guru ?></option>
			      <?php endforeach ?>	      
			    </select>
			</div>
			<div class="row">
				<div class="col s6">
					<div>
						<label>Hari Ke</label>
					    <select class="browser-default" name="hari_ke">
					      <option value="" disabled >Pilih Jam Pelajaran</option>
					      <?php for ($i = 1;$i <= 5;$i++): ?>
					      	<option value="<?php echo $i ?>"><?php echo $i ?></option>
					      <?php endfor ?>	      
					    </select>
					</div>
				</div>
				<div class="col s6">
					<div>
						<label>Jam Pelajaran Ke</label>
					    <select class="browser-default" name="jam_ke">
					      <option value="" disabled >Pilih Jam Pelajaran</option>
					      <?php for ($i = 1;$i <= 5;$i++): ?>
					      	<option value="<?php echo $i ?>"><?php echo $i ?></option>
					      <?php endfor ?>	      
					    </select>
					</div>
				</div>
			</div>
			<button class="right btn indigo darken-3">Tambahkan</button>		
		</form>
	</div>
</div>