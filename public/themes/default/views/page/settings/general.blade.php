<!-- <div class="main-content"> -->
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="post-filters">
					{!! Theme::partial('pagemenu-settings',compact('timeline')) !!}
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading no-bg panel-settings">
						<h3 class="panel-title">
							{{ trans('common.general_settings') }}
						</h3>
					</div>
					<div class="panel-body nopadding">
						<div class="socialite-form">
							@include('flash::message')   
							
							<form action="{{ url('/'.$username.'/page-settings/general')}}" method="POST">
								{{ csrf_field() }}
								
								<div class="row">
									<div class="col-md-6">
										<fieldset class="form-group">
											{{ Form::label('username', trans('common.username'), ['class' => 'control-label']) }} 
											{{ Form::text('username', $timeline->username, ['class' => 'form-control', 'placeholder' => trans('common.username'), 'disabled' => 'disabled']) }}
											{{ Form::hidden('username', $timeline->username) }}
										</fieldset>
									</div>
									<div class="col-md-6">
										<div class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
											{{ Form::label('name', trans('auth.name'), ['class' => 'control-label']) }}
											{{ Form::text('name', $timeline->name, ['class' => 'form-control', 'placeholder' => trans('common.name_of_your_page')]) }}
											@if ($errors->has('name'))
											<span class="help-block">
												{{ $errors->first('name') }}
											</span>
											@endif
										</div>
									</div>
								</div>
								
								<fieldset class="form-group text-area-form">
									{{ Form::label('about', trans('common.about'), ['class' => 'control-label']) }}
									{{ Form::textarea('about', $timeline->about, ['class' => 'form-control', 'placeholder' => trans('messages.create_page_placeholder'), 'rows' => '2', 'cols' => '20'])}}
								</fieldset>
								
								<div class="row">
									<div class="col-md-6">
										<fieldset class="form-group">
											{{ Form::label('address', trans('common.address'), ['class' => 'control-label']) }}
											{{ Form::textarea('address', $timeline->page->address, ['class' => 'form-control', 'placeholder' => trans('common.address_of_your_page'), 'rows' => '5'])}}
										</fieldset>
									</div>
									<div class="col-md-6">
										<fieldset class="form-group">
											{{ Form::label('phone', trans('common.phone'), ['class' => 'control-label']) }}
											{{ Form::number('phone', $timeline->page->phone, ['class' => 'form-control', 'placeholder' => trans('common.phone')]) }}
										</fieldset>

										<fieldset class="form-group">
											{{ Form::label('website', trans('common.website'), ['class' => 'control-label']) }}
											{{ Form::text('website', $timeline->page->website, ['class' => 'form-control', 'placeholder' => trans('common.website')]) }}
										</fieldset>
									</div>
								</div>

								<div class="pull-right">
									{{ Form::submit(trans('common.update_page'), ['class' => 'btn btn-success']) }}
								</div>
								<div class="clearfix"></div>

							{{ Form::close() }}
						</div><!-- /socialite-form -->
					</div>
				</div><!-- /panel -->
			</div>
		</div><!-- /row -->
	</div>
<!-- </div> --><!-- /main-content -->