<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
		<h3 class="panel-title">
			{{ trans('common.manage_events') }}
		</h3>
		<div class="col-md-offset-9">
			{{ Form::label('sort by', 'Sort by:') }}
			{!! Form::select('manage_users', array('name_asc' => trans('admin.name_asc'), 'name_desc' => trans('admin.name_desc'), 'private' => trans('common.private'), 'public' => trans('common.public')), Request::get('sort'), ['class' => 'form-control eventsort']) !!}
		</div>		
	</div>
	
		
	<div class="panel-body nopadding">
		<ul class="nav nav-pills heading-list">			
			<li class="active"><a href="#ongoing" data-toggle="pill" class="header-text">{{ trans('common.ongoing') }}<span>{{ count($ongoning_events) }}</span></a></li>
			<li class="divider">&nbsp;</li>
			<li class=""><a href="#upcoming" data-toggle="pill" class="header-text">{{ trans('common.upcoming') }}<span>{{ count($upcoming_events) }}</span></a></li>
			<li class="divider">&nbsp;</li>
			<li class=""><a href="#expired" data-toggle="pill" class="header-text">{{ trans('common.expired') }}<span>{{ count($expired_events) }}</span></a></li>
		</ul>

		<div class="tab-content nopadding">
    		<div id="ongoing" class="tab-pane fade active in">
	    		<div class="table-responsive manage-table">
	        		<table class="table apps-table">
	      				@include('flash::message')
						@if(count($ongoning_events) > 0)
							
						<thead>
							<tr>
								<th>&nbsp;</th>
								<th>{{ trans('admin.id') }}</th> 
								<th>{{ trans('auth.name') }}</th>
								<th>{{ trans('common.type') }}</th>
								<th>{{ trans('common.guests') }}</th> 
								<th>{{ trans('admin.options') }}</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@foreach($ongoning_events as $ongoning)
								<tr>
									<td>&nbsp;</td>	
									<td>{{ $ongoning->event->id }}</td>
									<td><a href="#">
										<img src="{{ $ongoning->event->user->picture }}" alt="{{ $ongoning->event->timeline->name }}" title="{{ $ongoning->event->timeline->name }}"></a><a href="{{ url($ongoning->event->timeline->username) }}"> {{ $ongoning->event->timeline->name }}
										</a>
									</td> 
									<td><span class="label label-default">{{$ongoning->event->type}}</span></td>
									<td>{{ $ongoning->event->users->count() }}</td> 
									<td>
										<ul class="list-inline">
											<li><a href="{{ url('admin/events/'.$ongoning->event->timeline->username.'/edit')}}"><span class="pencil-icon bg-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a></li>
											<li><a href="{{ url('admin/events/'.$ongoning->event->id.'/delete')}}" onclick="return confirm('{{ trans("messages.are_you_sure") }}')"><span class="trash-icon bg-danger"><i class="fa fa-trash text-danger" aria-hidden="true"></i></span></a></li>
										</ul>
									</td>
									<td>&nbsp;</td> 
								</tr>
							@endforeach
						</tbody>
							
						@else
							<div class="alert alert-warning">{{ trans('messages.no_events') }}</div>
						@endif
	        		</table>
	        		<div class="pagination-holder groupnation">
	        			{{ $ongoning_events->render() }}
	        		</div>
	        	</div>
    		</div>
<!-- End of ongoing tab-->
			<div id="upcoming" class="tab-pane fade">
				<div class="table-responsive manage-table">
					<table class="table apps-table">         
						@if(count($upcoming_events) > 0)
							
								<thead>
									<tr>
										<th>&nbsp;</th>
										<th>{{ trans('admin.id') }}</th> 
										<th>{{ trans('auth.name') }}</th>
										<th>{{ trans('common.type') }}</th>
										<th>{{ trans('common.guests') }}</th> 
										<th>{{ trans('admin.options') }}</th>
										<th>&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									@foreach($upcoming_events as $upcoming)
									<tr>
										<td>&nbsp;</td>	
										<td>{{ $upcoming->event->id }}</td>
										<td><a href="#">
											<img src="{{ $upcoming->event->user->picture }}" alt="{{ $upcoming->event->timeline->name }}" title="{{ $upcoming->event->timeline->name }}"></a><a href="{{ url($upcoming->event->timeline->username) }}"> {{ $upcoming->event->timeline->name }}
											</a>
										</td> 
										<td><span class="label label-default">{{$upcoming->event->type}}</span></td>
										<td>{{ $upcoming->event->users->count() }}</td> 
										<td>
											<ul class="list-inline">
												<li><a href="{{ url('admin/events/'.$upcoming->event->timeline->username.'/edit')}}"><span class="pencil-icon bg-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a></li>
												<li><a href="{{ url('admin/events/'.$upcoming->event->id.'/delete')}}" onclick="return confirm('{{ trans("messages.are_you_sure") }}')"><span class="trash-icon bg-danger"><i class="fa fa-trash text-danger" aria-hidden="true"></i></span></a></li>
											</ul>
										</td>
										<td>&nbsp;</td> 
									</tr>
									@endforeach
								</tbody>
						@else
							<div class="alert alert-warning">{{ trans('messages.no_events') }}</div>
						@endif
	        		</table>
	        		<div class="pagination-holder groupnation">
	        			{{ $upcoming_events->render() }}
	        		</div>
				</div>
    		</div>
<!-- End of upcoming tab-->
		<div id="expired" class="tab-pane fade">
			<div class="table-responsive manage-table">
				<table class="table apps-table">         
					@if(count($expired_events) > 0)

					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>{{ trans('admin.id') }}</th> 
							<th>{{ trans('auth.name') }}</th>
							<th>{{ trans('common.type') }}</th>
							<th>{{ trans('common.guests') }}</th> 
							<th>{{ trans('admin.options') }}</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						@foreach($expired_events as $expired)
							<tr>
								<td>&nbsp;</td>	
								<td>{{ $expired->event->id }}</td>
								<td><a href="#">
									<img src="{{ $expired->event->user->picture }}" alt="{{ $expired->event->timeline->name }}" title="{{ $expired->event->timeline->name }}"></a><a href="{{ url($expired->event->timeline->username) }}"> {{ $expired->event->timeline->name }}
									</a>
								</td> 
								<td><span class="label label-default">{{$expired->event->type}}</span></td>
								<td>{{ $expired->event->users->count() }}</td> 
								<td>
									<ul class="list-inline">
										<li><a href="{{ url('admin/events/'.$expired->event->timeline->username.'/edit')}}"><span class="pencil-icon bg-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a></li>
										<li><a href="{{ url('admin/events/'.$expired->event->id.'/delete')}}" onclick="return confirm('{{ trans("messages.are_you_sure") }}')"><span class="trash-icon bg-danger"><i class="fa fa-trash text-danger" aria-hidden="true"></i></span></a></li>
									</ul>
								</td>
								<td>&nbsp;</td> 
							</tr>
						@endforeach
				</tbody>
				@else
				<div class="alert alert-warning">{{ trans('messages.no_events') }}</div>
				@endif
			</table>
			<div class="pagination-holder groupnation">
				{{ $expired_events->render() }}
			</div>
			</div>
		</div>
<!-- End of upcoming tab-->	
		</div>
	</div>
</div>
