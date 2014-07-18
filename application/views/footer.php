</div>
<!-- jQuery 2.0.2 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="<?php echo base_url(); ?>public/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>public/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>public/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- slimScroll -->
<script src="<?php echo base_url() ?>public/js/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ion-Range Slider -->
<script src="<?php echo base_url() ?>public/js/plugins/ionslider/ion.rangeSlider.min.js"></script>
<!-- wysihtml5 -->
<script src="<?php echo base_url() ?>public/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- select2 -->
<script src="<?php echo base_url() ?>public/js/select2/select2.js"></script>
<!-- select -->
<script src="<?php echo base_url() ?>public/js/select/bootstrap-select.js"></script>

<!-- exclusive scripts -->
<?php if (isset($admin_script)) echo $admin_script; ?>
<?php if (isset($main_script)) echo $main_script; ?>
<?php if (isset($data_script)) echo $data_script; ?>
<?php if (isset($tools_script)) echo $tools_script; ?>
<?php if (isset($builder_script)) echo $builder_script ?>
<?php if (isset($xytools_script)) echo $xytools_script  ?>
</body>
</html>