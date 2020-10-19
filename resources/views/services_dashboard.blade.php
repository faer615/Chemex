<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">宿主设备名称</th>
        <th scope="col">服务名称</th>
        <th scope="col">状态</th>
        <th scope="col">异常说明</th>
        <th scope="col">开始时间</th>
        <th scope="col">恢复时间</th>
    </tr>
    </thead>
    <tbody>
    @foreach($services as $service)
        <tr>
            <td>{{$service['device_name']}}</td>
            <td>{{$service['name']}}</td>
            <td>
                @switch($service['status'])
                    @case(0)
                    正常
                    @break
                    @case(1)
                    <span style="color: rgba(231,72,98,0.7);font-weight: 600;">异常</span>
                    @break
                    @case(2)
                    <span style="color: rgba(19,185,203,0.7);font-weight: 600;">恢复</span>
                    @break
                    @case(3)
                    <span style="color: rgba(246,204,51,0.7);font-weight: 600;">暂停</span>
                    @break
                @endswitch
            </td>
            <td>
                {!! implode('',$service['issues']) !!}
            </td>
            <td>{{$service['start']}}</td>
            <td>{{$service['end']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
