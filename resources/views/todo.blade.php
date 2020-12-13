@foreach($notifications as $key=>$notification)
    <div>
        <a href="{{$notification['data']['url']}}"
           target="_blank">{{($key+1).'：'.$notification['data']['title'].'，'.$notification['data']['content']}}</a>
    </div>
@endforeach
