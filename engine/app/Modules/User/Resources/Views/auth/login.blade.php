<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Авторизация в системе</title>
        <link rel="shortcut icon" href="{{ config('app.app_url') }}/public/styles/auth/img/favicon.png" type="image/png">
        <link rel="stylesheet" href="{{ config('app.app_url') }}/public/styles/auth/css/style.css" media="screen" type="text/css" />
    </head>

    <body>
        <div id="login-form">
            <h1>АВТОРИЗАЦИЯ</h1>
            <fieldset>
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <input type="email" name="email" required placeholder="Логин" class="{{ $errors->has('email') ? 'has-error' : '' }}" value="{{ old('email') }}">
                    <input type="password" name="password" required placeholder="Пароль" class="{{ $errors->has('password') ? 'has-error' : '' }}" value="{{ old('password') }}">
                    <input type="submit" value="ВОЙТИ">
                </form>
                @if ($errors->has('email'))
                    <span class="help-block">
                         <strong>{!! $errors->first('email') !!}</strong>
                    </span>
                @endif
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{!! $errors->first('password') !!}</strong>
                    </span>
                @endif
            </fieldset>
        </div>
    </body>
</html>