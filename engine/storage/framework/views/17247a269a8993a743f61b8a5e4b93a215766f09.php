<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Авторизация в системе</title>
        <link rel="shortcut icon" href="<?php echo e(asset('public/auth/img/favicon.png')); ?>" type="image/png">
        <link rel="stylesheet" href="<?php echo e(asset('public/auth/css/style.css')); ?>" media="screen" type="text/css" />
    </head>

    <body>
        <div id="login-form">
            <h1>АВТОРИЗАЦИЯ</h1>

            <fieldset>
                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <input type="email" name="email" required placeholder="Логин" class="<?php echo e($errors->has('email') ? 'has-error' : ''); ?>" value="<?php echo e(old('email')); ?>">
                    <input type="password" name="password" required placeholder="Пароль" class="<?php echo e($errors->has('password') ? 'has-error' : ''); ?>" value="<?php echo e(old('password')); ?>">
                    <input type="submit" value="ВОЙТИ">
                </form>
                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                         <strong><?php echo $errors->first('email'); ?></strong>
                    </span>
                <?php endif; ?>
                <?php if($errors->has('password')): ?>
                    <span class="help-block">
                        <strong><?php echo $errors->first('password'); ?></strong>
                    </span>
                <?php endif; ?>
            </fieldset>
        </div>
    </body>
</html>