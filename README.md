## 关于Celestial

Celestial是一个轻量的、现代设计风格的ICT设备资产管理系统。得益于 [Laravel](https://laravel.com/) 框架以及 [Dcat Admin](https://dcatadmin.com) 开发平台，使其具备了优雅、简洁的优秀体验。
Celestial是完全免费且开源的，任何人都可以无限制的修改代码以及部署服务，这对于很多想要对ICT资产做信息化管理的中小型企业来说，是一个很好的选择：低廉的成本换回的是高效的管理方案，同时又有健康的生态提供支持。

系统拥有以下模块：

- 设备台账管理

- 硬件台账管理

- 软件台账管理

- 雇员管理

- 数据图表

- 多国语言

- 私有化部署

## 最新版本

目前 Celestial 正在开发的收尾阶段，即将发布。

## 环境要求

`PHP 7.3 +`

`Mysql 5.6 +`

源码开发依赖于`composer`包管理器。

## 部署

### 生产环境部署

> 待补充

### 开发环境部署

欢迎对此感兴趣的开发者进行协同开发，使 Celestial 更趋于完美。开发过程相对于简单，没有过多的环境配置和改动。

1：为你的计算机安装 `PHP` 环境，参考：[PHP官方](https://www.php.net/downloads) 。

2：安装 `composer` 包管理工具，参考：[composer官方](https://getcomposer.org/download/) 。

3：进入项目根目录，执行 `composer install`以安装相关依赖。

4：在项目根目录中，复制 `.env.example` 为 `.env`。

5：编辑 `.env` 文件中的数据库连接配置相关字段。

5：仍然在项目根目录中，执行 `php artisan migrate` 进行数据库迁移。

6：参考 [Laravel](https://laravel.com/) 以及 [Dcat Admin](https://dcatadmin.com) 相关文档进行开发。

## 截图

![](https://oss.liujunyang.com/images/cache/screencapture-127-0-0-1-8000-auth-login-1600257365001.png)

![](https://oss.liujunyang.com/images/cache/screencapture-127-0-0-1-8000-software-records-create-1600257882966.png)

![](https://oss.liujunyang.com/images/cache/screencapture-127-0-0-1-8000-admin-1600171136666.png)

![](https://oss.liujunyang.com/images/cache/screencapture-127-0-0-1-8000-admin-software-records-create-1600170694210.png)

## 参与贡献

1：`Fork` 本仓库。

2：新建 `Feat_xxx` 分支。

3：提交代码。

4：新建 `Pull Request`。

## 开源协议

Celestial 遵循 MIT 开源协议，任何人和组织都可以任意拷贝源代码进行修改、分发等，不受任何限制。
