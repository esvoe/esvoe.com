<!-- <div class="main-content"> -->
	<div class="container container-grid">
		<div class="row">

			<div class="visible-lg col-lg-3 hide-1">
				{!! Theme::partial('advertising') !!}
			</div>
			<div class="col-lg-9 col-wallet">
				<div class="panel-page-pages">
					<div class="title-page-pages">
						<i class="icon-storinky  svoe-icon"></i>
						{{ trans('messages.pages-manage') }}
						<div class="side-right create-btn create-page-pages">
							<a href="{{ url(Auth::user()->username.'/create-page') }}" class="btn btn-success"><i class="icon-prisoidenitsa  svoe-icon"></i>{{ trans('common.create_page') }}</a>
						</div>
					</div>
					@if(Auth::user()->own_pages()->count())
					<div class="row">
							@foreach(Auth::user()->own_pages() as $userpage)
							<div class="col-md-3">
								<div class="wrap-pages-block">
									<div class="photo-pages-cover" style="background-image: url('@if($userpage->timeline_id && $userpage->avatar) {{ url('page/avatar/'.$userpage->avatar) }} @else {{ url('page/avatar/default-page-avatar.png') }} @endif');" title="{{ $userpage->name }}">
										<a href="{{ url($userpage->username) }}"></a>
									</div>
									<div class="content-pages-page">
										<p><a href="{{ url($userpage->username) }}">{{ $userpage->name }}</a></p>
										<span>category</span>
										<a href="" class="side-right delete-page delete_page" data-pagedelete-id="{{ $userpage->id }}"><i class="icon-vydalyty svoe-icon"></i>Удалить страницу</a>
									</div>
								</div>
							</div>
							@endforeach
					</div>
					@else
						<div class="alert alert-warning">
							{{ trans('messages.no_pages') }}
						</div>
					@endif

					@if(Auth::user()->own_pages()->count() && Auth::user()->own_pages()->count() > 3)
					<div class="show-more-page-pages">
						Показать еще <i class="icon-menyu svoe-icon"></i>
					</div>
					@endif
				</div>
				<div class="panel-page-pages">
					<div class="title-page-pages">
						<i class="icon-like svoe-icon"></i>
						{{ trans('common.joined_pages') }}
					</div>

					@if(Auth::user()->joinedPages()->count())
					<div class="row">
						@foreach(Auth::user()->joinedPages() as $joinpage)
						<div class="col-md-3">
							<div class="wrap-pages-block">
								<div class="photo-pages-cover" style="background-image: url('@if($joinpage->timeline_id && $joinpage->avatar) {{ url('page/avatar/'.$joinpage->avatar) }} @else {{ url('page/avatar/default-page-avatar.png') }} @endif');" title="">
									<a href="{{ url($joinpage->username) }}"></a>
								</div>
								<div class="content-pages-page">
									<p><a href="#">{{ $joinpage->name }}</a></p>
									<span>category</span>
									<a href="#" class="btn btn-success unjoin-page joined" data-timeline-id="">
										<i class="icon-prinyat svoe-icon"></i> {{ trans('common.joined') }}
									</a>
								</div>
							</div>
						</div>
						@endforeach
					</div>
					@else
						<div class="alert alert-warning">
							{{ trans('messages.no_pages') }}
						</div>
					@endif

					@if(Auth::user()->joinedPages()->count() && Auth::user()->joinedPages()->count() > 3 )
					<div class="show-more-page-pages">
						Показать еще <i class="icon-menyu svoe-icon"></i>
					</div>
					@endif
				</div>
				<div class="panel-page-pages">
					<div class="title-page-pages">
						<i class="icon-prisoidenitsa  svoe-icon"></i>
						Предлагаемые страницы
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="wrap-pages-block">
								<div class="photo-pages-cover" style="background-image: url('{!! Theme::asset()->url('images/set3/1.jpg') !!}');" title="">
									<a href="#"></a>
								</div>
								<div class="content-pages-page">
									<p><a href="#">Name page</a></p>
									<span>category</span>
									<div class="btn-hover-wrap wrap-btn-hover-pages pagelike-links">
										<div class="btn-follow page"><a href="#" class="btn btn-options btn-block btn-default page-like like" data-timeline-id=""><i class="icon-like  svoe-icon"></i> <span>{{ trans('common.like') }}</span></a></div>
										<div class="btn-follow page hidden"><a href="#" class="btn btn-options btn-block btn-success page-like liked " data-timeline-id=""><i class="fa fa-heart" aria-hidden="true"></i> <span>{{ trans('common.liked') }}</span></a></div>
										<a href="" class="btn-action-hover show-action-hover hidden-action-hover">
											<i class="icon-pidpysatysya  svoe-icon"></i>
											Подписаться
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="show-more-page-pages">
						Показать еще <i class="icon-menyu svoe-icon"></i>
					</div>
				</div>
			</div>

		</div><!-- /row -->
	</div>
<!-- </div> --><!-- /main-content -->