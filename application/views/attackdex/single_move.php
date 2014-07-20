<?php
$id = $info->id;
$name = $info->name;
$type = $info->type;
$type_id = strtolower($type);
$type_uri = base_url()."type/".$type_id;
$category = $info->category; 
$cat_id = strtolower($category);
$base_power = $info->base_power;
$pp = $info->pp;
$accuracy = $info->accuracy;
$priority = $info->priority;
$target = $info->target;
$desc = $info->desc;
$short_desc = $info->short_desc;
$no = $info->no;
?>
<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View
        <small>Move ~ <?php echo $name ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>move"><i class="fa fa-ge"></i> Move</a></li>
        <li class="active"><?php echo $name ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-md-12" id="">
	        <!-- Primary box -->
	        <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    <li><a href="#pokemon_list" data-toggle="tab">Pokemon</a></li>
                    <li class="active"><a href="#move-description" data-toggle="tab">Description</a></li>
                    <li class="pull-left header"><i class="fa fa-ge"></i><?php echo $name ?></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="move-description">
                        <p><b class="text-muted">#<?php echo $no ?></b></p>
                        <p><b class="text-muted">Type: </b><a class="type-icon-flat type-<?php echo $type_id ?>" href="<?php echo $type_uri ?>"><?php echo $type ?></a> <span class="category-icon <?php echo $cat_id ?>" title=""><?php echo $category ?></span></p>
                        <p><b class="text-muted">Power: </b><?php echo $base_power ?></p>
                        <p><b class="text-muted">PP: </b><?php echo $pp ?></p>
                        <p><b class="text-muted">Accuracy: </b><?php echo $accuracy ?></p>
                        <p><b class="text-muted">Priority: </b><?php echo $priority ?></p>
                        <p><b class="text-muted">Target: </b><?php echo $target ?></p>
                        <p><b class="text-muted">Description: </b><?php echo $desc ?></p>
                        <p><b class="text-muted">Short Description: </b><?php echo $short_desc ?></p>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="pokemon_list">
                        <table class="table table-bordered table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Ability</th>
                                    <th>HP</th>
                                    <th>ATK</th>
                                    <th>DEF</th>
                                    <th>S.ATK</th>
                                    <th>S.DEF</th>
                                    <th>SPD</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($pokemon_list as $pkm): ?>
                                <?php
                                $species_id = $pkm->species_id;
                                $species = $pkm->species;
                                $species_uri = base_url()."pokemon/".$species_id;
                                $dex_id = $pkm->dex_id;
                                $types = $pkm->types;
                                $abilities = $pkm->abilities;
                                $hp = $pkm->hp;
                                $atk = $pkm->atk;
                                $def = $pkm->def;
                                $sp_atk = $pkm->sp_atk;
                                $sp_def = $pkm->sp_def;
                                $spd = $pkm->spd;
                                $sprite_uri = base_url()."public/images/minisprites/".$species.".png";
                                ?>
                                <tr>
                                    <td><?php echo $dex_id?></td>
                                    <td><a href="<?php echo $species_uri ?>" title=""><?php echo $species ?></a></td>
                                    <td  class="col-sm-2">
                                    <?php foreach ($types as $type): ?>
                                        <?php 
                                        $type_id = strtolower($type);
                                        $type_uri = base_url()."type/".$type_id;
                                        ?>
                                        <a class="type-icon-flat type-<?php echo $type_id ?>" href="<?php echo $type_uri ?>"><?php echo $type ?></a>
                                    <?php endforeach ?>
                                    </td>
                                    <td class="col-sm-3">
                                    <?php $i = 0; foreach ($abilities as $ab) : if ($i > 0) echo " / "?>
                                        <?php 
                                        $ab_name = $ab->ability_name;
                                        $ab_id = $ab->ability_id;
                                        $ab_uri = base_url()."ability/".$ab_id;
                                        $id = $ab->id;
                                        ?>
                                        <?php if ($id == "H"): ?>
                                            <i><a class="text-red ability" data-toggle="popover" data-content="" data-ab-id="<?php echo $ab_id ?>" href="<?php echo $ab_uri ?>"><?php echo $ab_name ?></a></i>
                                        <?php else: ?>
                                            <a class="ability" data-toggle="popover" data-content="" data-ab-id="<?php echo $ab_id ?>" href="<?php echo $ab_uri ?>"><?php echo $ab_name ?></a>
                                        <?php endif; $i++ ?>
                                    <?php endforeach; ?>
                                    </td>
                                    <td><?php echo $hp ?></td>
                                    <td><?php echo $atk ?></td>
                                    <td><?php echo $def ?></td>
                                    <td><?php echo $sp_atk ?></td>
                                    <td><?php echo $sp_def ?></td>
                                    <td><?php echo $spd ?></td>
                                    <td><b><?php echo $hp+$atk+$def+$sp_atk+$sp_def+$spd ?></b></td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
	    </div><!-- /.col -->
	</div>
    <?php #echo '<pre>';print_r($info); echo '</pre>' ?>
    <?php #echo '<pre>';print_r($pokemon_list); echo '</pre>' ?>
    <?php echo "<pre>{elapsed_time}/{memory_usage}</pre>";?>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="notice-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="notice-title">Warning</h4>
				</div>
				<div class="modal-body" id="notice-message">
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="success-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="notice-title">Success</h4>
				</div>
				<div class="modal-body" id="notice-message">
					Hooray!
				</div>
			</div>
		</div>
	</div>
</section>
</aside>