<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Config;

class Translate extends Controller
{
    /**
     * 文本翻译
     *
     * @return void
     */
    public function nlp_texttrans()
    {
        // 设置请求数据
        $appkey = Config::get('appkey');
;
        $params = array(
            'app_id' => Config::get('appid'),
            'type' => '0',
            'text' => '科技公司',
            'time_stamp' => strval(time()),
            'nonce_str' => strval(rand()),
            'sign' => '',
        );
        $params['sign'] = getReqSign($params, $appkey);

// 执行API调用
        $url = 'https://api.ai.qq.com/fcgi-bin/nlp/nlp_texttrans';
        $response = doHttpPost($url, $params);
        echo $response;
    }
    /**
     * 图片翻译
     *
     * @return void
     */
    public function nlp_imagetranslate()
    {
        // 图片base64编码
        $path = 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1541506974077&di=9fb148566ed940a22428324569459094&imgtype=0&src=http%3A%2F%2Fpic.58pic.com%2F58pic%2F17%2F19%2F56%2F47Y58PICFP7_1024.jpg
';
        $data = file_get_contents($path);
        $base64 = base64_encode($data);

// 设置请求数据
        $appkey = '3Rj7EszbrLTAxTCf';
        $params = array(
            'app_id' => '1106878837',
            'image' => $base64,
            'session_id' => '1509333188',
            'scene' => 'doc',
            'source' => 'en',
            'target' => 'zh',
            'time_stamp' => strval(time()),
            'nonce_str' => strval(rand()),
            'sign' => '',
        );
        $params['sign'] = getReqSign($params, $appkey);

// 执行API调用
        $url = 'https://api.ai.qq.com/fcgi-bin/nlp/nlp_imagetranslate';
        $response = doHttpPost($url, $params);
        echo $response;
    }


}
