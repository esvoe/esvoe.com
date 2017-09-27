<!-- <div class="main-content"> -->
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body nopadding">
					<div class="mini-profile">
						<div class="background">
							<div class="widget-bg">
								<img src=" @if($timeline->cover) {{ url('event/cover/'.$timeline->cover->source) }} @else {{ url('event/cover/default-cover-event.png') }} @endif" alt="{{ $timeline->name }}" title="{{ $timeline->name }}">
							</div>
							<div class="event-avatar settings">
								<div class="event-date">
										2
								</div>			
								<div class="event-month">
									oct
								</div>
							</div>
						</div><!-- /background -->

						<div class="avatar-profile">
							<div class="avatar-details event-settings">
								<h2 class="avatar-name">
									<a href="{{ url($timeline->username) }}">
										{{ $timeline->name }}
									</a>
								</h2>
								<h4 class="avatar-mail">
									<a href="{{ url($timeline->username) }}"></a>
								</h4>
							</div>      
						</div><!-- /avatar-profile -->
					</div>
				</div><!-- /panel-body -->
			</div>
		</div><!-- /col-md-4 -->
		<div class="col-md-8">
			<div class="panel panel-default">
			@include('flash::message')
				<div class="panel-heading no-bg panel-settings">
					<h3 class="panel-title">
						{{ trans('common.general_settings') }}
					</h3>
				</div>
				<div class="panel-body nopadding">
					<div class="socialite-form">

						<form action="{{ url('/'.$username.'/event-settings/general') }}" method="POST">							

							{{ csrf_field() }}

							<div class="row">
								<div class="col-md-6">
									<fieldset class="form-group required {{ $errors->has('type') ? ' has-error' : '' }}">
										{{ Form::label('type', trans('common.type'), ['class' => 'control-label']) }}
										{{ Form::select('type', array('' => trans('admin.please_select'), 'private' => trans('common.private'), 'public' => trans('common.public')), $event_details->type ,array('class' => 'form-control')) }}
										@if ($errors->has('type'))
										<span class="help-block">
											{{ $errors->first('type') }}
										</span>
										@endif
									</fieldset>
								</div>
								<div class="col-md-6">
									<fieldset class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
										{{ Form::label('name', trans('auth.name')) }}
										{{ Form::text('name', $timeline->name, ['class' => 'form-control', 'placeholder' => trans('common.name_of_your_event')]) }}
										@if ($errors->has('name'))
										<span class="help-block">
											{{ $errors->first('name') }}
										</span>
										@endif
									</fieldset>
								</div>
							</div>

							<fieldset class="form-group required {{ $errors->has('start_date') || $errors->has('end_date') ? ' has-error' : '' }}">
								<div class="row">
									<div class="col-md-6">
										{{ Form::label('start_date', trans('admin.start_date'), ['class' => 'control-label']) }}

										<div class="input-group date form_datetime ">
											<span class="input-group-addon addon-left calendar-addon">
												<span class="fa fa-calendar"></span>
											</span>

											<input type="text" class="form-control" name="start_date" placeholder="01/01/1970" value="{!! $event_details->start_date !!}">

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
										{{ Form::label('end_date', trans('admin.end_date'), ['class' => 'control-label']) }}
										<div class="input-group date form_datetime ">
											<span class="input-group-addon addon-left calendar-addon">
												<span class="fa fa-calendar"></span>
											</span>                           

											<input type="text" class="form-control" name="end_date" placeholder="01/01/1970" value="{!! $event_details->end_date !!}">

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
							</fieldset>

							<fieldset class="form-group  required {{ $errors->has('location') ? ' has-error' : '' }}">
								{{ Form::label('location', trans('common.location')) }}
								{{ Form::text('location', $event_details->location, ['class' => 'form-control', 'id' => 'location-input', 'autocomplete' => 'off','placeholder' => trans('messages.enter_location'), 'onKeyPress' => "return initMap(event)" ]) }}
								@if ($errors->has('location'))
								<span class="help-block">
									{{ $errors->first('location') }}
								</span>
								@endif
							</fieldset>


							<fieldset class="form-group text-area-form">
								{{ Form::label('about', trans('common.about')) }}
								{{ Form::textarea('about', $timeline->about, ['class' => 'form-control', 'placeholder' => trans('common.about')])}}
							</fieldset>							
							
							
							<fieldset class="form-group">
								{{ Form::label('invite_privacy', trans('common.label_event_invite_privacy')) }}
								{{ Form::select('invite_privacy', array('only_guests' => trans('common.only_guests'), 'only_admins' => trans('admin.only_admin')), $event_details->invite_privacy, array('class' => 'form-control col-sm-6')) }}
							</fieldset>

							<fieldset class="form-group">
								{{ Form::label('timeline_post_privacy', trans('common.label_event_timeline_post_privacy')) }}
								{{ Form::select('timeline_post_privacy', array('only_admins' => trans('admin.only_admin'), 'only_guests' => trans('common.only_guests')), $event_details->timeline_post_privacy, array('class' => 'form-control col-sm-6')) }}
							</fieldset>
							

							
							<div class="pull-right">
								{{ Form::submit(trans('common.update_event'), ['class' => 'btn btn-success']) }}
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