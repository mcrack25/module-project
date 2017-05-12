@extends('admin::main')

@section('head')
    <link href="{{ Module::asset('admin::assets/plugins/switchery/css/switchery.min.css') }}" rel="stylesheet" />
@stop

@section('after_bootstrap_js')
    <script src="{{ Module::asset('admin::assets/plugins/switchery/js/switchery.min.js') }}"></script>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="m-t-0 header-title"><b>{{ trans('core::roles.top_name') }}</b></h4>
                        <p class="text-muted font-13 m-b-30">
                            {{ trans('core::roles.description_edit') }}
                        </p>
                    </div>
                </div>

                <form role="form" method="POST" action="{{ route('admin.roles.post_edit', $role->id) }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dataTable no-footer text-center table_middle" role="grid" >
                                <tbody>
                                    <tr role="row">
                                        <th class="text-right" style="width: 250px;">Название роли:</th>
                                        <td><input name="ru_name" type="text" class="form-control" placeholder="Название роли" value="{{ $role->ru_name }}" required></td>
                                    </tr>
                                    <tr role="row">
                                        <th colspan="2" class="text-center">Права доступа:</th>
                                    </tr>
                                    <tr role="row">
                                        <td colspan="2">
                                            {{ csrf_field() }}
                                            <div class="row" id="checkbox_inline">
                                                <ul>
                                                    @foreach($access as $access_one)
                                                        <li>
                                                            <div class="form-group">
                                                                <input name="access[{{ $access_one->id }}]"
                                                                    @foreach($role_access as $role_access_one)
                                                                        @if($role_access_one->id == $access_one->id)
                                                                            checked
                                                                        @endif
                                                                    @endforeach
                                                                type="checkbox" data-plugin="switchery" data-color="#5d9cec"/>
                                                                <label class="control-label">{{ $access_one->ru_name }}</label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr role="row">
                                        <th colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-floppy-disk"></i> Сохранить</button>
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