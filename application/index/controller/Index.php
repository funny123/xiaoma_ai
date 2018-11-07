<?php
namespace app\index\controller;
use think\Controller;
use marlon888\API;

class Index extends Controller
{
    /**
     * 文本翻译
     *
     * @return void
     */
    public function nlp_texttrans()
    {
        // 设置请求数据
        $appkey = '3Rj7EszbrLTAxTCf';
        $params = array(
            'app_id' => '1106878837',
            'type' => '0',
            'text' => '今天',
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

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
