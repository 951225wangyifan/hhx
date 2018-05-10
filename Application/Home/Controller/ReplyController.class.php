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
class ReplyController extends Controller {
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $page = I("get.p",1);
        $pageSize = 5;
        $count = M('reply')->count();
        $page = page($count, $pageSize);
        $firstrow = $page['firstrow'];
        $listrows = $page['listrows'];
        $page = $page['page'];
        $data = M('reply')->limit($firstrow,$listrows)->order('id desc')->select();
        $people = M('winning')->where('type = 1')->order('score asc')->limit(0,12)->select();
        $winning = M('winning')->where('type = 2')->order('id desc')->limit(0,4)->select();
        $this->assign('count',$count);
        $this->assign('list',$data);
        $this->assign('page',$page);
        $this->assign('people',$people);
        $this->assign('winning',$winning);
        $this->display();


    }

    //回答问题
    public function add(){
        if(IS_POST){
            $arrdata = I('post.');
            $arrdata['create_time'] = time();
            $data = M('reply') ->data($arrdata)->add();
            if ($data){
                alert('回答成功！','/Home/Reply/index');
            }else{
                alert('回答失败！');
            }
        }else{
            $user = M('user')->where(array('id'=>$_SESSION['User']['uid']))->find();
            $this->assign('user',$user);
            $this->display();
        }
    }
}