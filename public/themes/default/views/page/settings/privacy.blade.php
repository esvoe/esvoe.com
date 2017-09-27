<!-- <div class="main-content"> -->
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="post-filters">
				{!! Theme::partial('pagemenu-settings',compact('timeline')) !!}
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
			@include('flash::message')
				<div class="panel-heading no-bg panel-settings">
					<h3 class="panel-title">
						{{ trans('common.privacy_settings') }}
					</h3>
				</div>
				<div class="panel-body nopadding">
					<div class="socialite-form">						
						<form class="form-inline" action="{{ url('/'.$username.'/page-settings/privacy') }}" method="POST">
							{{ csrf_field() }}

							<div class="privacy-question">

								<ul class="list-group">
									<li href="#" class="list-group-item">
										<fieldset class="form-group">
											{{ Form::label('timeline_post_privacy', trans('common.label_page_timeline_post_privacy'), ['class' => 'control-label']) }}

											{{ Form::select('timeline_post_privacy', array('everyone' => trans('common.everyone'), 'only_admins' => trans('common.admins')), $page_details->timeline_post_privacy, array('class' => 'form-control col-sm-6')) }}
										</fieldset>
									</li>

									<li href="#" class="list-group-item">
										<fieldset class="form-group">
											{{ Form::label('member_privacy', trans('common.label_page_member_privacy')) }}
											{{ Form::select('member_privacy', array('members' => trans('common.members'), 'only_admins' => trans('common.admins')), $page_details->member_privacy, array('class' => 'form-control col-sm-6')) }}
										</fieldset>
									</li>
								</ul>
								<div class="pull-right">
									{{ Form::submit(trans('common.save_changes'), ['class' => 'btn btn-success']) }}
								</div>
								<div class="clearfix"></div>
							</div>	
						</form>

					</div><!-- /socialite-form -->
				</div>
			</div><!-- /panel -->
			
		</div>
	</div><!-- /row -->
</div>
<!-- </div> --><!-- /main-content -->