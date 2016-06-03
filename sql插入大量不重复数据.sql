-- mysql学习总结一当数据不存在的时候插入，存在的时候进行更新，删除重复数据 (2013-04-24 09:04:01)转载▼
-- 标签： 技术	分类： mysql
create table books(

    id int not null auto_increment,
    name varchar(50),
    type int,
    primary key(id)

)

-- 当name不为admin时候才插入
insert into books (name,type) select 'admin','1'from dual where not exists (select name from books where name='admin')

-- name字段设置为唯一
alter table books add unique key(name);

-- 当unique 字段name 已存在admin 的时候不插入
insert ignore into books(name,type) values ('admin','1')

-- 取消唯一字段name
alter table books drop index name;

-- 当数据不存在的时候插入，存在的时候进行更新（name 必须设为unigue）
insert into books(name,type) values('admin','2') on duplicate key update name='admin',type=2

-- 查找表中多余的重复记录，重复记录是根据单个字段（name）来判断

select * from books
where name in (select name from books group by name having count(name) > 1)

-- 删除表中多余的重复记录（多个字段），只留有id最小的记录

delete from books where id not in(select id from (select min(id) id from books where name=name and type=type group by name,type) e);
