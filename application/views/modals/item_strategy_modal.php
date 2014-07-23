<?php if ($strategies): ?>
<table class="table table-condensed">
	<thead>
		<tr>
			<th></th>
			<th>Pokemon</th>
			<th>Strategy</th>
		</tr>
	</thead>
	<tbody>
			<?php foreach ($strategies as $strategy): ?>
				<?php
				foreach ($strategy as $key => $value) {
					${$key} = $value;
				}
				?>
				<tr>
					<td class="col-xs-1"><img src="<?php echo base_url() ?>public/images/minisprites/<?php echo $species ?>.png" alt=""></td>
					<td class="col-xs-4"><a href="<?php echo base_url() ?>pokemon/<?php echo $species_id ?>" title="" data-toggle="" data-name="<?php echo $name ?>"><?php echo $species ?></a></td>
					<td class="col-xs-6"><?php echo $name ?></td>
				</tr>
			<?php endforeach ?>
	</tbody>
</table>
<?php else: ?>
	There's nothing here yet. May be you can help out?
<?php endif ?>