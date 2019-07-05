<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"D:\laragon\www\sticky\public/../application/index\view\order\confirm.html";i:1562316060;s:71:"D:\laragon\www\sticky\public/../application/index\view\public\head.html";i:1562307604;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="__STATIC__/index/css/base.css" />
    <link rel="stylesheet" href="__STATIC__/index/css/common.css" />
    <link rel="stylesheet" href="__STATIC__/index/css/<?php echo $controller; ?>.css" />
    <script type="text/javascript" src="__STATIC__/index/js/html5shiv.js"></script>
    <script type="text/javascript" src="__STATIC__/index/js/respond.min.js"></script>
    <script type="text/javascript" src="__STATIC__/index/js/jquery-1.11.3.min.js"></script>
</head>
<body>
<div class="header-bar">
    <div class="header-inner">
        <ul class="father">
            <li><a><?php echo $city['name']; ?></a></li>
            <li>|</li>
            <li class="city">
                <a>切换城市<span class="arrow-down-logo"></span></a>
                <div class="city-drop-down">
                    <h3>热门城市</h3>
                    <ul class="son">
                        <?php if(is_array($citys) || $citys instanceof \think\Collection || $citys instanceof \think\Paginator): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo url('index/index',['city'=>$vo['uname']]); ?>"><?php echo $vo['name']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>

                </div>
            </li>
            <?php if($user): ?>
                <li>欢迎您：<?php echo $user->username; ?></li>
                <li><a href="<?php echo url('user/logout'); ?>">退出</a></li>
            <?php else: ?>
            <li><a href="<?php echo url('user/register'); ?>">注册</a></li>
            <li>|</li>
            <li><a href="<?php echo url('user/login'); ?>">登录</a></li>

            <?php endif; ?>
            <li><a href="<?php echo url('bis/login'); ?>">商家登陆</a></li>

        </ul>
    </div>
</div>

<!--支付第一步-->
<div class="firstly">
    <div class="bindmobile-wrap">
        采用<span style="color:red">微信支付</span>
        ，购买成功后，团购券将发到您的注册邮箱：
        <span class="mobile"><?php echo $user->email; ?></span>
        <a class="link"></a>
    </div>

    <table class="table table-goods" cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
            <th class="first">商品</th>
            <th width="120">单价</th>
            <th width="190">数量</th>
            <th width="140" class="last">小计</th>
        </tr>
        <tr class="j-row">
            <td class="vtop">
                <div class="title-area" title="<?php echo $deal['name']; ?>">
                    <div class="img-wrap">
                        <a href="" target="_blank"><img src="<?php echo $deal['image']; ?>" width="130" height="79"></a>
                    </div>
                    <div class="title-wrap">
                        <div class="title">
                            <a href="" class="link"><?php echo $deal['name']; ?></a>
                        </div>
                        <div class="attrs"></div>
                    </div>
                </div>
            </td>
            <td>￥<span class="font14"><?php echo $deal['current_price']; ?></span></td>
            <td class="j-cell">
                <div class="buycount-ctrl">
                    <a class="j-ctrl ctrl minus disabled"><span class="horizontal"></span></a>
                    <input type="text" value="<?php echo $count; ?>" maxlength="10">
                    <a class="ctrl j-ctrl plus"><span class="horizontal"></span><span class="vertical"></span></a>
                </div>
                <span class="err-wrap j-err-wrap"></span>
            </td>
            <td class="price font14">¥<span class="j-sumPrice"><?php echo $deal['current_price']*$count; ?></span></td>
        </tr>
        </tbody>
    </table>



    <div class="final-price-area">应付总额：<span class="sum">￥<span class="price"><?php echo $deal['current_price']*$count; ?></span></span></div>

    <div class="page-button-wrap">
        <a  class="o2o_pay btn btn-primary">确认</a>
    </div>

    <div style="width: 100%;min-width: 1200px;height: 5px;background: #dbdbdb;margin: 50px 0 20px;"></div>
</div>

