@if(count($data)>0)
    <table class="table table-hover">
        <thead>
        <tr class="center">
            <th></th>
            <th>状态</th>
            <th>事件</th>
            <th>时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $key=>$item)
            <tr class="tr">
                @if($key == 0)
                    <td class="center">最新</td>
                @elseif($key == count($data)-1)
                    <td class="center">最旧</td>
                @else
                    <td class="center">↑</td>
                @endif
                @if($item['status']=='+')
                    <td class="center"><i class="feather icon-plus" style="color:royalblue"></i></td>
                    <td>关联了{{$item['type'].' : '.$item['name']}}</td>
                @else
                    <td class="center"><i class="feather icon-minus" style="color:orangered"></i></td>
                    <td>解除了{{$item['type'].' : '.$item['name']}}</td>
                @endif
                <td class="center">{{$item['datetime']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="empty-data"><i class="feather icon-alert-circle"></i>暂无数据</div>
@endif
<style>
    .tr td {
        height: auto;
        vertical-align: center;
    }

    .center {
        text-align: center;
    }
</style>
