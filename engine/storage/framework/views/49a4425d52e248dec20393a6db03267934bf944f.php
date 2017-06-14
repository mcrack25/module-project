<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="m-t-0 header-title"><b><?php echo e(trans('core::users.top_name')); ?></b></h4>
                        <p class="text-muted font-13 m-b-30">
                            <?php echo e(trans('core::users.description_add')); ?>

                        </p>
                    </div>
                </div>

                <form role="form" method="POST" action="<?php echo e(route('admin.users.post_add')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dataTable no-footer text-center table_middle" role="grid" >
                                <tbody>
                                    <tr role="row">
                                        <th class="text-right" style="width: 200px;">ФИО (или название ОГВ):</th>
                                        <td><input name="name" type="text" class="form-control" placeholder="ФИО (или название ОГВ)" value="<?php echo e(old('name')); ?>" required></td>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-right">Email:</th>
                                        <td><input name="email" type="email" class="form-control" placeholder="Email" value="<?php echo e(old('email')); ?>" required></td>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-right">Пароль:</th>
                                        <td><input name="password" type="password" class="form-control" value="" placeholder="Пароль" required></td>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-right">Повторите пароль:</th>
                                        <td><input name="password_confirmation" type="password" class="form-control" value="" placeholder="Повторите пароль" required></td>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-right">Роль:</th>
                                        <td>
                                            <select class="form-control" name="role_id">
                                                <?php if($roles): ?>
                                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(old('role') == $role->id): ?>
                                                            <option value="<?php echo e($role->id); ?>" selected><?php echo e($role->ru_name); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->ru_name); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-right">Редирект:</th>
                                        <td>
                                            <select class="form-control" name="route_id">
                                                <?php if($routes): ?>
                                                    <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(old('route_id') == $route->id): ?>
                                                            <option value="<?php echo e($route->id); ?>" selected><?php echo e($route->ru_name); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($route->id); ?>"><?php echo e($route->ru_name); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr role="row">
                                        <th colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-plus"></i> Добавить</button>
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