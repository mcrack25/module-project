@extends('admin.main')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="m-t-0 header-title"><b>Удаление пользователя</b></h4>
                        <p class="text-muted font-13 m-b-30">
                            Удаление пользователя из системы.
                        </p>
                    </div>
                </div>

                <form id="delete_form_user" role="form" method="POST" action="{{ route('admin.users_post_delete') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_ids[]" value="{{ $user->id }}">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dataTable no-footer text-center" role="grid" >
                                <tbody>
                                <tr role="row">
                                    <th class="text-right" style="width: 200px;">ФИО (или название ОГВ):</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr role="row">
                                    <th class="text-right">Email:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr role="row">
                                    <th class="text-right">Роль:</th>
                                    <td>{{ $user->role->ru_name or 'Нет роли'}}</td>
                                </tr>
                                <tr role="row">
                                    <th colspan="2" class="text-center">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-trash"></i> Удалить</button>
                                        <a href="{{ route('admin.users') }}" class="btn btn-primary waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-arrow-left"></i> Вернуться</a>
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