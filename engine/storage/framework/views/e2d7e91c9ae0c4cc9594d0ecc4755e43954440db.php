<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(Module::asset('menu::css/menu.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">

                        <div class="btn-group pull-right m-t-15">
                            <a href="<?php echo e(route('admin.menu.add')); ?>" class="btn btn-success waves-effect waves-light">Добавить новый пункт меню <i class="glyphicon glyphicon-plus"></i></a>
                        </div>

                        <h4 class="m-t-0 header-title"><b><?php echo e(trans('menu::menu.top_name')); ?></b></h4>
                        <p class="text-muted font-13 m-b-30">
                            <?php echo e(trans('menu::menu.description_edit')); ?>

                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">

                        <h3 class="text-center">Структура меню</h3>

                        <div id="page_menu">
                            <?php if($menus): ?>
                                <ul>
                                    <div class="div_level_1">
                                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu_one): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="menu_level_1<?php echo e(($menu_one->id == $id) ? ' active' : ''); ?>"><a href="<?php echo e(route('admin.menu.edit', ['id'=> $menu_one->id])); ?>"><?php echo e($menu_one->name); ?></a></li>
                                            <?php if(count($menu_one->submenu) > 0): ?>
                                                <div class="div_level_2">
                                                    <?php $__currentLoopData = $menu_one->submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="menu_level_2<?php echo e(($submenu->id == $id) ? ' active' : ''); ?>"><a href="<?php echo e(route('admin.menu.edit', ['id'=> $submenu->id])); ?>"><?php echo isset($submenu->icon) ? $submenu->icon : '<i class="ion-pound"></i>'; ?>&nbsp;&nbsp;<span><?php echo e($submenu->name); ?> </span></a></li>
                                                        <?php if(count($submenu->submenu) > 0): ?>
                                                            <div class="div_level_3">
                                                                <?php $__currentLoopData = $submenu->submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li class="menu_level_3<?php echo e(($sub_sub->id == $id) ? ' active' : ''); ?>"><a href="<?php echo e(route('admin.menu.edit', ['id'=> $sub_sub->id])); ?>"><span> <?php echo e($sub_sub->name); ?></span></a></li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </ul>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <h3 class="text-center">Изменение пункта меню</h3>
                        <form method="POST" action="<?php echo e(route('admin.menu.post_edit_delete', $id)); ?>">
                            <?php echo e(csrf_field()); ?>

                            <table class="menu_form">
                                <tr>
                                    <td class="names_menu" style="width: 170px">Название*:</td>
                                    <td><input name="name" type="text" class="form-control" placeholder="Название" value="<?php echo e($menu_form->name); ?>"></td>
                                </tr>
                                <tr>
                                    <td class="names_menu">Вложенность*:</td>
                                    <td>
                                        <?php if($menus): ?>
                                            <select name="parent_id" class="form-control">
                                                <option value="0" <?php echo e((0 == $menu_form->parent_id) ? ' selected' : ''); ?>>Главный пункт</option>
                                                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu_one): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($menu_one->id); ?>" <?php echo e(($menu_one->id == $menu_form->parent_id) ? ' selected' : ''); ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($menu_one->name); ?></option>
                                                    <?php if(count($menu_one->submenu) > 0): ?>
                                                        <?php $__currentLoopData = $menu_one->submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($submenu->id); ?>" <?php echo e(($submenu->id == $menu_form->parent_id) ? ' selected' : ''); ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($submenu->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="names_menu">Путь к странице*:</td>
                                    <td>
                                        <select name="route_id" class="form-control">
                                            <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($route->id); ?>" <?php echo e(($route->id == $menu_form->route_id) ? ' selected' : ''); ?>><?php echo e($route->ru_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="names_menu">Альтернативный URL:</td>
                                    <td><input name="other_url" value="<?php echo e($menu_form->other_url); ?>" type="text" class="form-control" placeholder="Если вам нужна какая то другая страница"></td>
                                </tr>

                                <tr>
                                    <td class="names_menu">Уровень сортировки:</td>
                                    <td><input name="sort" value="<?php echo e($menu_form->sort); ?>" type="text" class="form-control" placeholder="Уровень сортировки (По умолчанию - 1000)"></td>
                                </tr>
                                <tr>
                                    <td class="names_menu">Иконка:</td>
                                    <td><input name="icon" value="<?php echo e($menu_form->icon); ?>" type="text" class="form-control" placeholder="<span> или <i> тег иконки"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <br />
                                        <button type="submit" name="submit" value="save" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Сохранить</button>
                                        <button type="submit" name="submit" value="delete" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Удалить</button>
                                    </td>
                                </tr>
                            </table>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>