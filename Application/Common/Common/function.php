<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/30
 * Time: 10:49
 */
/**
 * 弹框
 * @param $msg 提示信息
 * @param $url 跳转链接
 */
function alert($msg,$url){
    echo "<script>window.location.href='".$url."';alert('".$msg."');</script>";
}

/**
 * 分页
 * @param $count 数据条数
 * @param $pageSize 每页显示的条数
 * @param array $parame 搜索条件
 * @return mixed
 */
function page($count,$pageSize,$parame = array()){
    $Page = new \Think\Page($count, $pageSize,$parame);
    $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录  每页<b>' . $pageSize . '</b>条  第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
    $Page->setConfig('prev', '上一页');
    $Page->setConfig('next', '下一页');
    $Page->setConfig('last', '末页');
    $Page->setConfig('first', '首页');
    $Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
    $page['page'] = $Page->show();
    foreach($parame as $key=>$val) {
        $Page->parameter .= "$key=".urlencode($val)."&";
    }
    $page['firstrow'] = $Page->firstRow;
    $page['listrows'] = $Page->listRows;
    return $page;
}

/**
 * 上传文件
 * @param $name 文件名
 * @param $type 文件类型。1：表示图片
 * @return string 返回文件的存储位置
 */
function upload($name,$type){
    $upload = new \Think\Upload(); //实例化上传类
    if($type == 1){
        $upload->maxSize = 3145728 ;   // 设置附件上传大小
        $upload->exts = array('jpg','png','gif','jpeg'); //设置上传文件类型
    }else{
        $upload->maxSize = 400*1024*1024 ;   // 设置附件上传大小
        $upload->exts = array('zip'); //设置上传文件类型
    }

    $upload->rootPath = './Public/Uploads/'; //设置文件上传目录
    //上传文件
    $info = $upload->uploadOne($name);
    if(!$info){
        alert($upload->getError());
        exit;
    }else{
        $file = '/Public/Uploads/'.$info['savepath'].$info['savename'];
        return $file;
    }
}

function verifyImage($type = 1, $length = 4, $pixel = 0, $line = 0, $sess_name = "verify")
{
//创建画布
//    session_start();
    $width = 80;
    $height = 28;
    $image = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);
//用填充矩形填充画布
    imagefilledrectangle($image, 1, 1, $width - 2, $height - 2, $white);

    $chars = buildRandomString($type, $length);
    $_SESSION[$sess_name] = $chars;
    $fontfiles = array("msyh.ttf", "simhei.ttf");
    for($i=0;$i<$length;$i++){
        $size = mt_rand(14, 18);
        $angle = mt_rand(-15, 15);
        $x = 5 + $i*$size;
        $y = mt_rand(20, 26);
        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
        $fontfile = './Public/Admin/fonts/' . $fontfiles[mt_rand(0, count($fontfiles) - 1)];
        $text = substr($chars,$i,1);
        imagettftext($image,$size,$angle,$x,$y,$color,$fontfile,$text);
    }

//加干扰元素点
    if ($pixel) {
        for ($i = 0; $i < 50; $i++) {
            imagesetpixel($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), $black);
        }
    }

//加干扰元素线
    if ($line) {
        for ($i = 1; $i < $line; $i++) {
            $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
            imageline($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), mt_rand(0, $width - 1), mt_rand(0, $height - 1), $color);
        }
    }

    header("content-type:image/gif");
    imagegif($image);
    imagedestroy($image);
}

//生成随机数方法
function buildRandomString($type = 1, $length = 4)
{
    if ($type == 1) {
        $chars = join("", range(0, 9));
    } elseif ($type == 2) {
        $chars = join("", array_merge(range("a", "z"), range("A", "Z")));

    } elseif ($type == 3) {
        $chars = join("", array_merge(range("a", "z"), range("A", "Z"), range(0, 9)));
    }
    $chars = str_shuffle($chars);//将字符串打乱
    return substr($chars, 0, $length);//随机截取字符串
}

