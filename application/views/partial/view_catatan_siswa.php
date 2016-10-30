<div class="col s12 filler">
	<form action="<?php echo site_url("rapor/catatan_siswa") ?>" method="POST">
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
	<form action="<?php echo site_url("actions/cat_siswa_save") ?>" method="POST" id="frm">
		<input type="hidden" name="ins" value="<?php echo base64_encode($input_selection) ?>">
		<table class="basic_table" id="">
			<tr>
				<th>No</th>
				<th>Nama Siswa</th>				
				<th>NIS</th>
			</tr>
			<?php $i=1;foreach ($data as $d): ?>
				<tr>
					<td rowspan="2"><?php echo $i++ ?></td>
					<td><strong><?php echo $d->nama_siswa ?></strong></td>
					<td><?php echo $d->kode_identitas ?></td>
				</tr>
				<tr>					
					<td colspan="2">
						<div class="input-field">
							<textarea style="max-width:auto!important" name="inp-des_<?php echo $d->id ?>" id="" cols="30" rows="10" class="materialize-textarea"><?php echo $d->deskripsi ?></textarea>
							<label for="">Deskripsi Siswa</label>
						</div>
						<div class="input-field">
							<textarea style="max-width:auto!important" name="inp-cat_<?php echo $d->id ?>" id="" cols="30" rows="10" class="materialize-textarea"><?php echo $d->cat_sikap ?></textarea>
							<label for="">Catatan Wali Kelas</label>
						</div>
					</td>
				</tr>
			<?php endforeach ?>
		</table>
	</form>
</div>