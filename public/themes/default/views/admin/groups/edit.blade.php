<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
			<h3 class="panel-title">
				{{ trans('admin.edit_group') }} ({{ $timeline->name }})
			</h3>
		</div>		
	<div class="panel-body">
		@include('flash::message')
		
		<form class="socialite-form" method="POST" action="{{ url('admin/groups/'.$username.'/edit') }}">
			{{ csrf_field() }}
			<fieldset class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
				{{ Form::label('name', trans('auth.name'), ['class' => 'control-label']) }}
				<input type="text" class="form-control" placeholder="{{ trans('admin.group_name_placeholder') }}" name="name" value="{{ $timeline->name }}">
				<small class="text-muted">{{ trans('admin.edit_group_text') }}</small>
				@if ($errors->has('name'))
				<span class="help-block">
					{{ $errors->first('name') }}
				</span>
				@endif
			</fieldset>

			<fieldset class="form-group">
				{{ Form::label('username', trans('common.username'), ['class' => 'control-label']) }}
				<input type="text" name="username" class="form-control content-form" placeholder="{{ trans('admin.username_placeholder') }}"  value="{{ $timeline->username }}" disabled>
				<small class="text-muted">{{ trans('admin.group_username_text') }}</small>
			</fieldset>	

			<fieldset class="form-group">
				{{ Form::label('about', trans('common.about'), ['class' => 'control-label']) }}				
				{{ Form::textarea('about', $timeline->about, ['class' => 'form-control', 'placeholder' => trans('common.about')])}}
				<small class="text-muted">{{ trans('admin.group_about_text') }}</small>
			</fieldset>

			<fieldset class="form-group required {{ $errors->has('type') ? ' has-error' : '' }}">
				{{ Form::label('type', trans('admin.group_privacy'), ['class' => 'control-label']) }}
				{{ Form::select('type', array('open' => 'open group','closed' => 'closed group','secret' => 'secret group') , $groups->type , ['class' => 'form-control','placeholder' => 'Please Select']) }}
				<small class="text-muted">{{ trans('admin.group_privacy_text') }}</small>
				@if ($errors->has('type'))
				<span class="help-block">
					{{ $errors->first('type') }}
				</span>
				@endif
			</fieldset>

			<fieldset class="form-group">
				{{ Form::label('member_privacy', trans('admin.add_privacy'), ['class' => 'control-label']) }}
				{{ Form::select('member_privacy', array('members' => 'Members','only_admins' => 'Only admins') , $groups->member_privacy , ['class' => 'form-control']) }}
				<small class="text-muted">{{ trans('admin.add_privacy_text') }}</small>				
			</fieldset>

			<fieldset class="form-group">
				{{ Form::label('post_privacy', trans('admin.timeline_post_privacy'), ['class' => 'control-label']) }}
				{{ Form::select('post_privacy', array('members' => 'Members', 'only_admins' => 'Only admins') , $groups->post_privacy , ['class' => 'form-control']) }}
				<small class="text-muted">{{ trans('admin.timeline_post_privacy_text') }}</small>				
			</fieldset>
			<fieldset class="form-group">
			{{ Form::label('event_privacy', trans('common.label_group_timeline_event_privacy')) }}
				{{ Form::select('event_privacy', array('members' => 'Members', 'only_admins' => 'Only admins'), $groups->event_privacy, array('class' => 'form-control col-sm-6')) }}
			</fieldset>

			<div class="pull-right">
				<button type="submit" class="btn btn-primary btn-sm">{{ trans('common.save_changes') }}</button>
			</div>
		</form>
	</div>
</div>
