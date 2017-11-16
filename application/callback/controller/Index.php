<?php
namespace app\callback\controller;
use think\Controller;

class Index extends Controller {
    function _initialize() {
        $this->file = 'data/log/pay/'.date('Y-m-d').'.txt';
        $this->order = db("mall_order");
        //获取积分赠送规则
        $this->giveScore = (int)db('config')->where(array('name'=>"giveScore"))->find()['data'];
    }

    function index(){
        $postStr = @file_get_contents('php://input');
        file_put_contents($this->file, $postStr."\r\n",FILE_APPEND);
    }

    /**
     * 微信回调
     * attach为1的时候是支付服务费，保存订单id到trade_id_service中，为3的时候是运费，订单号保存到trade_id中
     * 当Attach为2的时候代表是支付保证金，此时保存到流水表中
     */
    function wechat_callback(){
        file_put_contents($this->file, "微信回调\r\n",FILE_APPEND);
        if(IS_POST) {
            $postStr = file_get_contents("php://input");
            file_put_contents($this->file, "postStr: " . $postStr . "\r\n", FILE_APPEND);
            $postData = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            //验证签名

            if (wechat_check_sign($postData)) {
                exit;
            }
            $out_trade_no = $postData['out_trade_no']; //商户订单号
            $trade_no = $postData['transaction_id']; //微信交易号
            $trade_status = $postData['result_code']; //交易状态
            $return_code = $postData['return_code']; //返回code
            $attach = $postData['attach']; //返回code
            $total_fee = $postData['total_fee']; //返回订单金额
            $time = date('Y-m-d H:i:s');

            $array_params = explode('*',$attach);
            $attach = $array_params[0];
            $orderNo = $array_params[1];
            $succ_str = "<xml>
                          <return_code><![CDATA[SUCCESS]]></return_code>
                          <return_msg><![CDATA[OK]]></return_msg>
                        </xml>";
            if ($return_code == "SUCCESS" && $trade_status == 'SUCCESS') { //判断该笔订单是否在商户网站中已经做过处理
                $this->deal_callback($attach,$orderNo,$trade_no,$succ_str);
            }else{
                file_put_contents($this->file, "{$time} ：" . "订单:{$orderNo} 已被处理" . "\r\n", FILE_APPEND);
            }
            exit();

        }
    }

