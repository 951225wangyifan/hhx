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

class WinningController extends CheckController {

    public function __construct(){
        parent::__construct();
    }

    /**
     * 个人排名
     */
    public function index(){
        $page = I("get.p",1);
        $pageSize = 10;
        $type = I('get.type');
        if (!empty($type)){
            $arrwhere['type'] = $type;
            $parame['type'] = $type;
        }
        $name = I('get.name');
        if(!empty($name)){
            $arrwhere['name'] = array('like','%'.$name.'%');
            $parame['name'] = $name;
        }
        $arrwhere['type'] = 1;
        $count = M('winning')->where($arrwhere)->count();
        $page = page($count, $pageSize,$parame);
        $firstrow = $page['firstrow'];
        $listrows = $page['listrows'];
        $page = $page['page'];
        $data = M('winning')->where($arrwhere)->limit($firstrow,$listrows)->order('id desc')->select();
        $this->assign('count',$count);
        $this->assign('list',$data);
        $this->assign('page',$page);
        $this->display();
    }

    /**
     * 赛事排名
     */
    public function indexs(){
        $page = I("get.p",1);
        $pageSize = 10;
        $type = I('get.type');
        if (!empty($type)){
            $arrwhere['type'] = $type;
            $parame['type'] = $type;
        }
        $name = I('get.name');
        if(!empty($name)){
            $arrwhere['name'] = array('like','%'.$name.'%');
            $parame['name'] = $name;
        }
        $arrwhere['type'] = 2;
        $count = M('winning')->where($arrwhere)->count();
        $page = page($count, $pageSize,$parame);
        $firstrow = $page['firstrow'];
        $listrows = $page['listrows'];
        $page = $page['page'];
        $data = M('winning')->where($arrwhere)->limit($firstrow,$listrows)->order('id desc')->select();
        $this->assign('count',$count);
        $this->assign('list',$data);
        $this->assign('page',$page);
        $this->display();
    }
    /**
     * 个人增加
     */
    public function add(){
        if (IS_POST){
            $arr = I('post.');
            $arr['create_time'] = time();
            $arr['type'] = 1;
            $data = M('winning')->add($arr);
            if ($data){
                alert('添加成功！','/Admin/Winning/index');
            }else{
                $this->error('添加失败');
            }
        }else {
            $this->display();
        }
    }

    /**
     * 个人编辑
     */
    public function edit(){
        if (IS_POST){
            $arr = I('post.');
            $data = M('winning')->data($arr)->save();
            if ($data){
                alert('修改成功！','/Admin/Winning/index');
            }else{
                alert('修改失败！','/Admin/Winning/edit?id='.$arr['id']);
            }

        }else {
            $id = I('get.id');
            $data = M('winning')->where(array('id'=>$id))->find();
            $this->assign('list',$data);
            $this->display();
        }
    }

    /**
     * 赛事增加
     */
    public function adds(){
        if (IS_POST){
            $arrWhere = I('post.');
            $arrWhere['type'] = 2;
            $arrWhere['create_time'] = time();
            $picture = upload($_FILES['picture'],'1');
            $arrWhere['picture'] = $picture;
            $arrData = M('winning')->data($arrWhere)->add();
            if ($arrData){
                alert('添加成功','/Admin/Winning/after');
            }else {
                alert('添加失败','/Admin/Winning/adda');
            }
        }else{
            $this->display();
        }
    }
    /**
     * 赛事编辑
     */
    public function edits(){
        if(IS_POST){
            $image = $_FILES['picture']['name'];
            $arrwhere = I('post.');
            if (empty($image)){
                $data = M('winning')->data($arrwhere)->save();
                if ($data){
                    alert('修改成功！','/Admin/Winning/indexs');
                }else{
                    alert('修改失败！','/Admin/Winning/edits?id='.$arrwhere['id']);
                }
            }else{
                $picture = upload($_FILES['picture'],'1');
                $arrwhere['picture'] = $picture;
                $data = M('winning')->data($arrwhere)->save();
                if ($data){
                    alert('修改成功！','/Admin/Winning/indexs');
                }else{
                    alert('修改失败！','/Admin/Winning/edits?id='.$arrwhere['id']);
                }
            }
        }else{
            $id = I('get.id');
            $data = M('winning')->where(array('id'=>$id))->find();
            $this->assign('list',$data);
        }
        $this->display();
    }
    /**
     * 删除
     */
    public function delete(){
        $id = I('get.id');
        $data = M('winning')->where(array('id'=>$id))->delete();
        if ($data){
            alert('删除成功！','/Admin/Winning/index');
        }else{
            alert('删除失败！','/Admin/Winning/index');
        }
    }

}