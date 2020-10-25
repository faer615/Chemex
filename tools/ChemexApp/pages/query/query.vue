<template>
	<view>

	</view>
</template>

<script>
	export default {
		data() {
			return {
				url: '',
				config: ''
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
						content: '没有找到配置信息'
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