    /**
     * 支付宝异步通知回调页面
     * passback_params为1的时候是支付服务费，保存订单id到trade_id_service中，为3的时候是运费，订单号保存到trade_id中
     * 当passback_params为2的时候代表是支付保证金，此时保存到流水表中
     */
    public function alipay_callback() {
        file_put_contents($this->file, "支付宝回调\r\n",FILE_APPEND);
        if(IS_POST) {
            $orderNo = $_POST['out_trade_no']; //商户订单号
            $trade_no = $_POST['trade_no']; //支付宝交易号
            $trade_status = $_POST['trade_status']; //交易状态
            $passback_params = $_POST['passback_params']; //通知校验id
            $notify_id = $_POST['notify_id']; //通知校验id
            $total_fee = $_POST['total_amount'];//充值金额
            $time = date('Y-m-d H:i:s');
            file_put_contents($this->file, json_encode($_POST)."\r\n",FILE_APPEND);
            //校验请求信息
            Vendor('aop.AopClient');
            $aop = new \AopClient;
            $aop->alipayrsaPublicKey = file_get_contents('data/key/app_public_key_alipay.txt');
            $flag = $aop->rsaCheckV1($_POST,NULL, "RSA2");
            if(!$flag){
                file_put_contents($this->file, "{$time} "."支付宝回调验签失败"."\r\n",FILE_APPEND);
                exit;
            }
            $succ_str = 'success';
            $array_params = explode('*',$passback_params);
            $passback_params = $array_params[0];
            $orderNo = $array_params[1];

            if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
                $this->deal_callback($passback_params,$orderNo,$trade_no,$succ_str);

            }else{
                file_put_contents($this->file, "{$time} ：" . "信息错误，订单已被处理" . "\r\n", FILE_APPEND);
            }
            exit();
        }
    }

    /**
     * 回调结果处理
     * @param $passback_params string 回调返回的内容 1代表买鞋子，2代表支付每周抢鞋，3代表球鞋发售
     * @param $orderNo string 订单号（本系统生成的）
     * @param $trade_no string 交易号（第三方平台生成的）
     * @param $succ_str string 返回给第三方支付平台的内容
     *
     */
    private function deal_callback($passback_params,$orderNo,$trade_no,$succ_str){
        $time = date('Y-m-d H:i:s');

        if ($passback_params == '1') {
            //买鞋子
            $order = db("mall_order");
            file_put_contents($this->file, "{$time} ：" . "买鞋子操作" . "\r\n", FILE_APPEND);
            $pay_info = $order->where(array("orderId" => $orderNo))->find();

            //校验是否有此订单
            if (empty($pay_info)) {
                echo $succ_str;
                file_put_contents($this->file, "{$time} ：" . "订单:{$orderNo} 不存在" . "\r\n", FILE_APPEND);
                exit;
            }
            $payStatus = $pay_info['payStatus'];
            //处理订单
            ////判断该笔订单是否在商户网站中已经做过处理
            if ( $payStatus!= '0') {
                file_put_contents($this->file, "{$time} ：" . "{$orderNo} already done" . "\r\n", FILE_APPEND);
            } else {
                file_put_contents($this->file, "{$time} ：" . "开始处理订单:{$orderNo}" . "\r\n", FILE_APPEND);
                //保存微信交易号
                $this->deal_order($passback_params, $trade_no, $pay_info, $orderNo);
                file_put_contents($this->file, "{$time} ：" . "成功处理订单:{$orderNo}" . "\r\n", FILE_APPEND);
            }

        }elseif ($passback_params == '4'){
            //充值服务
            file_put_contents($this->file, "{$time} ：" . "充值服务" . "\r\n", FILE_APPEND);
            $where = array("rechargeId" => $orderNo);
            $pay_info = db('recharge')->where($where)->find();
            if($pay_info){
                $payStatus = $pay_info['payStatus'];
                if($payStatus == '0'){
                    $balance = $pay_info['fee'];
                    $score = $this->giveScore*$pay_info['fee'];
                    db()->execute("UPDATE sd_user SET balance = balance+{$balance},score = score + {$score} WHERE userId='{$pay_info['userId']}'");
                    file_put_contents($this->file, "{$time} ：" . "充值成功" . "\r\n", FILE_APPEND);
                    db('recharge')->where($where)->save(array('payStatus'=>'1'));

                    //推送消息
                    $content = array(
                        'title'=>'订单支付',
                        'fee'=>$pay_info['fee'],
                        'msg'=>'积分充值成功'
                    );

                    $user = db('user')->field("openid")->where(array('userId'=>$pay_info['userId']))->find();

                    push_weChatmsg($user['openid'],$content);


                }else{
                    file_put_contents($this->file, "{$time} ：" . "{$orderNo} already done" . "\r\n", FILE_APPEND);
                }

            }else{
                file_put_contents($this->file, "{$time} ：" . "充值失败；无此订单" . "\r\n", FILE_APPEND);
            }
        }else{
            //每周抢鞋和球鞋发售
            $where = array("performanceId" => $orderNo);
            if($passback_params == '2'){
                $pay_info = db("week_performance")->where($where)->find();
            }else{
                $pay_info = db("sell_performance")->where($where)->find();
            }
            $payStatus = $pay_info['payStatus'];
            if($payStatus == '0'){
                $time = date('Y-m-d H:i:s');
                $data = array();
                $data['trade_id'] = $trade_no;
                $data['payTime'] = $time;
                $data['payStatus'] = '1';
                //修改余额和优惠券状态
                $content = array(
                    'title'=>'订单支付',
                    'fee'=>$pay_info['fee'],
                );
                if($passback_params == '2'){
                    $content['msg'] = '每周抢鞋购买成功';
                    db("week_performance")->where($where)->save($data);
                }else{
                    $content['msg'] = '球鞋发售购买成功';
                    db("sell_performance")->where($where)->save($data);
                }

                $balanceStatus = $pay_info['balanceStatus'];
                $couponStatus = $pay_info['couponStatus'];
                $balance = $pay_info['balance'];
                $score = $this->giveScore*$pay_info['fee'];
                $couponWhere = array("couponId"=>$pay_info['couponId']);
                if($balanceStatus == '1'){
                    db("user")->execute("update sd_user set balance = balance-{$balance},score = score + $score where userId={$pay_info['userId']}");
                }

                if($couponStatus == '1'){
                    db("coupon")->where($couponWhere)->save(array("isuser"=>"1"));
                }

                //推送消息
                $user = db('user')->field("openid")->where(array('userId'=>$pay_info['userId']))->find();

                push_weChatmsg($user['openid'],$content);
            }
        }
        echo $succ_str;
    }


    /**
     * 订单处理
     * @param $passback_params
     * @param $trade_no
     * @param $pay_info //订单数据
     * @param $orderNo
     */
    private function deal_order($passback_params,$trade_no,$pay_info,$orderNo){
        $time = date('Y-m-d H:i:s');
        $data = array();
        $data['trade_id'] = $trade_no;
        $data['payTime'] = $time;
        $data['payStatus'] = '1';
        //买鞋子
        $this->order->where(array("orderId" => $orderNo))->save($data);
        //修改余额和优惠券状态
        $balanceStatus = $pay_info['balanceStatus'];
        $couponStatus = $pay_info['couponStatus'];
        $balance = $pay_info['balance'];
        $score = $this->giveScore*$pay_info['fee'];
        $couponWhere = array("couponId"=>$pay_info['couponId']);
        if($balanceStatus == '1'){
            db("user")->execute("update sd_user set balance = balance-{$balance},score = score + $score where userId={$pay_info['userId']}");
        }

        if($couponStatus == '1'){
            db("coupon")->where($couponWhere)->save(array("isuser"=>"1"));
        }
        //推送消息
        $content = array(
            'title'=>'订单支付',
            'fee'=>$pay_info['fee'],
            'msg'=>'订单支付成功'
        );

        $user = db('user')->field("openid")->where(array('userId'=>$pay_info['userId']))->find();

        push_weChatmsg($user['openid'],$content);
        duanxinbao_sms($pay_info['contactMobile'], null,'支付成功，请耐心等待发货哦。');
    }


}