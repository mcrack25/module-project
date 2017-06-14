<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="card-box table-responsive">

                <table class="table table-bordered table-str text-center table_middle" role="grid">
                    <tr>
                        <th colspan="3" class="info text-center" style="font-size: 16px">Информация о пользователе</th>
                    </tr>
                    <tr>
                        <td rowspan="3" class="success">
                            <img src="<?php echo e(Module::asset('admin::assets/images/users/avatar-1.png')); ?>" style="width:200px">
                        </td>
                        <th class="active text-right" style="width: 180px">ФИО или название ОГВ</th>
                        <td class="active text-left"><?php echo e($user->name); ?></td>
                    </tr>
                    <tr class="active">
                        <th class="text-right">Назначеная роль</th>
                        <td class="text-left"><?php echo e($user->role->ru_name); ?></td>
                    </tr>
                    <tr class="active">
                        <th class="text-right">Права доступа</th>
                        <td class="text-left">
                            <?php if(count($user->accesses_all) > 0): ?>
                                <?php $__currentLoopData = $user->accesses_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accesses): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($accesses->ru_name); ?><br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>