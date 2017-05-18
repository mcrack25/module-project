<ul>
@if(isset($menus))
    @foreach($menus as $menu_1)
        <?php $level_1 = 1; ?>





        @if(count($menu_1->submenu_access) > 0)
            @foreach ($menu_1->submenu_access as $menu_2)
                <?php $level_2 = 1; ?>



                    @if(count($menu_2->submenu_access) > 0)
                        @if($level_1 == 1)
                            <li class="text-muted menu-title">{{ $menu_1->name }}</li>
                            <?php $level_1++; ?>
                        @endif

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">{!! $menu_2->icon or '<i class="ion-pound"></i>' !!}  <span> {{ $menu_2->name }} </span> <span class="menu-arrow"></span></a>
                            <ul>
                                @foreach($menu_2->submenu_access as $menu_3)
                                    @if(!empty($menu_3->other_url))
                                        <li><a href="{!! $menu_3->other_url !!}" class="waves-effect">  <span> {{ $menu_3->name }} </span></a></li>
                                    @else
                                        <li><a href="<?php try{ echo route($menu_3->route->route);} catch(\Exception $e){echo 'javascript:void(0);';}?>" class="waves-effect">  <span> {{ $menu_3->name }} </span></a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @else

                        @if(!empty($menu_2->other_url))
                            @if($level_1 == 1)
                                <li class="text-muted menu-title">{{ $menu_1->name }}</li>
                                <?php $level_1++; ?>
                            @endif

                            <li><a href="{!! $menu_2->other_url !!}" class="waves-effect">{!! $menu_2->icon or '<i class="ion-pound"></i>' !!}  <span> {{ $menu_2->name }} </span></a></li>

                        @elseif(isset($menu_2->route))
                            @if($level_1 == 1)
                                <li class="text-muted menu-title">{{ $menu_1->name }}</li>
                                <?php $level_1++; ?>
                            @endif
                            <li><a href="<?php try{echo route($menu_2->route->route);}catch(\Exception $e){echo 'javascript:void(0);';}?>" class="waves-effect">{!! $menu_2->icon or '<i class="ion-pound"></i>' !!}  <span> {{ $menu_2->name }} </span></a></li>
                        @endif
                    @endif

            @endforeach


        @endif
    @endforeach
@endif
</ul>