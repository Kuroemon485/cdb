<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Admin
            <small>Post News</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-user"></i> Admin</a></li>
            <li class="active">Post News</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" id="move-section">
                <!-- Primary box -->
                <div class="box box-solid box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add new Species</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="label-control">Species ID</label>
                                <input type="text" id="pkm-species_id" class="form-control input-sm">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label" for="pkm-dex_id">Index</label>
                                <input type="text" class="form-control input-sm" id="pkm-dex_id" placeholder="Index" value="<?php echo (isset($dex_id) ? $dex_id : "") ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" for="pkm-species">Name</label>
                                <input type="text" class="form-control input-sm" id="pkm-species" placeholder="Name" value="<?php echo (isset($species) ? $species : "") ?>"/>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label" for="pkm-form">Base Species</label>
                                <select class="form-control input-sm selectpicker" id="pkm-base_species" placeholder="">
                                    <option value="0">Select a species</option>
                                    <?php foreach ($pkm_list as $pkm): ?>
                                        <option value="<?php echo $pkm->species_id ?>" <?php if(isset($base_species) && $base_species == $pkm->species_id) echo "selected" ?>><?php echo $pkm->dex_id.". ".$pkm->species ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label" for="pkm-hp">HP</label>
                                <input type="text" class="form-control input-sm" id="pkm-hp" placeholder="HP" value="<?php echo (isset($hp) ? $hp : "") ?>"/>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label" for="pkm-att">ATK</label>
                                <input type="text" class="form-control input-sm" id="pkm-atk" placeholder="ATT" value="<?php echo (isset($atk) ? $atk : "") ?>"/>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label" for="pkm-def">DEF</label>
                                <input type="text" class="form-control input-sm" id="pkm-def" placeholder="DEF" value="<?php echo (isset($def) ? $def : "") ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label" for="pkm-satt">Special ATK</label>
                                <input type="text" class="form-control input-sm" id="pkm-sp_atk" placeholder="Special ATT" value="<?php echo (isset($sp_atk) ? $sp_atk : "") ?>"/>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label" for="pkm-sdef">Special DEF</label>
                                <input type="text" class="form-control input-sm" id="pkm-sp_def" placeholder="Special DEF" value="<?php echo (isset($sp_def) ? $sp_def : "") ?>"/>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label" for="pkm-spd">Speed</label>
                                <input type="text" class="form-control input-sm" id="pkm-spd" placeholder="Speed" value="<?php echo (isset($spd) ? $spd : "") ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="label-control">Height (m)</label>
                                <input type="text" id="pkm-heigt_m" class="form-control input-sm">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label" for="pkm-dex_id">Weight (kg)</label>
                                <input type="text" class="form-control input-sm" id="pkm-weight_kg" placeholder="Index" value="<?php echo (isset($dex_id) ? $dex_id : "") ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-primary btn-block" id="submit-pokemon-btn"><i class="fa fa-check"></i> Submit</button>
                    </div>
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
    </section>
</aside>