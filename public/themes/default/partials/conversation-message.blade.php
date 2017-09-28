<li class="message-conversation">
	<div class="media post-list">
		<div class="media-left">
			<a href="#">
				<img src="{{ $message->sender->avatar }}" alt="images"  class="img-radius img-46">
	   		</a>
	  	</div>
  		<div class="media-body ">
	    	<h4 class="media-heading">
	    		<a href="#">{{ $message->sender->name }}</a>
    			<time class="post-time text-muted timeago" datetime="@{{ $message->created_at }}+00:00" title="@{{ $message->created_at }}+00:00">
                    @{{ $message->created_at }}+00:00
                  </time>
	    	</h4>
			<p class="post-text">
		    	{{ $message->description }}
			</p>
  		</div>
	</div>
</li>