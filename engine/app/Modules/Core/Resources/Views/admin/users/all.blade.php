@extends('admin::main')

@section('head')
    <link href="{{ Module::asset('admin::assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@stop

@section('after_bootstrap_js')
    <script src="{{ Module::asset('admin::assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ Module::asset('admin::js/for_datepicker.js') }}"></script>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <a href="{{ route('admin.users.add') }}" class="btn btn-success waves-effect waves-light">Добавить <i class="glyphicon glyphicon-plus"></i></a>
                        </div>

                        <h4 class="m-t-0 header-title"><b>{{ trans('core::users.top_name') }}</b></h4>
                        <p class="text-muted font-13 m-b-30">
                            {{ trans('core::users.description_all') }}
                        </p>
                    </div>
                </div>

                <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                    <form id="search_form" method="GET" action="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Дата:</span>
                                    <select name="date_type" class="form-control" style="width: 100px">
                                        <option value="created_at" {{ ($date_type == 'created_at') ? 'selected' : '' }}>Регистрации</option>
                                        <option value="updated_at" {{ ($date_type == 'updated_at') ? 'selected' : '' }}>Изменения</option>
                                    </select>
                                    <span class="input-group-addon">С:</span>
                                    <input name="date_s" type="text" class="datepicker-autoclose form-control" autocomplete="off" placeholder="дд.мм.гггг" id="date_s" value="{{ $date_s or '' }}">
                                    <span class="input-group-addon">ПО:</span>
                                    <input name="date_po" type="text" class="datepicker-autoclose form-control" autocomplete="off" placeholder="дд.мм.гггг" id="date_po" value="{{ $date_po or '' }}">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn waves-effect waves-light btn-primary"><i class="glyphicon glyphicon-filter"></i> Фильтровать</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <br />

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Показывать по:</span>
                                    <select name="count_on_page" aria-controls="datatable" class="form-control input-sm" onchange="this.form.submit()">
                                        @if(isset($count_list))
                                            @foreach($count_list as $count_list_one)
                                                @if($count_list_one == $count_on_page)
                                                    <option value="{{ $count_list_one }}" selected>{{ $count_list_one }}</option>
                                                @else
                                                    <option value="{{ $count_list_one }}">{{ $count_list_one }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="input-group-addon">записей</span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Сортировать по:</span>
                                    <select name="sort_name" class="form-control" style="width:100px;" onchange="this.form.submit()">
                                        @if(isset($sort_name))
                                            <option value="id" {{ ($sort_name == 'id') ? 'selected' : '' }}>ID</option>
                                            <option value="email" {{ ($sort_name == 'email') ? 'selected' : '' }}>Логин</option>
                                            <option value="name" {{ ($sort_name == 'name') ? 'selected' : '' }}>ФИО или ОГВ</option>
                                        @endif
                                    </select>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-sort"></i></span>
                                    <select name="sort_arrow" class="form-control" onchange="this.form.submit()">
                                        @if(isset($sort_arrow))
                                            <option value="asc" {{ ($sort_arrow == 'asc') ? 'selected' : '' }}>&#x2193;</option>
                                            <option value="desc" {{ ($sort_arrow == 'desc') ? 'selected' : '' }}>&#x2191;</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div id="datatable_filter" class="dataTables_filter text-right">
                                    <label>
                                        <div class="input-group m-t-10">
                                            <input type="text" id="example-input2-group2" name="search_text" class="form-control input-sm" aria-controls="datatable" placeholder="Поиск" value="{{ $search_text or '' }}">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn waves-effect waves-light btn-primary btn-sm"><i class="glyphicon glyphicon-search"></i> Искать</button>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-striped table-bordered dataTable no-footer text-center table_middle" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr role="row">
                                        <th tabindex="0" class="text-center" style="width: 20px;">ID</th>
                                        <th tabindex="0" class="text-center" style="width: 250px;">Логин</th>
                                        <th tabindex="0" class="text-center">ФИО или ОГВ</th>
                                        <th tabindex="0" class="text-center" style="width: 196.2px;">Назначенная роль</th>
                                        <th tabindex="0" class="text-center" style="width: 150px;">Действия</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if(isset($users))
                                        @if($users->count() > 0)
                                            @foreach ($users as $user)
                                                <tr role="row" class="{{ ($loop->count % 2) ? 'odd' : 'even' }}">
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{!! $user->role->ru_name or '<b style="color:red;">Нет роли</b>' !!}</td>
                                                    <td class="actions">
                                                        <a href="{{ route('admin.users.edit', $user->id ) }}" class="on-default edit-row"><i class="fa fa-pencil fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Изменить"></i></a>
                                                        <a href="{{ route('admin.users.delete', $user->id) }}" class="on-default remove-row"><i class="fa fa-trash-o fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Удалить"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr role="row" class="even">
                                                <td colspan="5"><b>{{ trans('core::users.items_none') }}</b></td>
                                            </tr>
                                        @endif
                                    @else
                                        <tr role="row" class="even">
                                            <td colspan="5"><b>{{ trans('core::users.items_not_isset') }}</b></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            @if(isset($users))
                                <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Показано {{ $users->count() }} из {{ $users->total() }} записей</div>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                @if(isset($users))
                                    {{ $users->appends(['count_on_page' => $count_on_page, 'sort_name' => $sort_name, 'sort_arrow' => $sort_arrow, 'search_text' => $search_text, 'date_type'=>$date_type, 'date_s'=> $date_s, 'date_po'=>$date_po])->links() }}
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop