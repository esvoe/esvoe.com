<div class="user-profile-buttons">
	<div class="row pagelike-links">
		@if($page->is_admin(Auth::user()->id))
			@if(!$page->likes->contains(Auth::user()->id))								
				<div class="col-md-6 col-sm-6 col-xs-6 left-col"><a href="#" class="btn btn-options btn-block btn-default page-like like" data-timeline-id="{{ $timeline->id }}"><i class="fa fa-thumbs-up"></i> {{ trans('common.like') }}</a></div>
				<div class="col-md-6 col-sm-6 col-xs-6 left-col hidden"><a href="#" class="btn btn-options btn-block btn-success page-like liked " data-timeline-id="{{ $timeline->id }}"><i class="fa fa-check"></i> {{ trans('common.liked') }}</a></div>
			@else
				<div class="col-md-6 col-sm-6 col-xs-6 left-col hidden"><a href="#" class="btn btn-options btn-block btn-default page-like like " data-timeline-id="{{ $timeline->id }}"><i class="fa fa-thumbs-up"></i> {{ trans('common.like') }}</a></div>
				<div class="col-md-6 col-sm-6 col-xs-6 left-col"><a href="#" class="btn btn-options btn-block btn-success page-like liked " data-timeline-id="{{ $timeline->id }}"><i class="fa fa-check"></i> {{ trans('common.liked') }}</a></div>
			@endif

			<div class="col-md-6 col-sm-6 col-xs-6 right-col">
				<a href="{{ url('/'.$timeline->username.'/page-settings/general') }}" class="btn btn-options btn-block btn-default"><i class="fa fa-gear"></i> 
					{{ trans('common.settings') }}
				</a>
			</div>

		@else
			@if(!$page->likes->contains(Auth::user()->id))								
				<div class="col-md-12 col-sm-12 col-xs-12  page"><a href="#" class="btn btn-options btn-block btn-default page-like like" data-timeline-id="{{ $timeline->id }}"><i class="fa fa-thumbs-up"></i> {{ trans('common.like') }}</a></div>
				<div class="col-md-12 col-sm-12 col-xs-12  page hidden"><a href="#" class="btn btn-options btn-block btn-success page-like liked " data-timeline-id="{{ $timeline->id }}"><i class="fa fa-check"></i> {{ trans('common.liked') }}</a></div>
			@else
				<div class="col-md-12 col-sm-12 col-xs-12  page hidden"><a href="#" class="btn btn-options btn-block btn-default page-like like " data-timeline-id="{{ $timeline->id }}"><i class="fa fa-thumbs-up"></i> {{ trans('common.like') }}</a></div>
				<div class="col-md-12 col-sm-12 col-xs-12  page"><a href="#" class="btn btn-options btn-block btn-success page-like liked " data-timeline-id="{{ $timeline->id }}"><i class="fa fa-check"></i> {{ trans('common.liked') }}</a></div>			
			@endif			

			<div class="col-md-6 col-sm-6 col-xs-6 left-col page hidden">
				<a href="{{ url('/'.Auth::user()->username.'/settings/general') }}" class="btn btn-options btn-block btn-default">
					<i class="fa fa-inbox"></i> {{ trans('common.messages') }}
				</a>
			</div>

		@endif
		</div>
	</div>

	<div class="user-bio-block">
		<div class="bio-header">{{ trans('common.about') }}</div>
		<div class="bio-description">
			{{ ($timeline['about'] != NULL) ? $timeline['about'] : trans('messages.no_description') }}
		</div>
		<ul class="bio-list list-unstyled">
			<li>
				<i class="fa fa-folder-o" aria-hidden="true"></i><span>{{ $page->category->name }}</span>
			</li>

			@if($page->address != null)
				<li>
					<i class="fa fa-map-marker" aria-hidden="true"></i><span>{{ $page->address }}</span>
				</li>
			@endif

			@if($page->website != null)
				<li>
					<i class="fa fa-globe" aria-hidden="true"></i><span>{{ $page->website }}</span>
				</li>
			@endif

			@if($page->phone != null)
				<li>
					<i class="fa fa-phone" aria-hidden="true"></i><span>{{ $page->phone }}</span>
				</li>
			@endif
		</ul>
	</div>

	<div class="widget-pictures widget-best-pictures"><!-- /pages-liked -->
		<div class="picture side-left">
			{{ trans('common.members') }}
		</div>
		@if(count($page_members) > 0)
			<div class="side-right show-all">
				<a href="{{ url($timeline->username.'/pagemembers') }}">{{ trans('common.show_all') }}</a>
			</div>
		@endif
		<div class="clearfix"></div>
		<div class="best-pictures my-best-pictures">
			<div class="row">
				@if(count($page_members) > 0)
					@foreach($page_members->take(12) as $page_member)
					<div class="col-md-2 col-sm-2 col-xs-2 best-pics">
						<a href="{{ url($page_member->username) }}" class="image-hover" data-toggle="tooltip" data-placement="top" title="{{ $page_member->name }}">
							<img src="{{ $page_member->avatar }}" alt="{{ $page_member->name }}" title="{{ $page_member->name }}">
						</a>
					</div>
					@endforeach
				@else
					<div class="alert alert-warning">{{ trans('messages.no_members') }}</div>
				@endif

			</div>
		</div>
	</div> <!-- /pages-liked -->

