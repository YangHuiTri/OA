<?php
//声明命名空间
namespace Admin\Controller;
//引入父类
use Think\Controller;
//声明并继承父类
class EmailController extends Controller{

	//发邮件
	public function send(){
		//判断请求类型
		if(IS_POST){
			//处理数据
			$post = I('post.');
			//实例化自定义模型
			$model = D('Email');
			//调用具体类中方法实现数据的保存
			$result = $model -> addData($post, $_FILES['file']);
			//判断结果
			if($result){
				//成功
				$this -> success('发送成功', U('sendBox'), 3);
			}else{
				//失败
				$this -> error('邮件发送失败');
			}
		}else{
			//查询收件人信息
			$data = M('User') -> field('id,truename') -> where('id != '.session('id'))->select();
			//变量分配
			$this -> assign('data', $data);
			//展示模板
			$this -> display();
		}
		
	}

	//发件箱
	public function sendBox(){
		//查询当前用户已经发送的邮件
		$data = M("Email") -> field('t1.*,t2.truename as truename') -> alias('t1') -> join('left join sp_user as t2 on t1.to_id = t2.id') -> where('t1.from_id = ' . session('id')) -> select();
		//将数据传递给模版
		$this -> assign('data',$data);
		//展示模版
		$this -> display();
	}

	//download
	public function download(){
		//接收id
		$id = I('get.id');
		//查询信息
		$data = M('Email') -> find($id);
		//下载代码
		$file = WORKING_PATH . $data['file'];
		header("Content-type: application/octet-stream");
		header('Content-Disposition: attachment; filename="' . basename($file) . '"');
		header("Content-Length: ". filesize($file));
		readfile($file);
	}


}