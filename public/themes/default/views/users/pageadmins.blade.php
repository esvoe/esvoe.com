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
							<div class="panel-heading no-bg panel-settings">
								<h3 class="panel-title">
									{{ trans('common.admins') }}
								</h3>
							</div>
							<div class="panel-body">

							@if(count($page_admins) > 0)
								<ul class="list-group page-likes">
									@foreach($page_admins as $page_admin)

									<li class="list-group-item holder">
										<div class="connect-list">
											<div class="connect-link side-left">
												<a href="{{ url(url($page_admin->username)) }}">
													<img src="{{ $page_admin->avatar }}" alt="{{ $page_admin->name }}" class="img-icon img-30" title="{{ $page_admin->name }}">
													{{ $page_admin->name }}
												</a>
												@if($page_admin->verified)
													<span class="verified-badge bg-success">
									                    <i class="fa fa-check"></i>
									                </span>
									            @endif
											</div>										
											
												@if($page->is_admin($page_admin->pivot->user_id) && $page->is_admin(Auth::user()->id))
												<div class="side-right follow-links">
												<div class="row">
													<form class="margin-right" method="POST" action="{{ url('/member/updatepage-role/') }}">
														{{ csrf_field() }}
														@if(count($page_admins) > 1)

															{{ Form::hidden('user_id', $page_admin->id) }}
															{{ Form::hidden('page_id', $page->id) }}

															<div class="col-md-5 col-sm-5 col-xs-5 padding-5">
																{{ Form::select('member_role', $roles, $page_admin->pivot->role_id , array('class' => 'form-control')) }}
															</div>
															<div class="col-md-3 col-sm-3 col-xs-3 padding-5">
																{{ Form::submit(trans('common.assign'), array('class' => 'btn btn-to-follow btn-success')) }}
															</div>
															<div class="left-col col-md-4 col-sm-4 col-xs-4 padding-5">
																<a href="#" class="btn btn-to-follow btn-default remove-pagemember remove" data-user-id="{{ $page_admin->id }} - {{ $page->id }}">
																	<i class="fa fa-trash"></i> {{ trans('common.remove') }} 
																</a>
															</div>
														
														@endif
													</form>
												
												</div>
												@endif
											</div>
											<div class="clearfix"></div>
										</div>
									</li>
									@endforeach
								</ul>
							@else
								<div class="alert alert-warning">{{ trans('messages.no_admin') }}</div>
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
