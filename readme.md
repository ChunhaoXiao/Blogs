
我的第一个 laravel 5.5 项目 个人博客

安装步骤：

1: 克隆代码到本地  git clone https://github.com/ChunhaoXiao/Blogs.git

2: 运行  composer install

3: 复制配置文件 cp .env.example .env

4:修改配置文件 .env 的数据库配置  

5: 运行数据迁移命令 php artisan migrate

6: 运行 php artisan db:seed 填充数据

前台访问 localhost

后台 localhost/admin  管理员用户名：admin@admin.com  管理员密码：password

初学 laravel, 前端不是太懂，基本套用的模板，做了一些修改， jquery 代码是自己写的。后端脚本完全是自己写的。
后端主要用到了 laravel 的模型关联,包括 一对一、 一对多、 多对多。还有 laravel 的邮件发送，队列 等

用到的扩展包：

markdown 编辑器 axhello/laravel-markdown-editor
图片处理 intervention/image