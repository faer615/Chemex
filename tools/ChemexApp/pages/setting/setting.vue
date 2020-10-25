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
				config: {
					domain: '',
					username: '',
					password: ''
				}
			}
		},
		methods: {
			bindDomainChange(e) {
				this.config.domain = e.target.value;
			},
			bindUsernameChange(e) {
				this.config.username = e.target.value;
			},
			bindPasswordChange(e) {
				this.config.password = e.target.value;
			},
			save() {
				let that = this;
				uni.showLoading({
					title: '正在保存'
				});
				uni.setStorage({
					key: 'config',
					data: that.config,
					success() {
						uni.showModal({
							title: '提示',
							content: '保存成功',
							showCancel: false
						})
					},
					fail(res) {
						console.log(res);
						uni.showModal({
							title: '提示',
							content: '保存失败',
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
	.input {
		margin: 20upx 40upx 0 40upx;
		border: solid 1upx rgba(0, 0, 0, 0.3);
		padding: 20upx;
		font-size: 40upx;
		border-radius: 10upx;
	}
</style>
