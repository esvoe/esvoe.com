<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
	@include('flash::message')
		<h3 class="panel-title">
			{{ trans('common.themes') }}
		</h3>
	</div>
	<div class="panel-body">
		<div class="independent-themes">
			<div class="row">
				@foreach($themesInfo as $theme)
					<div class="col-md-4">
						<div class="independent-block">
							<div class="theme-image">
								<a href="{{ url('admin/change-theme/'.$theme->directory) }}"><img src="{{  url($theme->thumbnail) }}" alt="images"></a>
								<span class="label label-default selected">{{ trans('common.selected') }}</span>
							</div>
							<div class="theme-sale">
								<div class="theme-details pull-left">
									<div class="theme-name">{{ $theme->name }}</div>
									<div class="theme-author">{{ trans('common.author') }} : {{ $theme->author }}</div>
								</div>
								<div class="theme-rate pull-right">
									{{ $theme->version }}
								</div>
								<div class="clearfix"></div>
							</div>
						</div><!-- /independent-block -->
					</div>
				@endforeach
			</div><!-- /row -->
		</div>
	</div>
</div>