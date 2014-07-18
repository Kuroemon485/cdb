					<div class="tab-pane active" id="pkm-detail">
			            <div class="row">
				            <div class="col-sm-4">
				            	<div class="row">
				            		<div class="col-md-12 col-xs-6">
						            	<i class="fa fa-image"></i>
						                <img class="center-block" src="<?php echo base_url() ?>public/images/f-sprite/<?php echo $species ?>.gif" alt="<?php echo $species ?>">
						            </div>
				            		<div class="col-md-12 col-xs-6">
					            		<table class="table table-condensed">
					            			<tr>
					            				<th>No.</th>
					            				<td><?php echo $dex_id; ?></td>
					            			</tr>
					            			<tr>
					            				<th>Type</th>
					            				<td>
					            					<?php foreach ($types as $type): ?>
								                    	<?php 
								                    	$type_uri = base_url()."type/".strtolower($type);
								                    	 ?>
								                    	<a href="<?php echo $type_uri ?>" class="type-icon-flat type-<?php echo strtolower($type) ?>"><?php echo $type ?></a>
								                    <?php endforeach ?>
					            				</td>
					            			</tr>
					            			<tr>
					            				<th>Abilities</th>
					            				<td>
					            					<?php $i = 0; foreach ($abilities as $ability): ?>
								                    <?php
								                    $ab_name = $ability->ability_name;
								                    $ab_id = $ability->ability_id;
								                    $ab_uri = base_url()."ability/".$ab_id;
								                    $ab_type = $ability->id;
								                    ?>
								                    	<?php if ($i > 0) echo ' - ' ?>
								                    	<a href="<?php echo $ab_uri ?>" class="ability" data-toggle="tooltip" data-original-title="" data-ab-id="<?php echo $ab_id ?>">
								                    		<?php if ($ab_type == "H"): ?>
								                    			<i class="text-red"><?php echo $ab_name ?></i>
								                    		<?php else: ?>
								                    			<?php echo $ab_name ?>
								                    		<?php endif ?>
								                    	</a>
								                    	<?php $i++; ?>
								                    <?php endforeach ?>
					            				</td>
					            			</tr>
					            			<tr>
					            				<th>Height</th>
					            				<td><?php echo $height_m ?>(m)</td>
					            			</tr>
					            			<tr>
					            				<th>Weight</th>
					            				<td><?php echo $weight_kg ?>(kg)</td>
					            			</tr>
					            			<tr>
					            				<th>Grass Knot Power</th>
					            				<td><?php echo $grass_knot_power ?></td>
					            			</tr>
					            		</table>
						            </div>
				            	</div>
				            </div>				            
				            <div class="col-sm-8">
				            	<table class="table table-hover">
				            		<tbody>
				            			<tr>
				            				<th>Base stat</th>
				            				<th><?php $total = 0; foreach ($stats as $stat) {
				            					$total += $stat;
				            				} echo $total;?></th>
				            				<th class="col-md-5"></th>
				            				<th>min-</th>
				            				<th>min</th>
				            				<th>max</th>
				            				<th>max+</th>
				            			</tr>
				            			<?php foreach ($stats as $key => $value): ?>
				            				<tr>
				            					<td><?php echo ucwords(str_replace('_', ' ', $key)) ?></td>
				            					<td><span id="<?php echo $key ?>" class="badge bg-<?php
				            						if ($value < 90) {
				                                        	echo 'yellow';
				                                        } 
				                                        if (90 <= $value && $value <= 110 ) {
				                                        	echo 'blue';
				                                        }
				                                        if ($value > 110 && $value < 150) {
				                                        	echo 'green';
				                                        }
				                                        if ($value >= 150) {
				                                        	echo 'red';
				                                        }
				                                        ?>"><?php echo $value ?></span></td>
				            					<td class="col-md-5 col-sm-5 col-xs-5">
				            						<div class="progress sm progress-striped">
				                                        <div class="progress-bar progress-bar-<?php 
				                                        if ($value < 90) {
				                                        	echo 'yellow';
				                                        } 
				                                        if (90 <= $value && $value <= 110 ) {
				                                        	echo 'blue';
				                                        }
				                                        if ($value > 110 && $value < 150) {
				                                        	echo 'green';
				                                        }
				                                        if ($value >= 150) {
				                                        	echo 'red';
				                                        }
				                                        ?>" style="width: <?php echo $value/250*100 ?>%"></div>
				                                    </div>
				            					</td>
				            					<td id="min_m_<?php echo $key ?>"></td>
				            					<td id="min_<?php echo $key ?>"></td>
				            					<td id="max_<?php echo $key ?>"></td>
				            					<td id="max_p_<?php echo $key ?>"></td>
				            				</tr>
				            			<?php endforeach ?>
				            		</tbody>
				            	</table>
				            </div>
		                </div> <!-- End row -->
                    </div><!-- /.tab-pane -->