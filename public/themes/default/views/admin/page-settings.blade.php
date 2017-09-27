<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
		<h3 class="panel-title">
			{{ trans('common.page_settings') }}
		</h3>
	</div>
	<div class="panel-body">
		@include('flash::message')

		<form method="POST" action="{{ url('admin/page-settings') }}">

			{{ csrf_field() }}
			<div class="privacy-question">

				<ul class="list-group">
					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							{{ Form::label('page_member_privacy', trans('admin.page_member_privacy')) }}
							{{ Form::select('page_member_privacy', array('members' => trans('common.members'), 'only_admins' => trans('admin.only_admins')), Setting::get('page_member_privacy', 'only_admins'), ['class' => 'form-control', 'placeholder' => trans('admin.please_select')]) }}
						</fieldset>						
					</li>

					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							{{ Form::label('page_timeline_post_privacy', trans('admin.page_timeline_post_privacy')) }}
							{{ Form::select('page_timeline_post_privacy', array('everyone' => trans('common.everyone'), 'only_admins' => trans('admin.only_admins')) , Setting::get('page_timeline_post_privacy', 'everyone') , ['class' => 'form-control', 'placeholder' => trans('admin.please_select')]) }}
						</fieldset>
					</li>
				</ul>
				<div class="pull-right">
					{{ Form::submit(trans('common.save_changes'), ['class' => 'btn btn-success']) }}
				</div>
			</div>
		{{ Form::close() }}
		
	</div>
</div><!-- /panel -->

<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
		<h3 class="panel-title">
			{{ trans('admin.manage_page_categories') }}
			<span class="btn-custom btn-rtl">
				<a href="{{ url('admin/category/create') }}" class="btn btn-default">{{ trans('admin.create_category') }}</a>
			</span>
		</h3>
	</div>
	<div class="panel-body">
		<div class="announcement-container table-responsive">	
			<table class="table announcements-table">
				<thead>
			    	<th>{{ trans('admin.name') }}</th>
			        <th>{{ trans('common.description') }}</th>	 
			        <th>{{ trans('common.status') }}</th>
			        <th>{{ trans('admin.action') }}</th>
		    	</thead>
			    <tbody>
			     @foreach($categories as $categorie)
			    	<tr>
			        	<td>{{ $categorie->name }}</td>
			            <td> 
			            	<span class="description">
			            		{{ str_limit($categorie->description, 50) }}			            		 
			            	</span>
						</td> 
						<td>
							@if($categorie->active == 1)
								{{ trans('admin.active') }}
							@else
								{{ trans('admin.inactive') }}
							@endif
						</td>
						<td>
							<ul class="list-inline">	
								<li><a href="{{ url('admin/category/'.$categorie->id.'/edit')}}"><span class="pencil-icon bg-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a></li>
								<li><a href="#" data-categorie-id="{{ $categorie->id }}" class="category-delete"><span class="trash-icon bg-danger"><i class="fa fa-trash" aria-hidden="true"></i></span></a></li>
							</ul>
						</td>
			        </tr>			        
			        @endforeach
			    </tbody>
			</table>
			<div class="pagination-holder">
				{{ $categories->render() }}
			</div>	
		</div>
	</div>
</div>
{!! Theme::asset()->container('footer')->usePath()->add('admin', 'js/admin.js') !!}
