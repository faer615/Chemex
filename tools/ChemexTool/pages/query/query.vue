<template>
	<view>
		<view>名称</view>
		<view>描述</view>
		<view>分类</view>
		<view>制造商</view>
		<view>序列号</view>
		<view>MAC</view>
		<view>IP</view>
		<view>照片</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				config: '',
				item: ''
			}
		},
		onLoad() {
			let that = this;
			uni.getStorage({
				key: 'config',
				success(res) {
					that.config = res.data;
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
			query() {

			},
			scan() {
				uni.scanCode({
					success: function(res) {
						console.log('条码类型：' + res.scanType);
						console.log('条码内容：' + res.result);
					}
				});
			}
		}
	}
</script>

<style>

</style>
