<div class="container container-grid">
    <div class="row">
        <div class="col-sm-3">
            <div class="wrap-name-game">
                <div class="img-sett-name"></div>
                <div class="name-game">Developer</div>
                <div class="clearfix"></div>
            </div>
            <!-- Nav tabs -->
            {!! Theme::partial('developer.menu') !!}
        </div>
        <div class="col-sm-9">

            <div class="tab-content content-sett-app">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-heading">
                                <a href="{{ route('developer.applications.index') }}">Applications</a> - Create Application
                            </div>
                        </div>
                        <div class="panel-body" style="padding: 20px">
                            @include('flash::message')

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            {!! Form::open([
                                'route'=>'developer.applications.create',
                                'method'=>'post',
                            ]) !!}

                            <div class="form-group">
                                {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                <small>Desc</small>
                            </div>

                            <div class="form-group">
                                <div class="">{!! Form::label('type', 'Application type', ['class' => 'control-label']) !!}</div>
                                    {!! Form::select('type', array(
                                    '1' => 'Internal Application',
                                    '2' => 'External Application',
                                ), null, array('class'=>'form-control')) !!}
                                <small>Desc</small>
                            </div>

                            {!! Form::submit(trans('developer.common.create'), ['class' => 'btn btn-primary']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>