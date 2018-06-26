<?php
namespace wxSdk;
class Jssdk {
  private $appId;
  private $appSecret;

  public function __construct($appId, $appSecret,$tokenSession=null) {
    $this->tokenSession =$tokenSession;
    $this->appId = $appId;
    $this->appSecret = $appSecret;
  }
  
  public function getSignPackage($ip=null) {
    $jsapiTicket = $this->getJsApiTicket();
    // 注意 URL 一定要动态获取，不能 hardcode.
//    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
//    $url2 = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if($ip == null){
        $ip = 'www.zsletel.com';
    }

    $url = "http://$ip";
    $timestamp = time();
    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);
    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       =>$url,
      "signature" => $signature,
      "rawString" => $string,
    );
    return $signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  public function getJsApiTicket() {
    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
//    $data = json_decode($this->get_php_file("jsapi_ticket.php"));
    if (cache('expire_time') < time()) {
      $accessToken = $this->getAccessToken();
//      return $accessToken;
      // 如果是企业号用以下 URL 获取 ticket
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
        //kgt8ON7yVITDhtdwci0qeclBTdMUrzpkRLyDyOj_S9ZX9OjeyhjAxdP7yqInWF2XkScJh1uisDowEf_SKBkgLg1504515050
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
      $res = json_decode($this->httpGet($url));

      $ticket = $res->ticket;
      if ($ticket) {
          cache('expire_time',time() + 7000);
          cache('jsapi_ticket',$ticket);
//        $data->jsapi_ticket = $ticket;
//        $this->set_php_file("jsapi_ticket.php", json_encode($data));
      }
    } else {
      $ticket = cache('jsapi_ticket');
    }

    return $ticket;
  }

  public function getAccessToken() {
    // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
//    $data = json_decode(file_get_contents("extra/access_token.json"));

    if (cache('expire_time1') < time()) {

      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
      $res = json_decode($this->httpGet($url));
      $access_token = $res->access_token;
//      $access_token = "Jp8S4A5-esf3kfxPROftUOzCxKIfnB_pRwuN61dYNQe8vJf7fxKbci985Hendb0cQ3-tKgO3-azg7ZIE19SquF7_s7dtUjsvHsaVcVg3o7IZCh8XPvJDWjsfw38hcDIHELIjAAAPWT";
      if ($access_token) {
          cache('expire_time1',time() + 7000);
          cache('access_token',$access_token);
//        $this->set_php_file("extra/access_token.php", json_encode($data));
      }
    } else {
      $access_token = cache('access_token');
    }
    return $access_token;
  }

  private function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);

    curl_close($curl);

    return $res;
  }

  private function get_php_file($filename) {
    return trim(substr(file_get_contents($filename), 15));
  }
  private function set_php_file($filename, $content) {
//     $fp = fopen($filename, "w");
//     fwrite($fp, "<?php exit();" . $content);
//     fclose($fp);
	   file_put_contents($filename,"<?php exit();?>" . $content);
  }
}

