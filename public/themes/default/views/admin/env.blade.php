

@include('flash::message')
@if (!session()->has('flash_notification.message'))
<div class="alert alert-warning">
	{{ trans('common.edit_on_risk') }}
</div>
@endif

<form action="{{ url('admin/save-env') }}" method="post">
	{{ csrf_field() }}
	<textarea class="form-control" name="env"  rows="30">{{ $env }}</textarea>

	<br>
	<button type="submit" class="btn pull-right btn-danger"> Save .ENV </button>	
</form>
