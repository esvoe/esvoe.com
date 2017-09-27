<h1>{{ trans('messages.create_a_new_message') }}</h1>
{{ Form::open(['route' => 'messages.store']) }}
<div class="col-md-6">
    <!-- Subject Form Input -->
    <div class="form-group">
        {{ Form::label('username', trans('common.username'), ['class' => 'control-label']) }}
        {{ Form::text('recipients[]', null, ['class' => 'form-control selectize', 'id'=>"messageReceipient"]) }}
    </div>

    <!-- Message Form Input -->
    <div class="form-group">
        {{ Form::label('message', trans('common.message'), ['class' => 'control-label']) }}
        {{ Form::textarea('message', null, ['class' => 'form-control']) }}
    </div>
 
    <!-- Submit Form Input -->
    <div class="form-group">
        {{ Form::submit(trans('auth.submit'), ['class' => 'btn btn-primary form-control']) }}
    </div>
</div>
{{ Form::close() }}
