<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link href="/Public/Home/css/media_query.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Home/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Home/css/font-awesome.min.css">
    <link href="/Public/Home/css/animate.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="/Public/Home/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Home/css/owl.theme.default.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap CSS -->
    <link href="/Public/Home/css/style_1.css" rel="stylesheet" type="text/css"/>
    <!-- Modernizr JS -->
    <script src="/Public/Home/js/modernizr-3.5.0.min.js"></script>
</head>
<body class="single">
<div class="container-fluid fh5co_header_bg">
    <div class="container">
        <div class="row">
            <div class="col-12 fh5co_mediya_center">
                <?php if($_SESSION['User']['uname']== null): ?><a href="/Home/Login/index" class="color_fff fh5co_mediya_setting"><i
                            class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;你好，请登录！</a>
                    <?php else: ?>
                    <a href="/Home/User/index" class="color_fff fh5co_mediya_setting"><i
                            class="fa fa-clock-o"></i><?php echo ($_SESSION['User']['uname']); ?></a><?php endif; ?>
                <div class="d-inline-block fh5co_trading_posotion_relative"><a href="#" class="treding_btn">Hello</a>
                    <div class="fh5co_treding_position_absolute"></div>
                </div>
                <a href="#" class="color_fff fh5co_mediya_setting">欢迎浏览我国普通高校（非体育类）院级篮球联赛系统</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 fh5co_padding_menu">
                <img src="/Public/Home/images/logo.png" alt="img" class="fh5co_logo_width"/>
            </div>
            <div class="col-12 col-md-9 align-self-center fh5co_mediya_right">
                <div class="text-center d-inline-block">
                    <a class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-search"></i></div></a>
                </div>
                <div class="text-center d-inline-block">
                    <a class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-linkedin"></i></div></a>
                </div>
                <div class="text-center d-inline-block">
                    <a class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-google-plus"></i></div></a>
                </div>
                <div class="text-center d-inline-block">
                    <a href="#" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-twitter"></i></div></a>
                </div>
                <div class="text-center d-inline-block">
                    <a href="#" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-facebook"></i></div></a>
                </div>
                <!--<div class="d-inline-block text-center"><img src="images/country.png" alt="img" class="fh5co_country_width"/></div>-->
                <div class="d-inline-block text-center dd_position_relative ">
                    <div class="form-control fh5co_text_select_option">
                        <span>
                        <?php if($_SESSION['User']['uname']== null): ?><a href="/Home/Login/index">登录</a>&nbsp;/&nbsp;<a href="/Home/Login/regist">注册</a>
                          <?php else: ?><a href="/Home/Login/log">退出</a></a><?php endif; ?>
                    </span>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-faded fh5co_padd_mediya padding_786">
    <div class="container padding_786">
        <nav class="navbar navbar-toggleable-md navbar-light ">
            <button class="navbar-toggler navbar-toggler-right mt-3" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
            <a class="navbar-brand" href="#"><img src="/Public/Home/images/logo.png" alt="img" class="mobile_logo_width"/></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/Home/Index/index">首页 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/Home/Match/before">赛前咨询 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/Home/Match/ing">赛中进行 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/Home/Match/after">赛后展示 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/Home/Reply/index">论坛区 <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div id="fh5co-title-box" style="height:250px;background-image: url(/Public/Home/images/camila-cordeiro-114636.jpg); background-position: 50% 90.5px;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="page-title">
        <div style="margin-top: 30px;">
        <span><?php echo (date('Y-m-d',$list["create_time"])); ?></span>
        <h2><?php echo ($list["title"]); ?></h2>
        </div>
    </div>
</div>
<div id="fh5co-single-content" class="container-fluid pb-4 pt-4 paddding">
    <div class="container paddding">
        <div class="row mx-0">
            <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
                <?php echo (stripslashes(htmlspecialchars_decode($list["content"]))); ?>
            </div>
            <div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">个人排名</div>
                </div>
                <div class="clearfix"></div>
                <div class="fh5co_tags_all">
                    <?php if(is_array($people)): $i = 0; $__LIST__ = $people;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vp): $mod = ($i % 2 );++$i;?><a href="#" class="fh5co_tagg"><?php echo ($vp["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4">比赛排名</div>
                </div>
                <?php if(is_array($winning)): $i = 0; $__LIST__ = $winning;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vw): $mod = ($i % 2 );++$i;?><div class="row pb-3">
                        <div class="col-5 align-self-center">
                            <img src="<?php echo ($vw["picture"]); ?>" alt="img" class="fh5co_most_trading"/>
                        </div>
                        <div class="col-7 paddding">
                            <div class="most_fh5co_treding_font"> <?php echo ($vw["name"]); ?></div>
                            <div class="most_fh5co_treding_font_123"> <?php echo (date('Y-m-d',$vw["create_time"])); ?></div>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>

            </div>
        </div>
    </div>
</div>
<div class="container-fluid fh5co_footer_bg pb-3">
    <div class="container animate-box">
        <div class="row">
            <div class="col-12 spdp_right py-5"><img src="/Public/Home/images/white_logo.png" alt="img" class="footer_logo"/></div>

        </div>
        <div class="row justify-content-center pt-2 pb-4">
            <div class="col-12 col-md-8 col-lg-7 ">
            </div>
        </div>
    </div>
</div>
<div class="container-fluid fh5co_footer_right_reserved">
    <div class="container">
        <div class="row  ">
            <div class="col-12 col-md-6 py-4 Reserved">Copyright &copy; 2018.湖南郴州高校业余篮球比赛.</div>
            <div class="col-12 col-md-6 spdp_right py-4">
            </div>
        </div>
    </div>
</div>
<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
</div>

<script src="/Public/Home/js/jquery.min.js"></script>
<script src="/Public/Home/js/owl.carousel.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>-->
<script src="/Public/Home/js/tether.min.js"></script>
<script src="/Public/Home/js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="/Public/Home/js/jquery.waypoints.min.js"></script>
<!-- Parallax -->
<script src="/Public/Home/js/jquery.stellar.min.js"></script>
<!-- Main -->
<script src="/Public/Home/js/main.js"></script>
<script>if (!navigator.userAgent.match(/Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i)){$(window).stellar();}</script>

</body>
</html>