<!--支付第二步-->
<div class="secondly">
    <div class="search">
        <img src="https://passport.baidu.com/export/reg/logo-nuomi.png" />
        <div class="w-order-nav-new">
            <ul class="nav-wrap">
                <li>
                    <div class="no"><span>1</span></div>
                    <span class="text">确认订单</span>
                </li>
                <li class="to-line "></li>
                <li class="current">
                    <div class="no"><span>2</span></div>
                    <span class="text">选择支付方式</span>
                </li>
                <li class="to-line "></li>
                <li class="">
                    <div class="no"><span>3</span></div>
                    <span class="text">购买成功</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="order_infor_module">
        <div class="order_details">
            <table width="100%">
                <tbody>
                <tr>
                    <td class="fl_left ">
                        <ul class="order-list">
                            <li>
                                <span class="order-list-no">订单1:</span>
                                <span class="order-list-name">好伦哥6店单人自助</span><span class="order-list-number">2份</span>
                            </li>
                        </ul>
                    </td>
                    <td class="fl_right">
                        <dl>
                            <dt>应付金额：</dt>
                            <dd class="money"><span><?php echo $deal['current_price']*$count; ?></span></dd>
                        </dl>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <h1 class="title">选择支付方式</h1>

    <div class="pay">第三方账户支付</div>
    <div class="paychoose">
        <input type="radio" checked />百度钱包
        <input type="radio" />支付宝
        <input type="radio" />支付宝扫码
    </div>

    <div class="pay">银行卡直接支付</div>
    <div class="paychoose">
        <input type="checkbox" />农业银行
        <input type="checkbox" />招商银行
        <input type="checkbox" />工商银行
    </div>
    <button>立即支付</button>

</div>

<!--支付第三步-->
<div class="third">
    <div class="search">
        <img src="https://passport.baidu.com/export/reg/logo-nuomi.png" />
        <div class="w-order-nav-new">
            <ul class="nav-wrap">
                <li>
                    <div class="no"><span>1</span></div>
                    <span class="text">确认订单</span>
                </li>
                <li class="to-line "></li>
                <li>
                    <div class="no"><span>2</span></div>
                    <span class="text">选择支付方式</span>
                </li>
                <li class="to-line "></li>
                <li class="current">
                    <div class="no"><span>3</span></div>
                    <span class="text">购买成功</span>
                </li>
            </ul>
        </div>
    </div>

    <div style="width: 980px;height: 300px;margin: 0 auto;text-align: center;line-height: 300px;font-size: 36px;">恭喜，购买成功！</div>
</div>

<div class="footer">
    <ul class="first">

    </ul>
    <ul class="second">

    </ul>
</div>

<script>
    //校验正整数
    function isNaN(number){
        var reg = /^[1-9]\d*$/;
        return reg.test(number);
    }

    function inputChange(num){
        if(!isNaN(num)){
            $(".buycount-ctrl input").val("1");
        }
        else{
            $(".buycount-ctrl input").val(num);
            $(".j-sumPrice").text($("td .font14").text() * num - $(".j-cellActivity span").text());
            $(".sum .price").text($("td .font14").text() * num - $(".j-cellActivity span").text());
            if(num == 1){
                $(".buycount-ctrl a").eq(0).addClass("disabled");
            }
            else{
                $(".buycount-ctrl a").eq(0).removeClass("disabled");
            }
        }
    }

    $(".buycount-ctrl input").keyup(function(){
        var num = $(".buycount-ctrl input").val();
        inputChange(num);
    });
    $(".minus").click(function(){
        var num = $(".buycount-ctrl input").val();
        num--;
        inputChange(num);
    });
    $(".plus").click(function(){
        var num = $(".buycount-ctrl input").val();
        num++;
        inputChange(num);
    });
    // 第一步之确认按钮
    $('.o2o_pay').click(function () {
        //购买数量
        var count = $(".buycount-ctrl input").val();
        var price = $(".sum .price").text();
        var url = "<?php echo url('order/index',['id'=>$deal['id']]); ?>"+"&deal_count="+count+"&total_price="+price;
        self.location=url;
    })
</script>
</body>
</html>