<div align="center">
    <img src="https://oss.celaraze.com/chemex/logo.png" />
</div>

<p align="center">
<a href="http://chemex.it" target="_blank">咖啡壶（Chemex）官方网站</a> |
<a href="https://chemex.famio.cn" target="_blank">Demo 演示站点</a>
</p>

<p align="center">
    <img src="https://img.shields.io/badge/Latest Release-2.0.0-orange" />
    <img src="https://img.shields.io/badge/PHP-7.3+-green" />
    <img src="https://img.shields.io/badge/MariaDB-10.2+-blueviolet" />
    <img src="https://img.shields.io/badge/License-GPL3.0-blue" />
</p>

<p align="center">
    <img src="https://travis-ci.com/Celaraze/Chemex.svg?branch=main" />
    <img src='https://gitee.com/celaraze/Chemex/badge/giteego.svg?name=PHP base env build&id=13010' />
    <img src="https://github.com/Celaraze/Chemex/workflows/Laravel/badge.svg?event=push" />
    <img src="https://app.fossa.com/api/projects/git%2Bgithub.com%2FCelaraze%2FChemex.svg?type=shield" />
</p>

<p align="center">
    <img src="https://app.fossa.com/api/projects/git%2Bgithub.com%2FCelaraze%2FChemex.svg?type=large" />
</p>

## 鸣谢

没有它们就没有 咖啡壶（Chemex）：

`JetBrains` 提供优秀的IDE。

<a href="https://www.jetbrains.com/?from=Chemex" target="_blank">
<img src="https://oss.celaraze.com/chemex/jetbrains.svg" />
</a>

