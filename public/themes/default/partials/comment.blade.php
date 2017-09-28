<div class="own-comment-block comment{{ $comment->id }} main-comment" id="comment{{ $comment->id }}" name="comment{{ $comment->id }}">
    <div class="photo-user-comment" style="background-image: url('{{ $comment->user->avatar }}'); cursor: pointer" onClick="window.location.href = '{{ url($comment->user->username) }}';"></div>
    <div class="comment-desc-block">
        <h5>
            <a href="{{ url($comment->user->username) }}">{{ $comment->user->name }}</a>
            {{--<span>13:31 21:05:17</span>--}}
            <span><time class="post-time timeago" datetime="{{ $comment->created_at }}+03:00" title="{{ $comment->created_at }}+03:00">{{ $comment->created_at }}+03:00</time></span>
        </h5>
        {{--<p>У нас все получится, за нами -правда. Вся мыслящая Украина с Вами, Михаил!</p>--}}
        <p>{!! nl2br($comment->description) !!}</p>
        <div class="post-image-holder  @if(count($comment->images()->get()) == 1) single-image @endif">
            @foreach($comment->images()->get() as $commentImage)
                @if($commentImage->type=='image')
                    <a href="{{ url('user/gallery/'.$commentImage->source) }}" data-lightbox="imageGallery.{{ $comment->id }}">
                        <img src="{{ url('user/gallery/'.$commentImage->source) }}" title="{{ $comment->user->name }}" alt="{{ $comment->user->name }}" style="max-width: 100%; max-height: 200px;">
                    </a>
                @endif
            @endforeach
        </div>
        @if($comment->youtube_video_id)
            <p><iframe src="https://www.youtube.com/embed/{{ $comment->youtube_video_id }}" frameborder="0" allowfullscreen></iframe></p>
        @endif
        <span class="answer-comment show-comment-reply">
            Ответить
        </span>
        <span class="like-comment {{ $comment->comments_liked->contains(Auth::user()->id)?'liked-comment':'' }}">
            <span class="like-comment-new" data-comment-id="{{ $comment->id }}"><i class="fa fa-heart" aria-hidden="true"></i></span>
            <?php
            $liked_ids = $comment->comments_liked->pluck('id')->toArray();
            $liked_names = $comment->comments_liked->pluck('name')->toArray();?>
            <span class="count show-users-modal" data-html="true" data-heading="{{ trans('common.likes') }}" data-users="{{ implode(',', $liked_ids) }}" data-original-title="{{ implode('<br />', $liked_names) }}">
                {{ $comment->comments_liked->count() }}
            </span>
        </span>
        <span class="complain-comment">
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background: #000">
                <img src="{!! Theme::asset()->url('images/_new/comment-dots.png') !!}" alt="" style="height: auto; width: auto">
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    @if($comment->user_id == Auth::user()->id)
                        <li><a href="#" class="delete-comment delete_comment" data-commentdelete-id="{{ $comment->id }}"><i class="fa fa-eye-slash" aria-hidden="true"></i>{{ trans('common.remove') }}</a></li>
                        <li><a href="#" class="edit-comment edit_comment" data-commentedit-id="{{ $comment->id }}"><i class="fa fa-edit" aria-hidden="true"></i>{{ trans('common.edit') }}</a></li>
                    @endif
                    @if($comment->user_id != Auth::user()->id)
                        <li><a href="#" class="hide-comment" data-comment-id="{{ $comment->id }}"><i class="fa fa-eye-slash" aria-hidden="true"></i>{{ trans('common.unshare') }}</a></li>
                        <li><a href="#" class="comment-report" data-comment-id="{{ $comment->id }}"><i class="fa fa-flag" aria-hidden="true"></i>{{ trans('common.report') }}</a></li>
                    @endif
                </ul>
            </div>
        </span>
    </div>

    <div class="comment-replies">
    @if($comment->replies()->count() > 0 )
        @foreach($comment->replies as $reply)
            @if (!$reply->user_hidden()->where('user_id', Auth::user()->id)->first())
            {!! Theme::partial('reply',compact('reply','post')) !!}
            @endif
        @endforeach
    @endif
    </div>

    {!! Theme::partial('create-reply',compact('comment','post')) !!}

{{--    <div class="show-next-comment">
        Переглянути наступних 45
    </div>--}}

{{--    <div class="show-next-comment"
         data-post-id="{{ $post->id }}"
         data-comment-next-page-url="{{ isset($comment_next_page_url)?$comment_next_page_url:'/ajax/get-next-post-comments?page=2' }}">
        Переглянути наступних 10
    </div>--}}
