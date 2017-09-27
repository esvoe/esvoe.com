<div class="container container-grid">
    <div class="row">
        <div class="col-xs-12">




            <div>

                @foreach($links as $link)

                    <div class="panel panel-danger">
                        <div class="panel-content" style="padding: 1em">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="{{static_uploads($link->application->image_main)}}" />
                                </div>
                                <div class="col-sm-7">
                                    {{$link->application->title}}





                                    {!! Form::open(array(
                                        'route' => array('application.action.unlink'),
                                        'method' => 'post'
                                    )) !!}

                                    {{csrf_token()}}
                                    {!! Form::hidden('id', $link->id) !!}

                                    {!! Form::submit('remove', array('class'=>'btn btn-danger')) !!}

                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

        </div>
    </div>
</div>