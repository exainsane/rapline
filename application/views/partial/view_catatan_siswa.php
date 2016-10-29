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
			</tr>
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