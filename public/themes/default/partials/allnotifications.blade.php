<div class="panel panel-default">
  <div class="panel-heading no-bg panel-settings">  
    <h3 class="panel-title">
      {{ trans('common.allnotifications') }} 
      @if(count($notifications) > 0)
        <span class="side-right">
          <a href="{{ url('allnotifications/delete') }}" class="btn btn-danger text-white allnotifications-delete">{{ trans('common.delete_all') }}</a>
        </span>
      @endif
    </h3>
  </div>
  <div class="panel-body timeline">  
    <div class="table-responsive">  
      <table class="table apps-table socialite">
        @if(count($notifications) > 0)
            <thead>               
                <th></th>
                <th>{{ trans('common.notification') }}</th>           
                <th>{{ trans('admin.action') }}</th>
            </thead>
            <tbody>
              @foreach($notifications as $notification)              
                  <tr>                                     
                    <td><a href="{{ url('/'.$notification->notified_from->timeline->username) }}">
                        <img src="{{ $notification->notified_from->avatar }}" alt="{{$notification->notified_from->username}}" title="{{$notification->notified_from->name}}"></a><a href="{{ url($notification->notified_from->username) }}"></a>
                    </td>
                    <td>{{ str_limit($notification->description,50) }}</td>                
                    <td><a href="#" data-notification-id="{{ $notification->id }}" class="notification-delete"><span class="trash-icon bg-danger"><i class="fa fa-trash" aria-hidden="true"></i></span></a></td>
                  </tr>
              @endforeach                       
            </tbody>            
        @else
          <div class="alert alert-warning">{{ trans('messages.no_notifications') }}</div>
          @include('flash::message')
        @endif        
      </table> 
      <div class="pagination-holder">
        {{ $notifications->render() }}
      </div>     
    </div>
  </div>
</div>