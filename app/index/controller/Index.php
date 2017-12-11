<?php
/**
 * Created by PhpStorm.
 * User: 诺言
 * Date: 2017/12/5
 * Time: 19:59
 */

namespace app\index\controller;


use system\model\Stu;
use yyf\core\Controller;
use yyf\model\Model;
use yyf\view\View;

class Index extends Controller
{
	public function __construct ()
	{
	}

	public function index ()
	{

		//测试能否使用
		//echo 1;
		//测试模型类，数据库连接正常，查询语句使用正常
		//dd(Model::q('select * from tag'));
		//排序封装

		// $data="select*from student where age>30 order by age desc";
		//dd(Stu::where('age>19')->order('age,desc')->getAll());
		//dd(Stu::q('select * from stu'));
		View::fetch();



	}

	public function add ()
	{
		//静态调用
		//View::fetch();
		//用于测试分离变量的变量
		//$a='nish';

		//实例化调用分离变量并加载模板的方法with和fetch
		//(new View())->with('a',$a)->fetch('index');
	}


}
