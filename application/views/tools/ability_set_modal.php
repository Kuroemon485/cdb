<?php 
#print_r($ability_set);
 ?>
<table class="table table-condensed">
<thead>
	<tr>
		<th>Name</th>
		<th>Rating</th>
		<th>Description</th>
	</tr>
</thead>
<tbody>
<?php foreach ($ability_set as $key => $value) : ?>
	<?php 
	$name = $value->name;
	$desc = $value->desc;
	$rating = $value->rating;
	switch ($rating) {
	    case 5:
	        $rating_text = "lead";
	        break;
	    case 4:
	        $rating_text = "text-green";
	        break;
	    case 3:
	        $rating_text = "text-aqua";
	        break;
	    case 2:
	        $rating_text = "text-light-blue";
	        break;
	    case 1:
	        $rating_text = "text-red";
	        break;
	    case 0:
	        $rating_text = "text-yellow";
	    case -1:
	        $rating_text = "text-muted";
	        break;
	    default:
	        $rating_text = "text-muted";
	        break;
	}
	 ?>
	<tr>
		<td><a href="#" class="<?php if($key === "H") echo "text-red" ?>" data-toggle="fill-data" data-name="<?php echo $name ?>"><?php echo $name ?></a></td>
		<td class="col-xs-1 <?php echo $rating_text ?>"><?php echo $rating ?></td>
		<td class="col-xs-8"><?php echo $desc ?></td>
	</tr>
<?php endforeach ?>
</tbody>
</table>