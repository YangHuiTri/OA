<?php
//声明命名空间
namespace Admin\Controller;
//引入父类
use Think\Controller;
//声明并继承父类
class KnowledgeController extends CommonController{

	//添加知识
	public function add(){
		//判断请求类型
		if(IS_POST){
			//处理请求数据
			$post = I('post.');
			//实例化自定义模型
			$model = D('Knowledge');
			//数据保存方法
			$result = $model -> addData($post,$_FILES['thumb']);
			//判断结果
			if($result){
				//成功
				$this -> success('添加成功',U('showList'),3);
			}else{
				//失败
				$this -> error('添加失败');
			}
		}else{
			//展示模板
			$this -> display();
		}
	}

	//知识列表
	public function showList(){
		//查询数据
		$model = M('Knowledge');
		$data = $model -> select();
		//变量分配
		$this -> assign('data', $data);
		//展示模板
		$this -> display();
	}

	//下载缩略图
	public function download(){
		//获取id
		$id = I("get.id");
		//查询数据信息
		$data = M('Knowledge') -> find($id);
		//下载代码
		$file = WORKING_PATH . $data['picture'];
		header("Content-type: application/octet-stream");
		header('Content-Disposition: attachment; filename="' . basename($file) . '"');
		header("Content-Length: ". filesize($file));
		readfile($file);
	}



}