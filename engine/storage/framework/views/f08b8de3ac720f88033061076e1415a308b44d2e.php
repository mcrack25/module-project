<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="m-t-0 header-title"><b><?php echo e(trans('core::users.top_name')); ?></b></h4>
                        <p class="text-muted font-13 m-b-30">
                            <?php echo e(trans('core::users.description_delete')); ?>

                        </p>
                    </div>
                </div>

                <form id="delete_form_user" role="form" method="POST" action="<?php echo e(route('admin.users.post_delete')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="user_ids[]" value="<?php echo e($user->id); ?>">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dataTable no-footer text-center" role="grid" >
                                <tbody>
                                <tr role="row">
                                    <th class="text-right" style="width: 200px;">ФИО (или название ОГВ):</th>
                                    <td><?php echo e($user->name); ?></td>
                                </tr>
                                <tr role="row">
                                    <th class="text-right">Email:</th>
                                    <td><?php echo e($user->email); ?></td>
                                </tr>
                                <tr role="row">
                                    <th class="text-right">Роль:</th>
                                    <td><?php echo e(isset($user->role->ru_name) ? $user->role->ru_name : 'Нет роли'); ?></td>
                                </tr>
                                <tr role="row">
                                    <th colspan="2" class="text-center">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-trash"></i> Удалить</button>
                                        <a href="<?php echo e(route('admin.users.all')); ?>" class="btn btn-primary waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-arrow-left"></i> Вернуться</a>
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