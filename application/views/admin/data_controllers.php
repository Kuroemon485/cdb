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
	 	<div class="col-md-6" id="add-section">
	        <!-- Primary box -->
	        <div class="box box-primary">
	            <div class="box-header">
	                <h3 class="box-title">Add Data</h3>
	            </div>
	            <div class="box-body">
	            	<a class="btn btn-app" href="<?php echo base_url() ?>admin/insert/news"><i class="fa fa-plus"></i> Post News/Announcement</a>
	            	<a class="btn btn-app" href="<?php echo base_url() ?>admin/insert/pokemon"><i class="fa fa-plus"></i> Add Pokemon</a>
	            	<a class="btn btn-app" href="<?php echo base_url() ?>admin/insert/move"><i class="fa fa-plus"></i> Add Move</a>
	            	<a class="btn btn-app" href="<?php echo base_url() ?>admin/insert/ability"><i class="fa fa-plus"></i> Add Ability</a>
	            	<a class="btn btn-app" href="<?php echo base_url() ?>admin/insert/item"><i class="fa fa-plus"></i> Add Item</a>
	            </div><!-- /.box-body -->
	        </div><!-- /.box -->
	    </div><!-- /.col -->
	    <div class="col-md-6" id="add-section">
	        <!-- Primary box -->
	        <div class="box box-primary">
	            <div class="box-header">
	                <h3 class="box-title">Modify Data</h3>
	            </div>
	            <div class="box-body">
	            	<a class="btn btn-app" href="<?php echo base_url() ?>admin/edit/news"><i class="fa fa-pencil"></i> Edit News/Announcement</a>
	            	<a class="btn btn-app" href="<?php echo base_url() ?>admin/edit/pokemon"><i class="fa fa-pencil"></i> Edit Pokemon</a>
	            	<a class="btn btn-app" href="<?php echo base_url() ?>admin/edit/move"><i class="fa fa-pencil"></i> Edit Move</a>
	            	<a class="btn btn-app" href="<?php echo base_url() ?>admin/edit/ability"><i class="fa fa-pencil"></i> Edit Ability</a>
	            	<a class="btn btn-app" href="<?php echo base_url() ?>admin/edit/item"><i class="fa fa-pencil"></i> Edit Item</a>
	            </div><!-- /.box-body -->
	        </div><!-- /.box -->
	    </div><!-- /.col -->
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