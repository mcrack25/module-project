@extends('admin::main')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="m-t-0 header-title"><b>{{ trans('core::routes.top_name') }}</b></h4>
                        <p class="text-muted font-13 m-b-30">
                            {{ trans('core::routes.description_delete') }}
                        </p>
                    </div>
                </div>

                <form role="form" method="POST" action="{{ route('admin.routes.post_delete') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="route_ids[]" value="{{ $route->id }}">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dataTable no-footer text-center table_middle" role="grid" >
                                <tbody>
                                <tr role="row">
                                    <th class="text-right" style="width: 200px;">Название роута:</th>
                                    <td>{{ $route->ru_name }}</td>
                                </tr>
                                <tr role="row">
                                    <th class="text-right">Роут:</th>
                                    <td>{{ $route->route }}</td>
                                </tr>
                                <tr role="row">
                                    <th class="text-right">Уровень доступа:</th>
                                    <td>{!! $route->access->ru_name or '<b style="color:red;">Без доступа</b>' !!}</td>
                                </tr>
                                <tr role="row">
                                    <th colspan="2" class="text-center">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-trash"></i> Удалить</button>
                                        <a href="{{ route('admin.routes.all') }}" class="btn btn-primary waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-arrow-left"></i> Вернуться</a>
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