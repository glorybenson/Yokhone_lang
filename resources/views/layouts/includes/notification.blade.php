<div class="notifications">
    <div class="topnav-dropdown-header">
        <span class="notification-title">Notifications</span>
        <a href="javascript:void(0)" class="clear-noti"> <i class="feather-x-circle"></i> </a>
    </div>
    <div class="noti-content">
        <ul class="notification-list">
            <?php $notifications=auth()->user()->notifications; ?>
            @if(isset($notifications))
            @forelse($notifications as $notification)
            <li class="notification-message">
                <a>
                    <div class="media">
                        <div class="media-body">
                            <p class="noti-details"><span class="noti-title"></span> {{$notification->data['message']}}
                                <span class="noti-title">
                                    @if($notification->data['data'] != ' ')
                                    <b>
                                        <spaceless> - {{$notification->data['data']}}</spaceless>
                                    </b>
                                    @else
                                    @endif
                                </span>
                            </p>
                            <p class="noti-time"><span class="notification-time">{{$notification->created_at->diffForHumans()}}</span></p>
                        </div>
                    </div>
                </a>
            </li>
            @empty
            @endforelse
            @endif

        </ul>
    </div>
    <div class="topnav-dropdown-footer">
        <a href="javascript:void(0);">View all Notifications</a>
    </div>
</div>