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

class TeacherController extends BaseController {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $page = I("get.p",1);
        $pageSize = 10;
        $phone = I('get.phone');
        if (!empty($phone)){
            $arrwhere['phone'] = array('like','%'.$phone.'%');
            $parame['phone'] = $phone;
        }
        $title = I('get.name');
        if(!empty($title)){
            $arrwhere['name'] = array('like','%'.$title.'%');
            $parame['name'] = $title;
        }
        $count = M('teacher')->where($arrwhere)->count();
        $page = page($count, $pageSize,$parame);
        $firstrow = $page['firstrow'];
        $listrows = $page['listrows'];
        $page = $page['page'];
        $data = M('teacher')->where($arrwhere)->limit($firstrow,$listrows)->order('id desc')->select();
        $this->assign('count',$count);
        $this->assign('page',$page);
        $this->assign('list',$data);
        $this->display();

    }

    public function add(){
        if (IS_POST){
            $arrWhere = I('post.');
            $arrWhere['create_time'] = time();
            $arrWhere['course'] = implode(',',$arrWhere['course']);
            $picture = upload($_FILES['picture'],'1');
            $arrWhere['picture'] = $picture;
            $arrData = M('teacher')->data($arrWhere)->add();
            if ($arrData){
                alert('添加成功','/Admin/Teacher/index');
            }else {
                alert('添加失败','/Admin/Teacher/add');
            }

        }else{
            $course = M('course')->select();
            $this->assign('course',$course);
            $this->display();
        }
    }
    public function edit(){
        if(IS_POST){
            $image = $_FILES['picture']['name'];
            $arrwhere = I('post.');
            $arrwhere['course'] = implode(',',$arrwhere['course']);
            if (empty($image)){
                $data = M('teacher')->data($arrwhere)->save();
                if ($data){
                    alert('修改成功！','/Admin/Teacher/index');
                }else{
                    alert('修改失败！','/Admin/Teacher/edit?id='.$arrwhere['id']);
                }
            }else{
                $picture = upload($_FILES['picture'],'1');
                $arrwhere['picture'] = $picture;
                $data = M('teacher')->data($arrwhere)->save();
                if ($data){
                    alert('修改成功！','/Admin/Teacher/index');
                }else{
                    alert('修改失败！','/Admin/Teacher/edit?id='.$arrwhere['id']);
                }
            }
        }else{
            $id = I('get.id');
            $data = M('teacher')->where(array('id'=>$id))->find();
            $course = M('course')->select();
            $this->assign('course',$course);
            $this->assign('list',$data);
        }
        $this->display();
    }

    public function delete(){
        $id = I('get.id');
        $data = M('teacher')->where(array('id'=>$id))->delete();
        if ($data){
            alert('删除成功！','/Admin/Teacher/index');
        }else{
            alert('删除失败！','/Admin/Teacher/index');
        }
    }
}