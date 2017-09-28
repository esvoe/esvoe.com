@if(Auth::user()->newThreadsCount() > 0)
	<span class="label label-danger">{{ $count }}</span>
@endif