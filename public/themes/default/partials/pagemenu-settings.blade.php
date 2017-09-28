<div class="panel panel-default">
	<div class="panel-body nopadding">
		<div class="mini-profile">
			<div class="background">
				<div class="widget-bg">
					<img src=" @if($timeline->cover) {{ url('page/cover/'.$timeline->cover->source) }} @else {{ url('page/cover/default-cover-page.png') }} @endif" alt="{{ $timeline->name }}" title="{{ $timeline->name }}">
				</div>
				<div class="avatar-img">
					<img src="@if($timeline->avatar) {{ url('page/avatar/'.$timeline->avatar->source) }} @else {{ url('page/avatar/default-page-avatar.png') }} @endif" alt="{{ $timeline->name }}" title="{{ $timeline->name }}">
				</div>
			</div>
			<div class="avatar-profile">
				<div class="avatar-details">
					<h2 class="avatar-name"><a href="{{ url($timeline->username) }}">{{ $timeline->name }}</a></h2>
					<h4 class="avatar-mail">
						<a href="{{ url($timeline->username) }}">
							{{ '@'.$timeline->username }}
						</a>
						{!! verifiedBadge($timeline) !!}
					</h4>
				</div>      
			</div><!-- /avatar-profile -->
		</div><!-- /mini-profile -->
	</div>
</div><!-- /panel -->

<div class="list-group list-group-navigation socialite-group">
	<a href="{{ url('/'.$timeline->username.'/page-settings/general') }}" class="list-group-item">
		<div class="list-icon socialite-icon {{ Request::segment(3) == 'general' ? 'active' : '' }}">
			<i class="fa fa-user"></i>
		</div>
		<div class="list-text">
			{{ trans('common.general_settings') }}
			<div class="text-muted">
				{{ trans('messages.menu_message_general') }}
			</div>
		</div>
		<div class="clearfix"></div>
	</a>
	<a href="{{ url('/'.$timeline->username.'/page-settings/privacy') }}" class="list-group-item">
		<div class="list-icon socialite-icon {{ Request::segment(3) == 'privacy' ? 'active' : '' }}">
			<i class="fa fa-user-secret"></i>
		</div>
		<div class="list-text">
			{{ trans('common.privacy_settings') }}
			<div class="text-muted">
				{{ trans('messages.menu_message_privacy') }}
			</div>
		</div>
		<div class="clearfix"></div>
	</a>
	<a href="{{ url('/'.$timeline->username.'/page-settings/wallpaper') }}" class="list-group-item">
		<div class="list-icon socialite-icon {{ Request::segment(3) == 'wallpaper' ? 'active' : '' }}">
			<i class="fa fa-image"></i>
		</div>
		<div class="list-text">
			{{ trans('common.wallpaper_settings') }}
			<div class="text-muted">
				{{ trans('messages.menu_message_wallpaper') }}
			</div>
		</div>
		<div class="clearfix"></div>
	</a>
	<a href="{{ url('/'.$timeline->username.'/page-settings/roles') }}" class="list-group-item">
		<div class="list-icon socialite-icon {{ Request::segment(3) == 'roles' ? 'active' : '' }}">
			<i class="fa fa-comments"></i>
		</div>
		<div class="list-text">
			{{ trans('common.admin_roles') }}
			<div class="text-muted">
				{{ trans('messages.menu_message_admin_roles') }}
			</div>
		</div>
		<div class="clearfix"></div>
	</a>
	
	<a href="{{ url('/'.$timeline->username.'/page-settings/likes') }}" class="list-group-item">
		<div class="list-icon socialite-icon {{ Request::segment(3) == 'likes' ? 'active' : '' }}">
			<i class="fa fa-connectdevelop"></i>
		</div>
		<div class="list-text">
			{{ trans('common.page_likes') }}
			<div class="text-muted">
				{{ trans('messages.menu_message_page_likes') }}
			</div>
		</div>
		<div class="clearfix"></div>
	</a>
	
</div>