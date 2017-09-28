<div class="panel panel-default panel-wallpaper">
	<div class="panel-heading no-bg">
		@include('flash::message')
		<div class="page-heading header-text">
			{{ trans('common.wallpapers') }}
		</div>
		<div class="pull-right">
			<form action="{{ url('admin/wallpapers') }}" method="post" class="form-inline" files="true" enctype="multipart/form-data">
				<div class="form-group col-md-offset-2 col-md-6">
					<input type="file" multiple="multiple" name="wallpapers[]" class="wallpapers-input" accept="image/jpeg,image/png,image/gif">
				</div>
				{{ csrf_field() }}
				<div class="form-group col-md-4">
					<button type="submit" class="btn btn-primary btn-downloadreport add-wallpapers"> 
						<i class="fa fa-upload" aria-hidden="true"></i>
						{{ trans('common.upload') }}
					</button>
				</div>
			</form>
		</div>
		<?php $wallpapers = App\Wallpaper::all(); ?>
		<div class="clearfix"></div>

		@if(count($wallpapers) <= 0)
		<br>
		<div class="alert alert-warning">
			{{trans('messages.no_wallpapers')}}
		</div>
		@endif
	</div>
</div>


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
							<a data-sub-html="<h4>{{ $wallpaper->title }}</h4>" href="{!! url('/wallpaper/'.$wallpaper->media->source) !!}"  class="btn lightgallery-item btn-default btn-single btn-lightbox btn-sm"><i class="fa fa-search"></i></a>

							<a href="{{ url('/admin/wallpaper/'.$wallpaper->id.'/delete') }}" class="btn btn-default btn-single btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>

						</div>
					</div>{{-- /widget-card-project --}}
				</div>
			</div>
		</div><!-- /panel -->

	</li>
	@endforeach
</ul>
@endif


{!! Theme::asset()->container('footer')->usePath()->add('lightgallery', 'js/lightgallery-all.min.js') !!}