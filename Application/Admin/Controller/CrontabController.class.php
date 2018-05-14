<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/14
 * Time: 10:30
 */
namespace Admin\Controller;
use Admin\Controller\CheckController;
class CrontabController extends CheckController {

    /* public function __construct(){
        parent::__construct();
    }
     */
    public function index(){
        $data['title'] = 'test';
        $data['content'] = '测试crontab内容';
        $data['type'] = range(1,4);
        $data['create_time'] = time();
        M('news')->add($data);
        $this->display();
    }
}