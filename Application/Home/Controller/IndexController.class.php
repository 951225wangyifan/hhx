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
class IndexController extends Controller {
	
	/* public function __construct(){
		parent::__construct();
	}
	 */
    public function index(){
        header("Content-type:text/html;charset=utf-8");
        $first = M('match')->where('type = 1')->order('id desc')->limit(0,1)->find();
        $match = M('match')->where('type = 1')->order('id desc')->limit(1,4)->select();
        $ing = M('match')->where('type = 2')->order('id desc')->limit(0,4)->select();
        $after = M('match')->where('type = 3')->order('id desc')->limit(0,3)->select();
        $people = M('winning')->where('type = 1')->order('score asc')->limit(0,12)->select();
        $winning = M('winning')->where('type = 2')->order('id desc')->limit(0,4)->select();
        $reply = M('reply')->order('id desc')->limit(0,4)->select();
        $this->assign('first',$first);
        $this->assign('match',$match);
        $this->assign('ing',$ing);
        $this->assign('after',$after);
        $this->assign('people',$people);
        $this->assign('winning',$winning);
        $this->assign('reply',$reply);
        $this->display();
    }
    public function single(){
        $this->display();
    }
}
