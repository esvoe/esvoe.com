 <div class="panel panel-default panel-post animated" id="post{{ $post->id }}">
  <div class="panel-heading no-bg">
    <div class="post-author">
      <div class="user-avatar">
        <a target="_blank" href="{{ url($post->user->username) }}"><img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" title="{{ $post->user->name }}"></a>
      </div>
      <div class="user-post-details">
        <ul class="list-unstyled no-margin">
          <li>
            <a target="_blank" href="{{ url($post->user->username) }}" class="user-name user">{{ $post->user->name }}</a>
            @if($post->users_tagged->count() > 0)
              {{ trans('common.with') }}
              <?php $post_tags = $post->users_tagged->pluck('name')->toArray()  ?>
              <?php $post_tags_ids = $post->users_tagged->pluck('id')->toArray()  ?>
              @foreach($post->users_tagged as $key => $user)
                @if($key==1)
                  {{ trans('common.and') }}
                    @if(count($post_tags)==1)
                      <a target="_parent" href="{{ url($user->username) }}"> {{ $user->name }}</a>
                    @else
                      <a href="#" target="_parent"> {{ count($post_tags).' '.trans('common.others') }}</a>
                    @endif
                  @break
                @endif
                <a target="_blank" href="{{ url($user->username) }}" class="user"> {{ array_shift($post_tags) }} </a>
              @endforeach
            
            @endif
          </li>
          <li>
            <time class="post-time timeago" datetime="{{ $post->created_at }}+03:00" title="{{ $post->created_at }}+03:00">sdfdfsdfsdfsd
              {{ $post->created_at }}+03:00
            </time>
            @if($post->location != NULL )
              {{ trans('common.at') }} 
              <span class="post-place">
                <a target="_blank" href="{{ url('/get-location/'.$post->location) }}"><i class="fa fa-map-marker"></i> {{ $post->location }}</a>
              </span>
          </li>
            @endif
          </ul>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div class="text-wrapper">
        <p>{{ $post->description }}</p>
        <div class="post-image-holder  @if(count($post->images()->get()) == 1) single-image @endif">
          @foreach($post->images()->get() as $postImage)
          <a target="_blank" href="{{ url('/post/'.$post->id) }}"><img src="{{ url('user/gallery/'.$postImage->source) }}"  title="{{ $post->user->name }}" alt="{{ $post->user->name }}"></a>
          @endforeach
        </div>
      </div>
      @if($post->youtube_video_id)
      <iframe src="https://www.youtube.com/embed/{{ $post->youtube_video_id }}" frameborder="0" allowfullscreen></iframe>
      @endif
      @if($post->soundcloud_id)
      <div class="soundcloud-wrapper">
        <iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/{{ $post->soundcloud_id }}&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
      </div>
      @endif
      <ul class="actions-count list-inline">
        
        @if($post->users_liked()->count() > 0)
        <?php
        $liked_ids = $post->users_liked->pluck('id')->toArray();
        $liked_names = $post->users_liked->pluck('name')->toArray();
        ?>
        <li>
          <a target="_blank" href="{{ url('/post/'.$post->id) }}"><span class="count-circle"><i class="fa fa-thumbs-up"></i></span> {{ $post->users_liked->count() }} {{ trans('common.likes') }}</a>
        </li>
        @endif
        
        @if($post->comments->count() > 0)
        <li>
          <a target="_blank" href="{{ url('/post/'.$post->id) }}"><span class="count-circle"><i class="fa fa-comment"></i></span>{{ $post->comments->count() }} {{ trans('common.comments') }}</a>
        </li>
        @endif
        
        @if($post->shares->count() > 0)
        <?php
        $shared_ids = $post->shares->pluck('id')->toArray();
        $shared_names = $post->shares->pluck('name')->toArray(); ?>
        <li>
          <a target="_blank" href="{{ url('/post/'.$post->id) }}"><span class="count-circle"><i class="fa fa-share"></i></span> {{ $post->shares->count() }} {{ trans('common.shares') }}</a>
        </li>
        @endif
        

      </ul>
    </div>
