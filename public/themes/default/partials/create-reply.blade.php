<style xmlns="http://www.w3.org/1999/html">
    .youtube-iframe-comment > iframe {
        width: 100%;
    }
</style>
<div class="block-what-comment comment-other-comment comment-reply" style="display: none">
    <div class="photo-what-new" style="background-image: url('{{ Auth::user()->avatar }}');"></div>
    <div class="form-group">
        {{--<textarea data-emojiable="true" class="form-control" placeholder="Коментувати"></textarea>--}}
        <form action="#" class="comment-form">
            {{--<input type="text" data-emojiable="true" class="form-control post-comment" placeholder="Коментувати" data-post-id="{{ $post->id }}" data-comment-id="{{ $comment->id }}" name="post_comment"/>--}}
            <textarea cols="1" rows="1" data-emojiable="true" class="form-control post-comment" placeholder="Коментувати" data-post-id="{{ $post->id }}" data-comment-id="{{ $comment->id }}" name="post_comment"/></textarea>
            <input type="file" class="comment-images-upload hidden" multiple="multiple" accept="image/jpeg,image/png,image/gif" name="post_images_upload[]" id="post_images_upload[]">
            <input type="hidden" name="youtube_title" value="">
            <input type="hidden" name="youtube_video_id" value="">
        </form>

        <div class="youtube-iframe-comment" style="padding-top: 5px"></div>
        <div class="video-addon post-addon" style="display: none">
            <span class="post-addon-icon"><i class="fa fa-film"></i></span>
            <div class="form-group">
                <input type="text" name="youtubeText" id="youtubeText" class="form-control youtube-text"
                       placeholder="{{ trans('messages.what_are_you_watching') }}" value="">
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="images-selected comment-images-selected" style="display:none">
            <span>3</span> {{ trans('common.photo_s_selected') }}
        </div>
        <div id="post-image-holder"></div>

        <div class="emoticons-wrapper post-addon" style="display:none"></div>

        <div class="comment-new-add">
            {{--<span data-add-new="people" class="add-what-people"><img src="{!! Theme::asset()->url('images/_new/what-new-people.png') !!}" alt="icon-what-new"></span>--}}
            <span data-add-new="photo" class="add-what-photo" id="imageUploadComment"><img src="{!! Theme::asset()->url('images/_new/what-new-photo.png') !!}" alt="icon-what-new"></span>
            {{--<span data-add-new="place" class="add-what-place"><img src="{!! Theme::asset()->url('images/_new/what-new-marker.png') !!}" alt="icon-what-new"></span>--}}
            <span data-add-new="youtube" class="add-what-youtube video-upload"><img src="{!! Theme::asset()->url('images/_new/what-new-youtube.png') !!}" alt="icon-what-new"></span>
            <span data-add-new="smile" class="add-what-smile emoticons-view" {{--id="emoticons"--}}><img src="{!! Theme::asset()->url('images/_new/what-new-smile.png') !!}" alt="icon-what-new"></span>
        </div>
    </div>
</div>


</div>