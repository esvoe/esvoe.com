<div class="container container-grid">
    <div class="row">
        <div class="col-sm-3">
            <div class="wrap-name-game">
                <div class="img-sett-name"></div>
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
                                <a href="{{route('developer.applications.edit.details', array('id' => $application->id))}}" class="btn btn-primary">Details</a>
                                <a href="{{route('developer.applications.edit.container', array('id' => $application->id))}}" class="btn btn-default">Container</a>
                                <a href="{{route('developer.applications.edit.external', array('id' => $application->id))}}" class="btn btn-default">Endpoints</a>
                                <a href="{{route('developer.applications.edit.permissions', array('id' => $application->id))}}" class="btn btn-default">Permissions</a>
                                <a href="{{route('developer.applications.edit.images', array('id' => $application->id))}}" class="btn btn-default">Images</a>
                            </div>


                            {!! Form::open([
                                'route' => array('developer.applications.edit.details', $application->id),
                                'method' => 'post',
                                'enctype'=>"multipart/form-data",
                                'files'=>"true"
                            ]) !!}

                                <table class="table table-field">
                                    <tr>
                                        <td class="label-td">Название:</td>
                                        <td class="form-control-field">
                                            {{ Form::text('title', $application->title, array('class' => 'form-control text-input')) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td">Описание:</td>
                                        <td class="form-control-field">
                                            {{ Form::textarea('description', $application->description, array('class' => 'form-control', 'cols'=>'30', 'rows'=>'5')) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="label-td">Category:</td>
                                        <td class="form-control-field">
                                            {{ Form::select('category_id', $categories ,$application->category_id, array('class'=>'form-control')) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="label-td">Enabled</td>
                                        <td class="form-control-field">
                                            {{ Form::checkbox('is_active', '1', ($application->is_active == 1), array('class' => 'form-control text-input')) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="label-td">Public</td>
                                        <td class="form-control-field">
                                            {{ Form::checkbox('is_visible', '1', ($application->is_visible == 1), array('class' => 'form-control text-input')) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="label-td">Icon image:</td>
                                        <td class="form-control-field">
                                            <img src="{{static_uploads($application->image_icon)}}"/>
                                            <input class="form-control text-input" name="image_icon" type="file">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="label-td"></td>
                                        <td class="form-control-field header-td-app">
                                            <button class="btn btn-primary">Сохранить изменения</button>
                                        </td>
                                    </tr>
                                </table>
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
