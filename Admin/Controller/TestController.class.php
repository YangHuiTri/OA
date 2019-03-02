<?php
//声明当前控制器类的命名空间
namespace Admin\Controller;
//引入父类控制器
use Think\Controller;
// use Think\Verify;
//声明控制器并继承父类控制器
class TestController extends Controller{
	//测试方法
	public function test(){
		echo "hello world";
		$this->display();
	}

	public function test1(){
		echo U('index');
	}

	public function test2(){
		//成功跳转
		$this->success('操作成功',U('test'),5);
	}

	//变量分配
	public function test3(){
		$arr = array('name','zhangsan','age','23');
		//变量分配
		$this->assign('arr',$arr);
		//输出模板
		$this->display();
	}

	//模板中函数使用
	public function test4(){
		//定义时间戳
		$time = time();
		//传递给模板
		$this->assign('time',$time);
		//展示模板
		$this->display();
	}

	//验证码
	public function test5(){
		//配置
		$cfg = array(
			'fontSize'	=>	12,
			'useCurve'	=>	false,
			'useNoise'	=>	false,
			'length'	=>	4,
			'fontttf'	=>	'4.ttf',
		);
		//实例化验证码类
		$verify = new \Think\Verify($cfg);
		//输出验证码
		$verify -> entry();
	}

}