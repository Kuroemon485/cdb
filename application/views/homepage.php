<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pokemon Competition Database
            <small>Get yourself championship here.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- The time line -->
                <ul class="timeline">
                    <?php if ($news): ?>
                        <?php foreach ($news as $key => $value):
                            $post_date = DateTime::createFromFormat('Y-m-d H:i:s', $value->post_date);
                            $title = $value->title;
                            $content = $value->content;
                            $post_type = $value->post_type;
                        ?>
                    <!-- timeline time label -->
                    <li class="time-label">
                        <span class="bg-red">
                            <?php echo $post_date->format('Y-m-d'); ?>
                        </span>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                        <i class="fa fa-<?php 
                            switch ($post_type) {
                                case 0:
                                    echo 'desktop';
                                    break;
                                case 1:
                                    echo 'envelope';
                                default:
                                    # code...
                                    break;
                            }
                         ?> bg-<?php 
                            switch ($post_type) {
                                case 0:
                                    echo 'red';
                                    break;
                                case 1:
                                    echo 'blue';
                                default:
                                    # code...
                                    break;
                            }
                         ?>"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i><?php echo $post_date->format('H:i:s') ?></span>
                            <h2 class="timeline-header"><?php echo $title ?></h2>
                            <div class="timeline-body">
                                <?php echo $content ?>
                            </div>
                        </div>
                    </li>
                    <!-- END timeline item -->
                    <!-- timeline time label -->
                        <?php endforeach ?>
                    <?php endif ?>
                    <li>
                        <i class="fa fa-clock-o"></i>
                    </li>
                </ul>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->