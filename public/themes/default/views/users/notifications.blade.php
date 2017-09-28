<!-- main-section -->
<!-- <div class="main-content"> -->
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="post-filters">
					{!! Theme::partial('usermenu-settings') !!}
				</div>
			</div>
			<div class="col-md-8">
				
				<div class="panel panel-default">
					<div class="panel-heading no-bg panel-settings">
						<h3 class="panel-title">
							{{ trans('common.email_notifications') }}
						</h3>
					</div>
					<div class="panel-body">
						@include('flash::message')

						{{ Form::open(array('class' => 'form-inline','url' => Auth::user()->username.'/settings/notifications', 'method' => 'post')) }}

						{{ csrf_field() }}
						
						<div class="privacy-question">
							<ul class="list-group">
								<li href="#" class="list-group-item">
									<fieldset class="form-group">
										{{ Form::label('email_follow', trans('common.label_email_follow')) }}
										{{ Form::select('email_follow', array('yes' => trans('common.yes'), 'no' => trans('common.no')), $userSettings->email_follow, array('class' => 'form-control')) }}
									</fieldset>
								</li>
								<li href="#" class="list-group-item">
									<fieldset class="form-group">
										{{ Form::label('email_like_post', trans('common.label_email_like_post')) }}
										{{ Form::select('email_like_post', array('yes' => trans('common.yes'), 'no' => trans('common.no')), $userSettings->email_like_post, array('class' => 'form-control')) }}
									</fieldset>
								</li>
								<li href="#" class="list-group-item">
									<fieldset class="form-group">
										{{ Form::label('email_post_share', trans('common.label_email_post_share')) }}
										{{ Form::select('email_post_share', array('yes' => trans('common.yes'), 'no' => trans('common.no')), $userSettings->email_post_share, array('class' => 'form-control')) }}
									</fieldset>
								</li>
								<li href="#" class="list-group-item">
									<fieldset class="form-group">
										{{  Form::label('email_comment_post', trans('common.label_email_comment')) }}
										{{ Form::select('email_comment_post', array('yes' => trans('common.yes'), 'no' => trans('common.no')), $userSettings->email_comment_post, array('class' => 'form-control')) }}
									</fieldset>
								</li>
								<li href="#" class="list-group-item">
									<fieldset class="form-group">
										{{ Form::label('email_like_comment', trans('common.label_email_like_comment')) }}
										{{ Form::select('email_like_comment', array('yes' => trans('common.yes'), 'no' => trans('common.no')), $userSettings->email_like_comment, array('class' => 'form-control')) }}
									</fieldset>
								</li>
								<li href="#" class="list-group-item">
									<fieldset class="form-group">
										{{ Form::label('email_reply_comment', trans('common.label_email_reply_comment')) }}
										{{ Form::select('email_reply_comment', array('yes' => trans('common.yes'), 'no' => trans('common.no')), $userSettings->email_reply_comment, array('class' => 'form-control')) }}
									</fieldset>
								</li>
								<li href="#" class="list-group-item">
									<fieldset class="form-group">
										{{ Form::label('email_join_group', trans('common.label_email_join_group')) }}
										{{ Form::select('email_join_group', array('yes' => trans('common.yes'), 'no' => trans('common.no')), $userSettings->email_join_group, array('class' => 'form-control')) }}
									</fieldset>
								</li>
								<li href="#" class="list-group-item">
									<fieldset class="form-group">
										{{ Form::label('email_like_page', trans('common.label_email_like_page')) }}
										{{ Form::select('email_like_page', array('yes' => trans('common.yes'), 'no' => trans('common.no')), $userSettings->email_like_page, array('class' => 'form-control')) }}
									</fieldset>
								</li>
							</ul>
							<div class="pull-right">
								{{ Form::submit(trans('common.save_changes'), ['class' => 'btn btn-success']) }}
							</div>
						</div>
						{{ Form::close() }}
					</div>
				</div><!-- /panel -->
				
			</div>
		</div><!-- /row -->
	</div>
<!-- </div> --><!-- /main-content