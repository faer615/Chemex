<div>
    <a class="btn btn-primary button" onclick="migrate()">更新数据库结构</a>
</div>

<div class="mt-1">
    <a class="btn btn-primary button" onclick="clearCache()">清理缓存</a>
</div>

<div class="mt-1">
    <a href="/static/tools/chemex_tool-1.0.0.apk" target="_blank" class="btn btn-primary button">下载 Chemex for Android
    </a>
</div>

<script>
    /**
     * 更新数据库结构
     */
    function migrate() {
        $.ajax({
            url: "/version/migrate",
            success: function (res) {
                if (res.code === 200) {
                    Dcat.success(res.message);
                } else {
                    Dcat.warning(res.message);
                }
            },
            error: function (res) {
                Dcat.error('执行错误：' + res);
            }
        });
    }

    /**
     * 清理缓存
     */
    function clearCache() {
        $.ajax({
            url: "/version/clear",
            success: function (res) {
                if (res.code === 200) {
                    Dcat.success(res.message);
                } else {
                    Dcat.warning(res.message);
                }
            },
            error: function (res) {
                Dcat.error('执行错误：' + res);
            }
        });
    }
</script>

<style>
    .button {
        width: 100%;
        color: white !important;
    }
</style>
