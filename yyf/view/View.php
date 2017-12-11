<?php
/**
 * Created by PhpStorm.
 * User: 诺言
 * Date: 2017/12/7
 * Time: 15:20
 */

namespace yyf\view;


class View
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
		return call_user_func_array([new Base(),$name],$arguments);

	}

}