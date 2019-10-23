## OverTeam

团队伙伴能力综合考量管理的工具，可自定义考量维度，定期记录考核指标，并生成每个员工对应的能力成长曲线。

同时，还包括了对团队内所需技能的管理，细化到伙伴的技能管理，技能成长度、掌握情况的反应。

## 安装

``` git clone  ``` 本项目

根目录运行 ``` composer install ``` 安装依赖

复制 ```.env.example``` 为 ```.env```

修改根目录 ```.env``` 文件进行本地化配置（数据库名称为overteam）

将根目录数据库脚本 ``` init.sql ``` 导入到您的数据库中

根目录运行 ``` php artisan key:generate ``` 生成应用密钥

根目录运行 ``` php artisan optimize ``` 清理缓存

Done！请通过 ```domain.com/admin``` 访问，默认登录用户名和密码都为 ```admin```

## 截图

![1.png](https://i.loli.net/2019/10/23/i4gFa1Ah5ENuMdk.png)

![2.png](https://i.loli.net/2019/10/23/lISshRAqU4DgfiC.png)

![3.png](https://i.loli.net/2019/10/23/U2CcdJFa9Oy3Mpi.png)

![4.png](https://i.loli.net/2019/10/23/TC9UAepuc1ydRWH.png)

## 贡献

首先感谢以下开源项目：

- **[Laravel](https://laravel.com/)**

- **[Laravel-Admin](https://laravel-admin.org/)**


所有的贡献者都在本项目的贡献清单中。

## 安全漏洞

如果您在OverTeam中发现安全漏洞，请通过 [famio@qq.com](mailto:famio@qq.com) 发送电子邮件告知我。

## 开源协议

遵循 [MulanPSL1.0 license](https://license.coscl.org.cn/MulanPSL/) 开源协议。
