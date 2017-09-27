<div class="container container-grid">
    <div class="row">
        <div class="col-sm-3">
            <div class="wrap-name-game">
                <div class="img-sett-name"></div>
                <div class="name-game">Application create</div>
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
                            Create category
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
                                'route' => array('developer.manage.categories.create'),
                                'method' => 'post',
                                'enctype'=>"multipart/form-data",
                                'files'=>"true"
                            ]) !!}

                            <tr>
                                <td class="label-td">{!! Form::label('type', 'Parent', ['class' => 'control-label']) !!}</td>
                                <td class="form-control-field">
                                    {{ Form::select('parent_id', $categories ,$category->parent_id, array('class'=>'form-control')) }}
                                </td>
                            </tr>

                            <div class="form-group">
                                {!! Form::label('title', 'Title:', ['class' => 'control-label']) !!}
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
                                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                            </div>

                            <tr>
                                <td class="label-td">Small image:</td>
                                <td class="form-control-field">
                                    <input class="form-control text-input" name="image_small" type="file">
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td">Large image:</td>
                                <td class="form-control-field">
                                    <input class="form-control text-input" name="image_large" type="file">
                                </td>
                            </tr>

                            {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>