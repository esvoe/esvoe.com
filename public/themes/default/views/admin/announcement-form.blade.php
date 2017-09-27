
<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
	@include('flash::message')
		<h3 class="panel-title">
			{{ $mode.' '.trans('admin.announcement') }}
		</h3>
	</div>
	<div class="panel-body">		
	@if($mode=="create")
		<form method="POST" class="socialite-form" action="{{ url('admin/announcements') }}">
	@else
		<form method="POST" class="socialite-form" action="{{ url('admin/announcements/'.$announcement->id.'/update') }}">
	@endif		    
	
	{{ csrf_field() }}
		<div class="form-horizontal announcements">
			<div class="form-group required {{ $errors->has('title') ? ' has-error' : '' }}">
			    {{ Form::label('title', trans('admin.title'), ['class' => 'col-sm-2 control-label']) }}
			    <div class="col-sm-10">
			      @if($mode == "create")
			      	{{ Form::text('title',null,['class' => 'form-control']) }}
			      @else
			      	{{ Form::text('title', $announcement->title, ['class' => 'form-control']) }}
			      @endif
			      
			      @if ($errors->has('title'))
			      <span class="help-block">
			      	{{ $errors->first('title') }}
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
			     	{{ Form::textarea('description', $announcement->description, ['class' => 'form-control']) }}
			     	@endif

			     	@if ($errors->has('description'))
					<span class="help-block">
						{{ $errors->first('description') }}
					</span>
					@endif		     	
			    </div>
			</div>
			
			<div class="form-group required {{ $errors->has('start_date') || $errors->has('end_date') ? ' has-error' : '' }}">
				<div class="row">
					<div class="col-md-6">
					 	{{ Form::label('start_date', trans('admin.start_date'), ['class' => 'col-sm-4 control-label']) }}

					 	<div class="input-group date datepicker col-sm-8">
                            <span class="input-group-addon addon-left calendar-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                            @if($mode=="create")
                            	<input type="text" class="form-control" name="start_date" id="datepicker1" placeholder="01/01/1970">
                            @else
                            	<input type="text" class="form-control" name="start_date" id="datepicker1" value="{{ $announcement->start_date }}">
                            @endif                            
                            <span class="input-group-addon addon-right angle-addon">
                                <span class="fa fa-angle-down"></span>
                            </span>
                        </div>
                        @if ($errors->has('start_date'))
                        <span class="help-block">
                        	{{ $errors->first('start_date') }}
                        </span>
                        @endif
					</div>
					<div class="col-md-6">
					 	{{ Form::label('end_date', trans('admin.end_date'), ['class' => 'col-sm-4 control-label']) }}
					 	<div class="input-group date datepicker col-sm-8">
                            <span class="input-group-addon addon-left calendar-addon">
                                <span class="fa fa-calendar"></span>
                            </span>                           
                            @if($mode=="create")
                            	<input type="text" class="form-control" name="end_date" id="datepicker2" placeholder="01/01/1970">
                            @else
                            	<input type="text" class="form-control" name="end_date" id="datepicker2" value="{{ $announcement->end_date }}">
                            @endif 
                             <span class="input-group-addon addon-right angle-addon">
                                <span class="fa fa-angle-down"></span>
                            </span>
                        </div>
                        @if ($errors->has('end_date'))
                        <span class="help-block">
                        	{{ $errors->first('end_date') }}
                        </span>
                        @endif
                    </div>
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












