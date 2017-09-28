<div class="container container-grid">
    <div class="row">
        <div class="col-sm-3">
            <div class="wrap-name-game">
                <div class="img-sett-name">
                    @if ($application->image_icon)
                    <img src="{{static_uploads($application->image_icon)}}"/>
                    @else
                    @endif
                </div>
                <div class="name-game">{{$application->title}}</div>
                <div class="clearfix"></div>
            </div>
            <!-- Nav tabs -->
            {!! Theme::partial('developer.menu') !!}
        </div>
        <div class="col-sm-9">
            <!-- Tab panes -->
            <div class="tab-content content-sett-app">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ route('developer.applications.index') }}">Applications</a> &gt; {{$application->title}}(Application) &gt; Details
                        </div>
                        <div class="panel-body">

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


                            <div class="panel" style="padding: 1em">
                                <a href="{{route('developer.applications.edit.details', array('id' => $application->id))}}" class="btn btn-default">Details</a>
                                <a href="{{route('developer.applications.edit.container', array('id' => $application->id))}}" class="btn btn-default">Container</a>
                                <a href="{{route('developer.applications.edit.external', array('id' => $application->id))}}" class="btn btn-default">Endpoints</a>
                                <a href="{{route('developer.applications.edit.permissions', array('id' => $application->id))}}" class="btn btn-primary">Permissions</a>
                                <a href="{{route('developer.applications.edit.images', array('id' => $application->id))}}" class="btn btn-default">Images</a>
                            </div>

                            {!! Form::open([
                                                            'route' => array('developer.applications.edit.permissions', $application->id),
                                                            'method' => 'post',
                                                        ]) !!}

                            <div style="padding: 2em;">


                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
