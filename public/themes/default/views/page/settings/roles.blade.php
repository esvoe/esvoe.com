<!-- <div class="main-content"> -->
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="post-filters">
				{!! Theme::partial('pagemenu-settings',compact('timeline')) !!}
			</div>
		</div>
		<div class="col-md-8">						
			<div class="post-filters">
				<div class="panel panel-default">
				@include('flash::message')
					<div class="panel-heading">
						<h3 class="panel-title">{{ trans('common.manage_roles') }}</h3>
					</div>
					<div class="panel-body">						
						<div class="holder">
							<p>{{ trans('messages.manage_roles_text') }}</p>
						</div>
						@if(count($page_members) > 0)
						<ul class="list-group page-likes">
							
							@foreach($page_members as $page_member)
							<li class="list-group-item holder">
								<div class="connect-list">
									<div class="connect-link side-left">
										<div class="follower">
											<a href="{{ url(url($page_member->username)) }}">
												<img src="{{ $page_member->avatar }}" alt="{{ $page_member->name }}" class="img-icon img-30" title="{{ $page_member->name }}">
												{{ $page_member->name }}
											</a>
										</div>
									</div>
									@if($page->is_admin(Auth::user()->id))
									<div class="side-right follow-links">
										<div class="row">	

											<form class="margin-right" method="POST" action="{{ url('/member/updatepage-role/') }}">
												{{ csrf_field() }}

												<div class="col-md-5 col-sm-5 col-xs-5 padding-5">
													{{ Form::select('member_role', $roles, $page_member->pivot->role_id , array('class' => 'form-control')) }}
												</div>

												{{ Form::hidden('user_id', $page_member->id) }}
												{{ Form::hidden('page_id', $page->id) }}

												<div class="col-md-3 col-sm-3 col-xs-3 padding-5">
													{{ Form::submit(trans('common.assign'), array('class' => 'btn btn-to-follow btn-default')) }}
												</div>

												<div class="col-md-4 col-sm-4 col-xs-4 padding-5">
													<a href="#" class="btn btn-to-follow btn-default remove-pagemember remove" data-user-id="{{ $page_member->id }} - {{ $page->id }}">
														<i class="fa fa-trash"></i> {{ trans('common.remove') }} 
													</a>
												</div>
											</form>	

											
										</div>
									</div>
									@endif
									<div class="clearfix"></div>
								</div>
							</li>
							@endforeach
						</ul>
						@else
						<div class="alert alert-warning">
							{{ trans('messages.no_members_to_admin') }}
						</div>
						@endif	
						
					</div>
				</div><!-- /panel -->
			</div>
		</div><!-- /col-md-8 -->
	</div>
	</div><!-- /container -->