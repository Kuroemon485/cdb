<?php 
$tip = "Ratings and how they work:

-2: Extremely detrimental
      The sort of ability that relegates Pokemon with Uber-level BSTs
      into NU.
    ex. Slow Start, Truant

-1: Detrimental
      An ability that does more harm than good.
    ex. Defeatist, Normalize

 0: Useless
      An ability with no net effect on a Pokemon during a battle.
    ex. Pickup, Illuminate

 1: Ineffective
      An ability that has a minimal effect. Should never be chosen over
      any other ability.
    ex. Damp, Shell Armor

 2: Situationally useful
      An ability that can be useful in certain situations.
    ex. Blaze, Insomnia

 3: Useful
      An ability that is generally useful.
    ex. Volt Absorb, Iron Fist

 4: Very useful
      One of the most popular abilities. The difference between 3 and 4
      can be ambiguous.
    ex. Technician, Protean

 5: Essential
      The sort of ability that defines metagames.
    ex. Drizzle, Shadow Tag";
 ?>
<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View
        <small>Ability Dex</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><i class="fa fa-gift"></i> Ability Dex</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-md-12" id="">
	        <!-- Primary box -->
	        <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-gift"> Ability Dex</i></h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="master-list" class="table table-bordered table-striped data-table-full">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Rating</th>
                                <th>Effect</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_abilities as $ability): ?>
                            <?php 
                            $name = $ability->name;
                            $desc = $ability->short_desc;
                            $id = $ability->id;
                            $uri = base_url().'ability/'.$id;
                            $rating = $ability->rating;
                            ?>
                        	<tr>
                        		<td><a href="<?php echo $uri ?>"><?php echo $name ?></a></td>
                                <td><?php echo $rating ?></td>
                        		<td><?php echo $desc ?></td>
                        	</tr>
                        <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Effect</th>
                            </tr>
                        </tfoot>
                    </table>
                    <pre>
						<?php #print_r($all_abilities) ?>
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