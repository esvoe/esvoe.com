<div class="list-group list-group-navigation socialite-group">
    <a href="{{ url('/admin') }}" class="list-group-item">

        <div class="list-icon socialite-icon {{ (Request::segment(1) == 'admin' && Request::segment(2)==null) ? 'active' : '' }}">
            <i class="fa fa-dashboard"></i>
        </div>
        <div class="list-text">
            <span class="badge pull-right"></span>
            {{ trans('common.dashboard') }}
            <div class="text-muted">
                {{ trans('common.application_statistics') }}
            </div>
        </div>
        <span class="clearfix"></span>
    </a>
    <a href="{{ url('/admin/general-settings') }}" class="list-group-item">

        <div class="list-icon socialite-icon {{ Request::segment(2) == 'general-settings' ? 'active' : '' }}">
            <i class="fa fa-shield"></i>
        </div>
        <div class="list-text">
            <span class="badge pull-right"></span>
            {{ trans('common.website_settings') }}
            <div class="text-muted">
             {{ trans('common.general_website_settings') }}
         </div>
     </div>
     <span class="clearfix"></span>
 </a>
 <a href="{{ url('/admin/user-settings') }}" class="list-group-item">

    <div class="list-icon socialite-icon {{ Request::segment(2) == 'user-settings' ? 'active' : '' }}">
        <i class="fa fa-user-secret"></i>
    </div>
    <div class="list-text">
        <span class="badge pull-right"></span>
        {{ trans('common.user_settings') }}
        <div class="text-muted">
            {{ trans('common.user_settings_text') }}
        </div>
    </div>
    <span class="clearfix"></span>
</a>
    <a href="{{ url('/admin/custom-pages') }}" class="list-group-item">

        <div class="list-icon socialite-icon {{ Request::segment(2) == 'custom-pages' ? 'active' : '' }}">
            <i class="fa fa-files-o"></i>
        </div>
        <div class="list-text">
            <span class="badge pull-right"></span>
            {{ trans('common.custom_pages') }}
            <div class="text-muted">
                {{ trans('common.custom_pages_text') }}
            </div>
        </div>
        <span class="clearfix"></span>
    </a>

    <a href="{{ url('/admin/wallpapers') }}" class="list-group-item">
  
        <div class="list-icon socialite-icon {{ Request::segment(2) == 'wallpapers' ? 'active' : '' }}">
            <i class="fa fa-picture-o"></i>
        </div>
        <div class="list-text">
            <span class="badge pull-right"></span>
            {{ trans('common.wallpapers') }}
            <div class="text-muted">
                {{ trans('common.wallpapers_text') }}
            </div>
        </div>
        <span class="clearfix"></span>
    </a> 
    
    <a href="{{ url('/admin/themes') }}" class="list-group-item">
  
        <div class="list-icon socialite-icon {{ Request::segment(2) == 'themes' ? 'active' : '' }}">
            <i class="fa fa-picture-o"></i>
        </div>
        <div class="list-text">
            <span class="badge pull-right"></span>
            {{ trans('common.themes') }}
            <div class="text-muted">
                {{ trans('common.themes_text') }}
            </div>
        </div>
        <span class="clearfix"></span>
    </a>
<a href="{{ url('/admin/page-settings') }}" class="list-group-item">

    <div class="list-icon socialite-icon {{ Request::segment(2) == 'page-settings' ? 'active' : '' }}">
        <i class="fa fa-comments"></i>
    </div>
    <div class="list-text">
        <span class="badge pull-right"></span>
        {{ trans('common.page_settings') }}
        <div class="text-muted">
            {{ trans('common.page_settings_text') }}
        </div>
    </div>
    <span class="clearfix"></span>
</a>
<a href="{{ url('/admin/group-settings') }}" class="list-group-item">

    <div class="list-icon socialite-icon {{ Request::segment(2) == 'group-settings' ? 'active' : '' }}">
        <i class="fa fa-group"></i>
    </div>
    <div class="list-text">
        <span class="badge pull-right"></span>
        {{ trans('common.group_settings') }}
        <div class="text-muted">
            {{ trans('common.group_settings_text') }}
        </div>
    </div>
    <span class="clearfix"></span>
</a>
<a href="{{ url('/admin/event-settings') }}" class="list-group-item">

    <div class="list-icon socialite-icon {{ Request::segment(2) == 'event-settings' ? 'active' : '' }}">
        <i class="fa fa-calendar"></i>
    </div>
    <div class="list-text">
        <span class="badge pull-right"></span>
        {{ trans('common.event_settings') }}
        <div class="text-muted">
            {{ trans('common.event_settings_text') }}
        </div>
    </div>
    <span class="clearfix"></span>
