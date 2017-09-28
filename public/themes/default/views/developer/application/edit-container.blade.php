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
                                <a href="{{route('developer.applications.edit.container', array('id' => $application->id))}}" class="btn btn-primary">Container</a>
                                <a href="{{route('developer.applications.edit.external', array('id' => $application->id))}}" class="btn btn-default">Endpoints</a>
                                <a href="{{route('developer.applications.edit.permissions', array('id' => $application->id))}}" class="btn btn-default">Permissions</a>
                                <a href="{{route('developer.applications.edit.images', array('id' => $application->id))}}" class="btn btn-default">Images</a>
                            </div>


                            <div style="padding: 2em;">

                                {!! Form::open([
                                    'route' => array('developer.applications.edit.container', $application->id),
                                    'method' => 'post',
                                    'enctype'=>"multipart/form-data",
                                    'files'=>"true"
                                ]) !!}

                                <div class="form-group">
                                    <label>Applicaton ID:</label>
                                    {!! Form::text(null, $application->id, array('class'=>'form-control', 'readonly'=>'readonly', 'style'=>'cursor: text;')) !!}
                                    <small>description</small>
                                </div>

                                <div class="form-group">
                                    <label>Main container URL:</label>
                                    {!! Form::text('url_main', $application->url_main, array('class'=>'form-control')) !!}
                                    <small>description</small>
                                </div>

                                <div class="form-group">
                                    <label>Main API Callback URL:</label>
                                    {!! Form::text('api_url', $application->api_url, array('class'=>'form-control')) !!}
                                    <small>description</small>
                                </div>

                                <div class="form-group">
                                    <label>Main API KEY:</label>
                                    <a href="#" onclick="return genNewApiKey();">(Update)</a>
                                    {!! Form::text('api_key', $application->api_key, array('class'=>'form-control', 'readonly'=>'readonly', 'style'=>'cursor: text;')) !!}
                                    <small>description</small>
                                </div>

                                <div class="form-group">
                                    <label>Main PAY KEY:</label>
                                    <a href="#" onclick="return genNewPaySign();">(Update)</a>
                                    {!! Form::text('pay_key', $application->pay_sign, array('class'=>'form-control', 'readonly'=>'readonly', 'style'=>'cursor: text;')) !!}
                                    <small>description</small>
                                </div>

                                <button type="submit" class="btn btn-default">Submit</button>
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function genNewPaySign() {
        var token = $('meta[name="csrf_token"]').attr('content');

        $.ajax('{!! route('developer.applications.ajax.update_pay_key',array('id'=> $application->id)) !!}',
            {
                method: "POST",
                data: {
                    _token: token
                },
                dataType: 'JSON',
            }
        ).done(function(response) {
            if (response['status'] !== '200' ) {
                console.log(response['message']);
                return;
            }
            $("input[name='pay_sign']").val(response['pay_sign']);
        });
        return false;
    }

    function genNewApiKey() {
        var token = $('meta[name="csrf_token"]').attr('content');

        $.ajax('{!! route('developer.applications.ajax.update_api_key',array('id'=> $application->id)) !!}',
            {
                method: "POST",
                data: {
                    _token: token
                },
                dataType: 'JSON',
            }
        ).done(function(response) {
            if (response['status'] !== '200' ) {
                console.log(response['message']);
                return;
            }

            $("input[name='api_key']").val(response['api_key']);
        });
        return false;
    }
</script>