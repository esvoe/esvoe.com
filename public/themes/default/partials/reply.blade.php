<div class="own-comment-block answer-comment-block">
    <div class="photo-user-comment" style="background-image: url('{{ $reply->user->avatar }}'); cursor: pointer" onClick="window.location.href = '{{ url($reply->user->username) }}';"></div>
    <div class="comment-desc-block">
        <h5>
            <a href="{{ url($reply->user->username) }}">{{ $reply->user->name }}</a>
            {{--<span>13:31 21:05:17</span>--}}
            <span><time class="post-time timeago" datetime="{{ $reply->created_at }}+03:00" title="{{ $reply->created_at }}+03:00">{{ $reply->created_at }}+03:00</time></span>
        </h5>
        <p>{!! nl2br($reply->description) !!}</p>
        <div class="post-image-holder  @if(count($reply->images()->get()) == 1) single-image @endif">
            @foreach($reply->images()->get() as $replyImage)
                @if($replyImage ->type=='image')
                    <a href="{{ url('user/gallery/'.$replyImage->source) }}" data-lightbox="imageGallery.{{ $reply->id }}">
                        <img src="{{ url('user/gallery/'.$replyImage->source) }}" title="{{ $reply->user->name }}" alt="{{ $reply->user->name }}" style="max-width: 100%; max-height: 200px;">
                    </a>
                @endif
            @endforeach
        </div>
        @if($reply->youtube_video_id)
            <p><iframe src="https://www.youtube.com/embed/{{ $reply->youtube_video_id }}" frameborder="0" allowfullscreen></iframe></p>
        @endif
        {{--<p>У нас все получится, за нами -правда. Вся мыслящая Украина с Вами, Михаил!</p>--}}
        {{--<span class="like-comment like-comment-new {{ $reply->comments_liked->contains(Auth::user()->id)?'liked-comment':'' }}" data-comment-id="{{ $reply->id }}">
            <i class="fa fa-heart" aria-hidden="true"></i>
            <span class="count">{{ $reply->comments_liked->count() }}</span>
        </span>--}}
        <span class="like-comment {{ $reply->comments_liked->contains(Auth::user()->id)?'liked-comment':'' }}">
            <span class="like-comment-new" data-comment-id="{{ $reply->id }}"><i class="fa fa-heart" aria-hidden="true"></i></span>
            <?php
            $liked_ids = $reply->comments_liked->pluck('id')->toArray();
            $liked_names = $reply->comments_liked->pluck('name')->toArray();?>
            <span class="count show-users-modal" data-html="true" data-heading="{{ trans('common.likes') }}" data-users="{{ implode(',', $liked_ids) }}" data-original-title="{{ implode('<br />', $liked_names) }}">
            {{ $reply->comments_liked->count() }}
            </span>
        </span>
        <span class="complain-comment">
            {{--<img src="{!! Theme::asset()->url('images/_new/comment-dots.png') !!}" alt="">--}}
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background: #000">
                <img src="{!! Theme::asset()->url('images/_new/comment-dots.png') !!}" alt="" style="height: auto; width: auto">
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    @if($reply->user_id == Auth::user()->id)
                        <li><a href="#" class="delete-comment delete_comment" data-commentdelete-id="{{ $reply->id }}"><i class="fa fa-eye-slash" aria-hidden="true"></i>{{ trans('common.remove') }}</a></li>
                        <li><a href="#" class="edit-comment edit_comment" data-commentedit-id="{{ $reply->id }}"><i class="fa fa-edit" aria-hidden="true"></i>{{ trans('common.edit') }}</a></li>
                    @endif
                    @if($reply->user_id != Auth::user()->id)
                        <li><a href="#" class="hide-comment" data-comment-id="{{ $reply->id }}"><i class="fa fa-eye-slash" aria-hidden="true"></i>{{ trans('common.unshare') }}</a></li>
                        <li><a href="#" class="comment-report" data-comment-id="{{ $reply->id }}"><i class="fa fa-flag" aria-hidden="true"></i>{{ trans('common.report') }}</a></li>
                    @endif
                </ul>
            </div>
        </span>
    </div>
</div>