<?php

return [
    //微信配置
    'wxConfig' => [
        'appid' => 'xxx',
        'fun' => 'new',
        'lang' => 'zh_CN'
    ],
    //微信连接地址
    'wxUrl' => [
        'domain' => 'https://wx.qq.com',
        'jslogin' => 'https://login.weixin.qq.com/jslogin',//获取UUID
        'qrcode' => 'https://login.weixin.qq.com/qrcode/',//生成二维码
        'login' => 'https://login.weixin.qq.com/cgi-bin/mmwebwx-bin/login',//二维码登陆
        'getinfo' => 'https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxnewloginpage',//获取基础信息
        'init' => 'https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxinit',//微信初始化
        'statusnotify' => 'https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxstatusnotify',//状态通知
        'getcontact' => 'https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxgetcontact',//获取联系人列表
        'batchgetcontact' => 'https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxbatchgetcontact',//获取群列表
        'synccheck' => 'https://webpush.wx.qq.com/cgi-bin/mmwebwx-bin/synccheck',//同步检查
        'sync' => 'https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxsync',//数据同步
        'sendmsg' => 'https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxsendmsg',//发送文本消息
        'sendemoticon' => 'https://wx2.qq.com/cgi-bin/mmwebwx-bin/webwxsendemoticon',//发送表情
        'geticon' => 'https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxgeticon',//获取图片
        'getheadimg' => 'https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxgetheadimg',//获取群图片
        'getmsgimg' => 'https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxgetmsgimg',//获取消息图片
        'getvideo' => 'https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxgetvideo',//获取视频
        'getvoice' => 'https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxgetvoice',//获取语音
    ]
];