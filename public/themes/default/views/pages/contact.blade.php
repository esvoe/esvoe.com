<div class="main-content">	
	<div class="container">		
		<div class="panel panel-default contact-panel">
		
			<div class="panel-heading no-bg panel-settings">
				<h3 class="panel-title">{{ trans('common.contact') }}</h3>

			</div>
			<div class="panel-body static-body">
				<p class="static-para">
					{{ Setting::get('contact_text', 'Contact page description can be edited in admin panel') }}
				</p>
				@include('flash::message')
				<div class="login-block static-pages">


					<!-- /contact form goes here --> 

					<div class="contact-form">
						<!-- <h3 class="av-special-heading-tag" itemprop="headline">Send us mail</h3> -->
						<div class="special-heading-border">
							<div class="special-heading-inner-border">

							</div>
						</div>
					</div>

					<form method="POST" action="{{ url('contact') }}" class="socialite-form">
					{{ csrf_field() }}
						<fieldset>
							<div class="row">
								<div class="col-md-6 col-sm-12 col-xs-12 left-form">
									<div class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
										{{ Form::label('name', trans('auth.name'), ['class' => 'control-label']) }}
										<input type="text" class="form-control" name="name" placeholder="{{ trans('messages.name_placeholder') }}">
										@if ($errors->has('name'))
										<span class="help-block">
											{{ $errors->first('name') }}
										</span>
										@endif
									</div>
								</div>
								<div class="col-md-6 col-sm-12 col-xs-12 right-form">
									<div class="form-group required {{ $errors->has('email') ? ' has-error' : '' }}">
										{{ Form::label('email', trans('auth.email_address'), ['class' => 'control-label']) }}
										<input type="email" class="form-control" name="email" placeholder="{{ trans('messages.email_placeholder') }}">
										@if ($errors->has('email'))
										<span class="help-block">
											{{ $errors->first('email') }}
										</span>
										@endif
									</div>
								</div>

								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="form-group required {{ $errors->has('subject') ? ' has-error' : '' }}">
										{{ Form::label('subject', trans('auth.subject'), ['class' => 'control-label']) }}
										<input type="text" class="form-control" placeholder="{{ trans('messages.subject_placeholder') }}" name="subject">
										@if ($errors->has('subject'))
										<span class="help-block">
											{{ $errors->first('subject') }}
										</span>
										@endif
									</div>
								</div>

								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="form-group required {{ $errors->has('message') ? ' has-error' : '' }}">
										{{ Form::label('message', trans('common.message'), ['class' => 'control-label']) }}
										<textarea class="form-control" rows="3" placeholder="{{ trans('messages.message_placeholder') }}" name="message"></textarea>
										@if ($errors->has('message'))
										<span class="help-block">
											{{ $errors->first('message') }}
										</span>
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success btn-submit">{{ trans('auth.submit') }}</button>
							</div>

						</fieldset>
					</form>

				</div>
				<!-- /login-block -->
			</div>
		</div>
	</div>
</div>