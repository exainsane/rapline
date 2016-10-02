<div class="col s12 filler">
	<form action="<?php echo site_url("rapor/show/") ?>" method="POST">
	<div class="row">
		<div class="col s12 l3">
			<label>Semester</label>
		    <select class="browser-default" name="smt">
		      <option value="" disabled >Pilih Semester</option>
		      <?php foreach ($datasmt as $smt): ?>
		      	<option value="<?php echo base64_encode($smt->id) ?>" <?php echo $smt->id == $smt_now?"selected":"" ?>><?php echo $smt->nomor_semester." (".$smt->tahun_masuk."/".($smt->tahun_masuk+1).")" ?></option>
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
	<table class="basic_table striped initial-default">
		<tr>
			<th>No</th>
		<?php foreach ($fields as $f): ?>
			<?php if (strlen($fcaption[$f]) > 0): ?>
				<th><?php echo $fcaption[$f] ?></th>
			<?php endif ?>
		<?php endforeach ?>
		</tr>
		<?php $i=0;foreach ($data as $d): ?>
			<tr>
			<td><?php echo ++$i ?></td>
				<?php foreach ($fields as $f): ?>			
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