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
                        <h4 class="m-t-0 header-title"><b>{{ trans('core::accesses.top_name') }}</b></h4>
                        <p class="text-muted font-13 m-b-30">
                            {{ trans('core::accesses.description_edit') }}
                        </p>
                    </div>
                </div>

                <form role="form" method="POST" action="{{ route('admin.access.post_edit', $access->id) }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dataTable no-footer text-center table_middle" role="grid" >
                                <tbody>
                                    <tr role="row">
                                        <th class="text-right" style="width: 250px;">Название доступа:</th>
                                        <td><input name="ru_name" type="text" class="form-control" placeholder="Название доступа" value="{{ $access->ru_name }}" required></td>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-right">Ключ доступа (латинскими):</th>
                                        <td><input name="name" type="text" class="form-control" placeholder="Латинскими буквами и без пробелов" value="{{ $access->name }}" required></td>
                                    </tr>
                                    <tr role="row">
                                        <th colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-floppy-disk"></i> Сохранить</button>
                                            <a href="{{ route('admin.access.all') }}" class="btn btn-primary waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-arrow-left"></i> Вернуться</a>
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