<?php
//声明命名空间
namespace Admin\Controller;
//引入父类
use Think\Controller;
//声明并继承父类
class EmptyController extends Controller{
	public function _empty(){
		$this -> display('Empty/error');
	}
}