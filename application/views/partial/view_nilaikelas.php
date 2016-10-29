<div class="col s12 filler">
	<form action="<?php echo site_url("rapor/raporkelas") ?>" method="POST">
	<div class="row">
		<div class="col s12 l3">
			<label>Kelas</label>
		    <select class="browser-default" name="kls">
		      <option value="" disabled >Pilih Kelas</option>
		      <?php foreach ($datasmt as $kls): ?>
		      	<option value="<?php echo base64_encode($kls->id) ?>" <?php echo $kls->id == $input_selection?"selected":"" ?>><?php echo getTingkat($kls->nama_kelas, $kls->tahun_masuk) ?> (<?php echo $kls->nomor_semester; ?>)</option>
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
		<table class="basic_table striped" id="tbnilai">
			<tr>
				<th>No</th>
				<th>Nama Siswa</th>
				<th>NIS</th>
				<?php foreach ($datamapel as $mapel): ?>					
					<th><?php echo $mapel->nama_mata_pelajaran ?></th>
				<?php endforeach ?>
			</tr>
			<?php if (count($datanilai) < 1): ?>
				<td style="text-align:center" colspan="<?php echo 3+count($datamapel) ?>">Belum ada nilai yang di inputkan!</td>
			<?php endif ?>
			<?php $i=0;foreach ($datanilai as $d): ?>
				<tr class="tbrow">
					<?php $cdatasiswa = $datasiswa[search_where($d["id"],$datasiswa,"id")] ?>
					<td><?php echo ++$i ?></td>
					<td><?php echo $cdatasiswa->nama_siswa ?></td>
					<td><?php echo $cdatasiswa->kode_identitas ?></td>
					<?php foreach ($datamapel as $mapel): ?>
						<td class="center-align"><strong><?php echo $d["nilai"][$mapel->id] ?></strong></td>
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