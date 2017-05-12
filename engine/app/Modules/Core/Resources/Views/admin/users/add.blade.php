@extends('admin::main')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="m-t-0 header-title"><b>{{ trans('core::users.top_name') }}</b></h4>
                        <p class="text-muted font-13 m-b-30">
                            {{ trans('core::users.description_add') }}
                        </p>
                    </div>
                </div>

                <form role="form" method="POST" action="{{ route('admin.users.post_add') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dataTable no-footer text-center" role="grid" >
                                <tbody>
                                    <tr role="row">
                                        <th class="text-right" style="width: 200px;">ФИО (или название ОГВ):</th>
                                        <td><input name="name" type="text" class="form-control" placeholder="ФИО (или название ОГВ)" value="{{ old('name') }}" required></td>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-right">Email:</th>
                                        <td><input name="email" type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required></td>
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
                                                @if($roles)
                                                    @foreach($roles as $role)
                                                        @if(old('role') == $role->id)
                                                            <option value="{{ $role->id }}" selected>{{ $role->ru_name }}</option>
                                                        @else
                                                            <option value="{{ $role->id }}">{{ $role->ru_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                    </tr>
                                    <tr role="row">
                                        <th colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-plus"></i> Добавить</button>
                                            <a href="{{ route('admin.users.all') }}" class="btn btn-primary waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-arrow-left"></i> Вернуться</a>
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