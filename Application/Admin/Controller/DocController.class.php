<?php
//声明命名空间
namespace Admin\Controller;
//引入父类
use Think\Controller;
//声明并继承父类
class DocController extends Controller{

	//添加公文
	public function add(){
		//判断请求类型
		if(IS_POST){
			//接收数据
			$post = I('post.');
			//实例化模型
			$model = D('Doc');
			//数据保存
			$result = $model -> saveData($post,$_FILES['file']);
			//判断保存结果
			if($result){
				//成功
				$this -> success('添加成功!',U('showList'),3);
			}else{
				//失败
				$this -> error('添加失败！');
			}
		}else{
			//展示模版
			$this -> display();
		}
	}

	//公文列表
	public function showList(){
		//查询数据
		$model = M('Doc');
		$data = $model -> select();
		//分配变量
		$this -> assign('data', $data);
		//展示模板
		$this -> display();
	}



}