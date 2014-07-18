<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Create
        <small>Ability</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Create ability</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-md-6 col-md-offset-3" id="ability-section">
	        <!-- Primary box -->
	        <div class="box box-solid box-primary">
	            <div class="box-header">
	                <h3 class="box-title">Create ability</h3>
	            </div>
	            <div class="box-body">
	            	
	                <label class="control-label" for="ability-id">ID</label>
                    <input type="text" name="" id="ability-id" class="form-control" disabled="" value="">
                    <label for="ability-name" class="control-label">Name</label>
                    <input type="text" name="" id="ability-name" class="form-control">
                    <label for="ability-desc" class="control-label">Description</label>
                    <textarea name="" id="ability-desc" cols="30" rows="2" class="form-control"></textarea>
	            </div><!-- /.box-body -->
	            <div class="box-footer">
	            	<button id="ability-insert-submit" class="btn btn-primary center-block">Submit</button>
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
					<h4 class="modal-title text-green" id="myModalLabel"><b>Success</b></h4>
				</div>
				<div class="modal-body">
					<p class="text-green">Hooray</p>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-success" data-dismiss="modal">Okay</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="fail-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Fail</h4>
				</div>
				<div class="modal-body">
					Something's wrong here.
				</div>
			</div>
		</div>
	</div>

</section>
</aside>