<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Create
        <small>Move</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Create Move</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-md-8 col-md-offset-2" id="move-section">
	        <!-- Primary box -->
	        <div class="box box-solid box-primary">
	            <div class="box-header">
	                <h3 class="box-title">Create Move</h3>
	            </div>
	            <div class="box-body">
	            	
	            	<div class="row">
	            		<div class="col-md-6">
	            			<label class="control-label" for="move-id">ID</label>
                    		<input type="text" name="" id="move-id" class="form-control" disabled="" value="">
	            		</div>
	            		<div class="col-md-6">
	            			<label for="move-name" class="control-label">Name</label>
                    		<input type="text" name="" id="move-name" class="form-control">
	            		</div>
	            	</div>
	                
                    <div class="row">
                    	<div class="col-md-6">
                    		<label class="control-label" for="move-type">Type</label>
		                    <select name="" id="move-type" class="form-control" data-live-search="true">
		                    	<option value="0">Select a type</option>
		                    </select>
                    	</div>
                    	<div class="col-md-6">
                    		<label class="control-label" for="move-category">Category</label>
		                    <select name="" id="move-category" class="form-control">
		                    	<option value="0">Select a category</option>
		                    	<option value="1">Physic</option>
		                    	<option value="2">Special</option>
		                    	<option value="3">Other</option>
		                    </select>
                    	</div>
                    </div>
                    
                    <div class="row">
                    	<div class="col-md-4">
                    		<label class="control-label" for="move-pp">Power Point</label>
                    		<input type="text" name="" id="move-pp" class="form-control">
                    	</div>
                    	<div class="col-md-4">
                    		<label class="control-label" for="move-bp">Base Power</label>
                    		<input type="text" name="" id="move-bp" class="form-control">
                    	</div>
                    	<div class="col-md-4">
                    		<label class="control-label" for="move-acc">Accuracy</label>
                    		<input type="text" name="" id="move-acc" class="form-control">
                    	</div>
                    </div>
                    <!-- div.row>div.col-md-4*3 -->
                    <label for="move-desc" class="control-label">Description</label>
                    <textarea name="" id="move-desc" cols="30" rows="2" class="form-control"></textarea>
	            </div><!-- /.box-body -->
	            <div class="box-footer">
	            	<button id="move-insert-submit" class="btn btn-primary btn-sm center-block">Submit</button>
	            	<br>
	            </div>
	        </div><!-- /.box -->
	    </div><!-- /.col -->
	</div>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="success-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title text-green" id="myModalLabel">Success</h4>
				</div>
				<div class="modal-body">
					<p class="text-green">Added</p>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="fail-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title text-red" id="myModalLabel">Fail</h4>
				</div>
				<div class="modal-body">
					<p class="text-red">Something's wrong here.</p>
				</div>
			</div>
		</div>
	</div>
</section>
</aside>