<!-- main-section -->
<!-- <div class="main-content"> -->
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="post-filters">
				{!! Theme::partial('usermenu-settings') !!}
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				
				<div class="panel-heading no-bg panel-settings">
					<h3 class="panel-title">
						{{ trans('common.wallpaper_settings') }}
					</h3>

				</div>
				<div class="panel-body">
					@include('flash::message')
					<br>
					<h3>
						{{ trans('common.upload_new') }}
					</h3>
					<hr>
					<div class="row">
						
						<div class="col-md-4 socialite-form">
							<form method="POST" action="{{ url('/'.Auth::user()->username.'/settings/wallpaper/') }}" files="true" enctype="multipart/form-data" class="form">
								{{ csrf_field() }}
								<div class="row">
									<div class="form-group">
										<input type="file" name="wallpaper" class="" accept="image/jpeg,image/png,image/gif">
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-downloadreport add-wallpapers"> 
											<i class="fa fa-upload" aria-hidden="true"></i>
											{{ trans('common.upload') }}
										</button>
									</div>
								</div>
							</form>

						</div>
						<div class="col-md-4">
							@if(Auth::user()->timeline->background_id != NULL)

							<div class="panel panel-default">

								<div class="panel-body nopadding">
									<div class="padding-t5 text-center">
										{{ trans('common.active_wallpaper') }}
									</div>
									<div class="widget-card wallpaper">
										
										<div class="widget-card-bg">	
											<img src="{!! url('/wallpaper/'.Auth::user()->timeline->wallpaper->source) !!}" alt="{{ Auth::user()->timeline->wallpaper->title }}">
										</div>

									</div>

									<div class="pull-right activate padding-t5">
										@if(Auth::user()->timeline->background_id == Auth::user()->timeline->wallpaper->id)
											<span class="label label-success">{{ trans('common.active') }}</span>
										@endif
									</div>
									<div class="pull-left activate" style="padding-left: 11px">
										@if(Auth::user()->timeline->background_id == Auth::user()->timeline->wallpaper->id)
										<a href="{{ url('/'.Auth::user()->username.'/settings/toggle-wallpaper/deactivate/'.Auth::user()->timeline->wallpaper->id) }}" class="btn btn-primary">{{ trans('common.no_wallpaper') }}</a>
										@else
										<a href="{{ url('/'.Auth::user()->username.'/settings/toggle-wallpaper/activate/'.Auth::user()->timeline->wallpaper->id) }}" class="btn btn-default">{{ trans('common.activate') }}</a>
										@endif

									</div>
		
								</div>
							</div><!-- /panel -->

							@endif
						</div>
					</div>
					<br>
					
					<h3>
						{{ trans('common.select_from_existing') }}
					</h3>
					<hr>
					@if(count($wallpapers) > 0)
					<ul id="video-thumbnails" class="list-unstyled row">
						@foreach($wallpapers as $wallpaper)
						
						<li class="col-xs-6 col-sm-4 col-md-4">
							<div class="panel panel-default">
								<div class="panel-body nopadding">
									<div class="widget-card preview wallpaper">
										<div class="widget-card-bg">	
											<img src="{!! url('/wallpaper/'.$wallpaper->media->source) !!}" alt="{{ $wallpaper->title }}">
										</div>
										<div class="widget-card-project">
											<div class="bridge-text text-center ">
												<a data-sub-html="<h4>{{ $wallpaper->title }}</h4>" href="{!! url('/wallpaper/'.$wallpaper->media->source) !!}"  class="btn lightgallery-item btn-default btn-single btn-lightbox btn-sm"><i class="fa fa-search"></i> {{ trans('common.view_image') }}</a>

											</div>
										</div>{{-- /widget-card-project --}}
									</div>
									<div class="pull-right activate padding-t5">
										@if(Auth::user()->timeline->background_id == $wallpaper->media->id)
											<span class="label label-success">{{ trans('common.active') }}</span>
										@endif
									</div>
									<div class="pull-left activate" style="padding-left: 11px">
										@if(Auth::user()->timeline->background_id == $wallpaper->media->id)
										<a href="{{ url('/'.Auth::user()->username.'/settings/toggle-wallpaper/deactivate/'.$wallpaper->media->id) }}" class="btn btn-primary">{{ trans('common.no_wallpaper') }}</a>
										@else
										<a href="{{ url('/'.Auth::user()->username.'/settings/toggle-wallpaper/activate/'.$wallpaper->media->id) }}" class="btn btn-default">{{ trans('common.activate') }}</a>
										@endif

									</div>
								</div>
							</div><!-- /panel -->

						</li>
						@endforeach
					</ul>
					@else
						<div class="alert alert-warning">
							{{ trans('common.no_existing_wallpapers') }}
						</div>
					@endif
					
				</div>
				<!-- End of first panel -->

			</div>
		</div><!-- /row -->
	</div>
	<!-- </div> --><!-- /main-content -->
	
	