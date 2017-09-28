@include('flash::message')
<div class="panel panel-default">

	<div class="panel-heading no-bg panel-settings">
		<h3 class="panel-title">
			{{ $mode.' '.trans('admin.custom_page') }}
		</h3>
	</div>
	<div class="panel-body">		
		@if($mode =="create")
			<form method="POST" class="socialite-form" action="{{ url('admin/custom-pages') }}  ">
		@else
			<form method="POST" class="socialite-form" action="{{ url('admin/custom-pages/'.$staticPage->id.'/update') }}">
		@endif

			{{ csrf_field() }}
			<div class="privacy-question">
				<fieldset class="form-group required {{ $errors->has('title') ? ' has-error' : '' }}">
					{{ Form::label('title', trans('admin.page_title')) }}
					@if($mode == "create")
						{{ Form::text('title', NULL , array('class' => 'form-control', 'placeholder' => trans('admin.page_title_placeholder') )) }}
					@else
						{{ Form::text('title', $staticPage->title , array('class' => 'form-control', 'placeholder' => trans('admin.page_title_placeholder') )) }}
					@endif	
					@if ($errors->has('title'))
					<span class="help-block">
						{{ $errors->first('title') }}
					</span>
					@endif
				</fieldset>

				<fieldset class="form-group required {{ $errors->has('description') ? ' has-error' : '' }}">
					{{ Form::label('description', trans('admin.page_description')) }}
					@if($mode == "create")
						{{ Form::textarea('description', NULL , array('class' => 'form-control mytextarea', 'placeholder' => trans('messages.create_page_placeholder') )) }}
					@else
						{{ Form::textarea('description', $staticPage->description , array('class' => 'form-control mytextarea', 'placeholder' => trans('messages.create_page_placeholder') )) }}
					@endif	
					@if ($errors->has('description'))
					<span class="help-block">
						{{ $errors->first('description') }}
					</span>
					@endif
				</fieldset>

				<fieldset class="form-group">
					{{ Form::label('active', trans('common.status')) }}
					@if($mode == "create")
						{{ Form::select('active', array(1 => trans('admin.active'), 0 => trans('admin.inactive')), NULL, array('class' => 'form-control')) }}
					@else
						{{ Form::select('active', array(1 => trans('admin.active'), 0 => trans('admin.inactive')), $staticPage->active , array('class' => 'form-control')) }}				
					@endif
				</fieldset>
					
				<div class="pull-right">
					{{ Form::submit(trans('common.save_changes'), ['class' => 'btn btn-success']) }}
				</div>
			</div>
		</form>
	</div>
</div><!-- /panel -->