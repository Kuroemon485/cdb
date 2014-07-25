
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
	    </div><!-- /.col -->
	</div>
    <?php #echo '<pre>';print_r($basic); echo '</pre>' ?>
    <?php #echo '<pre>';print_r($learn_set); echo '</pre>' ?>
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