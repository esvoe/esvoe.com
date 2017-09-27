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
									{{ trans('common.addmembers') }}
								</h3>
							</div>
							<div class="panel-body">
								<form class="navbar-form sp-navbar-form" role="search">
									<div class="form-group full-width">
										<input type="text" data-url="{{ URL::to('api/v1/timelines') }}" class="form-control full-width" id="add-members-group" data-group-id="{{ $group->id }}" placeholder="Search for people">
									</div>
								</form>
								<div class="group-suggested-users"></div>
							</div>
							
							
						</div><!-- /panel -->
					</div>
				</div><!-- /main-content -->
			</div><!-- /row -->
		</div><!-- /col-md-10 -->

		<div class="col-md-2">
			{!! Theme::partial('timeline-rightbar') !!}
		</div>
	</div>
</div><!-- /container -->
