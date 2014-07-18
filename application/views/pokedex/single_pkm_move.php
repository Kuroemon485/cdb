					<div class="tab-pane" id="move-list">
                        <table class="table table-bordered table-condensed table-striped data-table-full" id="pkm-move-table">
	            			<thead>
	            				<tr>
		            				<th>Move</th>
		            				<th>Type</th>
		            				<th>Category</th>
		            				<th>Power</th>
		            				<th>PP</th>
		            				<th>Acc.</th>
		            				<th>Effect</th>
		            			</tr>
	            			</thead>
		            		<tbody>
		            			<?php foreach ($learn_set as $move): ?>
		            				<?php 
		            				$id = $move->id;
		            				$name = $move->name;
		            				$move_uri = base_url()."move/".$id;
		            				$type = $move->type;
		            				$l_type = strtolower($type);
		            				$type_uri = base_url()."type/".$l_type;
		            				$category = $move->category;
		            				$l_cat = strtolower($category);
		            				$base_power = ($move->base_power > 0) ? $move->base_power : '--';
		            				$pp = ($move->pp > 0) ? $move->pp : '--';
		            				$accuracy = ($move->accuracy > 0) ? $move->accuracy : '--';
		            				$desc = $move->short_desc;
		            				?>
		            				<tr>
		            					<td><a href="<?php echo $move_uri ?>"><?php echo $move->name ?></a></td>
		            					<td><?php echo " <a href='{$type_uri}' class='type-icon-flat type-{$l_type}'>{$type}</a>"; ?></td>
		            					<td><?php echo " <span href='' class='category-icon {$l_cat}'>{$category}</span>"; ?></td>
		            					<td><?php echo $base_power; ?></td>
		            					<td><?php echo $pp ?></td>
		            					<td><?php echo $accuracy;?></td>
		            					<td class="col-sm-6 col-sx-4"><?php echo $desc; ?></td>
		            				</tr>
		            			<?php endforeach ?>
		            		</tbody>
	            		</table>
                    </div><!-- /.tab-pane -->