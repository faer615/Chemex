<template>
	<view>
		<u-button class="row" type="warning" @click="scan()">扫码查询</u-button>
		<view class="row">名称：{{ name }}</view>
		<view class="row">描述：{{ description }}</view>
		<view class="row">分类：{{ category }}</view>
		<view class="row">厂商：{{ vendor }}</view>
		<view class="row">序列号：{{ sn }}</view>
		<view class="row">MAC：{{ mac }}</view>
		<view class="row">IP：{{ ip }}</view>
		<image class="row" :src="photo" mode="aspectFit"></image>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				settings: '',
				name: '',
				description: '',
				category: '',
				vendor: '',
				sn: '',
				mac: '',
				ip: '',
				photo: '',

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
					success: function(res) {
						that.string = res.result;
						uni.showLoading({
							title: '正在读取'
						})
						uni.request({
							url: that.settings.domain + '/api/info/' + that.string,
							method: 'GET',
							header: {
								Authorization: that.settings.jwt
							},
							success(item) {
								console.log(item);
								if (item.statusCode == 200 && item.data.code == 200) {
									that.name = item.data.data.name;
									that.description = item.data.data.description;
									that.category = item.data.data.category.name;
									that.vendor = item.data.data.vendor.name;
									that.sn = item.data.data.sn;
									that.mac = item.data.data.mac;
									that.ip = item.data.data.ip;
									that.photo = item.data.data.photo;
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
			}
		}
	}
</script>

<style>
	.content {
		padding: 80 upx;
	}

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
