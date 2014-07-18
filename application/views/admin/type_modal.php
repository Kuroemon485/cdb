<?php 
$types_list = array('Bug', 'Dark', 'Dragon', 'Electric', 'Fairy', 'Fighting', 'Fire', 'Flying', 'Ghost', 'Grass', 'Ground', 'Ice', 'Normal', 'Poison', 'Psychic', 'Rock', 'Steel', 'Water');

 ?>
<div class="row">
<?php foreach ($types_list as $type): ?>
    <?php 
    $tid = strtolower($type);
    ?>
    <div class="col-sm-2">
        <a href="#" data-toggle="fill-data" data-name="<?php echo $type ?>" class="type-icon-flat type-<?php echo $tid ?>"><?php echo $type ?></a>
    </div>
<?php endforeach ?>
</div>