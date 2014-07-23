<table class="table table-condensed">
	<thead>
		<tr>
			<th></th>
			<th>Name</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($item_list as $item): ?>
			<?php
			foreach ($item as $key => $value) {
				${$key} = $value;
			}
			?>
			<tr>
				<td class="col-xs-1"><img src="<?php echo base_url() ?>public/images/items/<?php echo $id ?>.png" alt=""></td>
				<td class="col-xs-3"><a href="#" title="" data-toggle="fill-data" data-name="<?php echo $name ?>"><?php echo $name ?></a></td>
				<td class="col-xs-8"><?php echo $desc ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>