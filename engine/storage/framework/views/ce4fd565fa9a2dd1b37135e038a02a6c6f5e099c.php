<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(Module::asset('admin::assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_bootstrap_js'); ?>
    <script src="<?php echo e(Module::asset('admin::assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(Module::asset('admin::js/for_datepicker.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <a href="<?php echo e(route('admin.routes.add')); ?>" class="btn btn-success waves-effect waves-light">Добавить <i class="glyphicon glyphicon-plus"></i></a>
                        </div>

                        <h4 class="m-t-0 header-title"><b><?php echo e(trans('core::routes.top_name')); ?></b></h4>
                        <p class="text-muted font-13 m-b-30">
                            <?php echo e(trans('core::routes.description_all')); ?>

                        </p>
                    </div>
                </div>

                <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                    <form id="search_form" method="GET" action="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Дата:</span>
                                    <select name="date_type" class="form-control" style="width: 100px">
                                        <option value="created_at" <?php echo e(($date_type == 'created_at') ? 'selected' : ''); ?>>Регистрации</option>
                                        <option value="updated_at" <?php echo e(($date_type == 'updated_at') ? 'selected' : ''); ?>>Изменения</option>
                                    </select>
                                    <span class="input-group-addon">С:</span>
                                    <input name="date_s" type="text" class="datepicker-autoclose form-control" autocomplete="off" placeholder="дд.мм.гггг" id="date_s" value="<?php echo e(isset($date_s) ? $date_s : ''); ?>">
                                    <span class="input-group-addon">ПО:</span>
                                    <input name="date_po" type="text" class="datepicker-autoclose form-control" autocomplete="off" placeholder="дд.мм.гггг" id="date_po" value="<?php echo e(isset($date_po) ? $date_po : ''); ?>">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn waves-effect waves-light btn-primary"><i class="glyphicon glyphicon-filter"></i> Фильтровать</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <br />

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Показывать по:</span>
                                    <select name="count_on_page" aria-controls="datatable" class="form-control input-sm" onchange="this.form.submit()">
                                        <?php if(isset($count_list)): ?>
                                            <?php $__currentLoopData = $count_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $count_list_one): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($count_list_one == $count_on_page): ?>
                                                    <option value="<?php echo e($count_list_one); ?>" selected><?php echo e($count_list_one); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($count_list_one); ?>"><?php echo e($count_list_one); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <span class="input-group-addon">записей</span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Сортировать по:</span>
                                    <select name="sort_name" class="form-control" style="width:100px;" onchange="this.form.submit()">
                                        <?php if(isset($sort_name)): ?>
                                            <option value="id" <?php echo e(($sort_name == 'id') ? 'selected' : ''); ?>>ID</option>
                                            <option value="route" <?php echo e(($sort_name == 'route') ? 'selected' : ''); ?>>Роут</option>
                                            <option value="ru_name" <?php echo e(($sort_name == 'ru_name') ? 'selected' : ''); ?>>Название роута</option>
                                        <?php endif; ?>
                                    </select>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-sort"></i></span>
                                    <select name="sort_arrow" class="form-control" onchange="this.form.submit()">
                                        <?php if(isset($sort_arrow)): ?>
                                            <option value="asc" <?php echo e(($sort_arrow == 'asc') ? 'selected' : ''); ?>>&#x2193;</option>
                                            <option value="desc" <?php echo e(($sort_arrow == 'desc') ? 'selected' : ''); ?>>&#x2191;</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div id="datatable_filter" class="dataTables_filter text-right">
                                    <label>
                                        <div class="input-group m-t-10">
                                            <input type="text" id="example-input2-group2" name="search_text" class="form-control input-sm" aria-controls="datatable" placeholder="Поиск" value="<?php echo e(isset($search_text) ? $search_text : ''); ?>">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn waves-effect waves-light btn-primary btn-sm"><i class="glyphicon glyphicon-search"></i> Искать</button>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-striped table-bordered dataTable no-footer text-center table_middle" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr role="row">
                                        <th tabindex="0" class="text-center" style="width: 20px;">ID</th>
                                        <th tabindex="0" class="text-center" style="width: 200px;">Роут</th>
                                        <th tabindex="0" class="text-center">Название роута</th>
                                        <th tabindex="0" class="text-center" style="width: 250px;">Уровень доступа</th>
                                        <th tabindex="0" class="text-center" style="width: 150px;">Действия</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if(isset($routes)): ?>
                                        <?php if($routes->count() > 0): ?>
                                            <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr role="row" class="<?php echo e(($loop->count % 2) ? 'odd' : 'even'); ?>">
                                                    <td><?php echo e($route->id); ?></td>
                                                    <td><?php echo e($route->route); ?></td>
                                                    <td><?php echo e($route->ru_name); ?></td>
                                                    <td><?php echo isset($route->access->ru_name) ? $route->access->ru_name : '<b style="color:red;">Без доступа</b>'; ?></td>
                                                    <td class="actions">
                                                        <a href="<?php echo e(route('admin.routes.edit', $route->id )); ?>" class="on-default edit-row"><i class="fa fa-pencil fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Изменить"></i></a>
                                                        <a href="<?php echo e(route('admin.routes.delete', $route->id)); ?>" class="on-default remove-row"><i class="fa fa-trash-o fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Удалить"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr role="row" class="even">
                                                <td colspan="5"><b><?php echo e(trans('core::routes.items_none')); ?></b></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <tr role="row" class="even">
                                            <td colspan="5"><b><?php echo e(trans('core::routes.items_not_isset')); ?></b></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?php if(isset($routes)): ?>
                                <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Показано <?php echo e($routes->count()); ?> из <?php echo e($routes->total()); ?> записей</div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                <?php if(isset($routes)): ?>
                                    <?php echo e($routes->appends(['count_on_page' => $count_on_page, 'sort_name' => $sort_name, 'sort_arrow' => $sort_arrow, 'search_text' => $search_text, 'date_type'=>$date_type, 'date_s'=> $date_s, 'date_po'=>$date_po])->links()); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>