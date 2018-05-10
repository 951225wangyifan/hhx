<?php
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  min <min_wenhao@163.com>
// +----------------------------------------------------------------------
// | 2016-7-2
// +----------------------------------------------------------------------
/**
 *	首页
 */
namespace Home\Controller;
use Think\Controller;
class MatchController extends Controller {

    /* public function __construct(){
        parent::__construct();
    }
     */
    /**
     * 赛前
     */

    public function before(){
        $page = I("get.p",1);
        $pageSize = 4;
        $count = M('match')->where('type = 1')->count();
        $page = page($count, $pageSize);
        $firstrow = $page['firstrow'];
        $listrows = $page['listrows'];
        $page = $page['page'];
        $data = M('match')->where('type = 1')->limit($firstrow,$listrows)->order('id desc')->select();
        $people = M('winning')->where('type = 1')->order('score asc')->limit(0,12)->select();
        $winning = M('winning')->where('type = 2')->order('id desc')->limit(0,4)->select();
        $this->assign('count',$count);
        $this->assign('list',$data);
        $this->assign('page',$page);
        $this->assign('people',$people);
        $this->assign('winning',$winning);
        $this->display();

    }
    public function contentb(){
        $id = I('get.id');
        $data = M('match')->where(array('id'=>$id))->find();
        $people = M('winning')->where('type = 1')->order('score asc')->limit(0,12)->select();
        $winning = M('winning')->where('type = 2')->order('id desc')->limit(0,4)->select();
        $this->assign('people',$people);
        $this->assign('winning',$winning);
        $this->assign('list',$data);
        $this->display();

    }

    /**
     * 赛中
     */
    public function ing(){
        $page = I("get.p",1);
        $pageSize = 4;
        $count = M('match')->where('type = 2')->count();
        $page = page($count, $pageSize);
        $firstrow = $page['firstrow'];
        $listrows = $page['listrows'];
        $page = $page['page'];
        $data = M('match')->where('type = 2')->limit($firstrow,$listrows)->order('id desc')->select();
        $people = M('winning')->where('type = 1')->order('score asc')->limit(0,12)->select();
        $winning = M('winning')->where('type = 2')->order('id desc')->limit(0,4)->select();
        $this->assign('people',$people);
        $this->assign('winning',$winning);
        $this->assign('count',$count);
        $this->assign('list',$data);
        $this->assign('page',$page);
        $this->display();
    }

    /**
     * 赛后
     */
    public function after(){
        $page = I("get.p",1);
        $pageSize = 4;
        $count = M('match')->where('type = 3')->count();
        $page = page($count, $pageSize);
        $firstrow = $page['firstrow'];
        $listrows = $page['listrows'];
        $page = $page['page'];
        $data = M('match')->where('type = 3')->limit($firstrow,$listrows)->order('id desc')->select();
        $people = M('winning')->where('type = 1')->order('score asc')->limit(0,12)->select();
        $winning = M('winning')->where('type = 2')->order('id desc')->limit(0,4)->select();
        $this->assign('people',$people);
        $this->assign('winning',$winning);
        $this->assign('count',$count);
        $this->assign('list',$data);
        $this->assign('page',$page);
        $this->display();
    }
}