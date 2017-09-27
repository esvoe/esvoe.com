<!-- <div class="main-content"> -->
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body nopadding">
					<div class="mini-profile">
						<div class="background">
							<div class="widget-bg">
								<img src=" @if($timeline->cover) {{ url('group/cover/'.$timeline->cover->source) }} @else {{ url('group/cover/default-cover-group.png') }} @endif" alt="{{ $timeline->name }}" title="{{ $timeline->name }}">
							</div>
							<div class="avatar-img">
								<img src="@if($timeline->avatar) {{ url('group/avatar/'.$timeline->avatar->source) }} @else {{ url('group/avatar/default-group-avatar.png') }} @endif" alt="{{ $timeline->name }}" title="{{ $timeline->name }}">
							</div>
						</div><!-- /background -->

						<div class="avatar-profile">
							<div class="avatar-details">
								<h2 class="avatar-name">
									<a href="{{ url($timeline->username) }}">
										{{ $timeline->name }}
									</a>
								</h2>
								<h4 class="avatar-mail">
									<a href="{{ url($timeline->username) }}">
										{{ '@'.$timeline->username }}
									</a>
								</h4>
							</div>      
						</div><!-- /avatar-profile -->
					</div>
				</div><!-- /panel-body -->
			</div>

			<div class="list-group list-group-navigation socialite-group">
				<a href="{{ url('/'.$timeline->username.'/group-settings/general') }}" class="list-group-item">
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
				<a href="{{ url('/'.$timeline->username.'/group-settings/wallpaper') }}" class="list-group-item">
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
			</div>

		</div><!-- /col-md-4 -->
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
							<form method="POST" action="{{ url('/'.$timeline->username.'/group-settings/wallpaper/') }}" files="true" enctype="multipart/form-data" class="form">
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
							@if($timeline->background_id != NULL)

							<div class="panel panel-default">

								<div class="panel-body nopadding">
									<div class="padding-t5 text-center">
										{{ trans('common.active_wallpaper') }}
									</div>
									<div class="widget-card wallpaper">
										<div class="widget-card-bg">	
											<img src="{!! url('/wallpaper/'.$timeline->wallpaper->source) !!}" alt="{{ $timeline->wallpaper->title }}">
										</div>

									</div>
									<div class="pull-right activate padding-t5">
										@if($timeline->background_id == $timeline->wallpaper->id)
											<span class="label label-success">{{ trans('common.active') }}</span>
										@endif
									</div>
									<div class="pull-left activate" style="padding-left: 11px">
										@if($timeline->background_id == $timeline->wallpaper->id)
										<a href="{{ url('/'.$timeline->username.'/group-settings/toggle-wallpaper/deactivate/'.$timeline->wallpaper->id) }}" class="btn btn-primary">{{ trans('common.no_wallpaper') }}</a>
										@else
										<a href="{{ url('/'.$timeline->username.'/group-settings/toggle-wallpaper/activate/'.$timeline->wallpaper->media->id) }}" class="btn btn-default">{{ trans('common.activate') }}</a>
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
										@if($timeline->background_id == $wallpaper->media->id)
											<span class="label label-success">{{ trans('common.active') }}</span>
										@endif
									</div>
									<div class="pull-left activate" style="padding-left: 11px;">
										@if($timeline->background_id == $wallpaper->media->id)
										<a href="{{ url('/'.$timeline->username.'/group-settings/toggle-wallpaper/deactivate/'.$wallpaper->media->id) }}" class="btn btn-primary">{{ trans('common.no_wallpaper') }}</a>
										@else
										<a href="{{ url('/'.$timeline->username.'/group-settings/toggle-wallpaper/activate/'.$wallpaper->media->id) }}" class="btn btn-default">{{ trans('common.activate') }}</a>
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
	
	