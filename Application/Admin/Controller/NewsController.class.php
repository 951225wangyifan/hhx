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

class NewsController extends CheckController {

    public function __construct(){
        parent::__construct();
    }

    public function index(){

        $page = I("get.p",1);
        $pageSize = 10;
        $type = I('get.type');
        if (!empty($type)){
            $arrwhere['type'] = $type;
            $parame['type'] = $type;
        }
        $title = I('get.title');
        if(!empty($title)){
            $arrwhere['title'] = array('like','%'.$title.'%');
            $parame['title'] = $title;
        }
        $count = M('new')->where($arrwhere)->count();
        $page = page($count, $pageSize,$parame);
        $firstrow = $page['firstrow'];
        $listrows = $page['listrows'];
        $page = $page['page'];
        $data = M('new')->where($arrwhere)->limit($firstrow,$listrows)->order('id desc')->select();
        $this->assign('count',$count);
        $this->assign('list',$data);
        $this->assign('page',$page);
        $this->display();
    }
    public function add(){
        if (IS_POST){
            $arr = I('post.');
            $arr['create_time'] = time();
            $data = M('new')->add($arr);
            if ($data){
                alert('添加成功！','/Admin/News/index');
            }else{
                alert('添加失败！','/Admin/News/index');
            }
        }else {
            $this->display();
        }
    }
    public function edit(){
        if (IS_POST){
            $arr = I('post.');
            $data = M('new')->data($arr)->save();
            if ($data){
                alert('修改成功！','/Admin/News/index');
            }else{
                alert('修改失败！','/Admin/News/edit?id='.$arr['id']);
            }
        }else {
            $id = I('get.id');
            $data = M('new')->where(array('id'=>$id))->find();
            $this->assign('list',$data);
            $this->display();
        }
    }

    public function delete(){
        $id = I('get.id');
        $data = M('new')->where(array('id'=>$id))->delete();
        if ($data){
            alert('删除成功！','/Admin/News/index');
        }else{
            alert('删除失败！','/Admin/News/index');
        }
    }

}