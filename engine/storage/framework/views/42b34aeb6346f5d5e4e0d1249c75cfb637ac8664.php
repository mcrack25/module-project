<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(Module::asset('admin::assets/plugins/switchery/css/switchery.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_bootstrap_js'); ?>
    <script src="<?php echo e(Module::asset('admin::assets/plugins/switchery/js/switchery.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="m-t-0 header-title"><b><?php echo e(trans('core::roles.top_name')); ?></b></h4>
                        <p class="text-muted font-13 m-b-30">
                            <?php echo e(trans('core::roles.description_add')); ?>

                        </p>
                    </div>
                </div>

                <form role="form" method="POST" action="<?php echo e(route('admin.roles.post_add')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dataTable no-footer text-center table_middle" role="grid" >
                                <tbody>
                                <tr role="row">
                                    <th class="text-right" style="width: 250px;">Название роли:</th>
                                    <td><input name="ru_name" type="text" class="form-control" placeholder="Название роли" value="<?php echo e(old('ru_name')); ?>" required></td>
                                </tr>
                                <tr role="row">
                                    <th colspan="2" class="text-center">Права доступа:</th>
                                </tr>
                                <tr role="row">
                                    <td colspan="2">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="row" id="checkbox_inline">
                                            <ul>
                                                <?php $__currentLoopData = $access; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $access_one): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <div class="form-group">
                                                            <input name="access[<?php echo e($access_one->id); ?>]" type="checkbox" data-plugin="switchery" data-color="#5d9cec"/>
                                                            <label class="control-label"><?php echo e($access_one->ru_name); ?></label>
                                                        </div>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr role="row">
                                    <th colspan="2" class="text-center">
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-plus"></i> Добавить</button>
                                        <a href="<?php echo e(route('admin.roles.all')); ?>" class="btn btn-primary waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-arrow-left"></i> Вернуться</a>
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>