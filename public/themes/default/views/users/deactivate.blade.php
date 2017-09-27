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
						@include('flash::message')
						<div class="panel panel-default">
							<div class="panel-heading no-bg panel-settings">
								<h3 class="panel-title">
									{{ trans('common.deactivate_account') }}
								</h3>
							</div>
							<div class="panel-body no-padding">
								<div class="accout-deactivate">
									<img src="{{  Theme::asset()->url('images/delete-img.png') }}" alt="images">
									<div class="delete-text">
										{{ trans('messages.confirm_deactivate_question') }}
									</div>
								</div>
								<div class="delete-btn">
									<form action="{{ url(Auth::user()->username.'/deleteme') }}" class="user-delete-form">
										<button type="button" class="btn btn-delete-user btn-danger">{{ trans('messages.yes_deactivate') }}</button>
									</form>
								</div>
							</div>
						<!--ending first panel-->
						
						
						</div>
					</div>
				</div>
			</div>
		<!-- </div> -->