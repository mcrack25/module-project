@extends('admin::main')

@section('head')
    <link href="{{ Module::asset('menu::css/menu.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <div class="row">
                    <div class="col-sm-12">

                        <div class="btn-group pull-right m-t-15">
                            <a href="{{ route('admin.menu.add') }}" class="btn btn-success waves-effect waves-light">Добавить новый пункт меню <i class="glyphicon glyphicon-plus"></i></a>
                        </div>

                        <h4 class="m-t-0 header-title"><b>{{ trans('menu::menu.top_name') }}</b></h4>
                        <p class="text-muted font-13 m-b-30">
                            {{ trans('menu::menu.description_edit') }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">

                        <h3 class="text-center">Структура меню</h3>

                        <div id="page_menu">
                            @if($menus)
                                <ul>
                                    <div class="div_level_1">
                                        @foreach ($menus as $menu_one)
                                            <li class="menu_level_1{{ ($menu_one->id == $id) ? ' active' : '' }}"><a href="{{ route('admin.menu.edit', ['id'=> $menu_one->id]) }}">{{ $menu_one->name }}</a></li>
                                            @if(count($menu_one->submenu) > 0)
                                                <div class="div_level_2">
                                                    @foreach($menu_one->submenu as $submenu)
                                                        <li class="menu_level_2{{ ($submenu->id == $id) ? ' active' : '' }}"><a href="{{ route('admin.menu.edit', ['id'=> $submenu->id]) }}">{!! $submenu->icon or '<i class="ion-pound"></i>' !!}&nbsp;&nbsp;<span>{{ $submenu->name }} </span></a></li>
                                                        @if(count($submenu->submenu) > 0)
                                                            <div class="div_level_3">
                                                                @foreach($submenu->submenu as $sub_sub)
                                                                    <li class="menu_level_3{{ ($sub_sub->id == $id) ? ' active' : '' }}"><a href="{{ route('admin.menu.edit', ['id'=> $sub_sub->id]) }}"><span> {{ $sub_sub->name }}</span></a></li>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </ul>
                            @endif
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <h3 class="text-center">Изменение пункта меню</h3>
                        <form method="POST" action="{{ route('admin.menu.post_edit_delete', $id) }}">
                            {{ csrf_field() }}
                            <table class="menu_form">
                                <tr>
                                    <td class="names_menu" style="width: 170px">Название*:</td>
                                    <td><input name="name" type="text" class="form-control" placeholder="Название" value="{{ $menu_form->name }}"></td>
                                </tr>
                                <tr>
                                    <td class="names_menu">Вложенность*:</td>
                                    <td>
                                        @if($menus)
                                            <select name="parent_id" class="form-control">
                                                <option value="0" {{ (0 == $menu_form->parent_id) ? ' selected' : '' }}>Главный пункт</option>
                                                @foreach ($menus as $menu_one)
                                                    <option value="{{ $menu_one->id }}" {{ ($menu_one->id == $menu_form->parent_id) ? ' selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $menu_one->name }}</option>
                                                    @if(count($menu_one->submenu) > 0)
                                                        @foreach($menu_one->submenu as $submenu)
                                                            <option value="{{ $submenu->id }}" {{ ($submenu->id == $menu_form->parent_id) ? ' selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $submenu->name }}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="names_menu">Путь к странице*:</td>
                                    <td>
                                        <select name="route_id" class="form-control">
                                            @foreach($routes as $route)
                                                <option value="{{ $route->id }}" {{ ($route->id == $menu_form->route_id) ? ' selected' : '' }}>{{ $route->ru_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="names_menu">Альтернативный URL:</td>
                                    <td><input name="other_url" value="{{ $menu_form->other_url }}" type="text" class="form-control" placeholder="Если вам нужна какая то другая страница"></td>
                                </tr>

                                <tr>
                                    <td class="names_menu">Уровень сортировки:</td>
                                    <td><input name="sort" value="{{ $menu_form->sort }}" type="text" class="form-control" placeholder="Уровень сортировки (По умолчанию - 1000)"></td>
                                </tr>
                                <tr>
                                    <td class="names_menu">Иконка:</td>
                                    <td><input name="icon" value="{{ $menu_form->icon }}" type="text" class="form-control" placeholder="<span> или <i> тег иконки"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <br />
                                        <button type="submit" name="submit" value="save" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Сохранить</button>
                                        <button type="submit" name="submit" value="delete" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Удалить</button>
                                    </td>
                                </tr>
                            </table>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop