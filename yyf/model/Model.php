<?php
/**
 * Created by PhpStorm.
 * User: 诺言
 * Date: 2017/12/7
 * Time: 16:25
 */

namespace yyf\model;


class Model
{
	public function __call ( $name , $arguments )
	{
		//dd($name);die;
		// TODO: Implement __call() method.
		return self::load($name , $arguments );
	}
	public static function __callStatic ( $name , $arguments )
	{
		//dd($name);die;
		// TODO: Implement __callStatic() method.
		return self::load($name , $arguments );

	}
	public static function load($name , $arguments ){
		$class=get_called_class();
		return call_user_func_array([new Base($class),$name],$arguments);

	}

}