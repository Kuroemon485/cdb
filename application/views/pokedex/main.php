<?php 
$types_list = array('Bug', 'Dark', 'Dragon', 'Electric', 'Fairy', 'Fighting', 'Fire', 'Flying', 'Ghost', 'Grass', 'Ground', 'Ice', 'Normal', 'Poison', 'Psychic', 'Rock', 'Steel', 'Water');

 ?>
<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pokedex
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Pokedex</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">By alphabet</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="<?php echo base_url() ?>pokedex/masterlist" class="btn btn-block btn-xs btn-success">Master List</a>
                        </div>
                        <br><br>
                        <div class="col-sm-4">
                            <select name="" id="" class="selectpicker">
                                <option value="">A-G</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select name="" id="" class="selectpicker">
                                <option value="">H-R</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select name="" id="" class="selectpicker">
                                <option value="">S-Z</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	 	<div class="col-sm-6" id="">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">By type</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                    <?php foreach ($types_list as $type): ?>
                        <?php 
                        $tid = strtolower($type);
                        $turi = base_url().'type/'.$tid;
                        ?>
                        <div class="col-sm-2">
                            <a href="<?php echo $turi ?>" class="type-icon-flat type-<?php echo $tid ?>"><?php echo $type ?></a>
                        </div>
                    <?php endforeach ?>
                    </div>
                </div>
            </div>
	    </div><!-- /.col -->
	</div>
    <?php #echo '<pre>';print_r($all); echo '</pre>' ?>
    <?php echo "<pre>{elapsed_time}/{memory_usage}</pre>";?>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="notice-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="notice-title">Warning</h4>
				</div>
				<div class="modal-body" id="notice-message">
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