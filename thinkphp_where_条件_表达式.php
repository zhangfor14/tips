<?php
Where 条件表达式格式为：

$map['字段名']  = array('表达式', '操作条件');
其中 $map 是一个普通的数组变量，可以根据自己需求而命名。上述格式中的表达式实际是运算符的意义：

ThinkPHP运算符 与 SQL运算符 对照表
TP运算符	SQL运算符	例子	实际查询条件
eq	=	$map['id'] = array('eq',100);	等效于：$map['id'] = 100;
neq	!=	$map['id'] = array('neq',100);	id != 100
gt	>	$map['id'] = array('gt',100);	id > 100
egt	>=	$map['id'] = array('egt',100);	id >= 100
lt	<	$map['id'] = array('lt',100);	id < 100
elt	<=	$map['id'] = array('elt',100);	id <= 100
like	like	$map<'username'> = array('like','Admin%');	username like 'Admin%'
between	between and	$map['id'] = array('between','1,8');	id BETWEEN 1 AND 8
not between	not between and	$map['id'] = array('not between','1,8');	id NOT BETWEEN 1 AND 8
in	in	$map['id'] = array('in','1,5,8');	id in(1,5,8)
not in	not in	$map['id'] = array('not in','1,5,8');	id not in(1,5,8)
and（默认）	and	$map['id'] = array(array('gt',1),array('lt',10));	(id > 1) AND (id < 10)
or	or	$map['id'] = array(array('gt',3),array('lt',10), 'or');	(id > 3) OR (id < 10)
xor（异或）	xor	两个输入中只有一个是true时，结果为true，否则为false，例子略。	1 xor 1 = 0
exp	综合表达式	$map['id'] = array('exp','in(1,3,8)');	$map['id'] = array('in','1,3,8');
补充说明

同 SQL 一样，ThinkPHP运算符不区分大小写，eq 与 EQ 一样。
between、 in 条件支持字符串或者数组，即下面两种写法是等效的：
$map['id']  = array('not in','1,5,8');
$map['id']  = array('not in',array('1','5','8'));
exp 表达式

上表中的 exp 不是一个运算符，而是一个综合表达式以支持更复杂的条件设置。exp 的操作条件不会被当成字符串，可以使用任何 SQL 支持的语法，包括使用函数和字段名称。

exp 不仅用于 where 条件，也可以用于数据更新，如：

$Dao = M("Article");

// 构建 save 的数据数组，文章点击数+1
$data['id'] = 10;
$data['counter'] = array('exp','counter+1');

// 根据条件保存修改的数据
$User->save($data);