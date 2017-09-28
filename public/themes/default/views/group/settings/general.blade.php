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
						{{ trans('common.general_settings') }}
					</h3>
				</div>
				<div class="panel-body nopadding">
					<div class="socialite-form">
						@include('flash::message')

						<form action="{{ url('/'.$username.'/group-settings/general') }}" method="POST">							

							{{ csrf_field() }}

							<div class="row">
								<div class="col-md-6">
									<fieldset class="form-group">
										{{ Form::label('username', trans('common.username')) }}
										{{ Form::text('username', $timeline->username, ['class' => 'form-control', 'placeholder' => trans('common.username'), 'disabled' => 'disabled']) }}
									</fieldset>
								</div>
								<div class="col-md-6">
									<fieldset class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
										{{ Form::label('name', trans('auth.name')) }}
										{{ Form::text('name', $timeline->name, ['class' => 'form-control', 'placeholder' => trans('common.name_of_your_group')]) }}
										@if ($errors->has('name'))
										<span class="help-block">
											{{ $errors->first('name') }}
										</span>
										@endif
									</fieldset>
								</div>
							</div>

							<fieldset class="form-group text-area-form">
								{{ Form::label('about', trans('common.about')) }}
								{{ Form::textarea('about', $timeline->about, ['class' => 'form-control', 'placeholder' => trans('messages.create_group_placeholder'), 'rows' => '2', 'cols' => '20'])}}
							</fieldset>

							<fieldset class="form-group">
								{{ Form::label('type', trans('common.privacy')) }}
								<div class="radio">
									<label>
										@if($group_details->type == "open")
										<input type="radio" name="type" id="optionsRadios1" value="open" checked>
										@else
										<input type="radio" name="type" id="optionsRadios1" value="open">
										@endif	
										<i class="fa fa-globe"></i> {{ trans('common.open_group') }}
										<p>{{ trans('messages.radio_open_group') }}</p>
									</label>
								</div>
								<div class="radio margin-left">
									<label class="margin-left-113">
										@if($group_details->type == "closed")
										<input type="radio" name="type" id="optionsRadios2" value="closed" checked>
										@else
										<input type="radio" name="type" id="optionsRadios2" value="closed">
										@endif	
										<i class="fa fa-lock"></i> {{ trans('common.closed_group') }}
										<p>{{ trans('messages.radio_closed_group') }}</p>
									</label>
								</div>
								<div class="radio">
									<label class="margin-left-112">
										@if($group_details->type == "secret")
										<input type="radio" name="type" id="optionsRadios3" value="secret" checked>
										@else
										<input type="radio" name="type" id="optionsRadios3" value="secret">
										@endif	
										<i class="fa fa-shield"></i> {{ trans('common.secret_group') }}
										<p>{{ trans('messages.radio_secret_group') }}</p>
									</label>
								</div>																					
							</fieldset>
							
							<fieldset class="form-group">
								{{ Form::label('member_privacy', trans('common.label_group_member_privacy')) }}
								{{ Form::select('member_privacy', array('members' => trans('common.members'), 'only_admins' => trans('common.admins')), $group_details->member_privacy, array('class' => 'form-control col-sm-6')) }}
							</fieldset>

							<fieldset class="form-group">
								{{ Form::label('post_privacy', trans('common.label_group_timeline_post_privacy')) }}
								{{ Form::select('post_privacy', array('members' => trans('common.members'), 'only_admins' => trans('common.admins'), 'everyone' => trans('common.everyone')), $group_details->post_privacy, array('class' => 'form-control col-sm-6')) }}
							</fieldset>
							
							<fieldset class="form-group">
								{{ Form::label('event_privacy', trans('common.label_group_timeline_event_privacy')) }}
								{{ Form::select('event_privacy', array('members' => trans('common.members'), 'only_admins' => trans('common.admins')), $group_details->event_privacy, array('class' => 'form-control col-sm-6')) }}
							</fieldset>
							
							<div class="pull-right">
								{{ Form::submit(trans('common.update_group'), ['class' => 'btn btn-success']) }}
							</div>
							<div class="clearfix"></div>

						</form>
					</div><!-- /socialite form -->
				</div>
			</div><!-- /panel -->
			
		</div>
	</div><!-- /row -->
</div>
<!-- </div> -->
<!-- /main-content -->