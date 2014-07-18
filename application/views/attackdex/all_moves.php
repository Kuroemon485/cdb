<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View
        <small>Attackdex</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><i class="fa fa-ge"></i> Attackdex</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-md-12" id="">
	        <!-- Primary box -->
	        <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-ge"></i> Attackdex</h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="master-list" class="table table-bordered table-condensed table-striped data-table-full">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Power</th>
                                <th>PP</th>
                                <th>ACC</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_move as $move): ?>
                            <?php
                            $name = $move->name;
                            $move_uri = base_url().'move/'.$move->id;
                            $type = $move->type;
                            $type_id = strtolower($type);
                            $type_uri = base_url().'type/'.$type_id;
                            $category = $move->category; 
                            $cat_id = strtolower($category);
                            $pp = ($move->pp != 0) ? $move->pp : '--';
                            $base_power = ($move->base_power != 0) ? $move->base_power : '--';
                            $accuracy = ($move->accuracy != 0) ? $move->accuracy : '--';
                            $desc = $move->short_desc;
                            ?>
                        	<tr>
                        	   <td><a href="<?php echo $move_uri ?>" title=""><?php echo $name ?></a></td>
                               <td><a class="type-icon-flat type-<?php echo $type_id ?>" href="<?php echo $type_uri ?>" title=""><?php echo $type ?></a></td>
                               <td><span class="category-icon <?php echo $cat_id ?>" title=""><?php echo $category ?></span></td>
                               <td><?php echo $base_power ?></td>
                               <td><?php echo $pp ?></td>
                               <td><?php echo $accuracy ?></td>
                               <td><?php echo $desc ?></td>
                        	</tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                    <pre>
						<?php #print_r($all_move) ?>
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