<!-- main-section -->

<div class="container">
	<div class="row">
		<div class="col-md-10">

			{!! Theme::partial('page-header',compact('timeline','page')) !!}
			
			<div class="row">
				<div class=" timeline">
					<div class="col-md-4">
						
						{!! Theme::partial('page-leftbar',compact('timeline','page','page_members')) !!}
					</div>

					<div class="col-md-8">
					<div class="panel panel-default">
						@include('flash::message')
							<div class="panel-heading no-bg panel-settings">
								<h3 class="panel-title">
									{{ trans('common.members') }}
								</h3>
							</div>
							<div class="panel-body">								
								@if(count($page_members) > 0)
								<ul class="list-group page-likes">
									@foreach($page_members as $page_member)
									<li class="list-group-item holder">
										<div class="connect-list">
											<div class="connect-link side-left">
												<a href="{{ url($page_member->username) }}">													
													<img src="{{ $page_member->avatar }}" alt="{{ $page_member->name }}" class="img-icon img-30" title="{{ 
														$page_member->name }}">
													{{ $page_member->name }}
												</a>
												@if($page_member->verified)
													<span class="verified-badge bg-success">
									                    <i class="fa fa-check"></i>
									                </span>
									            @endif
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
