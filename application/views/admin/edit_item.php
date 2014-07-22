<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit
        <small>Item</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Edit item</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-md-8 col-md-offset-2" id="ab-section">
	        <!-- Primary box -->
	        <div class="box box-solid box-primary">
	            
	            <div class="box-body">
	            	<div class="row">
		                <div class="col-md-3">
		                	<label class="control-label" for="ab-list">Select</label>
			                <select name="" id="item-list" class="form-control" size="9">
		                    	<option value="0">Select an item</option>
		                    	<?php if ($all_item): ?>
		                    		<?php foreach ($all_item as $item): ?>
		                    			<option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
		                    		<?php endforeach ?>
		                    	<?php endif ?>
		                    </select>
		                </div>
	                    <div class="col-md-9">
		                    <label for="ab-name" class="control-label">Name</label>
		                    <input type="text" name="" id="item-name" class="form-control" disabled="">

		                    <label for="ab-description" class="control-label">Description</label>
		                    <textarea name="" id="item-desc" cols="30" rows="5" class="form-control"></textarea>
		                </div>
	                </div>
	            </div><!-- /.box-body -->
	            <div class="box-footer">
	            	<button id="update-item-btn" class="btn btn-primary btn-block">Submit</button>
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