<?php
/**
 * Created by PhpStorm.
 * User: 诺言
 * Date: 2017/12/6
 * Time: 21:07
 */

namespace yyf\core;


class Controller
{
	private $url;

	/**
	 * 消息提示
	 *
	 * @param $msg   提示消息
	 */
	public function message ( $msg )
	{
		include './view/message.php';
	}

	/**
	 * 跳转连接
	 *
	 * @param string $url
	 */
	public function setRedirect ( $url = '' )
	{
		if ( $url ) {
			//说明指定了跳转地址
			$this->url = "location.href='$url'";
		} else {
			//说明没有给跳转地址，默认back
			$this->url = "window.history.back()";
		}

		return $this;
	}

	/**
	 * 成功提示
	 *
	 * @param $msg    提示消息
	 * @param $url    跳转地址
	 */
	protected function success ( $msg , $url )
	{
		include '/view/success.html';
		die;
	}

	/**
	 * 失败提示
	 *
	 * @param $msg    提示消息
	 * @param $url    跳转地址
	 */
	protected function error ( $msg , $url = '' )
	{
		include 'view/error.html';
		die;
	}

}