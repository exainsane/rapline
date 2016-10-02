<div class="col s12 <?php echo isset($form)?"l8":"l12" ?> filler">
	<blockquote class="border-blue"><h5><?php echo $table_title ?></h5></blockquote>
	<table class="basic_table striped">
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
<div class="col s12 l4">
	<?php if (isset($form)): ?>
		<?php echo $form ?>
	<?php endif ?>
</div>