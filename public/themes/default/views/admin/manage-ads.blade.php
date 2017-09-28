<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
		<h3 class="panel-title">
			{{ trans('common.manage_ads') }}
		</h3>
	</div>
	<div class="panel-body nopadding">
		<div class="socialite-form">

			@include('flash::message')
			<form method="POST" action="{{ url('admin/manage-ads') }}">
				{{ csrf_field() }}
				<fieldset class="form-group">
					{{ Form::label('home_ad', trans('admin.home_ad'), ['class' => 'control-label']) }}
					{{ Form::textarea('home_ad', Setting::get('home_ad'), ['class' => 'form-control', 'rows' => '4']) }}
				</fieldset>
					
				<fieldset class="form-group">
					{{ Form::label('timeline_ad', trans('admin.timeline_ad'), ['class' => 'control-label']) }}
					{{ Form::textarea('timeline_ad', Setting::get('timeline_ad'), ['class' => 'form-control', 'rows' => '4']) }}
				</fieldset>

				<fieldset class="form-group">
					{{ Form::label('timeline_right_ad', trans('admin.timeline_right_ad'), ['class' => 'control-label']) }}
					{{ Form::textarea('timeline_right_ad', Setting::get('timeline_right_ad'), ['class' => 'form-control', 'rows' => '4']) }}
				</fieldset>

				<fieldset class="form-group">
					{{ Form::label('createpage_ad', trans('admin.createpage_ad'), ['class' => 'control-label']) }}
					{{ Form::textarea('createpage_ad', Setting::get('createpage_ad'), ['class' => 'form-control', 'rows' => '4']) }}
				</fieldset>

				<fieldset class="form-group">
					{{ Form::label('creategroup_ad', trans('admin.creategroup_ad'), ['class' => 'control-label']) }}
					{{ Form::textarea('creategroup_ad', Setting::get('creategroup_ad'), ['class' => 'form-control', 'rows' => '4']) }}
				</fieldset>

				<fieldset class="form-group">
					{{ Form::label('postcontent_ad', trans('admin.postcontent_ad'), ['class' => 'control-label']) }}
					{{ Form::textarea('postcontent_ad', Setting::get('postcontent_ad'), ['class' => 'form-control', 'rows' => '4']) }}
				</fieldset>

				<div class="pull-right">
					{{ Form::submit(trans('common.save_changes'), ['class' => 'btn btn-success']) }}
				</div>
				<div class="clearfix"></div>
			</form>
		</div><!-- /Socialite-form -->
	</div>
</div><!-- /panel -->