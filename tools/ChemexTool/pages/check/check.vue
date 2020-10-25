<template>
    <view>
        <view class="scan" style="background-color: rgba(76,181,171,1);" @click="scan()">扫码盘点</view>
    </view>
</template>

<script>
export default {
    data() {
        return {
            settings: '',
            string: '',
        }
    },
    onLoad() {
        let that = this;
        uni.getStorage({
            key: 'settings',
            success(res) {
                that.settings = res.data;
            },
            fail() {
                uni.showModal({
                    title: '提示',
                    content: '没有找到配置信息',
                    showCancel: false,
                    success() {
                        uni.navigateTo({
                            url: '../setting/setting'
                        })
                    }
                })
            }
        })
    },
    methods: {
        scan() {
            let that = this;
            uni.scanCode({
                success: function (res) {
                    that.string = res.result;
                    uni.showLoading({
                        title: '正在读取'
                    })
                    uni.request({
                        url: that.settings.domain + '/api/check/' + that.string,
                        method: 'GET',
                        header: {
                            Authorization: that.settings.jwt
                        },
                        success(item) {
                            console.log(item);
                            if (item.statusCode == 200 && item.data.code == 200) {
                                uni.showModal({
                                    title: '盘点选项',
                                    content: '请选择盘点结果',
                                    confirmText: '盘盈',
                                    cancelText: '盘亏',
                                    success(res) {
                                        if (res.confirm) {
                                            that.check(item.data.data.id, 1);
                                        }
                                        if (res.cancel) {
                                            that.check(item.data.data.id, 2);
                                        }
                                    }
                                })
                            }
                        },
                        fail(res) {
                            console.log(res);
                        },
                        complete() {
                            uni.hideLoading();
                        }
                    })
                }
            });
        },
        check(id, option) {
            let that = this;
            uni.request({
                method: 'POST',
                url: that.settings.domain + '/api/check/do',
                data: {
                    track_id: id,
                    option: option
                },
                header: {
                    Authorization: that.settings.jwt
                },
                success(res) {
                    if (res.statusCode == 200 & res.data.code == 200) {
                        uni.showModal({
                            title: '提示',
                            content: '盘点完成',
                            showCancel: false
                        })
                    }
                },
                fail(res) {
                    console.log(res);
                }
            })
        }
    }
}
</script>

<style>
.scan {
    color: white;
    width: 400 upx;
    height: 150 upx;
    margin: 50 upx auto 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 40 upx;
    border-radius: 20 upx;
}
</style>
