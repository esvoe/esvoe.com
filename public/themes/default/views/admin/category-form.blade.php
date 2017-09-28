
<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">	
	@include('flash::message')
		<h3 class="panel-title">
			{{ $mode.' '.trans('admin.page_category') }}
		</h3>
	</div>
	<div class="panel-body">		
	@if($mode=="create")
		<form method="POST" class="socialite-form" action="{{ url('admin/category/create') }}">
	@else
		<form method="POST" class="socialite-form" action="{{ url('admin/category/'.$category->id.'/update') }}">
	@endif		    
	
	{{ csrf_field() }}
		<div class="form-horizontal announcements">
			<div class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
			    {{ Form::label('name', trans('admin.name'), ['class' => 'col-sm-2 control-label']) }}
			    <div class="col-sm-10">
			      @if($mode == "create")
			      	{{ Form::text('name',null,['class' => 'form-control']) }}
			      @else
			      	{{ Form::text('name', $category->name, ['class' => 'form-control']) }}
			      @endif
			      
			      @if ($errors->has('name'))
			      <span class="help-block">
			      	{{ $errors->first('name') }}
			      </span>
			      @endif
			    </div>
			</div>
			<div class="form-group required {{ $errors->has('description') ? ' has-error' : '' }}">
			    {{ Form::label('description', trans('common.description'), ['class' => 'col-sm-2 control-label']) }}
			    <div class="col-sm-10">
			     	@if($mode =="create")
			     		{{ Form::textarea('description', null ,['class' => 'form-control']) }}
			     	@else
			     	{{ Form::textarea('description', $category->description, ['class' => 'form-control']) }}
			     	@endif

			     	@if ($errors->has('description'))
					<span class="help-block">
						{{ $errors->first('description') }}
					</span>
					@endif		     	
			    </div>
			</div>

			<div class="form-group required {{ $errors->has('active') ? ' has-error' : '' }}">
			    {{ Form::label('active', trans('admin.active'), ['class' => 'col-sm-2 control-label']) }}
			    <div class="col-sm-10">
			     	@if($mode =="create")
			     		{{ Form::select('active', array(1 => trans('admin.active'), 0 => trans('admin.inactive')), null , ['class' => 'form-control', 'placeholder' => trans('admin.please_select')]) }}
			     	@else
			     		{{ Form::select('active', array(1 => trans('admin.active'), 0 => trans('admin.inactive')), $category->active , ['class' => 'form-control', 'placeholder' => trans('admin.please_select')]) }}
			     	@endif

			     	@if ($errors->has('active'))
					<span class="help-block">
						{{ $errors->first('active') }}
					</span>
					@endif		     	
			    </div>
			</div>
			

			<div class="form-group">
			    <div class="text-center">
			      @if($mode=="create")
			      	<button type="submit" class="btn btn-success">{{ trans('common.create') }}</button>
			      @else
			      	<button type="submit" class="btn btn-success">{{ trans('common.save_changes') }}</button>
			      @endif
			    </div>
			</div>
		</div><!-- /announcements -->
		</form>
	</div>
</div>












