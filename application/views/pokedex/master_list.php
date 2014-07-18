
<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pokedex
        <small>Master List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class=""><a href="<?php echo base_url(); ?>pokedex"><i class="fa fa-bug"></i> Pokedex</a></li>
        <li class="active"></i> Master List</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-md-12" id="">
	        <!-- Primary box -->
	        <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-bug"></i> Master List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="master-list" class="table table-bordered table-condensed table-striped data-table-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
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
                        <?php if ($all): ?>                            
                        <?php foreach ($all as $pkm): ?>
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
                                <th><img src="<?php echo $sprite_uri;?>" alt=""></th>
                                <td><a href="<?php echo $species_uri ?>" title=""><?php echo $species ?></a></td>
                                <td>
                                <?php foreach ($types as $type): ?>
                                    <?php 
                                    $type_id = strtolower($type);
                                    $type_uri = base_url()."type/".$type_id;
                                    ?>
                                    <a class="type-icon-flat type-<?php echo $type_id ?>" href="<?php echo $type_uri ?>"><?php echo $type ?></a>
                                <?php endforeach ?>
                                </td>
                                <td>
                                <?php $i = 0; foreach ($abilities as $ab) : if ($i > 0) echo " / "?>
                                    <?php 
                                    $ab_name = $ab->ability_name;
                                    $ab_id = $ab->ability_id;
                                    $ab_uri = base_url()."ability/".$ab_id;
                                    $id = $ab->id;
                                    ?>
                                    <?php if ($id == "H"): ?>
                                        <i><a class="text-red" href="<?php echo $ab_uri ?>"><?php echo $ab_name ?></a></i>
                                    <?php else: ?>
                                        <a href="<?php echo $ab_uri ?>"><?php echo $ab_name ?></a>
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
                        <?php else: ?>
                        <p class="text-red">Something's wrong here</p>
                        <?php endif ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
	    </div><!-- /.col -->
	</div>
    <?php #echo '<pre>';print_r($all); echo '</pre>' ?>
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