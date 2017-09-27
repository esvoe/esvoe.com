<div class="widget-events widget-left-panel">
	<div class="menu-list">
		<ul class="list-unstyled">
			<li class="{!! (Request::segment(1)=='' ? 'active' : '') !!}"><a href="{{ url('/') }}" class="btn menu-btn"><i class="fa fa-trophy" aria-hidden="true"></i>{{ trans('common.home') }}</a></li>

			@if(Setting::get('enable_browse') == 'on')
				<li class="{!! (Request::segment(1)=='browse' ? 'active' : '') !!}"><a href="{{ url('/browse') }}" class="btn menu-btn"><i class="fa fa-globe" aria-hidden="true"></i>{{ trans('common.browse') }} </a></li>
			@endif

			<li><a href="{{ url(Auth::user()->username) }}" class="btn menu-btn"><i class="fa fa-user" aria-hidden="true"></i>{{ trans('common.my_profile') }} </a></li>

			<li class="{!! (Request::segment(2)=='albums' ? 'active' : '') !!}"><a href="{{ url('/'.Auth::user()->username.'/albums') }}" class="btn menu-btn"><i class="fa fa-film" aria-hidden="true"></i>{{ trans('common.albums') }}</a></li>

			<li class="{!! (Request::segment(1)=='messages' ? 'active' : '') !!}"><a href="{{ url('messages') }}" class="btn menu-btn"><i class="fa fa-comments" aria-hidden="true"></i>{{ trans('common.messages') }}</a></li>

			<li><a href="{{ url(Auth::user()->username.'/pages') }}" class="btn menu-btn"><i class="fa fa-file-text" aria-hidden="true"></i>{{ trans('common.pages') }} <span class="event-circle">{{ Auth::user()->own_pages()->count() }}</span></a></li>

			<li><a href="{{ url(Auth::user()->username.'/groups') }}" class="btn menu-btn"><i class="fa fa-group" aria-hidden="true"></i>{{ trans('common.groups') }} <span class="event-circle">{{ Auth::user()->own_groups()->count() }}</span></a></li>	
            
			<li><a href="{{ url('/'.Auth::user()->username.'/settings/general') }}" class="btn menu-btn"><i class="fa fa-cog" aria-hidden="true">{{ trans('common.settings') }}</i></a></li>
		</ul>
	</div>
	<div class="menu-heading">
		{{ trans('common.most_trending') }}
	</div>
	<div class="categotry-list">
		<ul class="list-unstyled">
			@if($trending_tags != "")
				@foreach($trending_tags as $trending_tag)
				<li><span class="hash-icon"><i class="fa fa-hashtag"></i></span> <a href="{{ url('?hashtag='.$trending_tag->tag) }}">{{ $trending_tag->tag }}</a></li>
				@endforeach
			@else
				<span class="text-warning">{{ trans('messages.no_tags') }}</span>
				
			@endif
		</ul>
	</div>
</div><!-- /widget-events -->