<template>
	<view class="content">
		<image class="logo" src="/static/logo.png"></image>
		<view class="mode">
			<view style="background-color: rgba(99,181,247,1);" @click="toQuery()">查询模式</view>
			<view style="background-color: rgba(76,181,171,1);" @click="toCheck()">盘点模式</view>
			<view style="background-color: rgba(255,153,76,1);" @click="toSetting()">站点配置</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				title: 'Hello'
			}
		},
		onLoad() {

		},
		methods: {
			toQuery() {
				uni.navigateTo({
					url: '../query/query'
				})
			},
			toCheck() {
				uni.navigateTo({
					url: '../check/check'
				})
			},
			toSetting() {
				uni.navigateTo({
					url: '../setting/setting'
				})
			}
		}
	}
</script>

<style>
	.content {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
	}

	.logo {
		height: 200rpx;
		width: 200rpx;
		margin-top: 200rpx;
		margin-left: auto;
		margin-right: auto;
		margin-bottom: 50rpx;
	}

	.mode {
		display: flex;
		flex-direction: column;
		justify-content: center;
	}

	.mode>view {
		color: white;
		width: 400upx;
		height: 150upx;
		margin-top: 50upx;
		display: flex;
		justify-content: center;
		align-items: center;
		font-size: 40upx;
		border-radius: 20upx;
	}

	.title {
		font-size: 36rpx;
		color: #8f8f94;
	}
</style>
