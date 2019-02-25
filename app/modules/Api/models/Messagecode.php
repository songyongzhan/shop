<?php
/**
 * Created by PhpStorm.
 * User: songyongzhan
 * Date: 2019/2/25
 * Time: 14:40
 * Email: 574482856@qq.com
 *
 * 短信 模型
 */
defined('APP_PATH') OR exit('No direct script access allowed');

class MessagecodeModel extends BaseModel {


  //需要请求外部接口

  public $messageSign;
  public $messageUsername;
  public $messagePassword;

  public function _init() {
    parent::_init(); // TODO: Change the autogenerated stub
    $this->_host = 'http://101.200.29.88:8082/';
    $this->messageSign = MESSAGESIGN;
    $this->messageUsername = MESSAGEUSERNAME;
    $this->messagePassword = MESSAGEPASSWORD;
  }

  public function send($mobile, $message) {

    $data = [
      'CorpID' => $this->messageUsername,
      'Pwd' => $this->messagePassword,
      'Mobile' => $mobile,
      'Content' => urlencode($this->messageSign . $message)
    ];
    $data=$this->fetchPost('SendMT/SendMessage', $data);
    


  }


  /*public function sendMessage($message,$mobile){
    $content=urlencode("【中国肉类协会】".$message);
    $url="";
    $userName="lyldzl";
    $userPass="lyldzl";
    $params = 'CorpID='.$userName.'&Pwd='.$userPass.'&Mobile='.$mobile.'&Content='.$content;
    $xmlcontent=self::curl($url,"post",$params);
    $_data=explode(",",$xmlcontent);
    $res=false;
    if($_data[0]==03){
      //插入到数据库
      $_data=array("type"=>1,"content"=>$message,"mobile"=>$mobile,"returnstatus"=>"-","message"=>"-","taskId"=>$_data[1]);
      $data=M("Message")->create($_data);
      $data['posttime']=time();
      $result=M("Message")->data($data)->add();
      if($result){
        $res=true;
      }
    }
    return $res;
  }*/


}

