<?php

namespace yyf\model;

use Exception;
use PDO;

class Base
{
	private static $pdo = null;
	protected $table;
	protected $field='';
	protected $where;
    protected $order;
	public function __construct ($class)
	{
		//获取表名
		$this->table = strtolower (ltrim (strrchr($class,'\\'),'\\'));
		//1.连接数据库
		if ( is_null ( self ::$pdo ) ) {
			$this -> connect ();
		}
	}



	/**
	 * 连接数据库
	 */
	private function connect ()
	{
		try {
			$dsn        = c('database','driver').":host=".c('database','host').";dbname=".c('database','dbname');
			$user       = c('database','user');
			$password   = c('database','password');
			self ::$pdo = new PDO( $dsn , $user , $password );
		} catch ( Exception $e ) {
			exit( $e -> getMessage () );
		}
	}

	//执行有结果集的查询
	//select
	public function q ( $sql )
	{
		try {
			//执行sql语句
			$res = self ::$pdo -> query ( $sql );

			//将结果集取出来
			return $res -> fetchAll ( PDO::FETCH_ASSOC );
		} catch ( Exception $e ) {
			die( $e -> getMessage () );
		}
	}

	//执行无结果集的sql
	//insert、update、delete
	public function e ( $sql )
	{
		try {
			return self ::$pdo -> exec ( $sql );
		} catch ( Exception $e ) {
			//输出错误消息
			die( $e -> getMessage () );
		}
	}
	public function field($field){
		//赋值
		$this->field=$field;
		return $this;
	}
	public function where($where){
		//赋值

		$this -> where = 'where ' . $where;
		return $this;
	}
	public function find ( $pk )
	{
		//p($this->table);
		//获取查询数据表的主键
		$priKey = $this -> getPriKey ();
		$this->field  = $this->field ? : '*';
		//$sql = "select * from student where id=1";
		$sql = "select {$this->field} from {$this->table} where {$priKey}={$pk}";
		$res = $this -> q ( $sql );

		return current ( $res );
	}
	public function first ()
	{
		//$sql = "select * from student where sname='赵虎'";
		$this->field  = $this->field ? : '*';

		$sql  = "select {$this->field} from {$this->table} {$this->where}";
		$data = $this -> q ( $sql );

		//p($data);
		return current ( $data );
	}
	public function getPriKey ()
	{
		$sql = "desc {$this->table}";
		$res = $this -> q ( $sql );
		//p($res);//这里一定要打印看数据
		foreach ( $res as $k => $v ) {
			if ( $v[ 'Key' ] == 'PRI' ) {
				$priKey = $v[ 'Field' ];
				break;
			}
		}

		return $priKey;
	}

	public function insert($data){
		//p($data);die;
		$field = '';
		$value = '';
		foreach($data as $k=>$v){
			$field .= $k . ',';
			if(is_int ($v)){
				$value .= $v . ',';
			}else{
				$value .= "'$v'" . ',';
			}
		}
		$field = rtrim ($field,',');
		//p($field);die;
		$value = rtrim ($value,',');
		//p($value);die;
		//$sql = "insert into student (age,sname,sex,cid) values (1,'超人','男',1)";
		$sql = "insert into {$this->table} ({$field}) values ({$value})";
		//p($sql);die;
		return $this->e ($sql);
	}
	public function delete(){
		//如果没有where条件不允许更新
		if(!$this->where){
			return false;
		}
		//$sql = "delete from student where id=1";
		$sql = "delete from {$this->table} {$this->where}";
		return $this->e ($sql);
	}
	public function update($data){
		//如果没有where条件不允许更新
		if(!$this->where){
			return false;
		}
		$set = '';
		foreach($data as $k=>$v){
			if(is_int ($v)){
				$set .= $k . '=' . $v . ',';
			}else{
				$set .= $k . '=' . "'$v'" . ',';
			}
		}
		$set = rtrim($set,',');
		//p($set);die;
		//sql = "update student set sname='',age=19,sex='男' where id=1";
		$sql = "update {$this->table} set {$set} {$this->where}";
		return $this->e ($sql);
	}

	public function getAll ()
	{
		//如果他成立用自己本身，不成立用星
		$this->field  = $this->field ? : '*';
		//原生sql语句
		//$sql = "select * from student";
		//所有的数据表统一走一个属性（table属性）
		$sql = "select {$this->field} from {$this -> table}  {$this->where} {$this->order}";
		//p($sql);die;
		//返回所有数据的一个数组数据
		return $this -> q ( $sql );
	}
	public function order($order){
		//将$order转为数组
		$order=explode (',',$order);
		//dd($order);
		//拼接好赋值给$order
		$this->order='order by '.$order[0]." $order[1]";
		//$sql="select*from student where age>30 order by age desc";
		//返回对象
		return $this;

	}
}