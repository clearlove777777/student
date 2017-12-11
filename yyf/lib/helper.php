<?php
/**
 * 助手函数
 */
header ( 'Content-type:text/html;charset=utf8' );
//设置时区【PRC东八区北京时间】
date_default_timezone_set ( 'PRC' );
//打印函数
if ( ! function_exists ( 'dd' ) ) {
	function dd ( $var )
	{
		echo '<pre style="width: 100%;background: #ccc;border-radius: 2px;padding: 6px;box-sizing: border-box">';
		if ( is_bool ( $var ) || is_null ( $var ) ) {
			var_dump ( $var );
		} else {
			print_r ( $var );
		}
		echo '</pre>';
	}
}


/**
 * 检测是否为post提交
 */
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
	//说明是post请求
	define ( 'IS_POST' , true );
} else {
	define ( 'IS_POST' , false );
}
/**
 * 检测是否为ajax
 */
if ( isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] == 'XMLHttpRequest' ) {
	define ( 'IS_AJAX' , true );
} else {
	define ( 'IS_AJAX' , false );
}
/**
 * C 操作配置项
 *
 * @param $var 操作配置项的文件名字
 * @param $value 操作的配置项名字
 *
 * @return array|mixed|null
 */
function c ( $var , $value)
{
	//如果没有传入配置项文件名，直接停止运行
	if (!$var) {
		return null;
	}
	//p($var);//database


	//加载对应的配置项文件
	$file = "../system/config/" . $var . '.php';
	//文件不存在，停止运行
	if ( ! is_file ( $file ) ) {
		return null;
	}
	$data = include $file;
	//p($data);die;
	//如果有一个元素，那么
	if ( !$value) {
		//返回全部数据
		return $data;
	}
	else {
		//说明数组有多个元素
		return isset( $data[ $value ] ) ? $data[ $value ] : null;
	}


}











