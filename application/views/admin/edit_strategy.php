<?php 
$types_list = array('Bug', 'Dark', 'Dragon', 'Electric', 'Fairy', 'Fighting', 'Fire', 'Flying', 'Ghost', 'Grass', 'Ground', 'Ice', 'Normal', 'Poison', 'Psychic', 'Rock', 'Steel', 'Water');
if (isset($current_pkm)) {
    foreach ($current_pkm as $key => $value) {
        ${$key} = $value;
    }
}
$natures = array("Adamant", "Bashful", "Bold", "Brave", "Calm", "Careful", "Docile", "Gentle", "Hardy", "Hasty", "Impish", "Jolly", "Lax", "Lonely", "Mild", "Modest", "Naive", "Naughty", "Quiet", "Quirky", "Rash", "Relaxed", "Sassy", "Serious", "Timid");
$stats_list = array('hp' => 'HP', 'atk' => 'Attack', 'def' => 'Defense', 'sp_atk' => 'Sp.Atk', 'sp_def' => 'Sp.Def', 'spd' => 'Speed');
?>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/control_panel/database"><i class="fa fa-user"></i> Admin</a></li>
            <li class="active">Edit strategy</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
       <div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Edit strategy</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-xs-4">
                    <select name="" id="strategy_list" class="form-control input-sm">
                        <option value="">Pick a strategy</option>
                        <?php if (isset($strategy_list)): ?>
                            <?php foreach ($strategy_list as $strategy): ?>
                                <option value="<?php echo $strategy->id ?>"><?php echo $strategy->name ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>

                <div class="col-md-4 col-xs-4">
                    <!-- <button class="btn btn-danger btn-sm"><i class="fa fa-eraser"></i> Reset</button> -->
                    <button id="submit-strategy" class="btn btn-primary btn-sm" data-work-mode="edit"><i class="fa fa-check"></i> Submit</button>
                </div>
            </div><!-- .row for Build Name-->
            <div class="row">
                <div class="col-md-4 col-xs-4">
                    <label for="" class="label-control">Name</label>
                    <input type="text" id="strategy-name" class="form-control input-sm" placeholder="Strategy name">
                </div>
                <div class="col-md-4 col-xs-4">
                    <label for="" class="label-control">Species</label>
                    <select class="form-control input-sm" id="strategy-species-id" name="">
                        <option value="">Pick a species</option>
                        <?php foreach ($pkm_list as $pkm): ?>
                            <option value="<?php echo $pkm->species_id ?>"><?php echo $pkm->species ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="label-control"><i class="fa fa-image"></i></label>
                    <img src="<?php echo base_url()?>public/images/f-sprite/egg.png" alt="" class="center-block img-responsive pkm-sprite" id="pkm-img">
                </div>
                <div class="col-md-3 col-xs-4">
                    <label for="" class="label-control"><i class="fa fa-gift"></i> Ability</label>
                    <input type="text" name="" data-toggle="modal" data-input="ability" id="strategy-ability" class="form-control input-sm" data-species-id="<?php if (isset($species_id)) echo $species_id ?>"></input>
                    <label for="" class="label-control"><i class="fa fa-key"></i> Item</label>
                    <input name="" type="text" data-toggle="modal" data-input="item" id="strategy-item" class="form-control input-sm"></input>
                </div>
                <div class="col-md-3 col-xs-4">
                    <label for="" class="label-control">Level</label>
                    <input type="number" id="strategy-lv" name="" id="" min="1" max="100" value="100" class="form-control input-sm">
                    <label for="" class="label-control">Happiness</label>
                    <input type="number" id="strategy-happiness" name="" id="" min="0" max="255" value="255" class="form-control input-sm">
                </div>
                <div class="col-md-3 col-xs-4">
                    <label for="" class="label-control">Nature</label>
                    <select name="" id="nature-list" class="form-control input-sm">
                        <?php foreach ($natures as $nature): ?>
                            <option value="<?php echo $nature ?>"><?php echo $nature ?></option>
                        <?php endforeach ?>
                    </select>

                </div>
            </div><!-- .row for Detail-->
            <div class="row">
                <div class="col-md-3  col-xs-3">
                    <label for="" class="label-control">Move 1</label>
                    <input type="text" data-toggle="modal" data-input="learn_set" name="" id="strategy-move-1" class="form-control input-sm" data-species-id="<?php if (isset($species_id)) echo $species_id ?>"></input>
                </div>
                <div class="col-md-3  col-xs-3">
                    <label for="" class="label-control">Move 2</label>
                    <input type="text" data-toggle="modal" data-input="learn_set" name="" id="strategy-move-2" class="form-control input-sm" data-species-id="<?php if (isset($species_id)) echo $species_id ?>"></input>
                </div>
                <div class="col-md-3  col-xs-3">
                    <label for="" class="label-control">Move 3</label>
                    <input type="text" data-toggle="modal" data-input="learn_set" name="" id="strategy-move-3" class="form-control input-sm" data-species-id="<?php if (isset($species_id)) echo $species_id ?>"></input>
                </div>
                <div class="col-md-3  col-xs-3">
                    <label for="" class="label-control">Move 4</label>
                    <input type="text" data-toggle="modal" data-input="learn_set" name="" id="strategy-move-4" class="form-control input-sm" data-species-id="<?php if (isset($species_id)) echo $species_id ?>"></input>
                </div>
            </div><!-- .row for Moves-->
            <div class="row">
                <div class="col-md-12">
                    <label for="" class="label-control">Stats</label>
                    <table class="table table-condensed table-responsive">
                        <thead>
                            <tr>
                                <th>Base</th>
                                <th colspan="2" id="tbs"></th>
                                <th colspan="">EVs</th>
                                <th>IVs</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stats_list as $key => $value): ?>
                                <tr>
                                    <th><?php echo $value ?></th>
                                    <td><span id="base-<?php echo $key ?>" class="badge">0</span></td>
                                    <td class="col-md-6 col-sm-6 col-xs-0">
                                        <div class="progress sm progress-striped">
                                            <div class="progress-bar" id="base-<?php echo $key ?>-bar" style="width: 0%"></div>
                                        </div>
                                    </td>
                                    <td class="col-md-1 col-sm-1 col-xs-1">
                                        <input type="text" min="0" max="252" maxlength="3" size="3" class="form-control input-sm input-ev" id="ev-<?php echo $key ?>" value="0">
                                    </td>
                                    <td class="col-md-1 col-sm-1 col-xs-1">
                                        <input type="text"  min="0" max="31" maxlength="2" size="3" id="iv-<?php echo $key ?>" class="form-control input-sm input-iv" value="31">
                                    </td>
                                    <td class="col-md-1 col-sm-1 col-xs-1">
                                        <b class="text-green" id="total-<?php echo $key ?>" readonly=""></b>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- .row -->
            <div class="row">
                <div class="col-md-12">
                    <form>
                        <textarea id="strategy-desc" class="wysihtml5" id="strategy-description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>                      
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="response-modal">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title text-green" id="response-title"></h4>
                    </div>
                    <div class="modal-body" id="response-message">
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
    </div>
</section>
</aside>