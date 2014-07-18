
<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View
        <small>Item Dex</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><i class="fa fa-key"></i> Item Dex</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-md-12" id="">
	        <!-- Primary box -->
	        <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-key"></i> Items Dex</h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="master-list" class="table table-bordered table-striped data-table-full">
                        <thead>
                            <tr>
                                <th>Icon</th>
                                <th>Name</th>
                                <th>Effect</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_items as $item): ?>
                            <?php 
                            $name = $item->name;
                            $desc = $item->desc;
                            $id = $item->id;
                            $sprite_uri = base_url()."public/images/items/".$id.".png";
                            $item_uri = base_url()."item/".$id;
                            ?>
                        	<tr>
                                <td class="col-xs-1"><img class="center-block"src="<?php echo $sprite_uri ?>" alt="<?php echo $id.".png" ?>"></td>
                        		<td><span class="text-green"><?php echo $name ?></span></td>
                        		<td><?php echo $desc ?></td>
                        	</tr>
                        <?php endforeach ?>
                        </tbody>
                        <!-- <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Effect</th>
                            </tr>
                        </tfoot> -->
                    </table>
                    <pre>
						<?php #print_r($all_items) ?>
					</pre>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
	    </div><!-- /.col -->
	</div>
    <?php echo "<pre>{elapsed_time}/{memory_usage}</pre>";?>
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
				<div class="modal-body" id="notice-message">
					Hooray!
				</div>
			</div>
		</div>
	</div>
</section>
</aside>