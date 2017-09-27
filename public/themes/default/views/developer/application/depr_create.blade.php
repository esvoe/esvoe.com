<div class="container container-grid">
    <div class="row">
        <div class="col-sm-3">
            <div class="wrap-name-game">
                <div class="img-sett-name"></div>
                <div class="name-game">{{trans('developer.title_main')}}</div>
                <div class="clearfix"></div>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs li-tab-app" role="tablist">
                <li class="active"><a href="{{route('developer.home')}}">{{ trans('developer.menu.home') }}</a></li>
                <li><a href="{{route('developer.applications')}}">{{trans('developer.menu.applications')}}</a></li>
                <li><a href="{{route('developer.documents')}}">{{trans('developer.menu.documents')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-9">
            <!-- Tab panes -->
            <div class="tab-content content-sett-app">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-heading">
                                <a href="{{ route('developer.applications') }}">{{ trans('developer.common.applications') }}</a> - {{trans('developer.common.new_app')}}
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
                                'route'=>'developer.application.create',
                                'method'=>'post',
                            ]) !!}

                            <div class="form-group">
                                {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                <small>Application title</small>
                            </div>

                            <div class="form-group">
                                {!! Form::label('description', trans('developer.common.description'), ['class' => 'control-label']) !!}
                                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('type', 'Type:', ['class'=> 'control-label']) !!}
                                <br />
                                {!! Form::select('type', array(
                                    '1' => 'Internal',
                                    '2' => 'External',
                                ), ['class'=> 'control-label']) !!}
                                <br />
                                <small>Application type</small>
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