

@include('flash::message')
@if (!session()->has('flash_notification.message'))
<div class="alert alert-warning">
	{{ trans('common.edit_on_risk') }}
</div>
@endif
@if($count > 0)
	<form action="{{ url('admin/update-database')  }}" method="POST" role="form">
		{{ csrf_field() }}
		<button type="submit" class="btn btn-block btn-danger">{{ trans('common.update_now') }}</button>
	</form>
@else
	<div class="alert alert-success">
		<strong>{{ trans('messages.no_pending_updates') }}</strong>
	</div>
@endif
<br>

<pre class="text-center">
{!! $output !!}
</pre>