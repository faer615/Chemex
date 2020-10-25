<template>
    <view class="content">
        <input class="input" placeholder="站点URL" type="text" @input="bindDomainChange"/>
        <input class="input" placeholder="账户" type="text" @input="bindUsernameChange"/>
        <input class="input" placeholder="密码" type="text" @input="bindPasswordChange"/>
        <button class="input" style="background-color: rgba(99,181,247,1);color: white;border: none;" @click="save()">
            保存
        </button>
    </view>
</template>

<script>
export default {
    data() {
        return {
            settings: {
                domain: '',
                username: '',
                password: '',
                jwt: ''
            },
        }
    },
    methods: {
        bindDomainChange(e) {
            this.settings.domain = e.target.value;
        },
        bindUsernameChange(e) {
            this.settings.username = e.target.value;
        },
        bindPasswordChange(e) {
            this.settings.password = e.target.value;
        },
        save() {
            let that = this;
            uni.showLoading({
                title: '正在保存'
            });
            uni.request({
                method: 'POST',
                url: that.settings.domain + '/api/auth/login',
                data: {
                    username: that.settings.username,
                    password: that.settings.password
                },
                success(res) {
                    if (res.statusCode == 200) {
                        that.settings.jwt = 'bearer ' + res.data.access_token;
                        console.log(that.settings);
                        uni.setStorage({
                            key: 'settings',
                            data: that.settings,
                            success() {
                                uni.showModal({
                                    title: '提示',
                                    content: '登录成功',
                                    showCancel: false
                                })
                            },
                            fail(res) {
                                console.log(res);
                                uni.showModal({
                                    title: '提示',
                                    content: '认证失败，请检查',
                                    showCancel: false
                                })
                            },
                            complete() {
                                uni.hideLoading();
                            }
                        })
                    }
                }
            })
        }
    }
}
</script>

<style>
.input {
    margin: 20 upx 40 upx 0 40 upx;
    border: solid 1 upx rgba(0, 0, 0, 0.3);
    padding: 20 upx;
    font-size: 40 upx;
    border-radius: 10 upx;
}
</style>
