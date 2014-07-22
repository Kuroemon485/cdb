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
		                    		<option value="<?php echo $move->id ?>"><?php echo $move->name ?></option>
		                    	<?php endforeach ?>
		                    	<?php endif ?>
		                    </select>
	                    </div>
	                    <div class="col-md-9">
			            	<div class="row">
			                    <div class="col-xs-12"><label for="move-name" class="control-label">Name</label>
			                    <input type="text" name="" id="move-name" class="form-control" disabled=""></div>
			                </div>
		                    <div class="row">
			                    <div class="col-xs-6">
			                    <label for="move-type" class="control-label">Type</label>
			                    <select type="text" name="" id="move-type" class="form-control">
			                    	<?php $types = array('Bug', 'Dark', 'Dragon', 'Electric', 'Fairy', 'Fighting', 'Fire', 'Flying', 'Ghost', 'Grass', 'Ground', 'Ice', 'Normal', 'Poison', 'Psychic', 'Rock', 'Steel', 'Water') ?>
			                    	<?php foreach ($types as $type): ?>
			                    		<option value="<?php echo $type ?>"><?php echo $type ?></option>
			                    	<?php endforeach ?>
			                    </select>
			                    </div>
			                    <div class="col-xs-6">
			                    <label for="move-category" class="control-label">Category</label>
			                    <select type="text" name="" id="move-category" class="form-control">
			                    	<option value="Physical">Physical</option>
			                    	<option value="Special">Special</option>
			                    	<option value="Status">Status</option>
			                    </select>
			                    </div>
		                    </div>
		                    <div class="row">
			                    <div class="col-xs-4"><label for="move-power" class="control-label">Power</label>
			                    <input type="text" name="" id="move-base_power" class="form-control"></div>
			                    <div class="col-xs-4"><label for="move-pp" class="control-label">PP</label>
			                    <input type="text" name="" id="move-pp" class="form-control"></div>
			                    <div class="col-xs-4"><label for="move-accuracy" class="control-label">Accuracy</label>
			                    <input type="text" name="" id="move-accuracy" class="form-control"></div>
		                    </div>
		                    <div class="row">
			                    <div class="col-xs-6">
				                    <label for="" class="control-label">Description</label>
				                    <textarea name="" id="move-desc" cols="30" rows="5" class="form-control"></textarea>
			                    </div>
			                    <div class="col-xs-6">
				                    <label for="" class="control-label">Short Description</label>
				                    <textarea name="" id="move-short_desc" cols="30" rows="5" class="form-control"></textarea>
			                    </div>
		                    </div>
		                </div>
	                </div>
	            </div><!-- /.box-body -->
	            <div class="box-footer">
	            	<button id="update-move-btn" class="btn btn-primary btn-block">Submit</button>
	            	<br>
	            	<?php //echo '<pre>';print_r($all_moves);echo '</pre>' ?>
	            </div>
	        </div><!-- /.box -->
	    </div><!-- /.col -->
	</div>
	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" id="response-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="response-title" id="notice-title">Success</h4>
				</div>
				<div class="modal-body">
					<p id="response-message"></p>
				</div>
			</div>
		</div>
	</div>

</section>
</aside>