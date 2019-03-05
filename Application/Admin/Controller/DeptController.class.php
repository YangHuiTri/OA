<?php
namespace Admin\Controller;
use Think\Controller;
class DeptController extends Controller{
	//展示实例化的结果
	public function shilihua(){
		//普通实例化
		$model = new \Admin\Model\DeptModel();
		dump($model);
	}

	//add方法使用
	public function tianjia(){
		//实例化模型
		$model = M('Dept');
		//声明数组（关联数组）
		$data = array(
			'name'	=>	'人事部',
			'pid'	=>	'0',
			'sort'	=>	'1',
			'remark'=>	'这是人事部门'
		);
		//添加到数据库
		$result = $model->add($data);
		dump($result);
	}

	//添加部门
	public function add(){
		//判断请求类型
		if(IS_POST){
			//接收数据
			$post = I('post.');
			//写入数据
			$model = D('Dept');
			//创建数据对象
			$data = $model -> create();
			//判断验证结果
			if(!$data){
				//提示用户验证失败
				$this -> error($model -> getError());
			}
			$result = $model -> add();
			//判断返回值
			if($result){
				//成功
				$this->success('添加成功',U('showList'),3);
			}else{
				//失败
				$this->error('添加失败');
			}
		}else{
			//查询顶级部门
			$model = M('Dept');
			$data = $model -> where('pid = 0') -> select();
			//展示数据
			$this->assign('data', $data);
			//展示模板
			$this->display();
		}
	}

	//部门列表
	public function showList(){
		//查询数据
		$model = M('Dept');
		$data = $model -> order('sort desc') -> select();
		//二次遍历查询顶级部门
		foreach ($data as $key => $value) {
			$info = $model -> find($value['pid']);
			$data[$key]['deptname'] = $info['name'];
		}
		//使用load方法载入文件
		load('@/tree');
		$data = getTree($data);
		//分配数据
		$this -> assign('data', $data);
		//展示模板
		$this -> display();
	}

	//部门编辑
	public function edit(){
		if(IS_POST){
			//处理post请求
			$post = I('post.');
			//实例化
			$model = M('Dept');
			//保存操作
			$result = $model -> save($post);
			//判断结果成功与否
			if($result !== false){
				//修改成功
				$this -> success('修改成功',U('showList'),3);
			}else{
				//修改失败
				$this -> error('修改失败');
			}
		}else{
			//接收部门id
			$id = I('get.id');
			//实例化模型
			$model = M('Dept');
			//查询数据
			$data = $model -> find($id);
			//查询全部的部门信息，给下拉列表使用
			$info = $model -> where("id != $id") -> select();
			//变量分配
			$this -> assign('data',$data);
			$this -> assign('info',$info);
			//展示模版
			$this -> display();
		}
	}

	//删除部门
	public function del(){
		//接收id
		$id = I('get.deptid');
		//实例化模型
		$model = M('Dept');
		//删除
		$result = $model -> delete($id);
		//判断结果
		if($result){
			//删除成功
			$this->success('删除成功!');
		}else{
			//删除失败
			$this -> error('删除失败！');
		}
	}



}