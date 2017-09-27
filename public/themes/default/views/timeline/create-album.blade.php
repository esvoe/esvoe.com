<!-- main-section -->	
<div class="container">
	<div class="row">              
		<div class="col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading no-bg panel-settings">
					<h3 class="panel-title">{{ trans('common.create_album') }}</h3>
				</div>

				<div class="panel-body nopadding">  
					<div class="socialite-form">
						@if(isset($message))
						<div class="alert alert-success">                                       
							{{ $message }}                                    
						</div>
						@endif                          
						<form class="margin-right" method="POST" action="{{ url('/'.Auth::user()->username.'/create-album/') }}">
							{{ csrf_field() }}

							<fieldset class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
								{{ Form::label('name', trans('auth.name'), ['class' => 'control-label']) }}
								{{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('common.name_of_the_album')]) }}
								@if ($errors->has('name'))
								<span class="help-block">
									{{ $errors->first('name') }}
								</span>
								@endif
							</fieldset>

							<fieldset class="form-group">
								{{ Form::label('about', trans('common.about'), ['class' => 'control-label']) }}
								{{ Form::textarea('about', old('about'), ['class' => 'form-control', 'placeholder' => trans('messages.create_album_placeholder'), 'rows' => '4', 'cols' => '20', 'maxlength' => '80']) }}
							</fieldset>

							<fieldset class="form-group">
								{{ Form::label('album_photos', trans('common.upload_photos'), ['class' => 'control-label']) }}
								{{ Form::file('album_photos', ['multiple' => 'multiple']) }}
							</fieldset>

							<fieldset class="form-group">
								<div class="pull-right">
									{{ Form::submit(trans('common.create_album'), ['class' => 'btn btn-success']) }}
								</div>
							</fieldset>

						</form>
					</div><!-- /socialite-form -->
				</div>
			</div><!-- /panel -->		
		</div><!-- /col-md-8 -->

		<div class="col-md-4 col-lg-4">
			{!! Theme::partial('home-rightbar',compact('suggested_users', 'suggested_groups', 'suggested_pages')) !!}
		</div>
	</div>
</div>	
<!-- /main-section -->