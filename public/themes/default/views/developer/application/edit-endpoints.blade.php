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
                        <div class="panel-body" data-container="endpoints">

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
                                <a href="{{route('developer.applications.edit.external', array('id' => $application->id))}}" class="btn btn-primary">Endpoints</a>
                                <a href="{{route('developer.applications.edit.permissions', array('id' => $application->id))}}" class="btn btn-default">Permissions</a>
                                <a href="{{route('developer.applications.edit.images', array('id' => $application->id))}}" class="btn btn-default">Images</a>
                            </div>

                            <div style="padding: 1em" data-container="endpoint-list">

                                @foreach($endpoints as $endpoint)
                                <div class="panel panel-default">
                                    <div class="panel-body" style="padding: 1em">
                                        <div class="input-group ">
                                            <span class="input-group-addon" style="min-width:300px; text-align: left;">NAME</span>
                                            {!! Form::input('text','name', $endpoint->name, array('class'=>'form-control', 'readonly'=>'readonly', 'style'=>'cursor: text', 'placeholder'=>'Generated value')) !!}
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="min-width:300px; text-align: left;">SITE URI</span>
                                            {!! Form::input('text','site', $endpoint->url, array(
                                            'class'=>'form-control',
                                            'placeholder' => 'https://your-app-domain/'
                                            )) !!}
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="min-width:300px; text-align: left;">REDIRECT URI</span>
                                            {!! Form::input('text','redirect', $endpoint->redirect, array(
                                            'class'=>'form-control',
                                            'placeholder' => 'https://your-app-domain/redirect'
                                            )) !!}
                                        </div>
                                    </div>
                                    <div class="panel-footer text-right">
                                        <button class="btn btn-primary" data-action="endpoint-update">Update</button>
                                        <button class="btn btn-danger" data-action="endpoint-delete">Remove</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div style="padding: 1em" data-container="endpoint-new">

                                <div class="panel panel-danger" data-form-name="create_endpoint">
                                    <div class="panel-heading">
                                        Create new endpoint
                                    </div>
                                    <div class="panel-body" style="padding: 1em">

                                        <div class="alert alert-danger hide fade in">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon" style="min-width:300px; text-align: left;">SITE URI</span>
                                            <input type="text" class="form-control" name="site" placeholder="https://your-app-domain/">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="min-width:300px; text-align: left;">REDIRECT URI</span>
                                            <input type="text" class="form-control" name="redirect" placeholder="https://your-app-domain/redirect">
                                        </div>
                                    </div>
                                    <div class="panel-footer text-right">
                                        <button class="btn btn-primary"  data-action="endpoint-create">Create</button>
                                    </div>
                                </div>

                            </div>

                            <div class="hidden" style="display:none;">

                                <div class="panel panel-default" data-template="endpoint" style="display:none;">
                                    <div class="panel-body" style="padding: 1em">
                                        <div class="input-group ">
                                            <span class="input-group-addon" style="min-width:300px; text-align: left;">NAME</span>
                                            <input type="text" class="form-control" readonly="readonly" style="cursor: text" name="name" placeholder="Generated value">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="min-width:300px; text-align: left;">SITE URI</span>
                                            <input type="text" class="form-control" name="site" placeholder="https://your-app-domain/">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="min-width:300px; text-align: left;">REDIRECT URI</span>
                                            <input type="text" class="form-control" name="redirect" placeholder="https://your-app-domain/redirect">
                                        </div>
                                    </div>
                                    <div class="panel-footer text-right">
                                        <button class="btn btn-primary" data-action="endpoint-update">Update</button>
                                        <button class="btn btn-danger" data-action="endpoint-delete">Remove</button>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $('[data-container="endpoints"]')
        .on('click', '[data-action="endpoint-create"]', function (e) {
            e.preventDefault();

            console.log("end-p-create");

            var $panel = $(this).parents('.panel:first');
            $panel.css("pointer-events", "none");
            $panel.animate({ opacity: 0.4 }, 300);

            var site_uri = $panel.find('input[name="site"]').val();
            var redirect_uri = $panel.find('input[name="redirect"]').val();

            $.ajax('create_endpoint', {
                'method':'post',
                'data': {
                    '_token':token,
                    'site': site_uri,
                    'redirect': redirect_uri
                }
            })
                .done(function(response){
                    if (response.status === '200' && response.data) {
                        console.log("created");
                        var $template = $('div[data-template="endpoint"]').clone();
                        $template.removeAttr('data-template');

                        $template.find('input[name="name"]').val(response.data.name);
                        $template.find('input[name="site"]').val(response.data.site);
                        $template.find('input[name="redirect"]').val(response.data.redirect);

                        $('div[data-container="endpoint-list"]').append($template);

                        $template.slideDown();

                        $panel.find('input').val('');
                    }
                })
                .error(function(error){

                });
            $panel.css("pointer-events", "auto");
            $panel.animate({
                opacity: 1.0
            }, 300);
        })
        .on('click', '[data-action="endpoint-update"]', function(e) {
            e.preventDefault();

            var $panel = $(this).parents('.panel:first');
            $panel.css("pointer-events", "none");
            $panel.animate({ opacity: 0.4 }, 300);

            $panel.find('input')
                .addClass('has-error');


            $.ajax('update_endpoint', {
                'method': 'post',
                'data': {
                    '_token': $('meta[name="csrf_token"]').attr('content'),
                    'name': $panel.find('input[name="name"]').val(),
                    'url': $panel.find('input[name="site"]').val(),
                    'redirect': $panel.find('input[name="redirect"]').val()
                }
            }).done(function (response) {
                $panel.css("pointer-events", 'auto');
                $panel.animate({
                    opacity: 1.0
                }, 300);
            }).error(function(error) {
                $panel.css("pointer-events", 'auto');
                $panel.animate({
                    opacity: 1.0
                }, 300);
            });

        })
        .on('click', '[data-action="endpoint-delete"]', function(e) {
            e.preventDefault();

            var $panel = $(this).parents('.panel:first');
            $panel.css("pointer-events", "none");
            $panel.animate({ opacity: 0.4 }, 300);

            $.ajax('delete_endpoint', {
                'method': 'post',
                'data': {
                    '_token': $('meta[name="csrf_token"]').attr('content'),
                    'endpoint': $panel.find('input[name="name"]').val()
                }
            }).done(function (response) {
                if (response.status === '200') {
                    $panel.slideUp(function () {
                        $panel.remove();
                    });
                    return;
                }
                $panel.css("pointer-events", 'auto');
                $panel.animate({
                    opacity: 1.0
                }, 300);

            }).error(function(error) {
                $panel.css("pointer-events", 'auto');
                $panel.animate({
                    opacity: 1.0
                }, 300);
            });

        });


</script>