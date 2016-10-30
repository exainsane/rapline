<div class="col s12 filler">
	<form action="<?php echo site_url("data/eskul") ?>" method="POST">
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
			<a class="btn purple darken-1 modal-trigger" href="#popupform" style="margin-top:20px">Tambah Data</a>	
		</div>
	</div>
	</form>
	<blockquote class="border-blue"><h5><?php echo $table_title ?></h5></blockquote>
	<style>
		.lst_pkl > td > a{
			visibility: collapse;
		}
		.lst_pkl > td:hover > a{
			visibility: visible;
		}
		.lst_pkl > td:hover > a:hover{
			color: red;
		}
	</style>	
	<input type="hidden" name="ins" value="<?php echo base64_encode($input_selection) ?>">
	<table class="basic_table" id="">
		<tr>
			<th>No</th>
			<th>Nama Siswa</th>				
			<th>NIS</th>
		</tr>
		<?php $i=1;$lid = "";foreach ($data as $d): ?>
			<?php if ($lid != $d->kode_identitas): ?>					
				<tr class="orange lighten-1">
					<td><?php echo $i++ ?></td>
					<td><strong><?php echo $d->nama_siswa ?></strong></td>
					<td><?php echo $d->kode_identitas ?></td>
				</tr>				
			<?php endif ?>
			<?php $lid = $d->kode_identitas ?>
				<tr class="lst_pkl">
					<td></td>
					<td><strong><i><?php echo $d->nama_eskul ?></i></strong> <a href="<?php echo site_url("actions/del_eskul?d=".base64_encode($d->id)) ?>">Delete</a></td>
					<td><strong><?php echo $d->keterangan ?></strong></td>
				</tr>
		<?php endforeach ?>
	</table>	
</div>
<div class="modal" id="popupform">
	<div class="modal-content">
		<h3>Tambahkan data Ekstrakurikuler</h3>
		<form action="<?php echo site_url("actions/save_eskul") ?>" method="POST">
			<input type="hidden" name="smt" value="<?php echo base64_encode($assigned->id) ?>">
			<table>
				<tr>
					<td>Semester</td>
					<td>:</td>
					<td><b><?php echo $assigned->nomor_semester ?></b></td>
				</tr>
				<tr>
					<td>Nama & NIS Siswa</td>
					<td>:</td>
					<td>
						<select name="siswa" id="" class="browser-default" required>
							<option value="" disabled="true">Pilih Siswa</option>
							<?php foreach ($dtsiswa as $siswa): ?>
								<option value="<?php echo base64_encode($siswa->id) ?>" required><?php echo $siswa->nama_siswa." (".$siswa->kode_identitas.")" ?></option>
							<?php endforeach ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Kegiatan Ektrakurikuler yang dijalani</td>
					<td>:</td>
					<td>
						<div class="input-field">
							<textarea name="nama_eskul" id="" cols="30" rows="10" required class="materialize-textarea"></textarea>
						</div>
					</td>
				</tr>
				<tr>
					<td>Keterangan</td>
					<td>:</td>
					<td>
						<div class="input-field">
							<textarea name="keterangan" id="" cols="30" rows="10" required class="materialize-textarea"></textarea>
						</div>
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