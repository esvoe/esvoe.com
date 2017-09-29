<ul class="nav nav-tabs li-tab-app" role="tablist">
    <li {!! (strpos(Route::currentRouteName(),'developer.index') === 0) ? ' class="active"':'' !!}><a href="{{route('developer.index')}}">{{ trans('developer.menu.home') }}</a></li>
    <li {!! (strpos(Route::currentRouteName(),'developer.application') === 0) ? 'class="active"':'' !!}><a href="{{route('developer.applications.index')}}">{{trans('developer.menu.applications')}}</a></li>
    <li {!! (strpos(Route::currentRouteName(),'developer.documents') === 0) ? ' class="active"':'' !!}><a href="{{route('developer.documents.index')}}">{{trans('developer.menu.documents')}}</a></li>
</ul>