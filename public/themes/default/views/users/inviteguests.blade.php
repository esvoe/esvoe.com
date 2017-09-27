<!-- main-section -->

<div class="container">
	<div class="row">
		<div class="col-md-10">
			{!! Theme::partial('event-header',compact('timeline','event')) !!}

			<div class="row">
				<div class=" timeline">
					<div class="col-md-4">

						{!! Theme::partial('event-leftbar',compact('timeline','event','event_guests')) !!}
					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-heading no-bg panel-settings">
								<h3 class="panel-title">
									{{ trans('common.invitemembers') }}
								</h3>
							</div>
							<div class="panel-body">
								<form class="navbar-form sp-navbar-form " role="search">
									<div class="form-group full-width">
										<input type="text" data-url="{{ URL::to('api/v1/timelines') }}" class="form-control full-width" id="add-members-event"  data-event-id="{{ $event->id }}" placeholder="Search for people">
									</div>
								</form>
								<div class="event-suggested-users"></div>
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
