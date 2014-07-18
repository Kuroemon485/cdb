<table class="table table-condensed">
<thead>
	<tr>
		<th></th>
		<th>Type</th>
		<th>Category</th>
		<th>Power</th>
		<th>Accuracy</th>
		<th>PP</th>
	</tr>
</thead>

<tbody>
<?php foreach ($learn_set as $move): ?>
	<?php 
	$name = $move->name;
	$id = $move->id;
	$type = strtolower($move->type);
	$category = strtolower($move->category);
	$power = ($move->base_power != 0) ? $move->base_power : "--";
	$pp = ($move->pp != 0) ? $move->pp : "--";
	$acc = ($move->accuracy != 0) ? $move->accuracy : "--";
	 ?>
	<tr>
		<td><a href="#" data-toggle="fill-data" data-id="<?php echo $id ?>" data-name="<?php echo $name ?>"><?php echo $name ?></a></td>
		<td><span class="type-icon-flat type-<?php echo $type ?>"><?php echo $type ?></span></td>
		<td><span class="category-icon <?php echo $category ?>"></span></td>
		<td><?php echo $power ?></td>
		<td><?php echo $acc ?></td>
		<td><?php echo $pp ?></td>
	</tr>
<?php endforeach ?>
</tbody>
</table>