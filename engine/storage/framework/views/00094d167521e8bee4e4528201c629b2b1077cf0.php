<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="m-t-0 header-title"><b><?php echo e(trans('note::note.top_name')); ?></b></h4>
                        <p class="text-muted font-13 m-b-30">
                            <?php echo e(trans('note::note.description_add')); ?>

                        </p>
                    </div>
                </div>

                <form role="form" method="POST" action="<?php echo e(route('admin.notes.post_edit')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dataTable no-footer text-center table_middle" role="grid" >
                                <tbody>
                                <tr role="row">
                                    <th class="text-right" style="width: 150px;">Заметка:</th>
                                    <td><textarea name="text" class="form-control" placeholder="Текст заметки" style="height: 200px;resize: none;" required><?php echo e($note->text); ?></textarea></td>
                                </tr>

                                <tr role="row">
                                    <th colspan="2" class="text-center">
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-plus"></i> Сохранить</button>
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