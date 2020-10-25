<template>
	<view class="content">
		<input class="input" type="text" placeholder="站点URL" @input="bindDomainChange" />
		<input class="input" type="text" placeholder="账户" @input="bindUsernameChange" />
		<input class="input" type="text" placeholder="密码" @input="bindPasswordChange" />
		<button class="input" style="background-color: rgba(99,181,247,1);color: white;border: none;" @click="save()">保存</button>
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
		margin: 20upx 40upx 0 40upx;
		border: solid 1upx rgba(0, 0, 0, 0.3);
		padding: 20upx;
		font-size: 40upx;
		border-radius: 10upx;
	}
</style>
