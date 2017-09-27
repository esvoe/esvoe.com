<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
		<h3 class="panel-title">
			{{ trans('admin.active_announcement') }}
		</h3>
	</div>
	<div class="panel-body">
	@if(Setting::get('announcement') != NULL && $current_anouncement != NULL)
		<div class="announcement-container">	
			<span class="announcement-title">
				{{ $current_anouncement->title }}
				<span class="pull-right label label-default expiry-date">
					@if($total_days != 0)
						{{ $total_days }} {{ trans('admin.days_to_expire') }}
					@else
						{{ trans('admin.expired') }}
					@endif					
				</span>
			</span>
			<div class="clearfix"></div>
			<div class="announcement-description pull-left">
				{{  $current_anouncement->description }}
				<div class="time-created">			
					<?php $announces_date = date("F d Y, G:i A", strtotime($current_anouncement->created_at));?>
					{!! '<br> Created on '.$announces_date !!}
				</div>
			</div>
			<span class="pull-right announcement-actions">
				<a href="#" class="view-by"><i class="fa fa-eye"></i> Views : {{ count($current_anouncement->users) }}</a>
				<a href="{{ url('admin/announcements/'.$current_anouncement->id.'/edit')}}">{{ trans('common.edit') }}</a>
			</span>
		</div>
		@else
			<div class="alert alert-warning ">{{ trans('messages.no_announcements') }}</div>
		@endif
	</div>
</div>

<div class="panel panel-default">
@include('flash::message')
	<div class="panel-heading no-bg panel-settings">
		<h3 class="panel-title">
			{{ trans('admin.announcements') }}
			<span class="side-right">
				<a href="{{ url('admin/announcements/create') }}" class="btn btn-success">{{ trans('common.create') }}</a>
			</span>
		</h3>
	</div>
	<div class="panel-body">
		<div class="announcement-container table-responsive">
			@if(count($announcements) > 0)	
				<table class="table announcements-table">
					<thead>
				    	<th>{{ trans('admin.title') }}</th>
				        <th>{{ trans('common.description') }}</th>	 
				        <th>{{ trans('admin.start_date') }}</th>
				        <th>{{ trans('admin.end_date') }}</th>
				        <th>{{ trans('common.status') }}</th>
				        <th>{{ trans('admin.action') }}</th>
			    	</thead>
				    <tbody>
				     @foreach($announcements as $announcement)
				    	<tr>
				        	<td>{{ $announcement->title }}</td>
				            <td> 
				            	<span class="description">
				            		{{ $announcement->description }} 
				            		{{-- <div class="time">			 --}}
				            			<?php  $announce_date = date("F d Y, G:i A", strtotime($announcement->created_at))  ?>
				            			{{-- {{ $announce_date }}
				            		</div> --}}
				            		<div class="time">
				            			<span class="help-text"><i class="fa fa-eye"></i> {{ count($announcement->users) }}
				            			</span>
				            		</div> 
				            	</span>
							</td> 
							<td>
								{{ $announcement->start_date }}
							</td>
							<td>
								{{ $announcement->end_date }}
							</td>
							<?php  $status = $announcement->id == Setting::get('announcement') ? trans('admin.active') : trans('admin.inactive')  ?>
							<td>
								@if($status == "Active")
								<a href="{{ url('admin/activate/'.$announcement->id)}}" class="btn btn-success announcement-status" >{{ $status }}</a>
								@else
								<a href="{{ url('admin/activate/'.$announcement->id)}}" class="btn btn-default announcement-status" >{{ $status }}</a>
								@endif
							</td>
							<td>
								<ul class="list-inline">	
									<li><a href="{{ url('admin/announcements/'.$announcement->id.'/edit')}}"><span class="pencil-icon bg-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a></li>
									<li><a href="#" data-announcement-id="{{ $announcement->id }}" class="announce-delete"><span class="trash-icon bg-danger"><i class="fa fa-trash" aria-hidden="true"></i></span></a></li>
								</ul>
							</td>
				        </tr>			        
				        @endforeach
				    </tbody>
				</table>
				<div class="pagination-holder">
					{{ $announcements->render() }}
				</div>
			@else
				<div class="alert alert-warning">{{ trans('messages.no_announcements') }}</div>
			@endif
		</div>
	</div>
</div>
{!! Theme::asset()->container('footer')->usePath()->add('admin', 'js/admin.js') !!}
