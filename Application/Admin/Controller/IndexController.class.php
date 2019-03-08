<?php
//声明命名空间
namespace Admin\Controller;
//引入父类
use Think\Controller;
//声明当前类并继承父类
class IndexController extends CommonController{

	//index方法
	public function index(){
		//展示模板
		$this->display();
	}

	//home方法
	public function home(){
		//展示模板
		$this->display();
	}

}