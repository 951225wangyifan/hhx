<?php
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  min <min_wenhao@163.com>
// +----------------------------------------------------------------------
// | 2016-7-2
// +----------------------------------------------------------------------
/**
 *	用户中心
 */
namespace Admin\Controller;
use Admin\Controller\BaseController;
class LoginController extends BaseController {
	
	public function __construct(){
		parent::__construct();
	} 
	
    public function login(){
    	 if (IS_POST) {
                 $arrWhere['name']=I('post.name');
                 $strpas=I('post.password');
                 $arrWhere['password']=md5($strpas);
                 $result = M('admin')->where($arrWhere)->find();
                 if ($result) {
                     cookie('name',$result['name'],86400);
                     session('User',array(
                         'uid'=>$result['id'],
                         'uname'=>$result['name']
                     ));
                         echo 1; //登录成功
                 }else {
                     echo 2; //用户名或密码错误
                 }

    	}else {
    		$this->display();
    	 } 
        
    }

    public function logout(){
        session('User',null);
        $this->success('退出成功','/Admin/Login/login');
    }

    //验证码
    public function image(){
      verifyImage();
    }
}