<?php
$name = $detail->name
?>

<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Type
        <small><?php echo $name ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>type"><i class="fa fa-fire"></i> Type</a></li>
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
                    <!-- <li class=""><a href="#type-description" data-toggle="tab">Type Match up</a></li> -->
                    <li class=""><a href="#move-list" data-toggle="tab">Move</a></li>
                    <li class="active"><a href="#pokemon_list" data-toggle="tab">Pokemon</a></li>
                    <li class="pull-left header"><i class="fa fa-fire"></i><?php echo $name ?></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="type-description">
                        
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane active" id="pokemon_list">
                        <table class="table table-bordered table-condensed table-striped data-table-full table-responsive">
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
                                    <td class="col-sm-2">
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
                                            <i><a class="text-red ability" data-toggle="tooltip" data-original-title="" data-ab-id="<?php echo $ab_id ?>" href="<?php echo $ab_uri ?>"><?php echo $ab_name ?></a></i>
                                        <?php else: ?>
                                            <a class="ability" data-toggle="tooltip" data-original-title="" data-ab-id="<?php echo $ab_id ?>" href="<?php echo $ab_uri ?>"><?php echo $ab_name ?></a>
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
                    <div class="tab-pane" id="move-list">
                        <table class="table table-bordered table-condensed table-striped data-table-full">
                            <thead>
                                <tr>
                                    <th>Move</th>
                                    <th>Category</th>
                                    <th>Power</th>
                                    <th>PP</th>
                                    <th>Acc.</th>
                                    <th class="col-md-6">Effect</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($move_list as $move): ?>
                                    <?php 
                                    $id = $move->id;
                                    $name = $move->name;
                                    $move_uri = base_url()."move/".$id;
                                    $category = $move->category;
                                    $l_cat = strtolower($category);
                                    $base_power = ($move->base_power > 0) ? $move->base_power : '--';
                                    $pp = ($move->pp > 0) ? $move->pp : '--';
                                    $accuracy = ($move->accuracy > 0) ? $move->accuracy : '--';
                                    $desc = $move->short_desc;
                                    ?>
                                    <tr>
                                        <td><a href="<?php echo $move_uri ?>"><?php echo $move->name ?></a></td>
                                        <td><?php echo " <span href='' class='category-icon {$l_cat}'></span>"; ?></td>
                                        <td><?php echo $base_power; ?></td>
                                        <td><?php echo $pp ?></td>
                                        <td><?php echo $accuracy;?></td>
                                        <td  class="col-sm-6"><?php echo $desc; ?></td>
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
    <?php #echo '<pre>';print_r($pokemon); echo '</pre>' ?>
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