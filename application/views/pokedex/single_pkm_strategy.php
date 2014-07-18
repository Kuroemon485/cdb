<?php
$stats = array(
	'hp' => 'Hp',
	'atk' => 'Atk',
	'def' => 'Def',
	'sp_atk' => 'Sp Atk',
	'sp_def' => 'Sp Def',
	'spd' => 'Spd'
	);
?>
					<div class="tab-pane" id="strategy">
                    	<div class="box-group" id="accordion">
						    <!-- I'm adding the .panel class so bootstrap.js collapse plugin detects it -->
						    <?php if (isset($strategies)): ?>
						    <?php foreach ($strategies as $strategy): ?>
						    <?php
						    $ab_id = $strategy->ability->ability_id;
						    $ab_uri = base_url()."ability/".$ab_id;
						    $ab_name = $strategy->ability->ability_name;
						    $ab_type = $strategy->ability->id;
						    $happiness = $strategy->happiness;
						    $item_id = $strategy->item->id;
						    $item_name = $strategy->item->name;
						    $item_desc = $strategy->item->desc;
						    $nature = $strategy->nature;
						    $description = $strategy->description;
						    ?>
						    <div class="panel box box-primary">
						        <div class="box-header">
						            <h4 class="box-title">
						                <a data-toggle="collapse" data-parent="#accordion" href="#str-<?php echo $strategy->id ?>">
						                <?php echo $strategy->name ?>
						                </a>
						            </h4>
						        </div>
						        <div id="str-<?php echo $strategy->id ?>" class="panel-collapse collapse">
						            <div class="box-body">
						            	<div class="row">
						            		<div class="col-sm-6">
						            			<table class="table table-condensed">
						            				<tr>
						            					<th>Ability</th>
						            					<td>
						            						<a href="<?php echo $ab_uri ?>" class="ability" data-toggle="tooltip" data-original-title="" data-ab-id="<?php echo $ab_id ?>">
									                    		<?php if ($ab_type == "H"): ?>
									                    			<i class="text-red"><?php echo $ab_name ?></i>
									                    		<?php else: ?>
									                    			<?php echo $ab_name ?>
									                    		<?php endif ?>
									                    	</a>
						            					</td>
						            					<th>Nature</th>
						            					<td><?php echo $nature ?></td>
						            				</tr>
						            				<tr>
						            					<th>Item</th>
						            					<td>
						            						<a href="#" data-toggle="tooltip" data-original-title="<?php echo $item_desc ?>"><?php echo $item_name ?></a>
						            					</td>
						            					<th>Happiness</th>
						            					<td><?php echo $happiness ?></td>
						            				</tr>
						            				<tr>
						            					<th colspan="4">Moveset</th>
						            				</tr>
						            				<?php for ($i=0; $i <= 4; $i++): ?>
						            					<?php if (isset($strategy->{'move_'.$i})): ?>
						            						<?php 
						            						$move_name = $strategy->{'move_'.$i}->name;
						            						$move_id = $strategy->{'move_'.$i}->id;
						            						$move_uri = base_url()."move/".$move_id;
						            						$move_desc = $strategy->{'move_'.$i}->desc;
						            						$move_power = ($strategy->{'move_'.$i}->base_power != 0) ? $strategy->{'move_'.$i}->base_power : "--";
						            						$move_acc = ($strategy->{'move_'.$i}->accuracy != 0) ? $strategy->{'move_'.$i}->accuracy : "--";
						            						$move_type = strtolower($strategy->{'move_'.$i}->type);
						            						?>
						            						<tr>
						            							<td>- <a href="<?php echo $move_uri ?>" data-toggle="tooltip" data-original-title="<?php echo $move_desc ?>"><?php echo $move_name ?></a></td>
						            							<td><span class="type-icon-flat type-<?php echo $move_type ?>"><?php echo $move_type ?></span></td>
						            							<td><small class="text-muted">Power </small><?php echo $move_power ?></td>
						            							<td><small class="text-muted">Acc. </small><?php echo $move_acc ?></td>
						            						</tr>
						            					<?php endif ?>
						            				<?php endfor ?>
						            			</table>
						            		</div>
						            		<div class="col-sm-6">
						            			<table class="table table-condensed str-stat" data-nature="<?php echo $nature ?>">
						            				<thead>
						            					<th>Base</th>
						            					<th></th>
						            					<th>EV</th>
						            					<th>IV</th>
						            					<th><a href="#" class="calc-stats" data-lv="50">lv.50</a> / <a href="#" class="calc-stats" data-lv="100">lv.100</a></th>
						            				</thead>
						            				<tbody>
						            					<?php foreach ($stats as $key => $value): ?>
						            						<?php $stat = $strategy->{'base_'.$key} ?>
						            						<tr>
						            							<th><?php echo $value ?></th>
						            							<td><span class="badge bg-<?php
								            						if ($stat < 90) {
								                                        	echo 'yellow';
								                                        } 
								                                        if (90 <= $stat && $stat <= 110 ) {
								                                        	echo 'aqua';
								                                        }
								                                        if ($stat > 110 && $stat < 150) {
								                                        	echo 'green';
								                                        }
								                                        if ($stat >= 150) {
								                                        	echo 'red';
								                                        }
								                                        ?>"><span id="base_<?php echo $key ?>"><?php echo $stat ?></span></span>
								                                </td>
						            							<td id="ev_<?php echo $key ?>"><?php echo $strategy->{'ev_'.$key} ?></td>
						            							<td id="iv_<?php echo $key ?>"><?php echo $strategy->{'iv_'.$key} ?></td>
						            							<td><span class="text-green" id="total-<?php echo $key ?>"></span></td>
						            						</tr>
						            					<?php endforeach ?>
						            				</tbody>
						            			</table>
						            		</div>
						            	</div>
						            </div>
						            <div class="box-footer">
							            <div class="row">
							            	<div class="col-md-12">
							            			<?php echo $description ?>
							            	</div>
							            </div>
						            </div>
						        </div>
						    </div>
						    <?php endforeach ?>
						    
						    <?php else: ?>
						    <?php endif ?>
						    
						</div>
                    </div>