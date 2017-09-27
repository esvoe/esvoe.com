<!-- <div class="main-content"> -->
	<div class="container container-grid">
		<div class="row">

			<!-- List of user pages-->

			<div class="col-md-6">
				<div class="post-filters pages-groups">
					
					<div class="panel panel-default">
						<div class="panel-heading no-bg panel-settings">
							<div class="side-right">
								<a href="{{ url(Auth::user()->username.'/create-page') }}" class="btn btn-success">{{ trans('common.create_page') }}</a>
							</div>
							<h3 class="panel-title">
								{{ trans('messages.pages-manage') }}
							</h3>
							
						</div>
						<div class="panel-body">
							@if(count($userPages))
								
							<ul class="list-group page-likes">
								@foreach($userPages as $userpage)
								<li class="list-group-item deletepage">
									<div class="connect-list">
										<div class="connect-link side-left">
											<a href="{{ url($userpage->username) }}">
												<img src=" @if($userpage->timeline_id && $userpage->avatar) {{ url('page/avatar/'.$userpage->avatar) }} @else {{ url('page/avatar/default-page-avatar.png') }} @endif" alt="{{ $userpage->name }}" title="{{ $userpage->name }}">{{ $userpage->name }}
											</a>
										</div>
										<div class="side-right">
											<a href="" class="side-right delete-page delete_page" data-pagedelete-id="{{ $userpage->id }}"><i class="fa fa-close text-danger"></i></a>
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
							<div class="side-right">
								<a href="{{ url(Auth::user()->username.'/create-group') }}" class="btn btn-success">{{ trans('common.create_group') }}</a>
							</div>
							<h3 class="panel-title">
								{{ trans('messages.groups-manage') }}
							</h3>
						</div>
						<div class="panel-body">
							@if(count($groupPages))
								
							<ul class="list-group page-likes">
								@foreach($groupPages as $grouppage)
								<li class="list-group-item deletegroup">
									
									<div class="connect-list">
										<div class="connect-link side-left">
											
											<a href="{{ url($grouppage->username) }}">
												<img src=" @if($grouppage->timeline_id && $grouppage->avatar) {{ url('group/avatar/'.$grouppage->avatar) }} @else {{ url('group/avatar/default-group-avatar.png') }} @endif" alt="{{ $grouppage->name }}" title="{{ $grouppage->name }}">{{ $grouppage->name }}
											</a>
											<span class="label label-default">{{ $grouppage->type }}</span>

										</div>
										<div class="side-right">
											<a href="#" class="side-right delete-group delete_group" data-groupdelete-id="{{ $grouppage->id }}"><span class="trash-icon bg-danger"><i class="fa fa-trash text-danger"></i></span></a>
										</div>
										<div class="clearfix"></div>
									</div><!-- /connect-list -->
								</li>
								@endforeach
							</ul>
							@else
								<div class="alert alert-warning">
									{{ trans('messages.no_groups') }}
								</div>
							@endif
						</div>
					</div>

				</div><!-- /panel -->
			</div>
		</div><!-- /row -->
	</div>
<!-- </div> --><!-- /main-content -->