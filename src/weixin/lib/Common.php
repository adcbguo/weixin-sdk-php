<?php
/**
 * 微信公共类库
 * User: ggc
 * Date: 2016/11/18 0018
 * Time: 19:46
 */
namespace weixin\lib;
class Common
{
    /**
     * 生成设备驱动id
     * @return int
     */
    static function genDeviceId(){
        return 'e'.rand(199999999,999999999).rand(100000,999999);
    }
    /**
     * 返回当前毫秒时间
     * @return float
     */
    static function msectime()
    {
        list($tmp1, $tmp2) = explode(' ', microtime());
        return sprintf('%.0f', (floatval($tmp1) + floatval($tmp2)) * 1000);
    }
}