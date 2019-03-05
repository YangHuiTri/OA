<?php
//声明命名空间
namespace Admin\Controller;
//引入父类
use Think\Controller;
//声明继承父类
class UserController extends Controller{

	//职员列表
	public function showList(){
		//查询数据
		$data = M('User') -> select();
		//变量分配
		$this -> assign('data', $data);
		//展示模板
		$this -> display();
	}

	//职员添加
	public function add(){
		//判断请求类型
		if(IS_POST){
			//处理表单提交
			$model = M('User');
			//创建数据对象
			$data = $model -> create();
			//添加时间字段
			$data['addtime'] = time();
			//写入数据表
			$result = $model -> add($data);
			//判断结果
			if($result){
				//成功
				$this -> success('添加成功',U('showList'),3);
			}else{
				//失败
				$this -> error('添加失败');
			}

		}else{
			//查询部门信息
			$data = M('Dept') -> field('id,name')	-> select();
			//分配到模板
			$this -> assign('data',$data);
			//展示模板
			$this -> display();
		}
	}

}