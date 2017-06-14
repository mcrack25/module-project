<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="m-t-0 header-title"><b><?php echo e(trans('core::roles.top_name')); ?></b></h4>
                        <p class="text-muted font-13 m-b-30">
                            <?php echo e(trans('core::roles.description_delete')); ?>

                        </p>
                    </div>
                </div>

                <form id="delete_form_user" role="form" method="POST" action="<?php echo e(route('admin.roles.post_delete')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="role_ids[]" value="<?php echo e($role->id); ?>">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dataTable no-footer text-center table_middle" role="grid" >
                                <tbody>
                                <tr role="row">
                                    <th class="text-right" style="width: 300px;">Название роли:</th>
                                    <td><?php echo e($role->ru_name); ?></td>
                                </tr>

                                <?php if($count_users > 0): ?>
                                    <tr role="row">
                                        <th class="text-right">Последствия:</th>
                                        <td style="color: red;">
                                            <b>Внимание!</b> Пользователей подключённых к данной роли - <b><?php echo e($count_users); ?></b>,<br />
                                            В случае удаления - пользователи останутся без роли.
                                        </td>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-right">Назначить другую роль:</th>
                                        <td>
                                            <select class="form-control" name="role_id">
                                                <?php if($roles): ?>
                                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role_one): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(old('role') == $role_one->id): ?>
                                                            <option value="<?php echo e($role_one->id); ?>" selected><?php echo e($role_one->ru_name); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($role_one->id); ?>"><?php echo e($role_one->ru_name); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <tr role="row">
                                    <th colspan="2" class="text-center">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-trash"></i> Удалить</button>
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