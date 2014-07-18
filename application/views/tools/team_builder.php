<?php
$types_list = array('Bug', 'Dark', 'Dragon', 'Electric', 'Fairy', 'Fighting', 'Fire', 'Flying', 'Ghost', 'Grass', 'Ground', 'Ice', 'Normal', 'Poison', 'Psychic', 'Rock', 'Steel', 'Water');
$natures = array("Adamant", "Bashful", "Bold", "Brave", "Calm", "Careful", "Docile", "Gentle", "Hardy", "Hasty", "Impish", "Jolly", "Lax", "Lonely", "Mild", "Modest", "Naive", "Naughty", "Quiet", "Quirky", "Rash", "Relaxed", "Sassy", "Serious", "Timid");
$stats_list = array('hp' => 'HP', 'atk' => 'Attack', 'def' => 'Defense', 'sp_atk' => 'Sp.Atk', 'sp_def' => 'Sp.Def', 'spd' => 'Speed');
function rc() {
    $colors = array('blue', 'green', 'red', 'yellow', 'aqua', 'purple', 'teal', 'maroon');
    return $colors[rand()&7];
}
?>

<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Tool
        <small>Team Builder</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Team Builder</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-xs-3" id="">
            <div class="box box-info" id="team-builder">
                <div class="box-header">
                    <input type="text" name="" id="input-team-name" class="form-control borderless" placeholder="Team Name">
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <?php for ($i=1; $i <= 6; $i++) : ?>
                        <div class="col-xs-6">
                        <a href="#" data-tab="pkm-<?php echo $i ?>" class="small-box bg-<?php echo rc() ?> see-pkm">
                            <div class="inner">
                                <img id="p<?php echo $i ?>-ico" class="center-block" src="<?php echo base_url() ?>public/images/minisprites/ani-egg.png" alt="">
                            </div>
                            <div class="small-box-footer">
                                <span class="pkm<?php echo $i ?>-name">PKM <?php echo $i ?></span>
                            </div>
                        </a>
                        </div>
                        <?php endfor ?>
                    </div> <!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button id="ie-button" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Import/Export</button>
                    <button id="save-button" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save</button>
                </div>
            </div><!-- /.box -->
	    </div><!-- /.col -->

        <div class="col-xs-9" id="">
            <div class="box box-info" id="team-preview">
                <div class="box-header">
                    <h3 class="box-title text-green" id="team-name">Team Name</h3>
                    <div class="box-tools pull-right">
                        <!-- reserved -->
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs" id="team-tab">
                            <?php for ($i=1; $i <= 6; $i++): ?>
                            <li class="<?php if ($i == 1) echo 'active' ?>"><a href="#pkm-<?php echo $i ?>" data-toggle="tab">Pokemon <?php echo $i ?></a></li>
                            <?php endfor ?>
                        </ul>
                        <div class="tab-content">
                            <?php for ($i=1; $i <= 6; $i++): ?>
                            <div class="tab-pane <?php if ($i==1) echo 'active' ?>" id="pkm-<?php echo $i ?>" data-tab-number="<?php echo $i ?>">
                                <label for="" class="label-control">Pokemon</label>
                                <div class="row">
                                    <div class="col-md-3 col-xs-3">
                                        <select name="" id="p<?php echo $i ?>-species" class="form-control input-sm pkm-list selectpicker" data-placeholder="Pick a Pokemon" data-live-search="true">
                                            <option value="">Pick a Pokemon</option>
                                            <?php foreach ($pkm_list as $pkm): ?>
                                                <option value="<?php echo $pkm->species_id ?>"><?php echo $pkm->species ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                    <label for="" class="label-control"><i class="fa fa-image"></i></label>
                                    <img id="p<?php echo $i ?>-img" src="<?php echo base_url()?>public/images/f-sprite/egg.png" alt="" class="center-block img-responsive pkm-sprite">
                                    </div>
                                    <div class="col-md-3 col-xs-4">
                                        <label for="" class="label-control"><i class="fa fa-gift"></i> Ability</label>
                                        <input type="text" class="form-control input-sm" id="p<?php echo $i ?>-ability" data-toggle="modal" data-input="ability">
                                        <label for="" class="label-control"><i class="fa fa-key"></i> Item</label>
                                        <input type="text" class="form-control input-sm" id="p<?php echo $i ?>-item" data-toggle="modal" data-input="item">
                                    </div>
                                    <div class="col-md-3 col-xs-4">
                                        <label for="" class="label-control">Level</label>
                                        <input type="number" id="p<?php echo $i ?>-lv" name="" id="" min="1" max="100" value="100" class="form-control input-sm">
                                        <label for="" class="label-control">Happiness</label>
                                        <input type="number" id="p<?php echo $i ?>-happiness" name="" id="" min="0" max="255" value="255" class="form-control input-sm">
                                    </div>
                                    <div class="col-md-3 col-xs-4">
                                        <label for="" class="label-control">Nature</label>
                                        <select name="" id="p<?php echo $i ?>-nature" class="form-control input-sm nature-list">
                                            <?php foreach ($natures as $nature): ?>
                                                <option value="<?php echo $nature ?>"><?php echo $nature ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-xs-4">
                                        <label for="" class="label-control">Gender</label>
                                        <select name="" id="p<?php echo $i ?>-gender" class="form-control input-sm gender-list">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div><!-- .row for Detail-->
                                <div class="row">
                                <?php for ($j=1; $j <= 4; $j++): ?>
                                    <div class="col-md-3 col-xs-6">
                                        <label for="" id="p<?php echo $i ?>-move-<?php echo $j ?>" class="label-control">Move <?php echo $j ?></label>
                                        <input type="text" id="p<?php echo $i ?>-m<?php echo $j ?>" class="form-control input-sm" data-toggle="modal" data-input="learn_set">
                                    </div>
                                <?php endfor ?>
                                </div><!-- .row for Moves-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="" class="label-control">Stats</label>
                                        <table class="table table-condensed table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Base</th>
                                                    <th colspan="2" id="p<?php echo $i ?>-tbs"></th>
                                                    <th colspan="2">EVs</th>
                                                    <th>IV</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($stats_list as $key => $value): ?>
                                                <tr>
                                                    <th><?php echo $value ?></th>
                                                    <td><span id="p<?php echo $i ?>-base-<?php echo $key ?>" class="badge">--</span></td>
                                                    <td class="col-md-3 col-sm-3 col-xs-0">
                                                        <div class="progress sm progress-striped">
                                                            <div class="progress-bar" id="p<?php echo $i ?>-base-<?php echo $key ?>-bar" style="width: 0%"></div>
                                                        </div>
                                                    </td>
                                                    <td class="col-md-3 col-sm-3 col-xs-0">
                                                        <input class="ev-range" id="p<?php echo $i ?>-ev-<?php echo $key ?>" type="text" name="ev-range-<?php echo $key ?>" value="" />
                                                    </td>
                                                    <td class="col-md-1 col-sm-1 col-xs-1">
                                                        <input type="text" min="0" max="252" maxlength="3" size="3" class="form-control input-sm input-ev" id="p<?php echo $i ?>-ev-<?php echo $key ?>" value="0">
                                                    </td>
                                                    <td class="col-md-1 col-sm-1 col-xs-1">
                                                        <input type="text"  min="0" max="31" maxlength="2" size="3" id="p<?php echo $i ?>-iv-<?php echo $key ?>" class="form-control input-sm input-iv" value="31">
                                                    </td>
                                                    <td class="col-md-1 col-sm-1 col-xs-1">
                                                        <span class="text-green" id="p<?php echo $i ?>-total-<?php echo $key ?>" readonly=""></span>
                                                    </td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- .row -->
                            </div><!-- /.tab-pane -->
                            <?php endfor ?>
                        </div><!-- /.tab-content -->
                    </div><!-- nav-tabs-custom -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
	</div>
    <?php #echo '<pre>';print_r($info); echo '</pre>' ?>
    <?php #echo '<pre>';print_r($pokemon_list); echo '</pre>' ?>
    <?php echo "<pre>{elapsed_time}/{memory_usage}</pre>";?>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="notice-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
					<h4 class="modal-title" id="notice-title">Warning</h4>
				</div>
				<div class="modal-body" id="notice-message">
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade data-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" id="">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
					<h4 class="modal-title" id="data-title"></h4>
				</div>
				<div class="modal-body" id="data-container">
				</div>
			</div>
		</div>
	</div>
    <div class="modal fade ie-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" id="">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                    <h4 class="modal-title" id="ie-title">Import - Export</h4>
                </div>
                <div class="modal-body" id="ie-container">
                    <textarea name="" id="" rows="10" class="form-control input-sm" value=""></textarea>
                </div>
                <div class="modal-footer">
                    <div class="row pull-right">
                        <div class="col-xs-12">
                            <button id="import-btn" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Import</button>
                            <button id="" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</aside>