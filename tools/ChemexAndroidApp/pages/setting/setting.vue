<template>
	<view class="content">
		<u-input class="row" v-model="settings.domain" type="text" :border="true" placeholder="站点URL" />
		<u-input class="row" v-model="settings.username" type="text" :border="true" placeholder="账户" />
		<u-input class="row" v-model="settings.password" type="text" :border="true" placeholder="密码" />
		<u-button class="row" type="primary" @click="save()">保存</u-button>
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
						} else {
							uni.showModal({
								title: '错误',
								content: '无法请求服务器',
								showCancel: false
							})
						}
					},
					fail(res) {
						uni.showModal({
							title: '错误',
							content: '未知错误',
							showCancel: false
						})
					},
					complete() {
						uni.hideLoading();
					}
				})
			}
		}
	}
</script>

<style>

</style>
