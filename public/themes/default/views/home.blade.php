<!-- main-section -->
	<!-- <div class="main-content"> -->
		<div class="container container-grid">
			<div class="row">
				<div class="visible-lg col-lg-3 hide-1">
					{!! Theme::partial('advertising') !!}
				</div>

				<div class="col-md-5 col-md-push-7 col-lg-4 col-lg-push-5 col-grid-2">
					<div class="sm-desc-prof">
						{!! Theme::partial('home-rightbar',compact('suggested_users', 'suggested_groups', 'suggested_pages')) !!}
					</div>
				</div>
              
                <div class="col-md-7 col-md-pull-5 col-lg-5 col-lg-pull-4 col-grid-1">
			   		@if (Session::has('message'))
				        <div class="alert alert-{{ Session::get('status') }}" role="alert">
				            {!! Session::get('message') !!}
				        </div>
				    @endif


					@if(isset($active_announcement))
						<div class="announcement alert alert-info">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<h3>{{ $active_announcement->title }}</h3>
							<p>{{ $active_announcement->description }}</p>
						</div>
					@endif
					
					@if($mode != "eventlist")
						{!! Theme::partial('create-post',compact('timeline','user_post')) !!}

						<div class="timeline-posts">
							@if($posts->count() > 0)
								@foreach($posts as $post)
									@if ($post->active == 0) @continue; @endif {{--чтобы не выводило скрытые посты--}}
									{!! Theme::partial('post',compact('post','timeline','next_page_url')) !!}
								@endforeach
							@else
								<div class="no-posts alert alert-warning">{{ trans('common.no_posts') }}</div>
							@endif
						</div>
					@else
						{!! Theme::partial('eventslist',compact('user_events','username')) !!}
					@endif
				</div><!-- /col-md-6 -->


			</div>
		</div>
	<!-- </div> -->
<!-- /main-section -->
