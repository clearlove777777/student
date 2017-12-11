<?php
/**
 * Created by PhpStorm.
 * User: 诺言
 * Date: 2017/12/6
 * Time: 19:14
 */

namespace yyf\core;

use app\index\controller\Index;


class Yyf
{

	public static function index ()
	{
		//处理错误
		self::handler();
		//1.测试能不能调用方法

		//    echo 1;

		//2.初始化
		self::init ();
		//3.自动实例化
		self::autorun ();

	}
	//错误异常处理
	public static function handler(){
		$whoops = new \Whoops\Run;
		$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
		$whoops->register();
	}

	private static function init ()
	{
		//开启session
		session_id () || session_start ();


	}

	private static function autorun ()
	{
		//执行应用
		//检测到get参数之后进行
		if ( isset( $_GET[ 's' ] ) ) {
			//将得到的get参数转成数组
			$arr = explode ( '/' , $_GET[ 's' ] );
			//         dd($arr);die;
			//给每个模块，控制器，方法都给上默认值，单个输入或者两个输入都会补全
			$m = isset( $arr[ 0 ] ) ? $arr[ 0 ] : 'index';
			$c = isset( $arr[ 1 ] ) ? ucfirst ( $arr[ 1 ] ) : 'Index';
			$a = isset( $arr[ 2 ] ) ? $arr[ 2 ] : 'index';

		} else {
			//如果没输入也给上默认值
			$m = 'index';//模块
			$c = 'Index';//控制器类
			$a = 'index';//方法
		}
		//打印数据
		//dd($m);
		//dd($c);
		//dd($a);

		//     die;
		//定义常量
		//让get参数的模块，控制器，方法可以全局使用
		define ( 'MODULE' , $m );
		define ( 'CONTROLLER' , $c );
		define ( 'ACTION' , $a );
		//拼接好累的地址
		$obj = "\app\\{$m}\controller\\{$c}";


		//实例化类并调用方法
		//     echo (new $obj)->$a();
		echo call_user_func_array ( [ new $obj , $a ] , [] );

	}
}