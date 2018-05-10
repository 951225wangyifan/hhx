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

class MatchController extends CheckController {

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
        $title = I('get.name');
        if(!empty($title)){
            $arrwhere['name'] = array('like','%'.$title.'%');
            $parame['name'] = $title;
        }
        $count = M('match')->where($arrwhere)->count();
        $page = page($count, $pageSize,$parame);
        $firstrow = $page['firstrow'];
        $listrows = $page['listrows'];
        $page = $page['page'];
        $data = M('match')->where($arrwhere)->limit($firstrow,$listrows)->order('id desc')->select();
        $this->assign('count',$count);
        $this->assign('page',$page);
        $this->assign('list',$data);
        $this->display();

    }

    /**
     * 赛前列表
     */
    public function before(){
        $page = I("get.p",1);
        $pageSize = 10;
        $title = I('get.title');
        if(!empty($title)){
            $arrwhere['title'] = array('like','%'.$title.'%');
            $parame['title'] = $title;
        }
        $arrwhere['type'] = 1;
        $count = M('match')->where($arrwhere)->count();
        $page = page($count, $pageSize,$parame);
        $firstrow = $page['firstrow'];
        $listrows = $page['listrows'];
        $page = $page['page'];
        $data = M('match')->where($arrwhere)->limit($firstrow,$listrows)->order('id desc')->select();
        $this->assign('count',$count);
        $this->assign('page',$page);
        $this->assign('list',$data);
        $this->display();
    }

    /**
     * 赛中列表
     */
    public function ing(){
        $page = I("get.p",1);
        $pageSize = 10;
        $title = I('get.title');
        if(!empty($title)){
            $arrwhere['title'] = array('like','%'.$title.'%');
            $parame['title'] = $title;
        }
        $arrwhere['type'] = 2;
        $count = M('match')->where($arrwhere)->count();
        $page = page($count, $pageSize,$parame);
        $firstrow = $page['firstrow'];
        $listrows = $page['listrows'];
        $page = $page['page'];
        $data = M('match')->where($arrwhere)->limit($firstrow,$listrows)->order('id desc')->select();
        $this->assign('count',$count);
        $this->assign('page',$page);
        $this->assign('list',$data);
        $this->display();
    }
    /**
     * 赛后列表
     */
    public function after(){
        $page = I("get.p",1);
        $pageSize = 10;
        $title = I('get.title');
        if(!empty($title)){
            $arrwhere['title'] = array('like','%'.$title.'%');
            $parame['title'] = $title;
        }
        $arrwhere['type'] = 3;
        $count = M('match')->where($arrwhere)->count();
        $page = page($count, $pageSize,$parame);
        $firstrow = $page['firstrow'];
        $listrows = $page['listrows'];
        $page = $page['page'];
        $data = M('match')->where($arrwhere)->limit($firstrow,$listrows)->order('id desc')->select();
        $this->assign('count',$count);
        $this->assign('page',$page);
        $this->assign('list',$data);
        $this->display();
    }
    /**
     * 赛前增加
     */
    public function addb(){
        if (IS_POST){
            $arrWhere = I('post.');
            $arrWhere['create_time'] = time();
            $picture = upload($_FILES['picture'],'1');
            $arrWhere['picture'] = $picture;
            $arrWhere['type'] = 1;
            $arrData = M('match')->data($arrWhere)->add();
            if ($arrData){
                alert('添加成功','/Admin/Match/before');
            }else {
                alert('添加失败','/Admin/Match/addb');
            }

        }else{
            $this->display();
        }
    }

    /**
     * 赛中增加
     */
    public function addi(){
        if (IS_POST){
            $arrWhere = I('post.');
            $arrWhere['create_time'] = time();
            $picture = upload($_FILES['picture'],'1');
            $arrWhere['picture'] = $picture;
            $arrWhere['type'] = 2;
            $arrData = M('match')->data($arrWhere)->add();
            if ($arrData){
                alert('添加成功','/Admin/Match/ing');
            }else {
                alert('添加失败','/Admin/Match/addi');
            }
        }else{
            $this->display();
        }
    }

    /**
     * 赛后增加
     */
    public function adda(){
        if (IS_POST){
            $arrWhere = I('post.');
            $arrWhere['create_time'] = time();
            $picture = upload($_FILES['picture'],'1');
            $arrWhere['picture'] = $picture;
            $arrWhere['type'] = 3;
            $arrData = M('match')->data($arrWhere)->add();
            if ($arrData){
                alert('添加成功','/Admin/Match/after');
            }else {
                alert('添加失败','/Admin/Match/adda');
            }
        }else{
            $this->display();
        }
    }


    /**
     * 赛前编辑
     */
    public function editb(){
        if(IS_POST){
            $image = $_FILES['picture']['name'];
            $arrwhere = I('post.');
            if ($arrwhere['type'] == 1){
                $url = '/Admin/Match/before';
            }else if($arrwhere['type'] == 2){
                $url = '/Admin/Match/ing';
            }else{
                $url = '/Admin/Match/after';
            }
            if (empty($image)){
                $data = M('match')->data($arrwhere)->save();
                if ($data){
                    alert('修改成功！',$url);
                }else{
                    alert('修改失败！','/Admin/Match/editb?id='.$arrwhere['id']);
                }
            }else{
                $picture = upload($_FILES['picture'],'1');
                $arrwhere['picture'] = $picture;
                $data = M('match')->data($arrwhere)->save();
                if ($data){
                    alert('修改成功！',$url);
                }else{
                    alert('修改失败！','/Admin/Match/editb?id='.$arrwhere['id']);
                }
            }
        }else{
            $id = I('get.id');
            $type = I('get.type');
            $data = M('match')->where(array('id'=>$id,'type'=>$type))->find();
            $this->assign('list',$data);
        }
        $this->display();
    }

    public function delete(){
        $id = I('get.id');
        $data = M('match')->where(array('id'=>$id))->delete();
        if ($data){
            alert('删除成功！','/Admin/Match/before');
        }else{
            alert('删除失败！','/Admin/Match/before');
        }
    }
}