@if(count($data['hardware'])>0)
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th colspan="6" class="title">硬件</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>分类</th>
            <th>名称</th>
            <th>规格</th>
            <th>序列号</th>
            <th>制造商</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['hardware'] as $key=>$item)
            <tr class="tr" onclick="go('{{route('hardware.records.show',$data['hardware'][$key]->id)}}')"
                style="cursor: pointer">
                <td>{{$item->id}}</td>
                <td>{{optional($item->category)->name}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->specification}}</td>
                <td>{{$item->sn}}</td>
                <td>{{optional($item->vendor)->name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div style="text-align: center;color: rgba(0,0,0,0.7)">无内容</div>
@endif
@if(count($data['software'])>0)
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th colspan="6" class="title">软件</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>分类</th>
            <th>名称</th>
            <th>版本</th>
            <th>授权方式</th>
            <th>制造商</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['software'] as $key=>$item)
            <tr class="tr" onclick="go('{{route('software.records.show',$data['software'][$key]->id)}}')"
                style="cursor: pointer">
                <td>{{$item->id}}</td>
                <td>{{optional($item->category)->name}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->version}}</td>
                <td>{{$item->distribution}}</td>
                <td>{{optional($item->vendor)->name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div style="text-align: center;color: rgba(0,0,0,0.7)">无内容</div>
@endif
@if(count($data['service'])>0)
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th colspan="6" class="title">服务程序</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>名称</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['service'] as $key=>$item)
            <tr class="tr" onclick="go('{{route('service.records.show',$data['service'][$key]->id)}}')"
                style="cursor: pointer">
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div style="text-align: center;color: rgba(0,0,0,0.7)">无内容</div>
@endif

<script>
    function go(url) {
        window.open(url);
    }
</script>

<style>
    .tr td {
        height: auto;
        vertical-align: center;
    }

    .title {
        text-align: center;
        background: #5CA4E9;
        color: #FFFFFF;
    }
</style>
