<form action="	" method="POST">
<div class="row">
	<div class="col s12 l3">
		<label>Semester</label>
	    <select class="browser-default" name="smt">
	      <option value="" disabled >Pilih Semester</option>
	      <?php foreach ($datasmt as $smt): ?>
	      	<option value="<?php echo base64_encode($smt->id) ?>" <?php echo $smt->id == $smt_now?"selected":"" ?>><?php echo $smt->tahun_masuk.($smt->ganjil == 1?" (Ganjil)":" (Genap)") ?></option>
	      <?php endforeach ?>	      
	    </select>
	</div>
	<div class="col s12 l9">
		<button class="btn indigo darken-1" style="margin-top:20px">Terapkan</button>
		<a href="#form" class="btn modal-trigger red darken-1 white-text" style="margin-top:20px">Input data wali kelas</a>
	</div>
</div>
</form>
<div class="col s12 filler">
	<blockquote class="border-blue"><h5><?php echo $table_title ?></h5></blockquote>
	<table class="basic_table striped">
		<tr>
			<th>No</th>
		<?php foreach ($fields as $f): ?>
			<?php if (!isset($fcaption[$f])) continue; ?>						
			<th><?php echo $fcaption[$f] ?></th>
		<?php endforeach ?>
		</tr>	
		<?php $i=0;foreach ($data as $d): ?>
			<tr>
				<td><?php echo ++$i ?></td>
				<?php foreach ($fields as $f): ?>
					<?php if (!isset($fcaption[$f])) continue; ?>
					<?php if ($f == "action" && isset($d->$f)): ?>
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
<div class="modal" id="form">
	<div class="modal-content">
		<h3>Wali kelas</h3>
		<form action="<?php echo site_url("admin/save_wali") ?>" method="POST">
			<input type="hidden" name="smt" value="<?php echo base64_encode($smt_now) ?>">
			<table>
				<tr>
					<td>Input ke semester</td>
					<td>:</td>
					<td><b><?php echo $datasmt[search_where($smt_now, $datasmt, "id")]->nomor_semester ?></b></td>
				</tr>
				<tr>
					<td>Guru wali</td>
					<td>:</td>
					<td>
						<select name="guru" id="" class="browser-default" required>
							<option value="" disabled="true">Pilih guru</option>
							<?php foreach ($dataguru as $guru): ?>
								<option value="<?php echo base64_encode($guru->id) ?>" <?php echo search_where($guru->id, $data, "id_guru") == -1?"":"disabled"; ?>><?php echo $guru->nama_guru ?></option>
							<?php endforeach ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Pilih kelas</td>
					<td>:</td>
					<td>
						<select name="kelas" id="" class="browser-default" required>
							<option value="" disabled="true">Pilih kelas</option>
							<?php foreach ($datakelas as $kelas): ?>
								<option value="<?php echo base64_encode($kelas->id) ?>" <?php echo search_where($kelas->id, $data, "id_kelas") == -1?"":"disabled" ?>><?php echo $kelas->nama_kelas ?></option>
							<?php endforeach ?>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><button class="btn btn-flat green white-text expand">Simpan</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>