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

class ReplyController extends CheckController {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $page = I("get.p",1);
        $pageSize = 10;
        $count = M('reply')->count();
        $page = page($count, $pageSize);
        $firstrow = $page['firstrow'];
        $listrows = $page['listrows'];
        $page = $page['page'];
        $data = M('reply')->limit($firstrow,$listrows)->order('id desc')->select();
        $this->assign('count',$count);
        $this->assign('page',$page);
        $this->assign('list',$data);
        $this->display();
    }
    public function content(){
        $id = I('get.id');
        $data = M('reply')->where(array('id'=>$id))->find();
        $this->assign('list',$data);
        $this->display();
    }
    public function delete(){
        $id = I('get.id');
        $data = M('reply')->where(array('id'=>$id))->delete();
        if ($data){
            alert('删除成功！','/Admin/Reply/index');
        }else{
            alert('删除失败！','/Admin/Reply/index');
        }
        $this->display();
    }
}