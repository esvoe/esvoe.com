<div class="panel panel-default">
@include('flash::message')
	<div class="panel-heading no-bg panel-settings">
		<h3 class="panel-title">
			{{ trans('common.event_settings') }}
		</h3>
	</div>
	<div class="panel-body">		

		<form method="POST" action="{{ url('admin/event-settings') }}">

			{{ csrf_field() }}
			<div class="privacy-question">

				<ul class="list-group">
					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							{{ Form::label('invite_privacy', trans('admin.invite_privacy')) }}
							{{ Form::select('invite_privacy', array('only_guests' => trans('common.only_guests'), 'only_admins' => trans('admin.only_admins')) , Setting::get('invite_privacy', 'only_admins') , ['class' => 'form-control', 'placeholder' => trans('admin.please_select')]) }}
						</fieldset>
					</li>
					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							{{ Form::label('event_timeline_post_privacy', trans('admin.event_timeline_post_privacy')) }}
							{{ Form::select('event_timeline_post_privacy', array('only_admins' => trans('admin.only_admins'), 'only_guests' => trans('common.only_guests')) , Setting::get('event_timeline_post_privacy', 'only_guests') , ['class' => 'form-control', 'placeholder' => trans('admin.please_select')]) }}
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