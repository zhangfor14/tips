<?php
namespace Home\Controller;
use Think\Controller;
use Think\Think;

//即时到账接口
class PayController extends Controller {
    //在类初始化方法中，引入相关类库
    public function _initialize() {
        vendor('Alipay.Corefunction');
        vendor('Alipay.Md5function');
        vendor('Alipay.Notify');
        vendor('Alipay.Submit');

    }

    //doalipay方法
    /*该方法其实就是将接口文件包下alipayapi.php的内容复制过来
      然后进行相关处理
    */
    public function doalipay(){
        //0元快捷支付
        if(I('post.ordtotal_fee') == 0 && I('post.trade_no')){
            $result = M('product_order')
                -> where(['user_id'=>decrypt(cookie('uid')),'produc_order_id'=>I('post.trade_no')])
                ->setField(['if_payment'=>'1','operation_state'=>'5']);
            $this->redirect(C('alipay.successpage'));//跳转到配置项中配置的支付成功页面；
            exit;
        }


        //得到订单提交时的地址，区分不同各类订单
        $pay_type = 0;
        $urlshang = $_SERVER['HTTP_REFERER'];
        if(strrpos($urlshang,'myorder') != false){
            $pay_type = '个人充值';
        }elseif(strrpos($urlshang,'commitOrder') != false){
            $pay_type = '私教购买';
        }elseif(strrpos($urlshang,'imbuyGoods') != false){
            $pay_type = '商城购买';
        }elseif(strrpos($urlshang,'Hractive') != false){
            $pay_type = '众筹活动';

        }else{

        }

        cookie('pay_type',$pay_type,3600);


        $alipay_config=C('alipay_config');
        /**************************请求参数**************************/
        $payment_type = "1"; //支付类型 //必填，不能修改
        $notify_url = C('alipay.notify_url'); //服务器异步通知页面路径
       // print_r($notify_url);die;
        $return_url = C('alipay.return_url'); //页面跳转同步通知页面路径
        $seller_email = C('alipay.seller_email');//卖家支付宝帐户必填
        $out_trade_no = $_POST['trade_no'];//商户订单号 通过支付页面的表单进行传递，注意要唯一！
        $new_order =substr($out_trade_no,0,1);

        //订单名称 //必填 通过支付页面的表单进行传递

        if($new_order=="C"){
            $total_fee =$_POST['ordtotal_feec'];
            $subject = $_POST['ordsubjectc'];
                  }else{
            $total_fee = $_POST['ordtotal_fee'];
            $subject = $_POST['ordsubject'];//付款金额  //必填 通过支付页面的表单进行传递

        }
        $body = $_POST['ordbody'];  //订单描述 通过支付页面的表单进行传递
        $show_url = $_POST['ordshow_url'];  //商品展示地址 通过支付页面的表单进行传递
         //商品展示地址 通过支付页面的表单进行传递
        $anti_phishing_key = "";//防钓鱼时间戳 //若要使用请调用类文件submit中的query_timestamp函数

        $exter_invoke_ip = get_client_ip(); //客户端的IP地址*/
        /************************************************************/

        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => trim($alipay_config['partner']),
            "payment_type"    => $payment_type,
            "notify_url"    => $notify_url,
            "return_url"    => $return_url,
            "seller_email"    => $seller_email,
            "out_trade_no"    => $out_trade_no,
            "subject"    => $subject,
            "total_fee"    => $total_fee,
            "body"            => $body,
            "show_url"    => $show_url,
            "anti_phishing_key"    => $anti_phishing_key,
            "exter_invoke_ip"    => $exter_invoke_ip,
            "_input_charset"    => trim(strtolower($alipay_config['input_charset']))
        );


