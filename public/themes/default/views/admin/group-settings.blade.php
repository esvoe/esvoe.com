<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
		<h3 class="panel-title">
			{{ trans('common.group_settings') }}
		</h3>
	</div>
	<div class="panel-body">
		@include('flash::message')

		<form method="POST" action="{{ url('admin/group-settings') }}">

			{{ csrf_field() }}
			<div class="privacy-question">

				<ul class="list-group">
					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							{{ Form::label('group_member_privacy', trans('admin.group_member_privacy')) }}
							{{ Form::select('group_member_privacy', array('members' => trans('common.members'), 'only_admins' => trans('admin.only_admins')) , Setting::get('group_member_privacy', 'only_admins') , ['class' => 'form-control', 'placeholder' => trans('admin.please_select')]) }}
						</fieldset>
					</li>
					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							{{ Form::label('group_timeline_post_privacy', trans('admin.group_timeline_post_privacy')) }}
							{{ Form::select('group_timeline_post_privacy', array('everyone' => trans('common.everyone'), 'only_admins' => trans('admin.only_admins'), 'members' => trans('common.members')) , Setting::get('group_timeline_post_privacy', 'members') , ['class' => 'form-control', 'placeholder' => trans('admin.please_select')]) }}
						</fieldset>
					</li>
					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							{{ Form::label('group_event_privacy', trans('admin.group_event_privacy')) }}
							{{ Form::select('group_event_privacy', array('members' => trans('common.members'), 'only_admins' => trans('admin.only_admins')) , Setting::get('group_event_privacy', 'only_admins') , ['class' => 'form-control', 'placeholder' => trans('admin.please_select')]) }}
						</fieldset>
					</li>
				</ul>
				<div class="pull-right">
					{{ Form::submit(trans('common.save_changes'), ['class' => 'btn btn-success']) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
</div><!-- /panel -->