<?php

/**
 * 微信消息发送相关
 * User: GGC
 * Date: 2016/11/18
 * Time: 12:30
 */
namespace weixin;
use weixin\lib\Common;
use weixin\lib\Http;
class WxSend
{
    public function text($wxUrl,$wxParam,$data){
        $http = new Http();
        $url = $wxUrl['sendmsg'].'?lang=zh_CN&pass_ticket='.$wxParam['ticket'];
        $header[] = 'ContentType: application/json; charset=UTF-8';
        $LocalID = Common::msectime();
        $data = json_encode([
            'BaseRequest' => [
                'Uin'=>$wxParam['uid'],
                'Sid'=>$wxParam['sid'],
                'Skey'=>$wxParam['skey'],
                'DeviceID'=> $wxParam['device_id']
            ],
            'Msg' => [
                'Type' => 1,
                'Content' => $data['text'],
                'FromUserName' => $data['FromUserName'],
                'ToUserName' => $data['ToUserName'],
                'LocalID' => $LocalID,
                'ClientMsgId' => $LocalID
            ],
            'Scene'=>0
        ],JSON_UNESCAPED_UNICODE);
        $res = $http->post($url,$header,$data);
        return json_decode($res);
    }

    public function motion(){}
}