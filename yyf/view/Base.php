<?php
/**
 * Created by PhpStorm.
 * User: 诺言
 * Date: 2017/12/7
 * Time: 15:23
 */

namespace yyf\view;


class Base
{
	public $data=[];
	public $file='';
	/**
	 * @param string $var 变量名
	 * @param        $val 变量值
	 *
	 * @return $this
	 */
	public function with($var='',$val){
		//把传入的变量名和变量值，存到属性data里面
		$this->data[$var]=$val;
		//dd($arr);
		return $this;
	}

	/**
	 * @param string $tpl 模板名
	 *
	 * @return $this
	 */
	public function fetch($tpl=''){
		//把数组键名转成变量名，键值转成变量值(生成变量)
		extract($this->data);
		//如果传入参数，那就加载传入的模板，如果没有就加载当前方法的模板
		$tpl=$tpl?$tpl:ACTION;
		//dd($tpl);
		$this->file='../app/'.MODULE.'/view/'.strtolower(CONTROLLER).'/'.$tpl.'.'.c('view','suffix');
		include $this->file;
		return $this;
	}
	public function __toString ()
	{
		//把数组键名转成变量名，键值转成变量值(生成变量)
		extract($this->data);
		//加载模板
		include $this->file;
		// TODO: Implement __toString() method.
		return '';
	}


}