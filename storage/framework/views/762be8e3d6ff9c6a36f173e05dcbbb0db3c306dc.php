<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QSDB| Manager </title>

    <!-- Bootstrap -->
    <link href="<?php echo e(asset('vendors/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo e(asset('vendors/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo e(asset('vendors/nprogress/nprogress.css')); ?>" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo e(asset('vendors/google-code-prettify/bin/prettify.min.css')); ?>" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="<?php echo e(asset('vendors/build/css/custom.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('vendors/sweetalert/sweetalert.css')); ?>" type="text/css" rel="stylesheet">

    <script src="<?php echo e(asset('vendors/sweetalert/sweetalert.min.js')); ?>" type="text/javascript"></script>
    <style>
        nav{
            text-align: center;
        }
        tr .column-title{
            text-align: center;
        }
        table{
            text-align: center;
        }
        .error{
            color: crimson;
        }
        .notes-success{
            background-color: green;
            color: white;
        }
        .notes-error{
            background-color: red;
            color: white;
        }
    </style>
    <?php $__env->startSection('custom-style'); ?>
    <?php echo $__env->yieldSection(); ?>
</head>
<body class="nav-md">
<?php $__env->startSection('header-tab'); ?>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('header-nav'); ?>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('index-nav'); ?>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php echo $__env->yieldSection(); ?>
<div class="modal fade" id="notes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">操作成功！</div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
</body>
</html>
<!-- jQuery -->
<script src="<?php echo e(asset('vendors/jquery/dist/jquery.min.js')); ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo e(asset('vendors/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- FastClick -->
<script src="<?php echo e(asset('vendors/fastclick/lib/fastclick.js')); ?>"></script>
<!-- NProgress -->
<script src="<?php echo e(asset('vendors/nprogress/nprogress.js')); ?>"></script>
<!-- bootstrap-wysiwyg -->
<script src="<?php echo e(asset('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/jquery.hotkeys/jquery.hotkeys.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/google-code-prettify/src/prettify.js')); ?>"></script>
<!-- Custom Theme Scripts -->
<script src="<?php echo e(asset('vendors/build/js/custom.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/master.js')); ?>"></script>
<script>
    var h = document.documentElement.clientHeight || document.body.clientHeight;
    $(document).ready(function(){
//        alert(h + 'px');
        $(".main_container .right_col").css('min-height',h + 'px');
    });
</script>
<?php $__env->startSection('custom-script'); ?>
<?php echo $__env->yieldSection(); ?>

