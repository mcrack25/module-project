<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e(Module::action('config::getOne', ['item'=>'admin_description', 'or'=>'Базовое приложение'])); ?>">
    <meta name="author" content="M-Crack">

    <title><?php echo e(Module::action('config::getOne', ['item'=>'admin_name', 'or'=>'Базовое приложение'])); ?></title>
    <link rel="shortcut icon" href="<?php echo e(Module::asset('admin::img/favicon.png')); ?>" type="image/png">

    <!--Morris Chart CSS -->
    <link href="<?php echo e(Module::asset('admin::assets/plugins/morris/morris.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(Module::asset('admin::assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(Module::asset('admin::assets/css/core.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(Module::asset('admin::assets/css/components.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(Module::asset('admin::assets/css/icons.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(Module::asset('admin::assets/css/pages.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(Module::asset('admin::assets/css/responsive.css')); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo e(Module::asset('admin::assets/js/modernizr.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('head'); ?>
    <link href="<?php echo e(Module::asset('admin::css/styles.css')); ?>" rel="stylesheet" type="text/css" />
</head>

<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="<?php echo e(route('admin.index')); ?>" class="logo"><i class="glyphicon glyphicon-user"></i> <span>mcrackCMS</span></a>
            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <div class="pull-left">
                        <button class="button-menu-mobile open-left waves-effect waves-light">
                            <i class="md md-menu"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>


                    <ul class="nav navbar-nav navbar-right pull-right">

                        <li class="hidden-xs">
                            <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                        </li>
                        <li class="dropdown top-menu-item-xs">
                            <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo e(Module::asset('admin::assets/images/users/avatar-1.png')); ?>" alt="user-img" class="img-circle"> </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)"><i class="ti-user m-r-10 text-custom"></i> <?php echo e(Auth::user()->name); ?></a></li>
                                <li class="divider"></li>
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();"><i class="ti-power-off m-r-10 text-danger"></i> Выйти
                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->

    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">

            <!--- Divider -->
            <div id="sidebar-menu">

                <?php echo Module::action('menu::show'); ?>


                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title"><?php echo e(Module::action('config::getOne', ['item'=>'admin_name', 'or'=>'Админ панель'])); ?></h4>
                        <p class="text-muted page-title-alt"><?php echo e(Module::action('config::getOne', ['item'=>'admin_description', 'or'=>'Базовое приложение'])); ?></p>
                    </div>
                </div>

                <?php echo $__env->yieldContent('content'); ?>


            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right">
            © 2017. Все права защищены.
        </footer>

    </div>

    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

</div>
<!-- END wrapper -->

<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="<?php echo e(Module::asset('admin::assets/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('admin::assets/js/bootstrap.min.js')); ?>"></script>

<?php echo $__env->yieldContent('after_bootstrap_js'); ?>
<script src="<?php echo e(Module::asset('admin::assets/js/detect.js')); ?>"></script>
<script src="<?php echo e(Module::asset('admin::assets/js/fastclick.js')); ?>/"></script>

<script src="<?php echo e(Module::asset('admin::assets/js/jquery.slimscroll.js')); ?>"></script>
<script src="<?php echo e(Module::asset('admin::assets/js/jquery.blockUI.js')); ?>"></script>
<script src="<?php echo e(Module::asset('admin::assets/js/waves.js')); ?>"></script>
<script src="<?php echo e(Module::asset('admin::assets/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('admin::assets/js/jquery.nicescroll.js')); ?>"></script>
<script src="<?php echo e(Module::asset('admin::assets/js/jquery.scrollTo.min.js')); ?>"></script>

<script src="<?php echo e(Module::asset('admin::assets/plugins/peity/jquery.peity.min.js')); ?>"></script>

<!-- jQuery  -->
<script src="<?php echo e(Module::asset('admin::assets/plugins/waypoints/lib/jquery.waypoints.js')); ?>"></script>
<script src="<?php echo e(Module::asset('admin::assets/plugins/counterup/jquery.counterup.min.js')); ?>"></script>


<script src="<?php echo e(Module::asset('admin::assets/plugins/morris/morris.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('admin::assets/plugins/raphael/raphael-min.js')); ?>"></script>

<script src="<?php echo e(Module::asset('admin::assets/plugins/jquery-knob/jquery.knob.js')); ?>"></script>

<script src="<?php echo e(Module::asset('admin::assets/pages/jquery.dashboard.js')); ?>"></script>

<!-- notifications  -->
<script src="<?php echo e(Module::asset('admin::assets/plugins/notifyjs/js/notify.js')); ?>"></script>
<script src="<?php echo e(Module::asset('admin::assets/plugins/notifications/notify-metro.js')); ?>"></script>
<!-- notifications  -->

<script src="<?php echo e(Module::asset('admin::assets/js/jquery.core.js')); ?>"></script>
<script src="<?php echo e(Module::asset('admin::assets/js/jquery.app.js')); ?>"></script>


<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });

        $(".knob").knob();

    });
</script>

<?php if(count($errors) > 0): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>
            $(document).ready(function () {
                $.Notification.autoHideNotify('error', 'top right', 'Ошибка!','<?php echo $error; ?>');
            });
        </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php if(session('message')): ?>
    <script>
        $(document).ready(function () {
            $.Notification.autoHideNotify('success', 'top right', 'Выполнено!','<?php echo session('message'); ?>');
        });
    </script>
<?php endif; ?>

</body>
</html>