</a>
<a href="{{ url('/admin/announcements') }}" class="list-group-item">

    <div class="list-icon socialite-icon {{ Request::segment(2) == 'announcements' ? 'active' : '' }}">
        <i class="fa fa-bullhorn"></i>
    </div>
    <div class="list-text">
        <span class="badge pull-right"></span>
        {{ trans('common.announcements') }}
        <div class="text-muted">
            {{ trans('common.announcements_text') }}
        </div>
    </div>
    <span class="clearfix"></span>
</a>

    <a href="{{ url('/admin/users') }}" class="list-group-item">

        <div class="list-icon socialite-icon {{ Request::segment(2) == 'users' ? 'active' : '' }}">
            <i class="fa fa-user-plus"></i>
        </div>
        <div class="list-text">
            <span class="badge pull-right"></span>
            {{ trans('common.manage_users') }}
            <div class="text-muted">
                {{ trans('common.manage_users_text') }}
            </div>
        </div>
        <span class="clearfix"></span>
    </a>
    <a href="{{ url('/admin/pages') }}" class="list-group-item">

        <div class="list-icon socialite-icon {{ Request::segment(2) == 'pages' ? 'active' : '' }}">
            <i class="fa fa-file-text"></i>
        </div>
        <div class="list-text">
            <span class="badge pull-right"></span>
            {{ trans('common.manage_pages') }}
            <div class="text-muted">
                {{ trans('common.manage_pages_text') }}
            </div>
        </div>
        <span class="clearfix"></span>
    </a>
    <a href="{{ url('/admin/groups') }}" class="list-group-item">

        <div class="list-icon socialite-icon {{ Request::segment(2) == 'groups' ? 'active' : '' }}">
            <i class="fa fa-group"></i>
        </div>
        <div class="list-text">
            <span class="badge pull-right"></span>
            {{ trans('common.manage_groups') }}
            <div class="text-muted">
                {{ trans('common.manage_groups_text') }}
            </div>
        </div>
        <span class="clearfix"></span>
    </a>
     <a href="{{ url('/admin/events') }}" class="list-group-item">

        <div class="list-icon socialite-icon {{ Request::segment(2) == 'events' ? 'active' : '' }}">
            <i class="fa fa-calendar-o"></i>
        </div>
        <div class="list-text">
            <span class="badge pull-right"></span>
            {{ trans('common.manage_events') }}
            <div class="text-muted">
                {{ trans('common.manage_events_text') }}
            </div>
        </div>
        <span class="clearfix"></span>
    </a>
    <a href="{{ url('/admin/manage-reports') }}" class="list-group-item">

        <div class="list-icon socialite-icon {{ Request::segment(2) == 'manage-reports' ? 'active' : '' }}">
            <i class="fa fa-bug"></i>
        </div>
        
        <div class="list-text">
            @if(Auth::user()->getReportsCount() > 0)
            <span class="badge pull-right">{{ Auth::user()->getReportsCount() }}</span>
            @endif            
            {{ trans('common.manage_reports') }}
            <div class="text-muted">
                {{ trans('common.manage_reports_text') }}
            </div>             
        </div>
        <span class="clearfix"></span>
    </a>   

    <a href="{{ url('/admin/manage-ads') }}" class="list-group-item">

        <div class="list-icon socialite-icon {{ Request::segment(2) == 'manage-ads' ? 'active' : '' }}">
            <i class="fa fa-send"></i>
        </div>
        <div class="list-text">
            <span class="badge pull-right"></span>
            {{ trans('common.manage_ads') }}
            <div class="text-muted">
                {{ trans('common.manage_ads_text') }}
            </div>
        </div>
        <span class="clearfix"></span>
    </a>
    <a href="{{ url('/admin/get-env') }}" class="list-group-item">

        <div class="list-icon socialite-icon {{ Request::segment(2) == 'get-env' ? 'active' : '' }}">
            <i class="fa fa-cogs"></i>
        </div>
        <div class="list-text">
            <span class="badge pull-right"></span>
            {{ trans('common.environment_settings') }}
            <div class="text-muted">
                {{ trans('common.edit_on_risk') }}
            </div>
        </div>
        <span class="clearfix"></span>
    </a>
    <a href="{{ url('/admin/update-database') }}" class="list-group-item">

        <div class="list-icon socialite-icon {{ Request::segment(2) == 'update-database' ? 'active' : '' }}">
            <i class="fa fa-database"></i>
        </div>
        <div class="list-text">
            <span class="badge pull-right"></span>
            Database Update 
            <div class="text-muted">
                database update
            </div>
        </div>
        <span class="clearfix"></span>
    </a>
    <a href="{{ url('/admin/translations') }}" class="list-group-item">

        <div class="list-icon socialite-icon {{ Request::segment(2) == 'translations' ? 'active' : '' }}">
            <i class="fa fa-book"></i>
        </div>
        <div class="list-text">
            <span class="badge pull-right"></span>
            Управления переводами
            <div class="text-muted">
                Перевод страниц
            </div>
        </div>
        <span class="clearfix"></span>
    </a>
</div>



