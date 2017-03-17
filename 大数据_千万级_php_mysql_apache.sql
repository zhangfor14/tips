



/**
 * 1.sql语句优化
 */
#一般查询sql语句
SELECT * FROM table WHERE id >= (SELECT id FROM table LIMIT 1000000, 1) LIMIT 10;
SELECT * FROM table WHERE id BETWEEN 1000000 AND 1000010;
SELECT * FROM table WHERE id IN(10000, 100000, 1000000...);
SELECT t1.* FROM gridhourmeteo t1 ,(SELECT ID FROM gridhourmeteo WHERE {$where} LIMIT {$page},50) t2 WHERE t1.ID=t2.ID

#通过简单的变换，实现千万级查询思路：
（1）通过优化索引，找出id，并拼成 “123,90000,12000″ 这样的字符串。
	SELECT id FROM table LIMIT 1000000, 1
（2）第2次查询找出结果。
	SELECT * FROM table WHERE id IN(10000, 100000, 1000000...);
 小小的索引+一点点的改动就使mysql 可以支持百万甚至千万级的高效分页！

#关于order by
30万数据时，加order by效率提高不多(1秒左右)，不加order by效率提高一半;10万数据时，效率提高明显。

#超过半数逆序分页法
意为判断分页开始id是否超过总数的一半，如果超过一半则反写sql，减小了LIMIT里面的offset值，从而提高效率。
30万数据，假如原SQL语句是ORDER BY id LIMIT 200000,20,可改写为ORDER BY id DESC LIMIT 99980,20,效率提高超过一个数量级。

/**
 * 2.mysql数据库优化,索引,分表
 */
#使用临时表缓存索引列，分页时使用临时表，获取到id用IN子查询。
SELECT id FROM table WHERE id IN(SELECT id FROM table_tmp LIMIT $start,$length);