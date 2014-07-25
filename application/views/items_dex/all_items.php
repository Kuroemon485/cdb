
<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Items Dex
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
                        		<td><a href="#" class="item-strategy" data-input="strategy" data-item-id="<?php echo $id ?>"><?php echo $name ?></a></td>
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
                </div><!-- /.box-body -->
            </div><!-- /.box -->
	    </div><!-- /.col -->
	</div>
    <?php echo "<pre>{elapsed_time}/{memory_usage}</pre>";?>
    <div class="modal fade data-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" id="">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                    <h4 class="modal-title" id="data-title"></h4>
                </div>
                <div class="modal-body" id="data-container">
                </div>
            </div>
        </div>
    </div>
</section>
</aside>