<div class="post-filters">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">{{ trans('common.dashboard') }}</h3>
		</div>
		<div class="panel-body table-responsive">
				<table class="annual-statistics table text-center">
					<tr>
						<td class="registered">{{ trans('admin.users_registered') }}</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $today_user_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.today') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $month_user_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_month') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $year_user_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_year') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $total_user_count }}</div>
								<div class="sales">
									<a href="#" class="text-success">{{ trans('admin.total') }}</a>
								</div>
							</div>
						</td>
					</tr>

					<tr>
						<td class="registered">{{ trans('admin.pages_created') }}</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $today_page_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.today') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $month_page_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_month') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $year_page_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_year') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $total_page_count }}</div>
								<div class="sales">
									<a href="#" class="text-success">{{ trans('admin.total') }}</a>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td class="registered">{{ trans('admin.groups_created') }}</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $today_group_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.today') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $month_group_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_month') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $year_group_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_year') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $total_group_count }}</div>
								<div class="sales">
									<a href="#" class="text-success">{{ trans('admin.total') }}</a>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td class="registered">{{ trans('admin.posts_posted') }}</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $today_post_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.today') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $month_post_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_month') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $year_post_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_year') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $total_post_count }}</div>
								<div class="sales">
									<a href="#" class="text-success">{{ trans('admin.total') }}</a>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td class="registered">{{ trans('admin.comments_posted') }}</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $today_comment_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.today') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $month_comment_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_month') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $year_comment_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_year') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $total_comment_count }}</div>
								<div class="sales">
									<a href="#" class="text-success">{{ trans('admin.total') }}</a>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td class="registered">{{ trans('admin.posts_shared') }}</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $today_shared_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.today') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $month_shared_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_month') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $year_shared_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_year') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $total_shared_count }}</div>
								<div class="sales">
									<a href="#" class="text-success">{{ trans('admin.total') }}</a>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td class="registered">{{ trans('admin.posts_liked') }}</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $today_like_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.today') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $month_like_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_month') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $year_like_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_year') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $total_like_count }}</div>
								<div class="sales">
									<a href="#" class="text-success">{{ trans('admin.total') }}</a>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td class="registered">{{ trans('admin.posts_reported') }}</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $today_report_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.today') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $month_report_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_month') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $year_report_count }}</div>
								<div class="sales">
									<a href="#" class="text-primary">{{ trans('admin.this_year') }}</a>
								</div>
							</div>
						</td>
						<td>
							<div class="widget-sales">
								<div class="no-of-sales">{{ $total_report_count }}</div>
								<div class="sales">
									<a href="#" class="text-success">{{ trans('admin.total') }}</a>
								</div>
							</div>
						</td>
					</tr>
				</table>
				<!--end-table-->
				
		</div>
	</div>
</div>