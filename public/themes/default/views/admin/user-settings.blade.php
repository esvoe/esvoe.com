<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
		<h3 class="panel-title">
			{{ trans('common.user_settings') }}
		</h3>
	</div>
	<div class="panel-body">
		@include('flash::message')

		<form method="POST" action="{{ url('admin/user-settings') }}">

			{{ csrf_field() }}
			<div class="privacy-question">

				<ul class="list-group">
					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							{{ Form::label('confirm_follow', trans('admin.confirm_follow')) }}
							{{ Form::select('confirm_follow', array('yes' => trans('common.yes'), 'no' => trans('common.no')), Setting::get('confirm_follow', 'no'), array('class' => 'form-control follow')) }}
						</fieldset>
					</li>
					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							{{ Form::label('follow_privacy', trans('admin.follow_privacy')) }}
							{{ Form::select('follow_privacy', array('everyone' => trans('common.everyone'), 'only_follow' => trans('admin.only_follow')), Setting::get('follow_privacy', 'everyone'), array('class' => 'form-control')) }}
						</fieldset>
					</li>
					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							{{ Form::label('comment_privacy', trans('admin.comment_privacy')) }}
							{{ Form::select('comment_privacy', array('everyone' => trans('common.everyone'), 'only_follow' => trans('admin.only_follow')), Setting::get('comment_privacy', 'everyone'), array('class' => 'form-control')) }}
						</fieldset>
					</li>
					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							{{  Form::label('user_timeline_post_privacy', trans('admin.user_timeline_post_privacy')) }}
							{{ Form::select('user_timeline_post_privacy', array('everyone' => trans('common.everyone'), 'only_follow' => trans('admin.only_follow'), 'nobody' => trans('common.no_one')), Setting::get('user_timeline_post_privacy', 'everyone'), array('class' => 'form-control')) }}
						</fieldset>
					</li>
					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							{{ Form::label('post_privacy', trans('admin.post_privacy')) }}
							{{ Form::select('post_privacy', array('everyone' => trans('common.everyone'), 'only_follow' => trans('admin.only_follow')), Setting::get('post_privacy', 'everyone'), array('class' => 'form-control')) }}
						</fieldset>
					</li>
					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							{{ Form::label('user_message_privacy', trans('admin.user_message_privacy')) }}
							{{ Form::select('user_message_privacy', array('everyone' => trans('common.everyone'), 'only_follow' => trans('admin.only_follow')), Setting::get('user_message_privacy', 'everyone'), array('class' => 'form-control')) }}
						</fieldset>
					</li>
				</ul>

				<h3>{{ trans('admin.add_custom_fields_for_user') }}</h3><hr>
				<div class="row">
					<div class="col-md-6">
						<fieldset class="form-group">
							{{ Form::label('custom_option1', trans('admin.custom_option1')) }}
							{{ Form::text('custom_option1', Setting::get('custom_option1'), array('class' => 'form-control','placeholder' => trans('admin.custom_option_placeholder'))) }}
						</fieldset>
					</div>
					<div class="col-md-6">
						<fieldset class="form-group">
							{{ Form::label('custom_option2', trans('admin.custom_option2')) }}
							{{ Form::text('custom_option2', Setting::get('custom_option2'), array('class' => 'form-control','placeholder' => trans('admin.custom_option_placeholder'))) }}
						</fieldset>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<fieldset class="form-group">
							{{ Form::label('custom_option3', trans('admin.custom_option3')) }}
							{{ Form::text('custom_option3', Setting::get('custom_option3'), array('class' => 'form-control','placeholder' => trans('admin.custom_option_placeholder'))) }}
						</fieldset>
					</div>
					<div class="col-md-6">
						<fieldset class="form-group">
							{{ Form::label('custom_option4', trans('admin.custom_option4')) }}
							{{ Form::text('custom_option4', Setting::get('custom_option4'), array('class' => 'form-control','placeholder' => trans('admin.custom_option_placeholder'))) }}
						</fieldset>
					</div>
				</div>

				<div class="pull-right">
					{{ Form::submit(trans('common.save_changes'), ['class' => 'btn btn-success']) }}
				</div>
			</div>
			{{ Form::close() }}



		</div>
	</div><!-- /panel -->