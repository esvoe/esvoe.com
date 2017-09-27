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
                            <a href="{{route('developer.manage.categories.index')}}">Categories</a>
                            Редактивароние категории {{$category->title}}
                        </div>
                        <div class="panel-heading">
                            <a href="{{route('developer.manage.categories.delete', array('id'=>$category->id))}}" class="btn btn-danger">Delete</a>
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
                                'route' => array('developer.manage.categories.edit', $category->id),
                                'method' => 'post',
                                'enctype'=>"multipart/form-data",
                                'files'=>"true"
                            ]) !!}


                            <tr>
                                <td class="label-td">{!! Form::label('parent_id', 'Parent category:', ['class' => 'control-label']) !!}</td>
                                <td class="form-control-field">
                                    {!! Form::select('parent_id', $categories, $category->parent_id, array('class'=>'form-control')) !!}
                                </td>
                            </tr>

                            <div class="form-group">
                                {!! Form::label('title', 'Title:', ['class' => 'control-label']) !!}
                                {!! Form::text('title', $category->title, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
                                {!! Form::textarea('description', $category->description, ['class' => 'form-control']) !!}
                            </div>

                            <tr>
                                <td class="label-td">Active</td>
                                <td class="form-control-field">
                                    {{ Form::checkbox('is_active', '1', ((int)$category->is_visible !== 0), array('class' => 'form-control text-input')) }}
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td">Visible</td>
                                <td class="form-control-field">
                                    {{ Form::checkbox('is_visible', '1', ((int)$category->is_visible !== 0), array('class' => 'form-control text-input')) }}
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td">small image:</td>
                                <td class="form-control-field">
                                    <img src="{{static_uploads($category->image_main)}}"/>
                                    <input class="form-control text-input" name="image_small" type="file">
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td">large image:</td>
                                <td class="form-control-field">
                                    <img src="{{static_uploads($category->image_main)}}"/>
                                    <input class="form-control text-input" name="image_large" type="file">
                                </td>
                            </tr>

                            {!! Form::submit('Update Category', ['class' => 'btn btn-primary']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>