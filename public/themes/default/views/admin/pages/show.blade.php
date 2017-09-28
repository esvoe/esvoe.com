<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
		<h3 class="panel-title">
			{{ trans('common.manage_pages') }}
		</h3>
	</div>
	<div class="panel-body timeline">
		<div class="col-md-offset-9">
			{{ Form::label('sort by', 'Sort by:') }}
			{!! Form::select('manage_users', array('name_asc' => trans('admin.name_asc'), 'name_desc' => trans('admin.name_desc'), 'likes_asc' => trans('common.likes_asc'), 'likes_desc' => trans('common.likes_desc')), Request::get('sort'), ['class' => 'form-control pagesort']) !!}
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
							<th>{{ trans('common.likes') }}</th> 
							<th>{{ trans('admin.options') }}</th> 
							<th>&nbsp;</th> 
						</tr>
					</thead>
					<tbody>
						@foreach($timelines as $timeline)
						<tr>
							@if($timeline->page)	
								<td>&nbsp;</td>	
								<td>{{ $timeline->page->id }}</td>
								<td><a href="#"><img src="@if($timeline->page->avatar) {{ url('page/avatar/'.$timeline->page->avatar) }} @else {{ url('page/avatar/default-page-avatar.png') }} @endif" alt="{{ $timeline->name }}" title="{{ $timeline->name }}"></a><a href="{{ url($timeline->username) }}"> {{ $timeline->name }}</a></td>
								<td>{{ $timeline->page->likes->count() }}</td> 
								<td>
									<ul class="list-inline">
										<li><a href="{{ url('admin/pages/'.$timeline->username.'/edit')}}"><span class="pencil-icon bg-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a></li>
										<li><a href="{{ url('admin/pages/'.$timeline->page->id.'/delete')}}" onclick="return confirm('{{ trans("messages.are_you_sure") }}')"><span class="trash-icon bg-danger"><i class="fa fa-trash" aria-hidden="true"></i></span></a></li>
									</ul>
								</td>
								<td>&nbsp;</td> 
							@endif
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
				<div class="pagination-holder">
					{{ $timelines->render() }}
				</div>	
			@else
				<div class="alert alert-warning">{{ trans('messages.no_pages') }}</div>
			@endif
		</div>
	</div>
