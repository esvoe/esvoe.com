<div class="container container-grid">
    <div class="row">
        <div class="col-sm-3">
            <div class="wrap-name-game">
                <div class="img-sett-name"></div>
                <div class="name-game">Application categories</div>
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
                            Categories
                        </div>
                        <div class="panel-heading">
                            <a href="{{route('developer.manage.categories.create')}}" class="btn btn-default">Create</a>
                        </div>
                        <div class="panel-body" style="padding: 1em;">
                            <ul class="list-group">
                            @foreach($categories as $category)
                                @if (isset($category['children']))
                                    <li class="list-group-item">
                                        <div class="panel">
                                        <a href="{{route('developer.manage.categories.edit', array('id'=> $category->id))}}">
                                            {{$category->title}}
                                        </a>
                                        <ul class="list-group">
                                    @foreach($category['children'] as $category)

                                                <li class="list-group-item" draggable="true">
                                                    <a href="{{route('developer.manage.categories.edit', array('id'=> $category->id))}}">
                                                    {{$category->title}}
                                                    </a>
                                                </li>

                                    @endforeach
                                        </ul>
                                        </div>
                                    </li>
                                @else
                                        <li class="list-group-item" draggable="true">
                                            <a href="{{route('developer.manage.categories.edit', array('id'=> $category->id))}}">
                                                {{$category->title}}
                                            </a>
                                        </li>
                                @endif
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>