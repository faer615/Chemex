<div>当前版本：{{$data['old']}}</div>
<div class="mt-1">最新版本：{{$data['new']}}</div>
@if($data['res'] == -1)
    <button id="update" style="width: 100%;" class="btn btn-primary mt-1" onclick="unzip('{{$data['url']}}')">更新
    </button>
@endif
<script>
    function unzip(url) {
        document.getElementById('update').setAttribute('disabled', 'disabled');
        document.getElementById('update').innerText = '正在更新';
        $.ajax({
            url: '/unzip?url=' + url,
            type: 'get',
            success: function () {
                window.location.reload();
            },
            complete: function () {
                document.getElementById('update').setAttribute('disabled', '');
                document.getElementById('update').innerText = '更新';
            }
        });
    }
</script>
