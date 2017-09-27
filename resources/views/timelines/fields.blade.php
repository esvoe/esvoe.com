<!-- Username Field -->
<div class="form-group col-sm-6">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- About Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('about', 'About:') !!}
    {!! Form::textarea('about', null, ['class' => 'form-control']) !!}
</div>

<!-- Avatar Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('avatar_id', 'Avatar Id:') !!}
    {!! Form::number('avatar_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Cover Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cover_id', 'Cover Id:') !!}
    {!! Form::number('cover_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Cover Position Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cover_position', 'Cover Position:') !!}
    {!! Form::text('cover_position', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('timelines.index') !!}" class="btn btn-default">Cancel</a>
</div>
