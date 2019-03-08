<?php
//声明命名空间
namespace Admin\Controller;
//引入父类
use Think\Controller;
//声明并继承父类
class CommonController extends Controller{

	// //构造方法
	// public function __construct(){
	// 	//构造父类
	// 	parent::__construct();
	// 	//判断是否登录

	// }

	//ThinkPHP提供
	public function _initialize(){
		//判断用户是否登录
		$id = session('id');
		if(empty($id)){
			//没有登录，跳转到登录页面
			// $this -> error('请先登录...',U('Public/login'),3);
			// exit;
			$url = U('Public/login');
			echo "<script>top.location.href='$url'</script>";exit;
		}
	}

}