        //建立请求
        $alipaySubmit = new \AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"post", "确认");
        echo $html_text;
    }

    /******************************
    服务器异步通知页面方法
    其实这里就是将notify_url.php文件中的代码复制过来进行处理

     *******************************/
    function notifyurl(){
        /*
        同理去掉以下两句代码；
        */
        //require_once("alipay.config.php");
        //require_once("lib/alipay_notify.class.php");

        //这里还是通过C函数来读取配置项，赋值给$alipay_config
        $alipay_config=C('alipay_config');
        //计算得出通知验证结果
        $alipayNotify = new \   AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {
            //验证成功
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            $out_trade_no   = $_POST['out_trade_no'];      //商户订单号
         //   print_r($out_trade_no);die;
            $trade_no       = $_POST['trade_no'];          //支付宝交易号
            $trade_status   = $_POST['trade_status'];      //交易状态
            $total_fee      = $_POST['total_fee'];         //交易金额
            $notify_id      = $_POST['notify_id'];         //通知校验ID。
            $notify_time    = $_POST['notify_time'];       //通知的发送时间。格式为yyyy-MM-dd HH:mm:ss。
            $buyer_email    = $_POST['buyer_email'];       //买家支付宝帐号；
            $parameter = array(
                "out_trade_no"     => $out_trade_no, //商户订单编号；
                "trade_no"     => $trade_no,     //支付宝交易号；
                "total_fee"     => $total_fee,    //交易金额；
                "trade_status"     => $trade_status, //交易状态
                "notify_id"     => $notify_id,    //通知校验ID。
                "notify_time"   => $notify_time,  //通知的发送时间。
                "buyer_email"   => $buyer_email,  //买家支付宝帐号；
            );

            if($_POST['trade_status'] == 'TRADE_FINISHED') {
                //
            }else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {

                if(!checkorderstatus($out_trade_no)){
                  orderhandle($parameter);
                //进行订单处理，并传送从支付宝返回的参数；
              }
            }
            echo "success";        //请不要修改或删除
        }else {
            //验证失败
            echo "fail";
        }
    }

    /*
        页面跳转处理方法；
        这里其实就是将return_url.php这个文件中的代码复制过来，进行处理；
        */
    function returnurl(){
        //头部的处理跟上面两个方法一样，这里不罗嗦了！
        $alipay_config=C('alipay_config');
        $alipayNotify = new \AlipayNotify($alipay_config);//计算得出通知验证结果
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {
            //验证成功
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
            $out_trade_no   = $_GET['out_trade_no'];      //商户订单号
            $trade_no       = $_GET['trade_no'];          //支付宝交易号
            $trade_status   = $_GET['trade_status'];      //交易状态
            $total_fee      = $_GET['total_fee'];         //交易金额
            $notify_id      = $_GET['notify_id'];         //通知校验ID。
            $notify_time    = $_GET['notify_time'];       //通知的发送时间。
            $buyer_email    = $_GET['buyer_email'];       //买家支付宝帐号；
            $parameter = array(
                "out_trade_no"     => $out_trade_no,      //商户订单编号；
                "trade_no"     => $trade_no,          //支付宝交易号；
                "total_fee"      => $total_fee,         //交易金额；
                "trade_status"     => $trade_status,      //交易状态
                "notify_id"      => $notify_id,         //通知校验ID。
                "notify_time"    => $notify_time,       //通知的发送时间。
                "buyer_email"    => $buyer_email,       //买家支付宝帐号
            );
            if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {

                if(!checkorderstatus($out_trade_no)){
                    orderhandle($parameter);  //进行订单处理，并传送从支付宝返回的参数；
                }
                $new_order =substr($out_trade_no,0,1);
                if($new_order=="C"){
                    $this->redirect(C('CHONG_ADDRESS'));
                }else{
                    $hr_active = 'no';//是否从众筹活动页面跳转而来
                    //个人充值送n*1积分 ,私教购买送10积分，商城购买送10积分
                    $uid = decrypt(cookie('uid'));
                    $bean = (int)$total_fee*1;
                    $pay_type = cookie('pay_type');
                    if($bean > 0 and $pay_type !=0){
                        if($pay_type == '个人充值'){
                            insert_user_been($uid,$bean,"充值成功"."+".$bean."积分",8);
                        }elseif($pay_type == '私教购买'){
                            $bean = 10;
                            insert_user_been($uid,$bean,"私教购买"."+".$bean."积分",15);
                        }elseif($pay_type == '商城购买'){
                            $bean = 10;
                            insert_user_been($uid,$bean,"商城购买"."+".$bean."积分",16);
                        }else{

                        }
                    }
                    //如果是众筹活动,更新支付成功状态并发送信息
                    if($pay_type == '众筹活动'){
                        $hr_active = 'yes';

                        $update_data = array(
                            'pay_state' =>1,
                            'remarks' => $_POST['remarks'],
                        );
                        $result = M('hr_active_enroll')-> where('trade_no='."'$out_trade_no'")->setField($update_data);
                       /* if($result){
                            $user_phone = M('hr_active_enroll')-> where('trade_no='."'$out_trade_no'")->getField('phone');
                            $msg = '亲爱的儒思VIP会员，恭喜您已成功加入儒思HR欢乐颂，我们共同“遇见更好的自己”！您同时获得了儒思“UP实训班”全年课程。具体活动详情及课程安排可通过儒思App交易明细查询详情。承诺赠送给您的等值儒币将在三个工作日内打入您的儒思实名关联账户中，如有相关问题，请致电咨询客服。';
                            send_sms("$user_phone", $msg);
                        }*/
                    }
                    cookie('trade_no',$out_trade_no,3600);
                    cookie('hr_active',$hr_active,3600);//将是否众筹状态带置成功页面，已改变页面显示内容 'successpage'=>'Order/myorder?ordtype=payed',

                    //支付成功发送短信
                    $this->payedSendMessage($out_trade_no);

                    $this->redirect(C('alipay.successpage').'&produc_order_id='.$out_trade_no);//跳转到配置项中配置的支付成功页面；
                }
            }else {
                echo "trade_status=".$_GET['trade_status'];
                $this->redirect(C('alipay.errorpage'));//跳转到配置项中配置的支付失败页面；
            }
        }else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "支付失败！";
        }
    }
    /**
     * [payedSendMessage 支付完成发送短信]
     * @return [type] [description]
     */
    public function payedSendMessage($out_trade_no){
        // 订单信息
        $data=D('Mycent')->getOrderData($out_trade_no);
        $class_mode_remark=$data['class_mode_remark'] ? $data['class_mode_remark'] : '无';
        $class_mode=$data['class_mode'];
        $class_field=explode('、',$data['field_goodat']);
        $class_field=$class_field[0];
        $teac_name=$data['teac_name'];
        $teac_mobile=$data['teac_mobile'];
        $stu_name=$data['stu_name'];
        $stu_mobile=$data['stu_mobile'];

        //发送信息
        $teac_msg = sprintf('【儒思HR】亲爱的%s老师，学员%s，购买了您的%s（留言：%s）。学员希望的上课方式%s，学员的联系方式为：%s，请您尽快与学员联系，沟通课程内容，约定上课时间，发送课程表，并进行线上确认课表发送。如有任何问题，欢迎拨打客服电话13331173231。',$teac_name,$stu_name,$class_field,$class_mode_remark,$class_mode,$stu_mobile);
        $stu_msg = sprintf('【儒思HR】亲爱的%s，,您已经购买%s老师的私人教练课程。%s老师会于24小时内与您联系，请保持手机畅通。如有任何问题，欢迎拨打客服电话13331173231。',$stu_name,$teac_name,$name_teac);

        $teac_res = send_lmobile($teac_mobile,$teac_msg);
        $stu_res = send_lmobile($stu_mobile,$stu_msg);
        
        //写入短信log
        $log['mobile'] = $teac_mobile;
        $log['content'] = $teac_msg;
        $log['time'] = date('Y-m-d H:i:s',time());
        $log['controller'] = 'PayController';
        $log['source'] = 'web';
        $log['send_state'] = $teac_res;
        $insert_log[]=$log;

        $log['mobile'] = $stu_mobile;
        $log['content'] = $stu_msg;
        $log['send_state'] = $stu_res;
        $insert_log[]=$log;

        $result=M('send_sms_log')->addAll($insert_log);
    }
}
?>



