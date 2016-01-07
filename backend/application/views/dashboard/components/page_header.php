<!DOCTYPE html>
<html>
<head>
	<title><?php  ?></title>
    <meta charset="UTF-8" >
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/bootstrap/css/bootstrap.min.css'); ?>" />
	<!--<link rel="stylesheet" type="text/css" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css" />-->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/bootstrap/css/sticky-footer.css'); ?>" />
<!--    <link rel="stylesheet" type="text/css" href="<?php /*echo site_url('assets/bootstrap/css/bootstrap-switch.min.css'); */?>" />
    <link rel="stylesheet" type="text/css" href="<?php /*echo site_url('jquery-ui-1.11.0/css/jquery-ui.min.css'); */?>" />
    <link rel="stylesheet" type="text/css" href="<?php /*echo site_url('css/datepicker.css'); */?>" />-->




    <!-- ############################################ -->
    <!-- ######### this is the js part ############## -->
    <!-- ############################################ -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
<!--    <script src="<?php /*echo site_url('jquery-ui-1.11.0/jquery-ui.min.js'); */?>"></script>
    <script src="<?php /*echo site_url('assets/bootstrap/js/bootstrap.min.js'); */?>"></script>
    <script src="<?php /*echo site_url('assets/bootstrap/js/bootstrap-switch.min.js'); */?>"></script>
    <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <script src="<?php /*echo site_url('assets/js/bootstrap-datepicker.js'); */?>"></script>-->


    <!-- Place inside the <head> of your HTML -->

        <link href="<?php echo site_url('css/admin.css'); ?>" rel="stylesheet">




    <script src="<?php echo site_url('nestedSortable-master/jquery.mjs.nestedSortable.js'); ?>"></script>
    <?php if(isset($sortable) && $sortable === TRUE): ?>
    <?php endif; ?>
    <script type="text/javascript" src="<?php echo site_url('tinymce/tinymce.min.js')?>" ></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea#inputContent"
        });
    </script>
    <script>
        $(function() {
            $('.datepicker').datepicker({ format : 'yyyy-mm-dd' });
        });
    </script>
</head>
<body>
