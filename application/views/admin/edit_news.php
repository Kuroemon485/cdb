<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Admin
        <small>Edit News / Annoucement</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>admin/control_panel/database"><i class="fa fa-user"></i> Admin</a></li>
        <li class="active">Edit News</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-md-8 col-md-offset-2" id="move-section">
	        <!-- Primary box -->
	        <div class="box box-solid box-primary">
	            <div class="box-header">
	                <h3 class="box-title">Contents</h3>
	            </div>
	            <div class="box-body">
	            	<label for="" class="control-label">News list</label>
	            	<select name="" id="news-list" class="form-control">
	            		<option value="">Pick a News</option>
	            		<?php foreach ($news_list as $news): ?>
	            			<option value="<?php echo $news->id ?>"><?php echo $news->title ?></option>
	            		<?php endforeach ?>
	            	</select>
	            	<label class="control-label" for="">Title</label>
	            	<input type="text" name="" id="news-title" class="form-control">
	            	<!-- div.row>div.col-md-4*3 -->
	            	<label for="" class="control-label ">Content</label>
	            	<textarea name="" id="news-content" cols="30" rows="10" class="form-control wysihtml5"></textarea>
	            </div><!-- /.box-body -->
	            <div class="box-footer">
	            	<button id="update-news-btn" class="btn btn-primary btn-block center-block">Submit</button>
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