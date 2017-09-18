#创建数据库
create database itcast charset utf8;

#选择数据库
use itcast;

-- 2)	需求：创建学生就业信息表，存储：学号,姓名，公司名称，就业薪资，毕业时间
create table job_info(
id int,
name varchar(10),
company varchar(30),
salary float,
grad_time date,
tel char(11),
qq varchar(12)
);

function f1($a =13){
	
}

#创建学生就业信息表，存储：学号,姓名，公司名称，就业薪资，毕业时间
create table job(
stu_id int primary key auto_increment comment "学号",
name varchar(10) not null unique key ,
sex char(2) not null default "保密",
company varchar(40),
#7 所有位数 2 小数位数 整数5位
salary decimal(7,2),
grad_time date comment "毕业时间"
);

#创建商品表
#编号 名称 价格 分类 销量 推荐数 是否包邮 图片路径 
create table goods(
goods_id int primary key auto_increment,
goods_name varchar(40) not null unique key,
price decimal(6,1) not null default 100,
cat varchar(20) ,
sales int not null default 100,
recommend int not  null default 200 comment "推荐数",
is_post_free tinyint not null default 1 comment "1包邮 0到付",
pic_path varchar(200) comment "图片保存路径"
); 

insert into goods (goods_id,goods_name,cat,price) values (null,'iphone x','手机',8388.9);
insert into goods values (666,'小米6',6999.9,'手机',9999,499,0,'./upload/1.png||./upload/2.png');
insert into goods values (null,'小米Mix',3999.9,'手机',9999,499,0,'./upload/1.png||./upload/2.png');

#用户编号 用户名 密码（md5加密--32位字符串保存） 上一次登录IP 上次登录时间 
create table user(
uid int primary key auto_increment,
username varchar(20) not null unique key,
pass char(32) comment "加密的密码",
last_ip varchar(20),
last_login datetime
);

insert into user values (null,'张三',md5('123456'),'1.2.3.4','2017-12-13 12:13:14');

insert into goods values 
	(null,'小米空气净化器',3999.9,'家电',9999,499,0,'./upload/1.png||./upload/2.png'),
	(null,'小米2',6999.9,'手机',9999,499,0,'./upload/1.png||./upload/2.png'),
	(null,'小米6',6999.9,'手机',9999,499,0,'./upload/1.png||./upload/2.png'),
	(null,'小米6',6999.9,'手机',9999,499,0,'./upload/1.png||./upload/2.png'),
	(null,'花裙子',999.9,'服装',9999,499,1,'./upload/1.png||./upload/2.png');

-- 学生表
create table stu(
id int primary key auto_increment,
name varchar(10) not null unique key,
class_id int
);

insert into stu values 
	(null,'陈诚',3),
	(null,'张成',1),
	(null,'徐杰',1),
	(null,'李刚',2),
	(null,'刘熙',3);

-- 班级表
create table class(
class_id int primary key auto_increment,
class_name varchar(20) not null unique key,
major varchar(20),
tutor varchar(20)
);

insert into class values 
	(null,'前端14','前端移动','宫老师'),
	(null,'前端15','前端移动','王老师'),
	(null,'大数据1','大数据','李老师');

select * from stu join class on stu.class_id =class.class_id;
select stu.*,class_name,major,tutor from stu join class on stu.class_id =class.class_id;

select * from apple_p join apple_c on apple_p.cid =apple_c.id;
select apple_p.*,apple_c.name,seq from apple_p join apple_c on apple_p.cid =apple_c.id;
select apple_p.*,apple_c.name,seq from apple_p join apple_c on apple_p.cid =apple_c.id
	where price > 4000;

	select * from apple_p where price > (select price from apple_p where name ="iphone7");