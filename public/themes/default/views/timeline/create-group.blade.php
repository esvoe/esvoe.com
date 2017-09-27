<!-- <div class="main-content"> -->
	<div class="container">
		<div class="row">
			<div class="col-md-8">

				<div class="panel panel-default">
					<div class="panel-heading no-bg panel-settings">
						<h3 class="panel-title">{{ trans('common.create_group') }}</h3>
					</div>
					<div class="panel-body nopadding">
						<div class="socialite-form">
							<form class="form margin-right" method="POST" action="{{ url('/'.$username.'/create-group/') }}">
								{{ csrf_field() }}

								<fieldset class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
									{{ Form::label('name', trans('auth.name'), ['class' => 'control-label']) }}
									{{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('common.name_of_your_group')]) }}
									@if ($errors->has('name'))
									<span class="help-block">
										{{ $errors->first('name') }}
									</span>
									@endif
								</fieldset>
								<fieldset class="form-group required{{ $errors->has('username') ? ' has-error' : '' }}">
									{{ Form::label('username', trans('common.username'), ['class' => 'control-label']) }}
									{{ Form::text('username', old('username'), ['class' => 'form-control','maxlength' => '16','placeholder' => trans('common.username')]) }}
									@if ($errors->has('username'))
									<span class="help-block">
										{{ $errors->first('username') }}
									</span>
									@endif
								</fieldset>
								<fieldset class="form-group">
									{{ Form::label('about', trans('common.about')) }}
									{{ Form::textarea('about', old('about'), ['class' => 'form-control', 'placeholder' => trans('messages.create_group_placeholder'), 'rows' => '4', 'cols' => '20']) }}
								</fieldset>
								<fieldset class="form-group">
									{{ Form::label('privacy', trans('common.privacy'), ['class' => 'control-label']) }}
									<div class="radio select-option">
										<label class="radio-header">
											<input type="radio" name="type" id="optionsRadios1" value="open" checked>
											<i class="fa fa-globe"></i> {{ trans('common.open_group') }}
											<p class="radio-text">{{ trans('messages.radio_open_group') }}</p>
										</label>
									</div>
									
									<div class="radio select-option margin-left">
										<label class="margin-left-113 radio-header">
											<input type="radio" name="type" id="optionsRadios2" value="closed">
											<i class="fa fa-lock"></i> {{ trans('common.closed_group') }}
											<p class="radio-text">{{ trans('messages.radio_closed_group') }}</p>
										</label>
									</div>
									
									<div class="radio select-option">
										<label class="margin-left-112 radio-header">
											<input type="radio" name="type" id="optionsRadios3" value="secret">
											<i class="fa fa-shield"></i> {{ trans('common.secret_group') }}
											<p class="radio-text">{{ trans('messages.radio_secret_group') }}</p>
										</label>
									</div>
									

								</fieldset>
								<div class="pull-right">
									{{ Form::submit(trans('common.create_group'), ['class' => 'btn btn-success']) }}
								</div>
								<div class="clearfix"></div>
							</form>
						</div><!-- /socialite-form -->
					</div>
				</div><!-- /panel -->  
			</div>

			<div class="col-md-4">
				
				<div class="panel panel-default">
					<div class="panel-heading no-bg panel-settings">
						<h3 class="panel-title text-normal">{{ trans('messages.learn_more_about_groups') }}</h3>
					</div>
					<div class="panel-body right-panel">
						<div class="privacy-question">
							<ul class="list-group right-list-group">
								<li href="#" class="list-group-item">
									<div class="holder">
										<div class="about-page right-side-label">
											{{ trans('messages.about_group_heading1') }}
										</div>
										<div class="page-description">
											{{ trans('messages.about_group_content1') }}
										</div>
									</div>
								</li>
								<li href="#" class="list-group-item">
									<div class="holder">
										<div class="about-page right-side-label">
											{{ trans('messages.about_group_heading2') }}
										</div>
										<div class="page-description">
											{{ trans('messages.about_group_content2') }}
										</div>
									</div>
								</li>
								<li href="#" class="list-group-item">
									<div class="holder">
										<div class="about-page right-side-label">
											{{ trans('messages.about_group_heading3') }}
										</div>
										<div class="page-description">
											{{ trans('messages.about_group_content3') }}
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div><!-- /panel-body -->
					
				</div>
				@if(Setting::get('creategroup_ad') != NULL)
				<div class="page-image">
					{!! htmlspecialchars_decode(Setting::get('creategroup_ad')) !!}
				</div>
				@endif
			</div><!-- /col-md-4 -->
		</div>
	</div><!-- /container -->
<!-- </div> -->