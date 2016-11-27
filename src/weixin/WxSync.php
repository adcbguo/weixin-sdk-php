<?php
/**
 * 微信同步任务相关
 * User: PHP
 * Date: 2016/11/18
 * Time: 12:47
 */
namespace weixin;
use weixin\lib\Common;
use weixin\lib\Http;
class WxSync
{
    public function notify($wxUrl, $wxParam,$wxConf)
    {
        $http = new Http();
        $url = $wxUrl['statusnotify'] . '?lang=' . $wxConf['lang'].'&pass_ticket=' . $wxParam['ticket'];
        $header[] = 'ContentType: application/json; charset=UTF-8';
        $data = json_encode([
            'BaseRequest' => [
                'Uin' => $wxParam['uid'],
                'Sid' => $wxParam['sid'],
                'Skey' => $wxParam['skey'],
                'DeviceID' => $wxParam['device_id']
            ],
            'Code'=>3,
            'FromUserName'=>$wxParam['user_name'],
            'ToUserName'=>$wxParam['user_name'],
            'ClientMsgId'=>$wxParam['ClientMsgId']
        ]);
        $res = $http->post($url, $header, $data);
        $res = json_decode($res);
        return $res;
    }
    /**
     * 检查微信状态
     * @param $wxUrl
     * @param $wxParam
     * @return array
     */
    public function check($wxUrl, $wxParam, $synckey)
    {
        $http = new Http();
        foreach ($synckey as $item) {
            if (empty($synckeyVal)) {
                $synckeyVal = $item['sync_key'] . '_' . $item['sync_val'];
            } else {
                $synckeyVal .= '|' . $item['sync_key'] . '_' . $item['sync_val'];
            }
        }
        $url = $wxUrl['synccheck'] . '?r=' . Common::msectime() .'&skey=' . urlencode($wxParam['skey']) .
            '&sid=' . $wxParam['sid'] . '&uin=' . $wxParam['uid'] .
            '&deviceid=' . $wxParam['device_id'] . '&synckey=' . urlencode($synckeyVal) .
            '&_=' . Common::msectime();
        $res = $http->get($url);
        preg_match('/retcode:\"(.*?)\"/', $res, $retcode);
        preg_match('/selector:\"(.*?)\"/', $res, $selector);
        return [
            'retcode' => $retcode[1],
            'selector' => $selector[1],
        ];
    }

    public function sync(){}
}