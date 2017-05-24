@extends('admin::main')

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="card-box table-responsive">

                <table class="table table-bordered table-str text-center table_middle" role="grid">
                    <tr>
                        <th colspan="3" class="info text-center">Информация о пользователе</th>
                    </tr>
                    <tr>
                        <td rowspan="3" class="success">
                            <img src="{{ Module::asset('admin::assets/images/users/avatar-1.png') }}" style="width:200px">
                        </td>
                        <th class="active text-right">Имя</th>
                        <td class="active text-left">{{ $user->name }}</td>
                    </tr>
                    <tr class="active">
                        <th class="text-right">Назначеная роль</th>
                        <td class="text-left">{{ $user->role->ru_name }}</td>
                    </tr>
                    <tr class="active">
                        <th class="text-right">Права доступа</th>
                        <td class="text-left">
                            @if(count($user->accesses_all) > 0)
                                @foreach($user->accesses_all as $accesses)
                                    {{ $accesses->ru_name }}<br>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@stop