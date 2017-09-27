<!-- <div class="main-content"> -->
	<div class="container">
		<div class="row">

			<!-- List of user pages-->

			<div class="col-md-6">
				<div class="post-filters pages-groups">
					
					<div class="panel panel-default">
						<div class="panel-heading no-bg panel-settings">
							<div class="side-right create-btn">
								<a href="{{ url(Auth::user()->username.'/create-page') }}" class="btn btn-success">{{ trans('common.create_page') }}</a>
							</div>
							<h3 class="panel-title small-heading">
								{{ trans('messages.pages-manage') }}
							</h3>
							
						</div>
						<div class="panel-body">
							@if(Auth::user()->own_pages()->count())
								
							<ul class="list-group page-likes">
								@foreach(Auth::user()->own_pages() as $userpage)
								<li class="list-group-item deletepage">
									<div class="connect-list">
										<div class="connect-link side-left">
											<a href="{{ url($userpage->username) }}">
												<img src=" @if($userpage->timeline_id && $userpage->avatar) {{ url('page/avatar/'.$userpage->avatar) }} @else {{ url('page/avatar/default-page-avatar.png') }} @endif" alt="{{ $userpage->name }}" title="{{ $userpage->name }}">{{ $userpage->name }}
											</a>
										</div>
										<div class="side-right">
											<a href="" class="side-right delete-page delete_page" data-pagedelete-id="{{ $userpage->id }}"><span class="trash-icon bg-danger"><i class="fa fa-trash text-danger"></i></span></a>
										</div>
										<div class="clearfix"></div>
									</div>
								</li>
								@endforeach
							</ul>
							@else
								<div class="alert alert-warning">
									{{ trans('messages.no_pages') }}
								</div>
							@endif
						</div>
					</div><!-- /panel -->
				</div>
			</div><!-- /col-md-6 -->
			
			<!-- List of user groups-->
			
			<div class="col-md-6">
				<div class="post-filters pages-groups">
					
					<div class="panel panel-default">
						<div class="panel-heading no-bg panel-settings">
							<h3 class="panel-title small-heading">
								{{ trans('common.joined_pages') }}
							</h3>
						</div>
						<div class="panel-body">
							@if(Auth::user()->joinedPages()->count())
								
							<ul class="list-group page-likes">
								@foreach(Auth::user()->joinedPages() as $joinpage)
								<li class="list-group-item holder">
									<div class="connect-list">
										<div class="connect-link side-left">
											<a href="{{ url($joinpage->username) }}">
												<img src=" @if($joinpage->timeline_id && $joinpage->avatar) {{ url('page/avatar/'.$joinpage->avatar) }} @else {{ url('page/avatar/default-page-avatar.png') }} @endif" alt="{{ $joinpage->name }}" title="{{ $joinpage->name }}">{{ $joinpage->name }}
											</a>
										</div>
										<div class="side-right page-unjoin">
											<div class="left-col">
												<a href="#" class="btn btn-success unjoin-page joined" data-timeline-id="{{ $joinpage->timeline_id }}">
													<i class="fa fa-check"></i> {{ trans('common.joined') }}
												</a>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
								</li>
								@endforeach
							</ul>
							@else
								<div class="alert alert-warning">
									{{ trans('messages.no_pages') }}
								</div>
							@endif
						</div>
					</div>

				</div><!-- /panel -->
			</div>
		</div><!-- /row -->
	</div>
<!-- </div> --><!-- /main-content -->