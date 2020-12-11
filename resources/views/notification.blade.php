<ul class="nav navbar-nav">
    <li class="dropdown dropdown-notification nav-item">
        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown" aria-expanded="true">
            <i class="ficon feather icon-bell"></i>
            @if(count($notifications)>0)
                <span class="badge badge-pill badge-primary badge-up">
                {{count($notifications)}}
                </span>
            @endif
        </a>
        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right ">
            <li class="dropdown-menu-header">
                <div class="dropdown-header m-0 p-2">
                    <h3 class="white">{{count($notifications)}}</h3>
                    <span class="grey darken-2">全部通知数量</span>
                </div>
            </li>
            @if(count($notifications)>0)
                <li class="scrollable-container media-list ps ps--active-y">
                    @foreach($notifications as $notification)
                        <a class="media d-flex justify-content-between"
                           href="{{route('notification.read',$notification['id'])}}">
                            <div class="d-flex align-items-start">
                                <div class="media-left">
                                </div>
                                <div class="media-body">
                                    <h6 class="primary media-heading">{{$notification['data']['title']}}</h6>
                                    <small class="notification-text">
                                        {{$notification['data']['content']}}
                                    </small>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </li>
                <li class="dropdown-menu-footer">
                    <a class="dropdown-item p-1 text-center" onclick="readAll()">全部已读</a>
                </li>
            @endif
        </ul>
    </li>
</ul>
<script>
    function readAll() {
        $.ajax({
            url: "/notifications/read_all",
            method: 'GET',
            success: function () {
                location.reload();
            }
        });
    }
</script>
