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
	                <h3 class="box-title">Post News</h3>
	            </div>
	            <div class="box-body">
	            	<label class="control-label" for="">Title</label>
	            	<input type="text" name="" id="news-title" class="form-control">
	            	<!-- div.row>div.col-md-4*3 -->
	            	<label class="control-label" for="">Post type</label>
	            	<select type="text" name="" id="news-post_type" class="form-control">
	            		<option value="1">News</option>
	            		<option value="0">Annoucement</option>
	            	</select>
	            	<label for="" class="control-label ">Content</label>
	            	<textarea name="" id="news-content" cols="30" rows="10" class="form-control wysihtml5"></textarea>
	            </div><!-- /.box-body -->
	            <div class="box-footer">
	            	<button id="submit-news-btn" class="btn btn-primary btn-block center-block">Submit</button>
	            	<br>
	            </div>
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