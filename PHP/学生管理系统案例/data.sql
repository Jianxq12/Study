
#管理员表 管理员 编号 用户名  密码 上次登录时间
create table admin(
admin_id int primary key auto_increment,
user varchar(20) not null unique key,
password char(32) not null
);