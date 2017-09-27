@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Timeline</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($timeline, ['route' => ['timelines.update', $timeline->id], 'method' => 'patch']) !!}

            @include('timelines.fields')

            {!! Form::close() !!}
        </div>
@endsection