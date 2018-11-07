<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Config;

class Imgeffect extends Controller
{
    /**
     * 图片滤镜 图片滤镜（天天P图）
     * 对原图进行滤镜特效处理，更适合人物图片
     *
     * @return void
     */
    public function ptu_imgfilter()
    {
        // 图片base64编码
        $path = 'https://file.digitaling.com/eImg/uimages/20171009/1507508998226085.jpg';
        $data = file_get_contents($path);
        $base64 = base64_encode($data);

        // 设置请求数据
        $appkey = Config::get('appkey');

        $params = array(
            'app_id' => Config::get('appid'),
            'image' => $base64,
            'filter' => '1',
            'time_stamp' => strval(time()),
            'nonce_str' => strval(rand()),
            'sign' => '',
        );
        $params['sign'] = getReqSign($params, $appkey);

        // 执行API调用
        $url = 'https://api.ai.qq.com/fcgi-bin/ptu/ptu_imgfilter';
        $response = doHttpPost($url, $params);
        $images = json_decode($response,1);
        $img = base64_decode($images['data']['image']);
        $a = file_put_contents('./test.jpg', $img); //返回的是字节数
        print_r($a);

    }
    /**
     * 人脸变妆
     * 给定图片和变妆编码，对原图进行人脸变妆特效处理
     *
     * @return void
     */
    public function ptu_facedecoration()
    {
        // 图片base64编码
        $path = 'https://file.digitaling.com/eImg/uimages/20171009/1507508998226085.jpg';
        $data = file_get_contents($path);
        $base64 = base64_encode($data);

        // 设置请求数据
        $appkey = Config::get('appkey');

        $params = array(
            'app_id' => Config::get('appid'),
            'image' => $base64,
            'decoration' => '22',
            'time_stamp' => strval(time()),
            'nonce_str' => strval(rand()),
            'sign' => '',
        );
        $params['sign'] = getReqSign($params, $appkey);

        // 执行API调用
        $url = 'https://api.ai.qq.com/fcgi-bin/ptu/ptu_facedecoration';
        $response = doHttpPost($url, $params);
        $images = json_decode($response, 1);
        $img = base64_decode($images['data']['image']);
        $a = file_put_contents('./test.jpg', $img); //返回的是字节数
        print_r($a);

    }

}
