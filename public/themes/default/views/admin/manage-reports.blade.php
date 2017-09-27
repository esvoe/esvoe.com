<div class="panel panel-default">

	<div class="panel-body nopadding">
        <ul class="nav nav-pills heading-list">
            <li class="active"><a href="#posts" data-toggle="pill" class="header-text">{{ trans('common.posts') }}<span>{{ count($post_reports) }}</span></a></li>
            <li class="divider">&nbsp;</li>
            <li class=""><a href="#users" data-toggle="pill" class="header-text">{{ trans('common.users') }}<span>{{ count($user_reports) }}</span></a></li>
            <li class="divider">&nbsp;</li>
           	<li class=""><a href="#pages" data-toggle="pill" class="header-text">{{ trans('common.pages') }}<span>{{ count($page_reports) }}</span></a></li>
           	<li class="divider">&nbsp;</li>
           	<li class=""><a href="#groups" data-toggle="pill" class="header-text">{{ trans('common.groups') }}<span>{{ count($group_reports) }}</span></a></li>
        </ul>
    </div>
    <div class="tab-content nopadding">
        <div id="posts" class="tab-pane fade active in">
            <table class="table apps-table">
             @include('flash::message')
            @if(count($post_reports) > 0)
                <thead>                
                    <tr>                        
                        <th>{{ trans('admin.reported_by') }}</th>
                        <th>{{ trans('common.post') }}</th>
                        <th>{{ trans('common.status') }}</th>
                        <th colspan="2">&nbsp;</th>                        
                    </tr>
                </thead>
                <tbody>
                @foreach($post_reports as $post_report)
                    <tr>                       
                        <td>
                            <a href="{{ url($user->find($post_report->reporter_id)->username) }}"><img src="{{ $user->find($post_report->reporter_id)->avatar }}" alt="{{ $user->find($post_report->reporter_id)->name }}" title="{{ $user->find($post_report->reporter_id)->name }}"></a>

                            <div class="app-details">
                                <div class="app-name">
                                    <a href="{{ url($user->find($post_report->reporter_id)->username) }}">{{ $user->find($post_report->reporter_id)->name }}</a>
                                </div>
                                <div class="text-secondary">
                                    {{ $user->find($post_report->reporter_id)->username }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <a href="{{ url('post/'.$post_report->post_id) }}">{{ trans('admin.show_post') }}</a>
                            <div class="text-secondary">
                                {{ trans('admin.id') }}: {{ $post_report->post_id }}
                            </div>
                        </td>

                        <td>
                            <span class="label label-default">{{ $post_report->status }}</span>
                          
                        </td>

                        <td>
                            <a href="{{ url('admin/mark-safe/'.$post_report->id) }}"><span class="label label-success">{{ trans('admin.mark_safe') }}</span></a>
                        </td>

                        <td>
                            <a href="{{ url('admin/delete-post/'.$post_report->id.'/'.$post_report->post_id) }}" onclick="return confirm('{{ trans("messages.are_you_sure") }}')"><span class="label label-danger">{{ trans('admin.delete_post') }}</span></a>
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            @else
                <div class="alert alert-warning">{{ trans('messages.no_reports') }}</div>
            @endif    
            </table>
        </div>
<!-- End of post tab-->

        <!--Start Users tab-->
        <div id="users" class="tab-pane fade">
            <table class="table apps-table">
                @if(count($user_reports) > 0)
                <thead>
                    <tr>                       
                        <th>{{ trans('admin.reported_by') }}</th>
                        <th>{{ trans('common.user') }}</th>
                        <th>{{ trans('common.status') }}</th>                       
                        <th colspan="2">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user_reports as $user_report)
                    <tr>
                        <td>
                           <a href="{{ url($user->find($user_report->reporter_id)->username) }}"><img src="{{ $user->find($user_report->reporter_id)->avatar }}" alt="{{ $user->find($user_report->reporter_id)->name }}" title="{{ $user->find($user_report->reporter_id)->name }}"></a>
                            
                            <div class="app-details">
                                <div class="app-name">
                                    <a href="{{ url($user->find($user_report->reporter_id)->username) }}">{{ $user->find($user_report->reporter_id)->name }}</a>
                                </div>
                                <div class="text-secondary">
                                    {{ $user->find($user_report->reporter_id)->username }}
                                </div>
                            </div>
                        </td>
                        <td>
                           <a href="{{ url($timeline->find($user_report->timeline_id)->username) }}">

                                <img src="{{ $timeline->find($user_report->timeline_id)->user->avatar }}" alt="{{ $timeline->find($user_report->timeline_id)->name }}" title="{{ $timeline->find($user_report->timeline_id)->name }}">
                            </a>
                            
                            <div class="app-details">
                                <div class="app-name">
                                    <a href="{{ url($timeline->find($user_report->timeline_id)->username) }}">{{ $timeline->find($user_report->timeline_id)->name }}</a>
                                </div>
                                <div class="text-secondary">
                                    {{ $timeline->find($user_report->timeline_id)->username }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="label label-default">{{ $user_report->status }}</span>
                        </td>
                        <td>
                            <a href="{{ url('admin/markpage-safe/'.$user_report->id) }}"><span class="label label-success">{{ trans('admin.mark_safe') }}</span></a>
                        </td>
                        <td>
                            <a href="{{ url('admin/deleteuser/'.$timeline->find($user_report->timeline_id)->username) }}" onclick="return confirm('{{ trans("messages.are_you_sure") }}')"><span class="label label-danger">{{ trans('admin.delete_user') }}</span></a>
                            {{-- <a href="#"><span class="label label-danger">{{ trans('admin.delete_user') }}</span></a> --}}
                        </td>
                     </tr>          
                    @endforeach
                </tbody>
            @else
                <div class="alert alert-warning">{{ trans('messages.no_reports') }}</div>
            @endif
            </table>
        </div>
        <!-- End of user tab-->

        <!-- Start Page tab-->
        <div id="pages" class="tab-pane fade">
            <table class="table apps-table">
            @if(count($page_reports) > 0)
                <thead>
                    <tr>                       
                        <th>{{ trans('admin.reported_by') }}</th>
                        <th>{{ trans('admin.page') }}</th>
                        <th>{{ trans('common.status') }}</th>                       
                        <th colspan="2">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($page_reports as $page_report)
                     <tr>
                        <td>
                           <a href="{{ url($user->find($page_report->reporter_id)->username) }}"><img src="{{ $user->find($page_report->reporter_id)->avatar }}" alt="{{ $user->find($page_report->reporter_id)->name }}" title="{{ $user->find($page_report->reporter_id)->name }}"></a>
                            
                            <div class="app-details">
                                <div class="app-name">
                                    <a href="{{ url($user->find($page_report->reporter_id)->username) }}">{{ $user->find($page_report->reporter_id)->name }}</a>
                                </div>
                                <div class="text-secondary">
                                    {{ $user->find($page_report->reporter_id)->username }}
                                </div>
                            </div>
                        </td>
                        <td>
                           <a href="{{ url($timeline->find($page_report->timeline_id)->username) }}">

                                <img src="{{ $timeline->find($page_report->timeline_id)->avatar ? url('page/avatar'.$timeline->find($page_report->timeline_id)->avatar) : url('page/avatar/default-page-avatar.png') }}" alt="{{ $timeline->find($page_report->timeline_id)->name }}" title="{{ $timeline->find($page_report->timeline_id)->name }}">
                            </a>
                            
                            <div class="app-details">
                                <div class="app-name">
                                    <a href="{{ url($timeline->find($page_report->timeline_id)->username) }}">{{ $timeline->find($page_report->timeline_id)->name }}</a>
                                </div>
                                <div class="text-secondary">
                                    {{ $timeline->find($page_report->timeline_id)->username }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="label label-default">{{ $page_report->status }}</span>
                        </td>
                        <td>
                            <a href="{{ url('admin/markpage-safe/'.$page_report->id) }}"><span class="label label-success">{{ trans('admin.mark_safe') }}</span></a>
                        </td>
                        <td>
                            <a href="{{ url('admin/deletepage/'.$timeline->find($page_report->timeline_id)->page->id.'/true') }}" onclick="return confirm('{{ trans("messages.are_you_sure") }}')"><span class="label label-danger">{{ trans('admin.delete_page') }}</span></a>
                        </td>
                     </tr>          
                    @endforeach
                </tbody>
            @else
                <div class="alert alert-warning">{{ trans('messages.no_reports') }}</div>
            @endif
            </table>
        </div>
        <!-- End of page tab-->

        <!-- Start Group tab-->
        <div id="groups" class="tab-pane fade">
            <table class="table apps-table">
           @if(count($group_reports) > 0)
                <thead>
                    <tr>                       
                        <th>{{ trans('admin.reported_by') }}</th>
                        <th>{{ trans('common.group') }}</th>                       
                        <th>{{ trans('common.status') }}</th>                       
                        <th colspan="2">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($group_reports as $group_report)
                    <tr>
                        <td>
                           <a href="{{ url($user->find($group_report->reporter_id)->username) }}"><img src="{{ $user->find($group_report->reporter_id)->avatar }}" alt="{{ $user->find($group_report->reporter_id)->name }}" title="{{ $user->find($group_report->reporter_id)->name }}"></a>
                            
                            <div class="app-details">
                                <div class="app-name">
                                    <a href="{{ url($user->find($group_report->reporter_id)->username) }}">{{ $user->find($group_report->reporter_id)->name }}</a>
                                </div>
                                <div class="text-secondary">
                                    {{ $user->find($group_report->reporter_id)->username }}
                                </div>
                            </div>
                        </td>
                        <td>
                           <a href="{{ url($timeline->find($group_report->timeline_id)->username) }}">

                                <img src="{{ $timeline->find($group_report->timeline_id)->avatar ? url('group/avatar'.$timeline->find($group_report->timeline_id)->avatar) : url('group/avatar/default-group-avatar.png') }}" alt="{{ $timeline->find($group_report->timeline_id)->name }}" title="{{ $timeline->find($group_report->timeline_id)->name }}">
                            </a>
                            
                            <div class="app-details">
                                <div class="app-name">
                                    <a href="{{ url($timeline->find($group_report->timeline_id)->username) }}">{{ $timeline->find($group_report->timeline_id)->name }}</a>
                                </div>
                                <div class="text-secondary">
                                    {{ $timeline->find($group_report->timeline_id)->username }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="label label-default">{{ $group_report->status }}</span>
                        </td>
                        <td>
                            <a href="{{ url('admin/markpage-safe/'.$group_report->id) }}"><span class="label label-success">{{ trans('admin.mark_safe') }}</span></a>
                        </td>
                        <td>
                            <a href="{{ url('admin/deletegroup/'.$timeline->find($group_report->timeline_id)->groups->id) }}" onclick="return confirm('{{ trans("messages.are_you_sure") }}')"><span class="label label-danger">{{ trans('admin.delete_group') }}</span></a>
                        </td>
                     </tr>  
                     
                    @endforeach
                </tbody>
            @else
                <div class="alert alert-warning">{{ trans('messages.no_reports') }}</div>
            @endif
            </table>
        </div>
        <!-- End of group tab-->
    </div>
	<div class="panel-body timeline hidden">
	@include('flash::message')
		@if(count($post_reports) > 0)
			<div class="table-responsive">
				<table class="table existing-products-table">
					<thead>
						<tr>
							<th>{{ trans('admin.id') }}</th> 
							<th>{{ trans('admin.reported_by') }}</th>
							<th>{{ trans('common.post') }}</th> 
							<th>{{ trans('common.status') }}</th>
							<th>{{ trans('admin.options') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($post_reports as $post_report)
						<tr>	
							<td>{{ $post_report->id }}</td>
							<td><a href="#"><img src="@if($post->getAvatar($post_report->reporter_id)) {{ url('user/avatar/'.$post->getAvatar($post_report->reporter_id)) }} @else {{ url('user/avatar/default-'.$post->getGender($post_report->reporter_id).'-avatar.png') }} @endif" alt="images"></a><a href="{{ url($post->getUserName($post_report->reporter_id)) }}"> {{ $post->getUserName($post_report->reporter_id) }}</a></td>

							<td><a href="#">{{ trans('admin.show_post') }}</a</td> 
							<td>{{ $post_report->status }}</td>
							<td>
								<a href="{{ url('admin/mark-safe/'.$post_report->id) }}" class="btn btn-success"><i class="fa fa-thumbs-up"></i>{{ trans('admin.mark_safe') }}</a>
								<a href="{{ url('admin/delete-post/'.$post_report->id.'/'.$post_report->post_id) }}" class="btn btn-danger" onclick="return confirm('{{ trans("messages.are_you_sure") }}')"><i class="fa fa-thumbs-down"></i>{{ trans('admin.delete_post') }}</a>

							</td> 
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
				@else
				<div class="alert alert-warning hidden">{{ trans('messages.no_reports') }}</div>
			@endif
		</div>
	</div>
