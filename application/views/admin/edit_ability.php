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
	 	<div class="col-md-8 col-md-offset-2" id="ab-section">
	        <!-- Primary box -->
	        <div class="box box-solid box-primary">
	            <div class="box-header">
	                <h3 class="box-title">Edit ability</h3>
	            </div>
	            <div class="box-body">
	            	<div class="row">
		                <div class="col-md-4">
		                	<label class="control-label" for="ab-list">Select</label>
			                <select name="" id="ab-id" class="form-control" size="9">
		                    	<option value="0">Select an ability</option>
		                    	<?php if ($all_ab): ?>
		                    		<?php foreach ($all_ab as $ab): ?>
		                    			<option value="<?php echo $ab->id ?>"><?php echo $ab->id.'. '.$ab->name ?></option>
		                    		<?php endforeach ?>
		                    	<?php endif ?>
		                    </select>
		                </div>
	                    <div class="col-md-8">
		                    <label for="ab-name" class="control-label">Name</label>
		                    <input type="text" name="" id="ab-name" class="form-control">
		                    <label for="ab-description" class="control-label">Description</label>
		                    <textarea name="" id="ab-description" cols="30" rows="5" class="form-control"></textarea>
	                    </div>
	                </div>
	            </div><!-- /.box-body -->
	            <div class="box-footer">
	            	<button id="ab-edit-submit" class="btn btn-primary center-block">Submit</button>
	            	<br>
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