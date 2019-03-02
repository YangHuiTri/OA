<?php
//声明当前控制器类的命名空间
namespace Home\Controller;
//引入父类控制器
use Think\Controller;
//声明控制器类并继承父类
class UserController extends Controller
{
	//测试方法
	public function test(){
		phpinfo();
	}
}