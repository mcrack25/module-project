@extends('admin::main')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="m-t-0 header-title"><b>{{ trans('core::routes.top_name') }}</b></h4>
                        <p class="text-muted font-13 m-b-30">
                            {{ trans('core::routes.description_edit') }}
                        </p>
                    </div>
                </div>

                <form role="form" method="POST" action="{{ route('admin.routes.post_edit', $route->id) }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-bordered dataTable no-footer text-center table_middle" role="grid" >
                                <tbody>
                                    <tr role="row">
                                        <th class="text-right" style="width: 200px;">Название роута:</th>
                                        <td><input name="ru_name" type="text" class="form-control" placeholder="Название роута" value="{{ $route->ru_name }}" required></td>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-right">Роут:</th>
                                        <td><input name="route" type="text" class="form-control" placeholder="Роут" value="{{ $route->route }}" required></td>
                                    </tr>
                                    <tr role="row">
                                        <th class="text-right">Уровень доступа:</th>
                                        <td>
                                            <select class="form-control" name="access_id">
                                                @if($accesses)
                                                    @foreach($accesses as $access)
                                                        @if($route->access_id == $access->id)
                                                            <option value="{{ $access->id }}" selected>{{ $access->ru_name }}</option>
                                                        @else
                                                            <option value="{{ $access->id }}">{{ $access->ru_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                    </tr>
                                    <tr role="row">
                                        <th colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-l-10 btn-md"><i class="glyphicon glyphicon-floppy-disk"></i> Сохранить</button>
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