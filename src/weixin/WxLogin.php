<?php
/**
 * 微信登陆相关
 * User: GGC
 * Date: 2016/11/18
 * Time: 12:42
 */
namespace weixin;
use weixin\lib\Common;
use weixin\lib\Http;
class WxLogin
{
    /**
     * 获取uuid
     * @param $wxUrl
     * @param $wxConf
     * @return array
     */
    public function getUuid($wxUrl, $wxConf)
    {
        $url = $wxUrl['jslogin'] . '?appid=' . $wxConf['appid'] . '&fun=' . $wxConf['fun'] . '&lang=' . $wxConf['lang'] . '&_=' . time();
        $http = new Http();
        $res = $http->get($url);
        preg_match('/\d+/', $res, $code);
        preg_match('/\"(.*?)\"/', $res, $uuid);
        return ['code' => $code[0], 'uuid' => $uuid[1]];
    }

    /**
     * 获取二维码地址
     * @param $wxUrl
     * @param string $uuid
     * @param string $wxConf
     * @return string
     */
    public function qrcode($wxUrl, $uuid = '', $wxConf = '')
    {
        if ($uuid) {
            return $wxUrl['qrcode'] . $uuid;
        } else {
            $array = $this->getUuid($wxUrl, $wxConf);
            return $wxUrl['qrcode'] . $array['uuid'];
        }
    }

    /**
     * 微信登陆
     * @param $wxUrl
     * @return array
     */
    public function login($wxUrl, $uuid, $tip = 1)
    {
        $url = $wxUrl['login'] . '?loginicon=true&tip=' . $tip . '&uuid=' . $uuid . '&_' . time();
        $http = new http();
        $res = $http->get($url);
        preg_match('/\d+/', $res, $code);
        preg_match('/window.redirect_uri=\"(.*?)\"/', $res, $url);
        preg_match('/window.userAvatar = \'(.*?)\'/', $res, $userAvatar);
        $url = (count($url) > 0) ? $url[1] : 0;
        $userAvatar = (count($userAvatar) > 0) ? $userAvatar[1] : 0;
        return ['code' => $code[0], 'url' => $url, 'userAvatar' => $userAvatar];
    }

    /**
     * 获取基础信息
     * @param $url
     * @return array
     */
    public function getInfo($url)
    {
        $http = new http();
        $res = $http->get($url);
        preg_match("/\<ret\>(.*?)\<\/ret\>/", $res, $ret);
        preg_match("/\<skey\>(.*?)\<\/skey\>/", $res, $skey);
        preg_match("/\<wxsid\>(.*?)\<\/wxsid\>/", $res, $wxsid);
        preg_match("/\<wxuin\>(.*?)\<\/wxuin\>/", $res, $wxuin);
        preg_match("/\<pass_ticket\>(.*?)\<\/pass_ticket\>/", $res, $pass_ticket);
        preg_match("/\<isgrayscale\>(.*?)\<\/isgrayscale\>/", $res, $isgrayscale);
        $res = [
            'ret' => $ret[1],
            'skey' => $skey[1],
            'wxsid' => $wxsid[1],
            'wxuin' => $wxuin[1],
            'ticket' => $pass_ticket[1],
            'isgrayscale' => $isgrayscale[1],
        ];
        return $res;
    }

    /**
     * 初始化微信
     * @param $wxUrl
     * @param $wxParam
     * @return mixed
     */
    public function init($wxUrl, $wxParam)
    {
        $http = new http();
        $url = $wxUrl['init'] . '?pass_ticket=' . $wxParam['ticket'] . '&lang=zh_CN&skey=' . $wxParam['skey'] . '&r=' . time();
        $header[] = 'ContentType: application/json; charset=UTF-8';
        $data = json_encode([
            'BaseRequest' => [
                'Uin' => $wxParam['uid'],
                'Sid' => $wxParam['sid'],
                'Skey' => $wxParam['skey'],
                'DeviceID' => $wxParam['device_id']
            ]
        ]);
        $res = $http->post($url, $header, $data);
        $res = json_decode($res);
        return $res;
    }
}