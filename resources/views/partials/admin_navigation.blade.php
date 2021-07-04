<li class="nav-item {{(request()->getRequestUri() == "/".lang())?"active":""}}">
    <a class="nav-link" href="{{app()->make("url")->to('/')}}/">
        <i class="icon ion-ios-pie-outline"></i>
        <span>{{trans('navigation.Dashboard')}}</span>
    </a>
</li>

@if(can('create-users') || can('view-users'))

    <li class="nav-item {{(request()->is('*/users*'))?"active":""}}">
        <a class="nav-link" href="{{ route('users') }}">
            <i class="icon ion-android-people"></i>
            <span>{{trans('navigation.Users')}}</span>
        </a>
    </li>

@endif

<li class="nav-item with-sub settings {{(request()->is('*/cities*'))?"active":""}}">
    <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="true">
        <i class="icon ion-ios-gear-outline"></i>
        <span>{{trans('navigation.Cities')}}</span>
    </a>
    <div class="sub-item">
        <ul>
            <li class="{{(request()->is('*/cities*'))?"active":""}}">
                <a href="/cities">{{trans('navigation.Cities')}}</a>
            </li>

            <li class="{{(request()->is('*/governorates*'))?"active":""}}">
                <a href="/governorates">{{trans('navigation.Governorates')}}</a>
            </li>
        </ul>
    </div><!-- dropdown-menu -->
</li>
{{-- only super admin can access configuration settings --}}
@if(@auth()->user()->type == App\Starter\Users\UserEnums::SUPER_ADMIN_TYPE)
    <li class="nav-item with-sub settings {{(request()->is('*/configs*' ,'*/roles*'))?"active":""}}">
        <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="true">
            <i class="icon ion-ios-gear-outline"></i>
            <span>{{trans('navigation.Settings')}}</span>
        </a>
        <div class="sub-item">
            <ul>
                <li class="{{(request()->is('*/configs*'))?"active":""}}">
                    <a href="/configs/edit">{{trans('navigation.Configurations')}}</a>
                </li>

                <li class="{{(request()->is('*/roles*'))?"active":""}}">
                    <a href="/roles">{{trans('navigation.Roles')}}</a>
                </li>
            </ul>
        </div><!-- dropdown-menu -->
    </li>
@endif

