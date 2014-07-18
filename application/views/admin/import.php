<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Import
        <small>Data from PokéAPI</small>
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
	                <h3 class="box-title">Import Pokemon</h3>
	            </div>
	            <div class="box-body">
	            	<label class="control-label" for="result-preview">Data Source</label>
	            	<input type="text" id="source" class="form-control" value="" readonly="">
	            	<br>
	            	<div class="row">
		            	<div class="col-md-12">
			            	<button id="import-pokedex" class="btn btn-success btn-sm import" disabled data-loading-text="<i class='ion-loading-a'></i> Importing Pokemon..."><i class="fa fa-bug"></i> Import Pokedex</button>
			            	<button id="import-learnset" class="btn btn-success btn-sm import" disabled data-loading-text="<i class='ion-loading-a'></i> Importing ..."><i class="fa fa-ge"></i> Import Learn Set</button>
			            	<button id="import-typeset" class="btn btn-success btn-sm import" disabled data-loading-text="<i class='ion-loading-a'></i> Importing ..."><i class="fa fa-fire"></i> Import Type Set</button>
			            	<button id="import-abilityset" class="btn btn-success btn-sm import" disabled data-loading-text="<i class='ion-loading-a'></i> Importing ..."><i class="fa fa-gift"></i> Import Ability Set</button>
		            	</div>
		            </div>
		            <br>
		            <div class="row">
		            	<div class="col-md-12">
			            	<button id="import-attackdex" class="btn btn-success btn-sm import" disabled data-loading-text="<i class='ion-loading-a'></i> Importing moves..."><i class="fa fa-ge"></i> Import Attackdex</button>
			            	<button id="import-abilities" class="btn btn-success btn-sm import" disabled data-loading-text="<i class='ion-loading-a'></i> Importing abilities..."><i class="fa fa-gift"></i> Import Abilities</button>
			            	<button id="import-items" class="btn btn-success btn-sm import" disabled data-loading-text="<i class='ion-loading-a'></i> Importing items..."><i class="fa fa-key"></i> Import Items</button>
		            	</div>
		            </div>
		            <br>
		            <div class="row">
			            <div class="col-md-12">
			            	<button id="extract" class="btn btn-primary btn-sm import" disabled data-loading-text="<i class='ion-loading-a'></i> Extracting..."><i class="fa fa-cloud-download"></i> Extract</button>
			            	<button class="btn btn-warning btn-sm" id="enable">Enable all</button>
			            	<button class="btn btn-primary btn-sm" id="disable">Disable all</button>
		            	</div>
		            </div>
	            </div><!-- /.box-body -->
	            <div class="box-footer">
	            	<div class="progress progress-striped">
                        <div id="import-progress" class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: 0%; min-width: 0%">
                            <span id="progress-number">0/0</span>
                        </div>
                    </div>
	            	
	            	<pre name="" id="log"></pre>
	            	<pre name="" id="result" class="pre-scrollable"></pre>
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
					<p class="text-green">Extracted</p>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="fail-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title text-red" id="myModalLabel"><b class="text-red">Fail</b></h4>
				</div>
				<div class="modal-body">
					<p class="text-red">Something's wrong here.</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger close" data-dismiss="modal">Dissmiss</button>
				</div>
			</div>
		</div>
	</div>
</section>
</aside>