<!-- <div class="main-content"> -->
<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
		@if($group_id != null)
		<h3 class="panel-title">{{ trans('common.create_event_in') }} {!! $timeline_name !!}</h3>
		@else
		<h3 class="panel-title">{{ trans('common.create_event') }}</h3>
		@endif						
	</div>

	<div class="panel-body nopadding">  
		<div class="socialite-form">
			@if(session()->has('message'))
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{ session()->get('message') }}
			</div>
			@endif                         
			<form class="margin-right" method="POST" action="{{ url('/'.$username.'/create-event/') }}">
				{{ csrf_field() }}

				<fieldset class="form-group required {{ $errors->has('type') ? ' has-error' : '' }}">
					{{ Form::label('type', trans('common.type'), ['class' => 'control-label']) }}
					{{ Form::select('type', array('' => trans('admin.please_select'), 'private' => trans('common.private'), 'public' => trans('common.public')), null ,array('class' => 'form-control')) }}
					@if ($errors->has('type'))
					<span class="help-block">
						{{ $errors->first('type') }}
					</span>
					@endif
				</fieldset>

				<fieldset class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
					{{ Form::label('name', trans('auth.name'), ['class' => 'control-label']) }}
					{{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('common.name_of_your_event')]) }}
					@if ($errors->has('name'))
					<span class="help-block">
						{{ $errors->first('name') }}
					</span>
					@endif
				</fieldset>   

				<fieldset class="form-group required {{ $errors->has('location') ? ' has-error' : '' }}">
					{{ Form::label('location', trans('common.location')) }}
					{{ Form::text('location', old('location'), ['class' => 'form-control', 'id' => 'location-input', 'autocomplete' => 'off','placeholder' => trans('common.enter_location'), 'onKeyPress' => "return initMap(event)" ]) }}
					@if ($errors->has('location'))
					<span class="help-block">
						{{ $errors->first('location') }}
					</span>
					@endif
				</fieldset>

				<fieldset class="form-group required {{ $errors->has('start_date') || $errors->has('end_date') ? ' has-error' : '' }}">
				<div class="row">
					<div class="col-md-6">
						{{ Form::label('start_date', trans('admin.start_date'), ['class' => 'control-label']) }}

						<div class="input-group date form_datetime">												

							<input type="text" class="form-control" name="start_date" placeholder="01/01/1970" value="{{ old('start_date') }}">

							<span class="input-group-addon addon-right calendar-addon">
								<span class="fa fa-calendar"></span>
							</span>

								{{-- <span class="input-group-addon addon-right angle-addon">
									<span class="fa fa-angle-down"></span>
								</span> --}}
							</div>
							@if ($errors->has('start_date'))
							<span class="help-block">
								{{ $errors->first('start_date') }}
							</span>
							@endif
						</div>
						<div class="col-md-6">
							{{ Form::label('end_date', trans('admin.end_date'), ['class' => 'control-label']) }}
							<div class="input-group date form_datetime">

								<input value="{{ old('end_date') }}" type="text" class="form-control" name="end_date" placeholder="01/01/1970">

								<span class="input-group-addon addon-right calendar-addon">
									<span class="fa fa-calendar"></span>
								</span>
								
								{{-- <span class="input-group-addon addon-right angle-addon">
									<span class="fa fa-angle-down"></span>
								</span> --}}
							</div>
							@if ($errors->has('end_date'))
							<span class="help-block">
								{{ $errors->first('end_date') }}
							</span>
							@endif
						</div>
					</div>
				</fieldset>

				<fieldset class="form-group required {{ $errors->has('eticket_event_id') ? ' has-error' : '' }}">
					{{ Form::label('eticket_event_id', trans('auth.eticket_event_id'), ['class' => 'control-label']) }}
					{{ Form::text('eticket_event_id', old('eticket_event_id'), ['class' => 'form-control', 'placeholder' => trans('common.eticket_event_id_title')]) }}
					@if ($errors->has('eticket_event_id'))
					<span class="help-block">
						{{ $errors->first('eticket_event_id') }}
					</span>
					@endif
				</fieldset>

				<fieldset class="form-group">
					{{ Form::label('about', trans('common.about'), ['class' => 'control-label']) }}							
					{{ Form::textarea('about', old('about'), ['class' => 'form-control','placeholder' => trans('common.about')]) }}									
				</fieldset>

				{!! Form::hidden('group_id', $group_id) !!}		

				<div class="pull-right">
					@if($group_id != null)
					<a href="{!! url($username) !!}" class="btn btn-default">Cancel</a>								    
					@else
					<a href="{!! url($username.'/events') !!}" class="btn btn-default">Cancel</a>								    
					@endif									
					{{ Form::submit(trans('common.create_event'), ['class' => 'btn btn-success']) }}
				</div>
				<div class="clearfix"></div>
							
			</form>
		</div>
	</div><!-- /panel-body -->
</div>			
<!-- </div> -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_vuWi_hzMDDeenNYwaNAj0PHzzS2GAx8&libraries=places&callback=initMap"
        async defer></script>

<script>
function initMap(event) 
{    
    var key;  
    var map = new google.maps.Map(document.getElementById('location-input'), {
    });

    var input = /** @type {!HTMLInputElement} */(
        document.getElementById('location-input'));        

    if(window.event)
    {
        key = window.event.keyCode; 

    }
    else 
    {
        if(event)
            key = event.which;      
    }       

    if(key == 13){       
    //do nothing 
    return false;       
    //otherwise 
    } else { 
        var autocomplete = new google.maps.places.Autocomplete(input);  
        autocomplete.bindTo('bounds', map);

    //continue as normal (allow the key press for keys other than "enter") 
    return true; 
    } 
}
</script>