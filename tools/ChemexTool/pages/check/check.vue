<template>
	<view>

	</view>
</template>

<script>
	export default {
		data() {
			return {
				config: '',
				string: '',
			}
		},
		onLoad() {
			let that = this;
			uni.getStorage({
				key: 'config',
				success(res) {
					that.jwt = res.data;
					that.scan();
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
					success: function(res) {
						console.log('条码类型：' + res.scanType);
						console.log('条码内容：' + res.result);
						that.string = res.result;
						uni.showLoading({
							title: '正在读取'
						})
						uni.request({
							url: that.config.domain + '/api/check/' + that.string,
							method: 'GET',
							header: {
								Authorization: that.config.jwt
							},
							success(res) {
								if (res.statusCode == 200 && res.data.code == 200) {
									uni.showModal({
										title: '盘点选项',
										content: '请选择盘点结果',
										confirmText: '盘盈',
										cancelText: '盘亏',
										success(res) {
											if (res.confirm) {
												that.check(res.data.data.id, 1);
											}
											if (res.cancel) {
												that.check(res.data.data.id, 2);
											}
										}
									})
								}
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
					url: that.config.domain + '/api/check/do',
					data: {
						track_id: id,
						option: option
					},
					header: {
						Authorization: that.config.jwt
					},
					success(res) {
						if (res.statusCode == 200 & res.data.code == 200) {
							uni.showModal({
								title: '提示',
								content: '盘点完成',
								showCancel: false
							})
						}
					}
				})
			}
		}
	}
</script>

<style>

</style>
