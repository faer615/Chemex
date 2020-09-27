@if(count($data)>0)
    <table class="table">
        <thead>
        <tr>
            <th>事件</th>
            <th>时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr class="{{$item['color']}}">
                <td>{{$item['status'] . $item['type'].' : '.$item['name']}}</td>
                <td>{{$item['datetime']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div style="text-align: center;color: rgba(0,0,0,0.7)">无内容</div>
@endif
