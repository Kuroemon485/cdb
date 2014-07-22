<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit
        <small>Ability</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Edit ability</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-md-12 col-md-offset-0" id="ab-section">
	        <!-- Primary box -->
	        <div class="box box-solid box-primary">
	            
	            <div class="box-body">
	            	<div class="row">
		                <div class="col-md-2">
		                	<label class="control-label" for="ab-list">Select</label>
			                <select name="" id="ab-list" class="form-control" size="9">
		                    	<option value="0">Select an ability</option>
		                    	<?php if ($all_ab): ?>
		                    		<?php foreach ($all_ab as $ab): ?>
		                    			<option value="<?php echo $ab->id ?>"><?php echo $ab->name ?></option>
		                    		<?php endforeach ?>
		                    	<?php endif ?>
		                    </select>
		                </div>
	                    <div class="col-md-10">
		                    <div class="row">
		                    	<div class="col-md-6">
				                    <label for="ab-name" class="control-label">Name</label>
				                    <input type="text" name="" id="ab-name" class="form-control" disabled="">
		                    	</div>
		                    	<div class="col-md-6">
		                    		<label for="" class="label-control">Rating</label>
		                    		<input type="text" class="form-control" id="ab-rating">
		                    	</div>
		                    	<div class="col-md-6">
				                    <label for="ab-description" class="control-label">Description</label>
				                    <textarea name="" id="ab-desc" cols="30" rows="5" class="form-control"></textarea>
				                </div>
				                <div class="col-md-6">
				                    <label for="ab-description" class="control-label">Short Description</label>
				                    <textarea name="" id="ab-short_desc" cols="30" rows="5" class="form-control"></textarea>
				                </div>
		                    </div>
		                </div>
	                </div>
	            </div><!-- /.box-body -->
	            <div class="box-footer">
	            	<button id="update-ability-btn" class="btn btn-primary btn-block">Submit</button>
	            	<br>
	            </div>
	        </div><!-- /.box -->
	    </div><!-- /.col -->
	</div>
	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" id="response-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="response-title"></h4>
				</div>
				<div class="modal-body">
					<p id="response-message"></p>
				</div>
			</div>
		</div>
	</div>

</section>
</aside>