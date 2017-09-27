<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="usersModalLabel">{{ $heading }}</h4>
</div> 
<div class="modal-body">
    <div class="user-follow socialite">
    @foreach($users as $user)
            <div class="media">
                    <div class="media-left">
                        <a href="{{ url($user->username) }}">
                            <img src="{{ $user->avatar }}" class="img-icon" alt="{{ $user->name }}" title="{{ $user->name }}">
                        </a>
                    </div>
                    <div class="media-body socialte-timeline follow-links">
                        <h4 class="media-heading">{{ $user->name }} <span class="text-muted">{{ '@'.$user->username }}</span></h4>
                        @if($user->timeline_id != Auth::user()->timeline_id)
                            @if(!$user->followers->contains(Auth::user()->id))
                                <div class="btn-follow">
                                    <a href="#" class="btn btn-default follow-user follow" data-timeline-id="{{ $user->timeline->id }}"> <i class="fa fa-heart"></i> {{ trans('common.follow') }}</a>
                                </div>
                                <div class="btn-follow hidden">
                                    <a href="#" class="btn btn-success follow-user unfollow" data-timeline-id="{{ $user->timeline->id }}"><i class="fa fa-check"></i> {{ trans('common.following') }}</a>
                                </div>
                            @else                            
                                <div class="btn-follow hidden">
                                    <a href="#" class="btn btn-default follow-user follow" data-timeline-id="{{ $user->timeline->id }}"> <i class="fa fa-heart"></i> {{ trans('common.follow') }}</a>
                                </div>
                                <div class="btn-follow">
                                    <a href="#" class="btn btn-success follow-user unfollow" data-timeline-id="{{ $user->timeline->id }}"><i class="fa fa-check"></i> {{ trans('common.following') }}</a>
                                </div>    
                            @endif
                        @endif    
                    </div>
                </div>
    @endforeach
</div>
</div>

