<div class="col s12 l8">
	<table>
		<?php foreach ($fields as $f): ?>
			<th><?php echo $f ?></th>
		<?php endforeach ?>
		<?php foreach ($data as $d): ?>
			<tr>
				<?php foreach ($fields as $f): ?>
					<?php if (isset($d[$f])): ?>
						<td><?php echo $d[$f] ?></td>
					<?php else: ?>
						<td>-</td>
					<?php endif ?>
				<?php endforeach ?>
			</tr>
		<?php endforeach ?>
	</table>
</div>
<div class="col s12 l4">
	<div class="card padding20">
		<?php echo $form ?>
	</div>
</div>