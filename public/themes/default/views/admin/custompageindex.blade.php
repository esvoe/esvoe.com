<div class="panel panel-default">
@include('flash::message')
<div class="panel-heading no-bg panel-settings">
	<h3 class="panel-title">
		{{ trans('admin.custom_pages') }}	
		<div class="btn-custom btn-rtl">
			<a class="btn btn-success" href="{{ url('admin/custom-pages/create') }}">Create</a>
		</div>
	</h3>

</div>
<div class="panel-body">	
	<div class="announcement-container">	
		<table class="table table-responsive" id="timelines-table">
		    <thead>
		    	<th>{{ trans('admin.title') }}</th>
		        <th>{{ trans('common.description') }}</th>
		        <th>{{ trans('common.status') }}</th>
		        <th colspan="3">{{ trans('admin.action') }}</th>
		    </thead>
		    <tbody>
		    @foreach($staticpages as $staticpage)
		        <tr>	        	
		        	<td>{{ $staticpage->title }}</td>
		            <td>{{ str_limit($staticpage->description,50) }}</td>
		             <?php $status = $staticpage->active == 1 ? trans('admin.active') : trans('admin.inactive'); ?>
		            <td>{{ $status }}</td>
					<td><a href="{{ url('admin/custom-pages/'.$staticpage->id.'/edit')}}">{{ trans('common.edit') }}</a></td>              		            
		        </tr>
		    @endforeach			    
		    </tbody>
		</table>			
	</div>
</div>
</div>