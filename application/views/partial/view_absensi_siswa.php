<div class="col s12 filler">
	<form action="<?php echo site_url("rapor/absensi") ?>" method="POST">
	<div class="row">
		<div class="col s12 l3">
			<label>Kelas</label>
		    <select class="browser-default" name="kls">
		      <option value="" disabled >Pilih Kelas</option>
		      <?php foreach ($dtkelas as $kls): ?>
		      	<option value="<?php echo base64_encode($kls->id) ?>" <?php echo $kls->id == $input_selection?"selected":"" ?>><?php echo getTingkat($kls->nama_kelas, $kls->tahun_masuk) ?> (<?php echo $kls->nomor_semester; ?>)</option>
		      <?php endforeach ?>	      
		    </select>
		</div>
		<div class="col s12 l9">
			<button class="btn indigo darken-1" style="margin-top:20px">Terapkan</button>	
			<a class="btn green darken-1" href="#" onclick="$('#frm').submit()" style="margin-top:20px">Simpan</a>	
		</div>
	</div>
	</form>
	<blockquote class="border-blue"><h5><?php echo $table_title ?></h5></blockquote>
	<form action="<?php echo site_url("actions/abs_siswa_save") ?>" method="POST" id="frm">
		<input type="hidden" name="ins" value="<?php echo base64_encode($input_selection) ?>">
		<table class="basic_table striped" id="">
			<tr>
				<th>No</th>
				<th>Nama Siswa</th>				
				<th>NIS</th>
				<th>Sakit</th>
				<th>Izin</th>
				<th>Alfa</th>
			</tr>
			<?php $i=1;foreach ($data as $d): ?>
				<tr id="iabsensi">
					<td><?php echo $i++ ?></td>
					<td><strong><?php echo $d->nama_siswa ?></strong></td>
					<td><?php echo $d->kode_identitas ?></td>
					<td><input type="number" name="abs-s-<?php echo $d->id ?>" value="<?php echo $d->sakit ?>"></td>
					<td><input type="number" name="abs-i-<?php echo $d->id ?>" value="<?php echo $d->izin ?>"></td>
					<td><input type="number" name="abs-a-<?php echo $d->id ?>" value="<?php echo $d->alfa ?>"></td>
				</tr>
			<?php endforeach ?>
		</table>
	</form>
</div>