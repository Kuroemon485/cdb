<?php 
$current_pkm = isset($current_pkm) ? $current_pkm : null;
?>
<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit
        <small>Pokemon</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Edit Pokemon</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-md-4" id="basic-section">
	        <!-- Primary box -->
	        <div class="box box-solid box-primary">
	            <div class="box-header">
	                <h3 class="box-title">Basic</h3>
	            </div>
	            <div class="box-body">
	            <div class="row">
		            <div class="col-md-6">
	            		<label class="control-label" for="pkm-pkdx_id">Pokedex ID</label>
		            	<select class="form-control" name="" id="pkm-pkdx_id">
	                    	<option value="">Select a Pokemon</option>
	                    	<?php foreach ($all_pkm as $pkm ): ?>
								<option value="<?php echo $pkm->pkdx_id; ?>" <?php if ( $current_pkm != null ) {if ($pkm->pkdx_id == $current_pkm->pkdx_id) echo 'selected';}?>><?php echo $pkm->national_id.'. '.$pkm->name; ?><?php if (isset($pkm->form)) echo ' '.$pkm->form ?></option>
							<?php endforeach ?>
	                    </select>
                    </div>
                    <div class="col-md-6">
	            		<label class="control-label" for="pkm-national_id">Index</label>
                    	<input type="text" class="form-control" id="pkm-national_id" placeholder="Index" value="<?php if ( $current_pkm != null ) echo $current_pkm->national_id; ?>"/>
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-6">
	            		<label class="control-label" for="pkm-name">Name</label>
                    	<input type="text" class="form-control" id="pkm-name" placeholder="Name" value="<?php if ( $current_pkm != null ) echo $current_pkm->name ?>"/>
	            	</div>
	            	<div class="col-md-6">
	            		<label class="control-label" for="pkm-form">Form</label>
                    	<input type="text" class="form-control" id="pkm-form" placeholder="Form" value="<?php if ( $current_pkm != null && isset($current_pkm->form)) echo $current_pkm->form ?>"/>
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-4">
	            		<label class="control-label" for="pkm-hp">HP</label>
                    	<input type="text" class="form-control" id="pkm-hp" placeholder="HP" value="<?php if ( $current_pkm != null ) echo $current_pkm->stats->hp ?>"/>
	            	</div>
	            	<div class="col-md-4">
	            		<label class="control-label" for="pkm-att">ATT</label>
                    	<input type="text" class="form-control" id="pkm-attack" placeholder="ATT" value="<?php if ( $current_pkm != null ) echo $current_pkm->stats->attack ?>"/>
	            	</div>
	            	<div class="col-md-4">
	            		<label class="control-label" for="pkm-def">DEF</label>
                    	<input type="text" class="form-control" id="pkm-defense" placeholder="DEF" value="<?php if ( $current_pkm != null ) echo $current_pkm->stats->defense ?>"/>
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-4">
	            		<label class="control-label" for="pkm-satt">Special ATT</label>
                    	<input type="text" class="form-control" id="pkm-sp_atk" placeholder="Special ATT" value="<?php if ( $current_pkm != null ) echo $current_pkm->stats->sp_atk ?>"/>
	            	</div>
	            	<div class="col-md-4">
	            		<label class="control-label" for="pkm-sdef">Special DEF</label>
                    	<input type="text" class="form-control" id="pkm-sp_def" placeholder="Special DEF" value="<?php if ( $current_pkm != null ) echo $current_pkm->stats->sp_def ?>"/>
	            	</div>
	            	<div class="col-md-4">
	            		<label class="control-label" for="pkm-spd">Speed</label>
                    	<input type="text" class="form-control" id="pkm-speed" placeholder="Speed" value="<?php if ( $current_pkm != null ) echo $current_pkm->stats->speed ?>"/>
	            	</div>
	            </div>
	            </div><!-- /.box-body -->
	            <div class="box-footer">
	            	<button id="pkm-basic-submit" class="btn btn-primary center-block">Submit</button>
					
	            </div>
	        </div><!-- /.box -->
	    </div><!-- /.col -->

	    <div class="col-md-4" id="type-section">
	        <!-- Primary box -->
	        <div class="box box-solid box-info">
	            <div class="box-header">
	                <h3 class="box-title">Type/Ability</h3>
	            </div>
	            <div class="box-body">
	            	<label class="control-label" for="type-1">Type 1</label>
                    <select class="form-control" name="" id="type-1">
                    	<option value="0">Select a type</option>
                    	<?php $types = array('bug', 'dark', 'dragon', 'electric', 'fairy', 'fight', 'fire', 'flying', 'ghost', 'grass', 'ground', 'ice', 'normal', 'poison', 'psychic', 'rock', 'steel', 'water') ?>
                    	<?php foreach ($types as $type): ?>
                    		<option value="<?php echo $type ?>" <?php if (isset($current_pkm->types[0])) { if ($current_pkm->types[0]==$type) echo 'selected'; } ?>><?php echo ucwords($type) ?></option>
                    	<?php endforeach ?>
                    </select>

					<label class="control-label" for="type-2">Type 2</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="checkbox" class="flat-red" id="enable-t2" <?php if (isset($current_pkm->types[1])) echo 'checked' ?>>
                        </span>
                        <select id="type-2" class="form-control">
                    		<option value="0">Select a type</option>
	                    	<?php foreach ($types as $type): ?>
	                    		<option value="<?php echo $type ?>"<?php if (isset($current_pkm->types[1])) { if ($current_pkm->types[1]==$type) echo 'selected'; } ?>><?php echo ucwords($type) ?></option>
	                    	<?php endforeach ?>
                        </select>
                    </div><!-- /input-group -->

	                <label class="control-label" for="ability-1">Ability 1</label>
                    <select class="form-control" name="" id="ability-1">
                    	<option value="0">Select an ability</option>
                    	<?php foreach ($all_ab as $ability): ?>
                    		<option value="<?php echo $ability->id ?>" <?php if (isset($current_pkm->abilities[0])) { if ($current_pkm->abilities[0]->id == $ability->id) echo 'selected'; } ?>><?php echo ucfirst($ability->name) ?></option>
                    	<?php endforeach ?>
                    </select>
					
					<label class="control-label" for="aility-2">Ability 2</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="checkbox" id="enable-a2" class="flat-red" <?php if (isset($current_pkm->abilities[1])) echo 'checked' ?>>
                        </span>
                        <select id="ability-2" class="form-control">
                        	<option value="0">Select an ability</option>
                        	<?php foreach ($all_ab as $ability): ?>
	                    		<option value="<?php echo $ability->id ?>" <?php if (isset($current_pkm->abilities[1])) { if ($current_pkm->abilities[1]->id == $ability->id) echo 'selected'; } ?>><?php echo ucfirst($ability->name) ?></option>
	                    	<?php endforeach ?>
                        </select>
                    </div><!-- /input-group -->
					
					<label class="control-label" for="ability-3">Ability 3</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="checkbox" id="enable-a3" class="flat-red" <?php if (isset($current_pkm->abilities[2])) echo 'checked' ?>>
                        </span>
                        <select id="ability-3" class="form-control">
                        	<option value="0">Select an ability</option>
                        	<?php foreach ($all_ab as $ability): ?>
	                    		<option value="<?php echo $ability->id ?>" <?php if (isset($current_pkm->abilities[2])) { if ($current_pkm->abilities[2]->id == $ability->id) echo 'selected'; } ?>><?php echo ucfirst($ability->name) ?></option>
	                    	<?php endforeach ?>
                        </select>
                    </div><!-- /input-group -->
					<br>
	            </div><!-- /.box-body -->
	            <div class="box-footer">
	            	<button id="pkm-ta-submit" class="btn btn-primary center-block">Submit</button>
	            </div>
	        </div><!-- /.box -->
	    </div><!-- /.col -->

	    <div class="col-md-4" id="move-section">
	        <!-- Primary box -->
	        <div class="box box-solid box-success">
	            <div class="box-header">
	                <h3 class="box-title">Move</h3>
	            </div>
	            <div class="box-body">
	            
	            </div><!-- /.box-body -->
	            <div class="box-footer">
	            	<div class="text-center">
						<button id="get-move-list" class="btn btn-success">Add 1 move</button>
                    	<button id="pkm-move-submit" class="btn btn-primary">Submit</button>
                    </div>
	            </div>
	        </div><!-- /.box -->
	    </div><!-- /.col -->
	</div>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="notice-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="notice-title">Warning</h4>
				</div>
				<div class="modal-body" id="notice-message">
					...
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