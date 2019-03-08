<?php
//声明命名空间
namespace Admin\Model;
//引入父类
use Think\Model;
//声明并继承父类
class EmailModel extends Model{
	//saveData
	public function addData($post, $file){
		//判断是否有文件需要处理
		if($file['error'] == '0'){
			//配置
			$cfg = array('rootPath' => WORKING_PATH.UPLOAD_ROOT_PATH);
			//实例化上传类
			$upload = new \Think\Upload($cfg);
			//上传
			$info = $upload -> uploadOne($file);
			//判断上传结果
			if($info){
				//成功，处理数据表中需要的字段
				$post['file'] = UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
				$post['hasfile'] = '1';
				$post['filename'] = $info['name'];
			}
		}
		//补充字段from_id、addtime
		$post['from_id'] = session('id');
		$post['addtime'] = time();
		//数据保存
		return $this -> add($post);
	}

}