[Laravel](https://laravel.com/) ，优雅的 PHP Web 框架。

[Dcat Admin](https://dcatadmin.com) ，高颜值、高效率的后台开发框架。

`Dr. Peter Schlumbohm`，感谢发明了 Chemex 冲煮咖啡。

## 简介

咖啡壶（Chemex）是一个轻量的、现代设计风格的 ICT 资产管理系统。得益于 [Laravel](https://laravel.com/) 框架以及 [Dcat Admin](https://dcatadmin.com) 开发平台，使其具备了优雅、简洁的优秀体验。
咖啡壶（Chemex） 是完全免费且开源的，任何人都可以无限制的修改代码以及部署服务，这对于很多想要对ICT资产做信息化管理的中小型企业来说，是一个很好的选择：低廉的成本换回的是高效的管理方案，同时又有健康的生态提供支持。

<p align="center">
    <img src="https://oss.celaraze.com/chemex/Chemex%20%E5%92%96%E5%95%A1%E5%A3%B6%20%281%29.png" />
</p>

`1.x` 版本升级到 `2.x` 版本请参考：[1.x升级2.x的操作方式](https://gitee.com/celaraze/Chemex/wikis/1.x%E5%8D%87%E7%BA%A72.x%E7%9A%84%E6%93%8D%E4%BD%9C%E6%96%B9%E5%BC%8F) 。

## 特点

涵盖 IT 资产管理的基本功能需求，项目主导者有八年多运维管理经验。

社区响应速度快，提出 Issue 后都会及时回复。

尽可能的操作简化，能一步解决的，绝不会设计第二步。

UI设计来自多个优秀开源项目，例如：Bootstrap、AdminLTE、Apex Charts等。
  
### 版本号命名

咖啡壶（Chemex）将会以咖啡豆品种作为 `major` 版本的命名，例如 `1.x` 版本称为 `肯亚（Kenya）`，旨在为 ICT 运维人员提供管理能力的同时，普及咖啡知识，静下心喝一杯属于当前版本的冲煮咖啡。

|major|版本名|发布|
|----|----|----|
|1.x|肯亚（Kenya）|✔|
|2.x|耶加雪菲（Yirgacheffe）|➖|

## 环境要求

`git`，用于管理版本，部署和升级必要工具。

`PHP 7.3 +`

`MariaDB 10.2 +`，数据库引擎，理论上 `MySQL 5.6+` 兼容支持。

`ext-zip` 扩展，注意和 PHP 版本相同。

`ext-json` 扩展，注意和 PHP 版本相同。

## 部署

> 注意：使用过程中，必须避免直接修改数据库数据，Laravel 拥有强大的 Eloquent ORM 模型层，Chemex 中的所有逻辑交互都由模型关联完成，直接修改数据库数据将会导致未知的错误。应用脱离数据库直接交互是现在最流行的做法。

> 视频部署演示教程：https://www.bilibili.com/video/BV1uK4y1j7pw/

生产环境下为遵守安全策略，非常建议在服务器本地进行部署，暂时不提供相关线上初始化安装的功能。因此，虽然前期部署的步骤较多，但已经为大家自动化处理了很大部分的流程，只需要跟着下面的命令一步步执行，一般是不会有部署问题的。

1：为你的计算机安装 `git`，Windows 环境请安装这个，Linux 环境一般都会自带，如果没有就执行 `yum/apt` 命令来安装即可。

2：为你的计算机安装 `PHP` 环境，参考：[PHP官方](https://www.php.net/downloads) 。

3：为你的计算机安装 `mariaDB`。

4：创建一个数据库，命名任意，但记得之后填写配置时需要对应正确，并且数据库字符集为 `utf8-general-ci`。

5：在你想要的目录中，执行 `git clone https://gitee.com/celaraze/Chemex.git` 完成下载。

6：在项目根目录中，复制 `.env.example` 文件为一份新的，并重命名为 `.env`。

7：在 `.env` 中配置数据库信息以及 `APP_URL` 信息。

8：进入项目根目录，执行 `php artisan migrate` 进行数据库迁移。

9：进入项目根目录，执行 `php artisan chemex:install` 进行安装，进度会卡住没反应（一般来说5秒），直接按回车继续即可。

10：你可能使用的web服务器为 `nginx` 以及 `apache`，无论怎样，应用的起始路径在 `/public` 目录，请确保指向正确。

11：修改web服务器的伪静态规则为：`try_files $uri $uri/ /index.php?$args;`。

12：此时可以通过访问 `http://your_domain` 来使用 咖啡壶（Chemex）。管理员账号密码为：`admin / admin`。

## 更新（通过Git Pull方式）

随时随地保持更新可以在项目根目录中执行 `sudo git pull reset --hard && git pull --force` 命令，将会同步分支的最新修改内容。

接着，执行 `php artisan migrate` 来更新数据库结构。

然后，执行 `php artisan db:seed --class=AdminTablesSeeder` 来更新数据库表数据。

享受使用吧。

## 截图

![](https://oss.celaraze.com/cache/screencapture-chemex-dev-famio-cn-auth-login-1603706219204.png)

![](https://oss.celaraze.com/cache/screencapture-chemex-dev-famio-cn-1603706238227.png)

![](https://oss.celaraze.com/cache/screencapture-chemex-dev-famio-cn-device-records-1603706430021.png)

![](https://oss.celaraze.com/cache/screencapture-chemex-dev-famio-cn-1603706418946.png)

![](https://oss.celaraze.com/cache/screencapture-chemex-dev-famio-cn-update-1603706399037.png)

![](https://oss.celaraze.com/cache/screencapture-chemex-dev-famio-cn-device-records-1603706347150.png)

![](https://oss.celaraze.com/cache/screencapture-chemex-dev-famio-cn-software-records-1603706367326.png)

![](https://oss.celaraze.com/cache/screencapture-chemex-dev-famio-cn-software-records-1603706441673.png)

## 参与贡献

`Fork` 本仓库，修改代码，提交 `Pull Request`。

## 开源协议

咖啡壶（Chemex）遵循 [GPL3.0](https://www.gnu.org/licenses/gpl-3.0.html) 开源协议。
