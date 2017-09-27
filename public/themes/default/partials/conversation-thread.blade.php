@if($latest_conversation)
<input type="hidden" name="conversation_id" class="conversation-id" value="{{ $latest_conversation->id }}">
<div class="conversation">
	<div class="left-side">
		
		@foreach($latest_conversation->messages as $key =>  $message)
			@if($message->sender->id != Auth::user()->id)
				{{ $message->sender->name }} <span class="chat-status"></span>
			@endif
			@break
		@endforeach
	</div>
	<div class="right-side">
		<ul class="list-inline primary-list">
			<li>
				<ul class="pagination">
		    		<li>
				    	<a href="#">
				        	<i class="fa fa-pencil" aria-hidden="true"></i>
				      	</a>
		    		</li>
				    <li>
				    	<a href="#">
				    		<i class="fa fa-reply" aria-hidden="true"></i>
				    	</a>
				    </li>
				    <li>
				    	<a href="#">
				        	<i class="fa fa-trash" aria-hidden="true"></i>
				      	</a>
		    		</li>
		  		</ul><!-- /pagination -->
			</li>
		</ul><!-- /primary-list -->
	</div>
	<div class="clearfix"></div>
</div>

	<ul class="list-unstyled coversations-thread smooth-scroll"> 

		@foreach($latest_conversation->messages as $message)
			{!! Theme::partial('conversation-message',compact('message')) !!}	
		@endforeach
		<div class="hidden">
		<li class="message-conversation current-user">
			<div class="media post-list">
				<div class="media-left">
					<a href="#">
			    		<img src="{!! Theme::asset()->url('images/avatar.png"') !!} class="img-icon img-46" alt="">
			   		</a>
			  	</div>
			  	<div class="media-body ">
			    	<h4 class="media-heading"><a href="#">jordan jackson</a><span class="text-muted">8:32AM</span></h4>
					 <p class="post-text">
				    	I have internet for 9 month and nevere could benefit from the full capacity of 5Mbit/s as it is filtered by O2 
					</p>
			  	</div>
			</div>
		</li>
		<li>
			<div class="message-divider">
				<div class="day">
					tuesday
				</div>
			</div>
		</li>
		<li class="message-conversation">
			<div class="media post-list">
				<div class="media-left">
					<a href="#">
			    		<img src="{!! Theme::asset()->url('images/avatar-bessie.png') !!}" class="img-icon img-46" alt="">
			   		</a>
			  	</div>
			  	<div class="media-body ">
			    	<h4 class="media-heading"><a href="#">bessie berry</a><span class="text-muted">8:34AM</span></h4>
					<p class="post-text">
				    	Funny comparison. so would the proper antivirus not slow down the internet as much or do you mean a 
						freebie doenst protect the computer from viruses?
					</p>
				  </div>
			</div>
		</li>
		<li class="message-conversation">
			<div class="media post-list">
				<div class="media-left">
					<a href="#">
			    		<img src="{!! Theme::asset()->url('images/avatar.png"') !!} class="img-icon img-46" alt="">
			   		</a>
			  	</div>
			  	<div class="media-body ">
			    	<h4 class="media-heading"><a href="#">jordan jackson</a><span class="text-muted">8:39AM</span></h4>
					<p class="post-text">
				    	I pay for the 4Mb/sec down, 512 Kb/sec up service from O2, and haven't had any problems. In fact, it's relatively 
					</p>
			  	</div>
			</div>
			 <div class="post-pictures">
		    	<div class="row post-row">
					<div class="col-md-4 image-col">
						<div class="img-holder">
							<a href="#"><img src="{!! Theme::asset()->url('images/nature8.png') !!}" alt="images">
								<div class="img-search">
									<i class="fa fa-search-plus"></i>
								</div>
							</a>
						</div>
					</div>
					<div class="col-md-4 image-col">
						<div class="img-holder">
							<a href="#">
								<img src="{!! Theme::asset()->url('images/nature8.png') !!}" alt="images">
								<div class="img-search">
									<i class="fa fa-search-plus"></i>
								</div>
							</a>
						</div>
					</div>
					<div class="col-md-4 image-col">
						<div class="img-holder">
							<a href="#"><img src="{!! Theme::asset()->url('images/nature8.png') !!}" alt="images">
								<div class="img-search">
									<i class="fa fa-search-plus"></i>
								</div>
							</a>
						</div>
					</div>
		    	</div>
		    </div>
		</li>
		<li>
			<div class="message-divider blue">
				<div class="day">
					new messages
				</div>
			</div>
		</li>
		<li class="message-conversation">
			<div class="media post-list">
				<div class="media-left">
					<a href="#">
			    		<img src="{!! Theme::asset()->url('images/avatar-bessie.png') !!}" class="img-icon img-46" alt="">
			   		</a>
			  	</div>
			  	<div class="media-body ">
			    	<h4 class="media-heading"><a href="#">bessie berry</a><span class="text-muted">8:45AM</span></h4>
					<p class="post-text">
				    	Funny comparison. so would the proper antivirus not slow down the internet as much or do you mean a 
						freebie doenst protect the computer from viruses?
					</p>
			  	</div>
			</div>
		</li>
		</div>
	</ul>

@endif