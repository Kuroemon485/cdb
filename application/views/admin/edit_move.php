<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit
        <small>Move</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Edit Move</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-md-12" id="move-section">
	        <!-- Primary box -->
	        <div class="box box-solid box-primary">
	            <div class="box-header">
	                <h3 class="box-title">Edit Move</h3>
	            </div>
	            <div class="box-body">
		            <div class="row">
		            	<div class="col-md-3">
		                    <label class="control-label" for="move-id">ID</label>
		                    <select name="" id="move-id" class="form-control" size="15">
		                    	<option value="0">Select a move</option>
		                    	<?php if ($all_moves): ?>
		                    	<?php foreach ($all_moves as $move): ?>
		                    		<option value="<?php echo $move->id ?>"><?php echo $move->id.'. '. $move->name ?></option>
		                    	<?php endforeach ?>
		                    	<?php endif ?>
		                    </select>
	                    </div>
	                    <div class="col-md-9">
			            	<div class="row">
			                    <div class="col-xs-12"><label for="move-name" class="control-label">Name</label>
			                    <input type="text" name="" id="move-name" class="form-control"></div>
			                </div>
		                    <div class="row">
			                    <div class="col-xs-6">
			                    <label for="move-type" class="control-label">Type</label>
			                    <select type="text" name="" id="move-type" class="form-control">
			                    	<?php $types = array('bug', 'dark', 'dragon', 'electric', 'fairy', 'fighting', 'fire', 'flying', 'ghost', 'grass', 'ground', 'ice', 'normal', 'poison', 'psychic', 'rock', 'steel', 'water') ?>
			                    	<?php foreach ($types as $type): ?>
			                    		<option value="<?php echo $type ?>"><?php echo ucwords($type) ?></option>
			                    	<?php endforeach ?>
			                    </select>
			                    </div>
			                    <div class="col-xs-6">
			                    <label for="move-category" class="control-label">Category</label>
			                    <select type="text" name="" id="move-category" class="form-control">
			                    	<option value="physical">Physical</option>
			                    	<option value="special">Special</option>
			                    	<option value="status">Status</option>
			                    </select>
			                    </div>
		                    </div>
		                    <div class="row">
			                    <div class="col-xs-4"><label for="move-power" class="control-label">Power</label>
			                    <input type="text" name="" id="move-power" class="form-control"></div>
			                    <div class="col-xs-4"><label for="move-pp" class="control-label">PP</label>
			                    <input type="text" name="" id="move-pp" class="form-control"></div>
			                    <div class="col-xs-4"><label for="move-accuracy" class="control-label">Accuracy</label>
			                    <input type="text" name="" id="move-accuracy" class="form-control"></div>
		                    </div>
		                    <div class="row">
			                    <div class="col-xs-6"><label for="move-desc" class="control-label">Description</label>
			                    <textarea name="" id="move-description" cols="30" rows="5" class="form-control"></textarea></div>
			                    <div class="col-xs-6"><label for="move-effect" class="control-label">Effect</label>
			                    <textarea name="" id="move-effect" cols="30" rows="5" class="form-control"></textarea></div>
		                    </div>
		                </div>
	                </div>
	            </div><!-- /.box-body -->
	            <div class="box-footer">
	            	<button id="move-edit-submit" class="btn btn-primary center-block">Submit</button>
	            	<br>
	            	<?php //echo '<pre>';print_r($all_moves);echo '</pre>' ?>
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
				<div class="modal-body">
					<p id="success-message"></p>
				</div>
			</div>
		</div>
	</div>

</section>
</aside>