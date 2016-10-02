<form action="<?php echo site_url("data/assignkelas") ?>" method="POST">
<div class="row">
	<div class="col s12 l3">
		<label>Semester</label>
	    <select class="browser-default" name="for_tahun">
	      <option value="" disabled >Pilih Tahun Angkatan</option>
	      <?php foreach ($datasmt as $smt): ?>
	      	<option value="<?php echo $smt->tahun_masuk ?>" <?php echo $smt->tahun_masuk == $smt_now?"selected":"" ?>>Tahun Angkatan <?php echo $smt->tahun_masuk ?></option>
	      <?php endforeach ?>	      
	    </select>
	</div>
	<div class="col s12 l4">
		<button class="btn indigo darken-1" style="margin-top:20px">Terapkan</button>
	</div>
</div>
</form>
<div class="col s12 filler">
	<blockquote class="border-blue"><h5><?php echo $table_title ?></h5></blockquote>
	<table class="basic_table striped">
		<tr>
			<th>No</th>
		<?php foreach ($fields as $f): ?>
			<th><?php echo $fcaption[$f] ?></th>
		<?php endforeach ?>
		</tr>	
		<?php $i=0;foreach ($data as $d): ?>
			<tr>
				<td><?php echo ++$i ?></td>
				<?php foreach ($fields as $f): ?>

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