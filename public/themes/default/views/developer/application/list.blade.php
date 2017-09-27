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
            <!-- Tab panes -->
            <div class="tab-content content-sett-app">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ route('developer.applications.index') }}">Applications</a>
                        </div>
                        <div class="panel-heading">
                            <a href="{{route('developer.applications.create')}}" class="btn btn-default">Create Application</a>
                        </div>
                        <div class="panel-body" style="padding: 20px">
                            @foreach ($applications as $application)
                                <div style="border-radius: 25px; border: 2px solid #0A246A;padding: 20px; ; margin: 5px">
                                    <a href="{{route('developer.applications.edit.details', array('id'=>$application->id))}}">
                                        <img src="{{static_uploads($application->image_icon)}}" width="40" height="40" style="margin-left: 10px"/>
                                            {{ $application->title }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="panel-heading">
                            <a href="{{route('developer.applications.create')}}" class="btn btn-default">Create Application</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>