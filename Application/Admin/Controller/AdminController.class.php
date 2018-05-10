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

class AdminController extends CheckController {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $page = I("get.p",1);
        $pageSize = 10;
        $name = I('get.name');
        if(!empty($name)){
            $arrwhere['name'] = array('like','%'.$name.'%');
            $parame['name'] = $name;
        }
        $count = M('admin')->where($arrwhere)->count();
        $page = page($count, $pageSize,$parame);
        $firstrow = $page['firstrow'];
        $listrows = $page['listrows'];
        $page = $page['page'];
        $data = M('admin')->where($arrwhere)->limit($firstrow,$listrows)->order('id desc')->select();
        $this->assign('count',$count);
        $this->assign('list',$data);
        $this->assign('page',$page);
        $this->display();
    }
    public function add(){
        if (IS_POST){
            $arrwhere = I('post.');
            $arrwhere['password'] = md5($arrwhere['password']);
            $arrwhere['create_time'] = time();
            $data = M('admin')->data($arrwhere)->add();
            if($data){
                alert('添加成功！','/Admin/Admin/index');
            }else{
                alert('添加失败！','/Admin/Admin/add');
            }
        }else{
            $this->display();
        }
    }
    public function edit(){
        if (IS_POST){
            $arr = I('post.');
            if(!empty($arr['passwords'])){
                $arr['password'] = md5($arr['passwords']);
            }
            $data = M('admin')->data($arr)->save();
            if ($data){
                alert('修改成功！','/Admin/Admin/index');
            }else{
                alert('修改失败！','/Admin/Admin/edit?id='.$arr['id']);
            }
        }else {
            $id = I('get.id');
            $data = M('admin')->where(array('id'=>$id))->find();
            $this->assign('list',$data);
            $this->display();
        }
    }


}