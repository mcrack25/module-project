<ul>
<?php if(isset($menus)): ?>
    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu_1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $level_1 = 1; ?>





        <?php if(count($menu_1->submenu_access) > 0): ?>
            <?php $__currentLoopData = $menu_1->submenu_access; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu_2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $level_2 = 1; ?>



                    <?php if(count($menu_2->submenu_access) > 0): ?>
                        <?php if($level_1 == 1): ?>
                            <li class="text-muted menu-title"><?php echo e($menu_1->name); ?></li>
                            <?php $level_1++; ?>
                        <?php endif; ?>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><?php echo isset($menu_2->icon) ? $menu_2->icon : '<i class="ion-pound"></i>'; ?>  <span> <?php echo e($menu_2->name); ?> </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <?php $__currentLoopData = $menu_2->submenu_access; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu_3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($menu_3->other_url)): ?>
                                        <li><a href="<?php echo $menu_3->other_url; ?>" class="waves-effect">  <span> <?php echo e($menu_3->name); ?> </span></a></li>
                                    <?php else: ?>
                                        <li><a href="<?php try{ echo route($menu_3->route->route);} catch(\Exception $e){echo 'javascript:void(0);';}?>" class="waves-effect">  <span> <?php echo e($menu_3->name); ?> </span></a></li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                    <?php else: ?>

                        <?php if(!empty($menu_2->other_url)): ?>
                            <?php if($level_1 == 1): ?>
                                <li class="text-muted menu-title"><?php echo e($menu_1->name); ?></li>
                                <?php $level_1++; ?>
                            <?php endif; ?>

                            <li><a href="<?php echo $menu_2->other_url; ?>" class="waves-effect"><?php echo isset($menu_2->icon) ? $menu_2->icon : '<i class="ion-pound"></i>'; ?>  <span> <?php echo e($menu_2->name); ?> </span></a></li>

                        <?php elseif(isset($menu_2->route)): ?>
                            <?php if($level_1 == 1): ?>
                                <li class="text-muted menu-title"><?php echo e($menu_1->name); ?></li>
                                <?php $level_1++; ?>
                            <?php endif; ?>
                            <li><a href="<?php try{echo route($menu_2->route->route);}catch(\Exception $e){echo 'javascript:void(0);';}?>" class="waves-effect"><?php echo isset($menu_2->icon) ? $menu_2->icon : '<i class="ion-pound"></i>'; ?>  <span> <?php echo e($menu_2->name); ?> </span></a></li>
                        <?php endif; ?>
                    <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
</ul>