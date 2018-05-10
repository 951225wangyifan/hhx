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
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	public function __construct(){
		parent::__construct();
	}
	
    public function index(){
	    if(IS_POST){
            $image = $_FILES['picture']['name'];
            $arrwhere['id'] = I('post.id');
            $arrwhere['name'] = I('post.name');
            $arrwhere['phone'] = I('post.phone');
            $pas = I('post.pas');
           /* dump($image);
            dump($arrwhere);
            dump($pas);
            exit;*/
            if (empty($image)){
                if($pas){
                    $arrwhere['password'] = md5($pas);
                    $data = M('user')->data($arrwhere)->save();
                    if ($data){
                        alert('修改成功！','/Home/Login/index');
                    }else{
                        alert('修改失败！');
                    }
                }
                $data = M('user')->data($arrwhere)->save();
                if ($data){
                    alert('修改成功！','/Home/User/index');
                }else{
                    alert('修改失败！');
                }
            }else{
                $picture = upload($_FILES['picture'],'1');
                $arrwhere['picture'] = $picture;
                if($pas){
                    $arrwhere['password'] = md5($pas);
                    $data = M('user')->data($arrwhere)->save();
                    if ($data){
                        alert('修改成功！','/Home/Login/index');
                    }else{
                        alert('修改失败！');
                    }
                }

                $data = M('user')->data($arrwhere)->save();
                if ($data){
                    alert('修改成功！','/Home/User/index');
                }else{
                    alert('修改失败！');
                }
            }
        }else{
            $id = $_SESSION['User']['uid'];
            $data = M('user')->where(array('id'=>$id))->find();
            $this->assign('list',$data);
            $this->display();
        }

    }
    public function tiwen(){
        $arr['uid'] = $_SESSION['User']['uid'];
        $arr['problem'] = I('post.problem');
        $arr['status'] = 2;
        $arr['create_time'] = time();
        $data = M('answer')->data($arr)->add();
        if ($data){
            $this->success('提交成功！','/Home/User/question');
        }else{
            $this->error('提交失败！');
        }
        $this->display();
    }
    public function question(){
        $uid = $_SESSION['User']['uid'];
        $count = M('answer')->where(array('uid'=>$uid))->count();
        $Page = new \Think\Page($count,15);
        $data = M('answer')->limit($Page->firstRow,$Page->listRows)->where(array('uid'=>$uid))->select();
        $show = $Page->show();
        $this->assign('list',$data);
        $this->assign('page',$show);
        $this->display();

    }
    public function answer(){
        $uid = $_SESSION['User']['uid'];
        $count = M('answer')->where(array('tid'=>$uid))->count();
        $Page = new \Think\Page($count,15);
        $data = M('answer')->limit($Page->firstRow,$Page->listRows)->where(array('tid'=>$uid))->select();
        $show = $Page->show();
        $this->assign('list',$data);
        $this->assign('page',$show);
        $this->display();
    }
   //问题详情
    public function content(){
        $id = I('get.id');
        $data = M('answer')->where(array('id'=>$id))->find();
        $this->assign('list',$data);
        $this->display();
    }
    //未解决问题
    public function appointment(){
        $count = M('answer')->where(array('status'=>2))->count();
        $Page = new \Think\Page($count,15);
        $data = M('answer')->limit($Page->firstRow,$Page->listRows)->where(array('status'=>2))->select();
        $show = $Page->show();
        $this->assign('list',$data);
        $this->assign('page',$show);
        $this->display();
    }
    //回答问题
    public function contenta(){
        if(IS_POST){
            $arrdata = I('post.');
            $arrdata['status'] = 1;
            $arrdata['tid'] = $_SESSION['User']['uid'];
            $arrdata['update_time'] = time();
            $data = M('answer') ->data($arrdata)->save();
            if ($data){
                $this->success('回答成功！','/Home/User/answer');
            }else{
                $this->error('回答失败！');
            }
        }else{
            $id = I('get.id');
            $data = M('answer')->where(array('id'=>$id))->find();
            $this->assign('list',$data);
            $this->display();
        }
    }
}