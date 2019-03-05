<?php
//声明命名空间
namespace Admin\Controller;
//引入父类
use Think\Controller;
//声明继承父类
class UserController extends Controller{

	//职员列表
	public function showList(){
		//模型实例化
		$model = M('User');
		//分页第一步：查询总的记录数
		$count = $model -> count();
		//分页第二步：实例化分页类，传递参数
		$page = new \Think\Page($count,1);	//每页显示1个
		//分页第三步：可选步骤，定义提示文字
		$page -> rollPage = 5;
		$page -> lastSuffix = false;
		$page -> setConfig('prev','上一页');
		$page -> setConfig('next','下一页');
		$page -> setConfig('last','末页');
		$page -> setConfig('first','首页');
		//分页第四步：使用show方法生成url
		$show = $page -> show();
		//分页第五步：展示数据
		$data = $model -> limit($page -> firstRow,$page -> listRows) -> select();
		//分页第六步：传递给模版
		$this -> assign('data',$data);
		$this -> assign('show',$show);
		//分页第七步：展示模版
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

	//统计图表
	public function charts(){
		//select t2.name as deptname,count(*) as count from sp_user as t1,sp_dept as t2 where t1.dept_id = t2.id group by deptname;
		$model = M();
		//连贯操作
		$data = $model -> field('t2.name as deptname,count(*) as count') -> table('sp_user as t1,sp_dept as t2') -> where('t1.dept_id = t2.id') -> group('deptname') -> select();
		$str = '[';
		//循环遍历字符串
		foreach ($data as $key => $value) {
			$str .= "['" . $value['deptname'] . "'," . $value['count'] . "],";
		}
		//去除最后的逗号
		$str = rtrim($str,',') . ']';
		//[['总裁办',1],['程序部',2],['管理部',2],['财务部',1],['运营部',1]]
		//传递给模版
		$this -> assign('str',$str);
		//展示模版
		$this -> display();
	}



}