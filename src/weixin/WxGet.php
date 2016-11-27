<?php
/**
 * 微信数据获取相关
 * User: GGC
 * Date: 2016/11/18
 * Time: 12:47
 */
namespace weixin;
use weixin\lib\Common;
use weixin\lib\Http;
class WxGet
{
    public function getContact(){}

    /**
     * 获取微信群组
     * @param $wxUrl
     * @param $wxParam
     * @return mixed
     */
    public function getBatch($wxUrl,$wxConfig,$wxParam)
    {
        $http = new Http();
        $url = $wxUrl['batchgetcontact'] . '?type=ex&r=' . Common::msectime() .'&lang='.$wxConfig['lang'].'&pass_ticket=' . $wxParam['ticket'];
        $header[] = 'ContentType: application/json; charset=UTF-8';
        $data = json_encode([
            'BaseRequest' => [
                'Uin' => $wxParam['wxuin'],
                'Sid' => $wxParam['wxsid'],
                'Skey' => $wxParam['skey'],
                'DeviceID' => $wxParam['device_id']
            ]
        ]);
        $res = $http->post($url, $header, $data);
        $res = json_decode($res);
        return $res;
    }

    public function getIcon(){}

    public function getHeadImg(){}

    public function getMsgImg(){}

    public function getVideo(){}

    public function getVoice(){}
}