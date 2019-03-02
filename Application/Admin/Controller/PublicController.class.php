<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller{
	//登录
	public function login(){
		//展示视图
		$this->display();
	}

	//验证码
	public function captcha(){
		//配置
		$cfg = array(
			'fontSize'	=>	12,
			'useCurve'	=>	false,
			'useNoise'	=>	false,
			'imageH'	=>	38,
			'imageW'	=>	90,
			'length'	=>	4,
			'fontttf'	=>	'4.ttf',
		);
		//实例化验证码类
		$verify = new \Think\Verify($cfg);
		//输出验证码
		$verify -> entry();
	}

	//登录验证
	public function checkLogin(){
		//接收数据
		$post = I('post.');
		//验证验证码
		$verify = new \Think\Verify();
		//验证
		$result = $verify -> check($post['captcha']);
		//判断验证码是否正确
		if($result){
			//验证码正确，继续处理用户名和密码
			$model = M('User');
			//删除接收的数据中验证码数据
			unset($post['captcha']);
			//查询
			$data = $model -> where($post) -> find();
			//判断是否存在用户
			if($data){
				//存在用户,用户信息持久化保存到session中，跳转到后台首页
				session('id',$data['id']);
				session('username', $data['username']);
				session('role_id', $data['role_id']);
				//跳转
				$this -> success('登录成功',U('Index/index'),3);
			}else{
				//不存在
				$this -> error('用户名或密码错误...');
			}
		}else{
			//验证码不正确
			$this -> error('您输入的验证码错误...');
		}
	}

	//退出方法
	public function logout(){
		//清除session
		session(null);
		//跳转
		$this -> success('退出成功',U('login',3));
	}


}