
{{--<nav class="navbar socialite navbar-default no-bg">--}}
	{{--<div class="container-fluid">--}}
		{{--<!-- Brand and toggle get grouped for better mobile display -->--}}
		{{--<div class="navbar-header">--}}
			{{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-4" aria-expanded="false">--}}
				{{--<span class="sr-only">Toggle navigation</span>--}}
				{{--<span class="icon-bar"></span>--}}
				{{--<span class="icon-bar"></span>--}}
				{{--<span class="icon-bar"></span>--}}
			{{--</button>--}}
			{{--<a class="navbar-brand socialite" href="{{ url('/') }}">--}}
				{{--<img class="socialite-logo" src="{!! url('setting/'.Setting::get('logo')) !!}" alt="{{ Setting::get('site_name') }}" title="{{ Setting::get('site_name') }}">--}}
			{{--</a>--}}
		{{--</div>--}}
		{{--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-4">--}}
			{{----}}
							{{----}}
			{{--@if (Auth::guest())--}}
			{{--<ul class="nav navbar-nav navbar-right">--}}
				{{--<li class="logout">--}}
					{{--<a href="{{ url('/register') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> {{ trans('common.join') }}</a>--}}
				{{--</li>--}}
				{{--@if (Config::get('app.env') == 'demo')--}}
					{{--<li class="logout">--}}
						{{--<a href="http://socialite-rtl.laravelguru.com" target="_blank">{{ trans('common.rtl_version') }}</a>--}}
					{{--</li>--}}
				{{--@endif--}}
			{{--</ul>--}}
			{{--@else--}}
			{{--<ul class="nav navbar-nav navbar-right" id="navbar-right">--}}
					{{--<li class="dropdown user-image socialite">--}}
						{{--<a href="{{ url(Auth::user()->username) }}" class="dropdown-toggle no-padding" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">--}}
							{{--<img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="img-radius img-30" title="{{ Auth::user()->name }}">--}}

							{{--<span class="user-name">{{ Auth::user()->name }}</span><i class="fa fa-angle-down" aria-hidden="true"></i></a>--}}
							{{--<ul class="dropdown-menu">--}}
								{{--@if(Auth::user()->hasRole('admin'))--}}
								{{--<li class="{{ Request::segment(1) == 'admin' ? 'active' : '' }}"><a href="{{ url('admin') }}"><i class="fa fa-user-secret" aria-hidden="true"></i>{{ trans('common.admin') }}</a></li>--}}
								{{--@endif--}}
								{{--<li class="{{ (Request::segment(1) == Auth::user()->username && Request::segment(2) == '') ? 'active' : '' }}"><a href="{{ url(Auth::user()->username) }}"><i class="fa fa-user" aria-hidden="true"></i>{{ trans('common.my_profile') }}</a></li>--}}

								{{--<li class="{{ Request::segment(2) == 'pages-groups' ? 'active' : '' }}"><a href="{{ url(Auth::user()->username.'/pages-groups') }}"><i class="fa fa-bars" aria-hidden="true"></i>{{ trans('common.my_pages_groups') }}</a></li>--}}

								{{--<li class="{{ Request::segment(3) == 'general' ? 'active' : '' }}"><a href="{{ url('/'.Auth::user()->username.'/settings/general') }}"><i class="fa fa-cog" aria-hidden="true"></i>{{ trans('common.settings') }}</a></li>--}}

								{{--<li><a href="{{ url('/logout') }}"><i class="fa fa-unlock" aria-hidden="true"></i>{{ trans('common.logout') }}</a></li>--}}
							{{--</ul>--}}
						{{--</li>--}}
	               {{--<!--  <li class="logout">--}}
	                    {{--<a href="{{ url('/logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i></a>--}}
	                {{--</li> -->--}}
	            {{--</ul>--}}
	            {{--@endif--}}
	        {{--</div><!-- /.navbar-collapse -->--}}
	    {{--</div><!-- /.container-fluid -->--}}
	{{--</nav>	--}}
	