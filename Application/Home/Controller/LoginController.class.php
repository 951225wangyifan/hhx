<?php
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  min <min_wenhao@163.com>
// +----------------------------------------------------------------------
// | 2016-7-2
// +----------------------------------------------------------------------
/**
 *	基类
 *	所有的Controller都得继承
 */
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    
  /*   public function __construct(){
        parent::__construct();
    }
     */
	public function index(){
        if (IS_POST){

            $arrdata['name'] = I('post.name');
            $arrdata['password'] = md5(I('post.password'));
            $data = M('user')->where($arrdata)->find();
            if ($data){
                session('User',array(
                    'uid'=>$data['id'],
                    'uname'=>$data['name']
                ));
                alert('登录成功！','/Home/User/index');
            }else{
                alert('登录失败！','/Home/Login/index');
            }
        }
		$this->display();
	}
    //注册
    public function regist(){
        if (IS_POST){
            $arr['name'] = I('post.name');
            $password = I('post.password');
            $arr['password'] = md5($password);
            $arr['phone'] = I('post.phone');
            $arr['type'] = I('post.type');
            $arr['picture'] = '\Public\Home\images\photo.jpg';
            $arr['create_time'] = time();
            $data = M('user')->add($arr);
            if ($data){
                alert('注册成功！','/Home/Login/index');
            }else{
                alert('注册失败！','/Home/Login/regist');
            }
        }else{
            $this->display();
        }

    }

    public function log(){
        session('User',null);
        alert('退出成功！','/Home/Login/index');
    }
}