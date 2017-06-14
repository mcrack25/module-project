<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="m-t-0 header-title"><b><?php echo e(trans('core::routes.top_name')); ?></b></h4>
                        <p class="text-muted font-13 m-b-30">
                            <?php echo e(trans('core::routes.description_add')); ?>

                        </p>
                    </div>
                </div>

                <form role="form" method="POST" action="<?php echo e(route('admin.routes.post_add')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dataTable no-footer text-center table_middle" role="grid" >
                                <tbody>
                                    <tr role="row">
                                        <th class="text-right" style="width: 200px;">Название роута:</th>
                                        <td><input name="ru_name" type="text" class="form-control" placeholder="Название роута" value="<?php echo e(old('ru_name')); ?>" required></td>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-right">Роут:</th>
                                        <td><input name="route" type="text" class="form-control" placeholder="Роут" value="<?php echo e(old('route')); ?>" required></td>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-right">Уровень доступа:</th>
                                        <td>
                                            <select class="form-control" name="access_id">
                                                <?php if(isset($accesses)): ?>
                                                    <?php $__currentLoopData = $accesses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $access): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(old('access_id') == $access->id): ?>
                                                            <option value="<?php echo e($access->id); ?>" selected><?php echo e($access->ru_name); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($access->id); ?>"><?php echo e($access->ru_name); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr role="row">
                                        <th colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-plus"></i> Добавить</button>
                                            <a href="<?php echo e(route('admin.routes.all')); ?>" class="btn btn-primary waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-arrow-left"></i> Вернуться</a>
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