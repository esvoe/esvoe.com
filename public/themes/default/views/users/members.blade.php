<!-- main-section -->

<div class="container">
	<div class="row">
		<div class="col-md-10">

			{!! Theme::partial('group-header',compact('timeline','group')) !!}
			
			<div class="row">
				<div class=" timeline">
					<div class="col-md-4">
						
						{!! Theme::partial('group-leftbar',compact('timeline','group','group_members','group_events','ongoing_events','upcoming_events')) !!}
					</div>

					<div class="col-md-8">												

						<div class="panel panel-default">
							<div class="panel-heading no-bg panel-settings">
								<h3 class="panel-title">
									{{ trans('common.members') }}
								</h3>
							</div>
							<div class="panel-body">
								@include('flash::message')
								@if(count($group_members) > 0)
								<ul class="list-group page-likes">
									@foreach($group_members as $group_member)
									<li class="list-group-item holder">
										<div class="connect-list">
											<div class="connect-link side-left">
												<a href="{{ url($group_member->username) }}">													
													<img src="{{ $group_member->avatar }}" alt="{{ $group_member->name }}" class="img-icon img-30" title="{{ 
														$group_member->name }}">
													{{ $group_member->name }}
												</a>
												@if($group_member->verified)
									              <span class="verified-badge bg-success">
									                    <i class="fa fa-check"></i>
									                </span>
									            @endif
											</div>
											@if($group->is_admin(Auth::user()->id))
											<div class="side-right follow-links">
												<div class="row">	

												<form class="margin-right" method="POST" action="{{ url('/member/update-role/') }}">
													{{ csrf_field() }}

													<div class="col-md-5 col-sm-5 col-xs-5 padding-5">
														{{ Form::select('member_role', $member_role_options, $group_member->pivot->role_id , array('class' => 'form-control')) }}
													</div>

													{{ Form::hidden('user_id', $group_member->id) }}
													{{ Form::hidden('group_id', $group_id) }}

													<div class="col-md-3 col-sm-3 col-xs-3 padding-5">
														{{ Form::submit(trans('common.assign'), array('class' => 'btn btn-to-follow btn-default')) }}
													</div>

													<div class="col-md-4 col-sm-4 col-xs-4 padding-5">
														<a href="#" class="btn btn-to-follow btn-default remove-member remove" data-user-id="{{ $group_member->id }} - {{ $group_id }}">
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
								<div class="alert alert-warning">{{ trans('messages.no_members') }}</div>
								@endif
							</div><!-- /panel-body -->
							
						</div>

					</div><!-- /col-md-8 -->
				</div><!-- /main-content -->
			</div><!-- /row -->
		</div><!-- /col-md-10 -->

		<div class="col-md-2">
			{!! Theme::partial('timeline-rightbar') !!}
		</div>
	</div>
</div><!-- /container -->
