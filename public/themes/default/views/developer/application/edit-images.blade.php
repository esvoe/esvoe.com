<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
</style>
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
                                <a href="{{route('developer.applications.edit.permissions', array('id' => $application->id))}}" class="btn btn-default">Permissions</a>
                                <a href="{{route('developer.applications.edit.images', array('id' => $application->id))}}" class="btn btn-primary">Images</a>
                            </div>


                            {!! Form::open([
                                'route' => array('developer.applications.edit.images', $application->id),
                                'method' => 'post',
                                'enctype'=>"multipart/form-data",
                                'files'=>"true"
                            ]) !!}

                            <div style="padding: 2em;">
                                <div class="form-group">
                                    <label>Main image</label>
                                    <img src="{{static_uploads($application->image_main)}}"/>
                                    {!! Form::input('file', 'image_main', null, array('class'=>'form-control-8')) !!}
                                    <small>description</small>
                                </div>
                                <div class="form-group">
                                    <label>Promo image</label>
                                    <img src="{{static_uploads($application->image_promo)}}"/>
                                    {!! Form::input('file', 'image_promo', null, array('class'=>'form-control-8')) !!}
                                    <small>description</small>
                                </div>

                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Screenshots
                        </div>
                        <div class="panel-body" style="padding: 1em">
                            <div data-container="screenshot-list">
                                @foreach($screenshots as $screenshot)
                                    <img src="{{static_uploads($screenshot->path)}}" class="img-thumbnail" style="height: 148px" width="230" height="148">
                                @endforeach
                            </div>


                            <div data-container="screenshot-uploader">

                                <div class="input-group" style="margin-top:2em">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file">
                                            Browse… <input type="file" id="imgInp">
                                        </span>
                                    </span>
                                    <input type="text" class="form-control" readonly>
                                </div>

                                <div>
                                    <img src="" id="img-upload" class="img-thumbnail" style="height: 148px" width="230" height="148">
                                </div>

                                <button class="btn btn-default" data-action="upload-screenshot">Upload file</button>

                            </div>
                        </div>
                        <div class="panel-footer text-right">

                        </div>
                    </div>






                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    $(function(){

        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('#img-upload').hide();

        $('[data-container="screenshot-uploader"] :text').val('');
        $('[data-container="screenshot-uploader"] :file').val('');



        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }

        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);

                }

                reader.readAsDataURL(input.files[0]);
                $('#img-upload').show();
            }
        }

        $("#imgInp").change(function(){
            var file = this.files[0];
            var match = ["image/jpeg", "image/png", "image/jpg"];

            if ( !( (file.type == match[0]) || (file.type == match[1]) || (file.type == match[2]) ) )
            {
                // remove preview

                $('#message').html('<div class="alert alert-warning" role="alert">Unvalid image format. Allowed formats: JPG, JPEG, PNG.</div>');

                return false;
            }
            readURL(this);
        });


        $('[data-action="upload-screenshot"]').on('click', function(e) {
            e.preventDefault();

            console.log("upload");

            var blobFile = $('#imgInp')[0].files[0];

            if (!blobFile) {
                console.log("no file");
                return;
            }

            var fd = new FormData();
            fd.append("fileToUpload", blobFile);
            fd.append('_token', $('meta[name="csrf_token"]').attr('content'))

            // 458x295

            $.ajax({
                url: "upload_screenshot", // Url to which the request is send
                type: "POST",             // Type of request to be send, called as method
                data: fd, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
            })
                .done(function(response){
                    console.log("resp", response);
                    if (response.status === "200") {


                        $('div[data-container="screenshot-list"]').append($(response.content));
                    }
                    $('#img-upload').hide();
                    $('[data-container="screenshot-uploader"] :text').val('');
                    $('[data-container="screenshot-uploader"] :file').val('');
                })
                .error(function(error){
                    console.log("error:", error)
                    $('#img-upload').hide();
                    $('[data-container="screenshot-uploader"] :text').val('');
                    $('[data-container="screenshot-uploader"] :file').val('');
                });
        });

    }); // ready end

</script>