<!-- <div class="main-content"> -->
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading no-bg panel-settings">
						<h3 class="panel-title">{{ trans('common.create_page') }}</h3>
					</div>

					<div class="panel-body nopadding">  
						<div class="socialite-form">
							@if(isset($message))
							<div class="alert alert-success">                                       
								{{ $message }}                                    
							</div>
							@endif                          
							<form class="margin-right" method="POST" action="{{ url('/'.$username.'/create-page/') }}">
								{{ csrf_field() }}

								<fieldset class="form-group required {{ $errors->has('category') ? ' has-error' : '' }}">
									{{ Form::label('category', trans('common.category'), ['class' => 'control-label']) }}                            

									{{ Form::select('category', array('' => trans('common.select_category'))+ $category_options, '', array('class' => 'form-control')) }}
									@if ($errors->has('category'))
									<span class="help-block">
										{{ $errors->first('category') }}
									</span>
									@endif

								</fieldset>
								
								<fieldset class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
									{{ Form::label('name', trans('auth.name'), ['class' => 'control-label']) }}
									{{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('common.name_of_your_page')]) }}
									@if ($errors->has('name'))
									<span class="help-block">
										{{ $errors->first('name') }}
									</span>
									@endif
								</fieldset> 

								<fieldset class="form-group required {{ $errors->has('username') ? ' has-error' : '' }}">
									{{ Form::label('username', trans('common.username'), ['class' => 'control-label']) }}									
									{{ Form::text('username', old('username'), ['class' => 'form-control','maxlength' => '26', 'placeholder' => trans('common.username')]) }}
									@if ($errors->has('username'))
									<span class="help-block">
										{{ $errors->first('username') }}
									</span>
									@endif
								</fieldset>

								<fieldset class="form-group">
									{{ Form::label('about', trans('common.about'), ['class' => 'control-label']) }}
									{{ Form::textarea('about', old('about'), ['class' => 'form-control', 'placeholder' => trans('messages.create_page_placeholder'), 'rows' => '4', 'cols' => '20']) }}
								</fieldset>

								<fieldset class="form-group">
									<div class="pull-right">
										{{ Form::submit(trans('common.create_page'), ['class' => 'btn btn-success']) }}
									</div>
								</fieldset>
								
							</form>
						</div>
					</div><!-- /panel-body -->
				</div>
			</div><!-- /col-md-8 -->

			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading no-bg panel-settings">
						<h3 class="panel-title">{{ trans('common.about').' '.trans('common.pages') }}</h3>
					</div>
					<div class="panel-body right-panel">
						<div class="privacy-question">
							<ul class="list-group right-list-group">
								<li href="#" class="list-group-item">
									<div class="holder">
										<div class="about-page">
											{{ Form::label('about_page_heading1', trans('messages.about_page_heading1'), ['class' => 'right-side-label']) }}
											</div>
										<div class="page-description">
											{{ trans('messages.about_page_content1') }}
										</div>
									</div>
								</li>
								<li href="#" class="list-group-item">
									<div class="holder">
										<div class="about-page">
											{{ Form::label('about_page_heading2', trans('messages.about_page_heading2'), ['class' => 'right-side-label']) }}
											</div>
										<div class="page-description">
											{{ trans('messages.about_page_content2') }}
										</div>
									</div>
								</li>
							</ul><!-- /list-group -->
						</div>
					</div><!-- /panel-body -->
				</div>
				
				@if(Setting::get('createpage_ad') != NULL)
				<div id="link_other" class="page-image">
					{!! htmlspecialchars_decode(Setting::get('createpage_ad')) !!}
				</div>
				@endif
			</div><!-- /col-md-4 -->
		</div>
	</div><!-- /container -->
<!-- </div> -->