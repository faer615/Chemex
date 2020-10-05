<div align="center">
    <img src="http://chemex.io/assets/images/logo.png"/>
    <h2>Chemex</h2>
</div>

<p align="center">
<a href="http://chemex.io">Chemex 官方网站</a> |
<a href="http://chemex.io">Demo 演示站点</a>
</p>

<p align="center">
    <img src="https://img.shields.io/badge/Latest Release-1.1.0-orange" />
    <img src="https://img.shields.io/badge/PHP-7.3+-green" />
    <img src="https://img.shields.io/badge/MySQL-5.6+-blueviolet" />
    <img src="https://img.shields.io/badge/License-GPL3.0-blue" />
</p>

## 关于Chemex

Chemex是一个轻量的、现代设计风格的ICT设备资产管理系统。得益于 [Laravel](https://laravel.com/) 框架以及 [Dcat Admin](https://dcatadmin.com) 开发平台，使其具备了优雅、简洁的优秀体验。
Chemex是完全免费且开源的，任何人都可以无限制的修改代码以及部署服务，这对于很多想要对ICT资产做信息化管理的中小型企业来说，是一个很好的选择：低廉的成本换回的是高效的管理方案，同时又有健康的生态提供支持。

系统拥有以下模块：

- 设备台账管理

    - 其中包含了设备的名称、所有软硬件、制造商、购入日期、保护日期、IP地址、MAC、使用者等维护内容，同时拥有设备相关历史记录。

- 硬件台账管理

    - 其中包含了硬件的名称、规格、序列号、归属设备管理等维护内容，同时拥有硬件相关历史记录。

- 软件台账管理
    
    - 其中包含了软件的名称、版本、分发方式、授权方式、购入金额、序列号、授权数量管理等维护内容，也有软件相关历史记录。

- 雇员管理

- 盘点管理
    
    - 设备、硬件、软件盘点任务的创建、完成和取消。
    
    - 盘盈盘亏。
    
    - 指定盘点负责人员。

- 数据图表

- 多国语言

    - 目前暂时最优支持中文简体，后续会发布英文语言，同时会支持语言切换。

- 私有化部署

    - 是的，只需要一个 `LNMP` 环境，就可以无限制的私有化部署。

## 最新版本

[1.1.0](https://gitee.com/famio/Chemex/raw/master/releases/Chemex-1.1.0.zip)

## 环境要求

`PHP 7.3 +`

`Mysql 5.6 +`

源码开发依赖于`composer`包管理器。

## 部署

### 生产环境部署

1：为你的计算机安装 `PHP` 环境，参考：[PHP官方](https://www.php.net/downloads) 。

2：为你的计算机安装 `MySQL` 或者 `mariaDB` 。

3：下载 [发行版](https://github.com/Celaraze/Chemex/releases) ，解压得到程序目录，放置到你想要放置的地方。

4：在项目根目录中，执行 `php artisan chemex:install` 根据提示进行安装。

5：你可能使用的web服务器为 `nginx` 以及 `apache`，无论怎样，应用的起始路径在 `/public` 目录，请确保指向正确。

6：修改web服务器的伪静态规则为：`try_files $uri $uri/ /index.php?$args;`。

### 开发环境部署

欢迎对此感兴趣的开发者进行协同开发，使 Chemex 更趋于完美。开发过程相对于简单，没有过多的环境配置和改动。

1：为你的计算机安装 `PHP` 环境，参考：[PHP官方](https://www.php.net/downloads) 。

2：安装 `composer` 包管理工具，参考：[composer官方](https://getcomposer.org/download/) 。

3：进入项目根目录，执行 `composer install`以安装相关依赖。

4：在项目根目录中，复制 `.env.example` 为 `.env`。

5：编辑 `.env` 文件中的数据库连接配置相关字段。

6：仍然在项目根目录中，执行 `php artisan migrate` 进行数据库迁移。

7：参考 [Laravel](https://laravel.com/) 以及 [Dcat Admin](https://dcatadmin.com) 相关文档进行开发。

## 截图

![](https://oss.liujunyang.com/images/cache/screencapture-127-0-0-1-8000-auth-login-1600257365001.png)

![](https://oss.liujunyang.com/images/cache/screencapture-127-0-0-1-8000-software-records-create-1600257882966.png)

![](https://oss.liujunyang.com/images/cache/screencapture-127-0-0-1-8000-admin-1600171136666.png)

![](https://oss.liujunyang.com/images/cache/screencapture-127-0-0-1-8000-admin-software-records-create-1600170694210.png)

## 参与贡献

1：`Fork` 本仓库。

2：修改代码。

3：新建 `Pull Request`。

## 开源协议

Chemex 遵循 [GPL3.0](https://www.gnu.org/licenses/gpl-3.0.html) 开源协议。
