<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
		<h3 class="panel-title">
			{{ trans('common.manage_groups') }}
		</h3>
	</div>
	<div class="panel-body timeline">
		<div class="col-md-offset-9">
			{{ Form::label('sort by', 'Sort by:') }}
			{!! Form::select('manage_users', array('name_asc' => trans('admin.name_asc'), 'name_desc' => trans('admin.name_desc'), 'open_group' => trans('common.open_group'), 'closed_group' => trans('common.closed_group'), 'secret_group' => trans('common.secret_group'), 'member_asc' => trans('common.member_asc'), 'member_desc' => trans('common.member_desc')), Request::get('sort'), ['class' => 'form-control groupsort']) !!}
		</div>

		@include('flash::message')
		@if(count($timelines) > 0)
			<div class="table-responsive manage-table">
				<table class="table existing-products-table socialite">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>{{ trans('admin.id') }}</th> 
							<th>{{ trans('auth.name') }}</th>
							<th>{{ trans('common.type') }}</th>
							<th>{{ trans('common.members') }}</th> 
							<th>{{ trans('admin.options') }}</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						@foreach($timelines as $timeline)
						<tr>
							<td>&nbsp;</td>	
							<td>{{ $timeline->groups->id }}</td>
							<td><a href="#"><img src="@if($timeline->groups->avatar) {{ url('group/avatar/'.$timeline->groups->avatar) }} @else {{ url('group/avatar/default-group-avatar.png') }} @endif" alt="{{ $timeline->name }}" title="{{ $timeline->name }}"></a><a href="{{ url($timeline->username) }}"> {{ $timeline->name }}</a></td> 
							<td><span class="label label-default">{{$timeline->groups->type}}</span></td>
							<td>{{ $timeline->groups->users->count() }}</td> 
							<td>
								<ul class="list-inline">
									<li><a href="{{ url('admin/groups/'.$timeline->username.'/edit')}}"><span class="pencil-icon bg-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a></li>
									<li><a href="{{ url('admin/groups/'.$timeline->groups->id.'/delete')}}" onclick="return confirm('{{ trans("messages.are_you_sure") }}')"><span class="trash-icon bg-danger"><i class="fa fa-trash text-danger" aria-hidden="true"></i></span></a></li>
								</ul>

							</td>
							<td>&nbsp;</td> 
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
				<div class="pagination-holder groupnation">
					{{ $timelines->render() }}
				</div>	
			@else
				<div class="alert alert-warning">{{ trans('messages.no_groups') }}</div>
			@endif
		</div>
	</div>
