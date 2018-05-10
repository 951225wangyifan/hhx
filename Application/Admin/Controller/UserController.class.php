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
use Admin\Controller\CheckController;

class UserController extends CheckController {

	public function __construct(){
		parent::__construct();
	}
	
    public function index(){
        $count = M('user')->count();
        $Page = new \Think\Page($count,15);
        $data = M('user')->limit($Page->firstRow,$Page->listRows)->select();
        $show = $Page->show();
        $this->assign('list',$data);
        $this->assign('page',$show);
        $this->display();
    }
    public function edit(){
        $this->display();
    }
    /**
     * 删除
     */
    public function delete(){
        $id = I('get.id');
        $data = M('user')->where(array('id'=>$id))->delete();
        if ($data){
            alert('删除成功！','/Admin/User/index');
        }else{
            alert('删除失败！','/Admin/User/index');
        }
    }
}