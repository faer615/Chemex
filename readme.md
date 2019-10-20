<img src="https://images.gitee.com/uploads/images/2019/1020/180446_e3f18517_463895.jpeg">

## TeamOne

TeamOne是一个用于管理员工各方面维度评价以及技能掌握情况的开源应用。

## 安装

``` git clone  ``` 本项目

根目录运行 ``` composer install ``` 安装依赖

复制 ```.env.example``` 为 ```.env```

修改根目录 ```.env``` 文件进行本地化配置（数据库名称为teamone）

将根目录数据库脚本 ``` init.sql ``` 导入到您的数据库中

根目录运行 ``` php artisan key:generate ``` 生成应用密钥

根目录运行 ``` php artisan optimize ``` 清理缓存

Done！请通过 ```domain.com/admin``` 访问，默认登录用户名和密码都为 ```admin```

## 截图

![0.png](https://i.loli.net/2019/10/20/wQzgbOFfvj9hCt7.png)

![1.png](https://i.loli.net/2019/10/20/pFKvbX4172P9fh6.png)

![2.png](https://i.loli.net/2019/10/20/WUQR59LvK4tSfCu.png)

![3.png](https://i.loli.net/2019/10/20/Y7ViByxQ8fretOJ.png)

![4.png](https://i.loli.net/2019/10/20/ox9zljtCHPnaTc8.png)

![5.png](https://i.loli.net/2019/10/20/A3zlhOeviModuWf.png)

## 贡献

首先感谢以下开源项目：

- **[Laravel](https://laravel.com/)**

- **[Laravel-Admin](https://laravel-admin.org/)**


所有的贡献者都在本项目的贡献清单中。

## 安全漏洞

如果您在TeamOne中发现安全漏洞，请通过 [famio@qq.com](mailto:famio@qq.com) 发送电子邮件告知我。

## 开源协议

遵循 [MulanPSL1.0 license](https://license.coscl.org.cn/MulanPSL/) 开源协议。
