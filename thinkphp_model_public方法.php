<?php
/**
 * 得到当前的数据对象名称
 */
public function getModelName() {}
/**
 * 得到完整的数据表名
 */
public function getTableName() {}
/**
 * 启动事务
 */
public function startTrans() {}
/**
 * 获取执行的SQL语句
 */
public function fetchSql($fetch=true){}
/**
 * 指定当前的数据表
 */
public function table($table) {}
/**
 * 获取数据表字段信息
 */
public function getDbFields(){}
/**
 * 获取主键名称
 */
public function getPk(){}
/**
 * 返回最后执行的sql语句
 */
public function getLastSql() {}
/**
 * 鉴于getLastSql比较常用 增加_sql 别名
 */
public function _sql(){}
/**
 * 返回最后插入的ID
 */
public function getLastInsID() {}