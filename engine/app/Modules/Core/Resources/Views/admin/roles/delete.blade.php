@extends('admin::main')

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="m-t-0 header-title"><b>{{ trans('core::roles.top_name') }}</b></h4>
                        <p class="text-muted font-13 m-b-30">
                            {{ trans('core::roles.description_delete') }}
                        </p>
                    </div>
                </div>

                <form id="delete_form_user" role="form" method="POST" action="{{ route('admin.roles.post_delete') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="role_ids[]" value="{{ $role->id }}">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dataTable no-footer text-center table_middle" role="grid" >
                                <tbody>
                                <tr role="row">
                                    <th class="text-right" style="width: 300px;">Название роли:</th>
                                    <td>{{ $role->ru_name }}</td>
                                </tr>

                                @if($count_users > 0)
                                    <tr role="row">
                                        <th class="text-right">Последствия:</th>
                                        <td style="color: red;">
                                            <b>Внимание!</b> Пользователей подключённых к данной роли - <b>{{ $count_users }}</b>,<br />
                                            В случае удаления - пользователи останутся без роли.
                                        </td>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-right">Назначить другую роль:</th>
                                        <td>
                                            <select class="form-control" name="role_id">
                                                @if($roles)
                                                    @foreach($roles as $role_one)
                                                        @if(old('role') == $role_one->id)
                                                            <option value="{{ $role_one->id }}" selected>{{ $role_one->ru_name }}</option>
                                                        @else
                                                            <option value="{{ $role_one->id }}">{{ $role_one->ru_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                    </tr>
                                @endif

                                <tr role="row">
                                    <th colspan="2" class="text-center">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-trash"></i> Удалить</button>
                                        <a href="{{ route('admin.roles.all') }}" class="btn btn-primary waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-arrow-left"></i> Вернуться</a>
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
@stop