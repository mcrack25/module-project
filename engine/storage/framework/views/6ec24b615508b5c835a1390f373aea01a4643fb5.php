<?php $__env->startSection('after_bootstrap_js'); ?>
    <script src="<?php echo e(Module::asset('admin::assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(Module::asset('admin::assets/plugins/autoNumeric/autoNumeric.js')); ?>" type="text/javascript"></script>

    <script type="text/javascript">
        jQuery(function($) {
            $('.autonumber').autoNumeric('init');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">

            <ul class="nav nav-tabs navtab-bg nav-justified">
                <li class="active">
                    <a href="#admin" data-toggle="tab" aria-expanded="true">
                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                        <span class="hidden-xs">Админка</span>
                    </a>
                </li>
                <li>
                    <a href="#profile1" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">Другой пункт</span>
                    </a>
                </li>
                <li>
                    <a href="#messages1" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                        <span class="hidden-xs">База данных</span>
                    </a>
                </li>
                <li>
                    <a href="#settings1" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-cog"></i></span>
                        <span class="hidden-xs">Другие настройки</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="admin">

                    <form class="form_table" role="form" method="POST" action="<?php echo e(route('admin.config.post_save')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable no-footer text-center" role="grid" >
                                    <tbody>
                                    <tr role="row">
                                        <th class="text-right" style="width: 250px;">Название админки:</th>
                                        <td><input name="admin_name" type="text" class="form-control" placeholder="Название админки" value="<?php echo e(isset($configs['admin_name']) ? $configs['admin_name'] : ''); ?>" required></td>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-right">Описание админки:</th>
                                        <td><input name="admin_description" type="text" class="form-control" placeholder="Описание админки" value="<?php echo e(isset($configs['admin_description']) ? $configs['admin_description'] : ''); ?>" required></td>
                                    </tr>

                                    <tr role="row">
                                        <th colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-floppy-disk"></i> Сохранить</button>
                                        </th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="tab-pane" id="profile1">

                </div>
                <div class="tab-pane" id="messages1">
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                </div>
                <div class="tab-pane" id="settings1">
                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin::main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>