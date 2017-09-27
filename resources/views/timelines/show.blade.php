@extends('layouts.app')

@section('content')
    @include('timelines.show_fields')

    <div class="form-group">
           <a href="{!! route('timelines.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
