<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function doHttpPost ($url, $params) {
    $curl = curl_init();

    $response = false;
 
            // 1. 设置HTTP URL (API地址)
        curl_setopt($curl, CURLOPT_URL, $url);

            // 2. 设置HTTP HEADER (表单POST)
        $head = array(
            'Content-Type: application/x-www-form-urlencoded'
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $head);

            // 3. 设置HTTP BODY (URL键值对)
        $body = http_build_query($params);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);

            // 4. 调用API，获取响应结果
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_NOBODY, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
        $_http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($_http_code != 200) {
            $msg = curl_error($curl);
            $response = json_encode(array('ret' => -1, 'msg' => "sdk http post err: {$msg}", 'http_code' => $_http_code));
            return;
        }

    curl_close($curl);
    return $response;
}
function getReqSign($params, $appkey)
{
        // 0. 补全基本参数
    // $params['app_id'] = $this->app_id;

    if (!$params['nonce_str']) {
        $params['nonce_str'] = uniqid("{$params['app_id']}_");
    }

    if (!$params['time_stamp']) {
        $params['time_stamp'] = time();
    }

        // 1. 字典升序排序
    ksort($params);

        // 2. 拼按URL键值对
    $str = '';
    foreach ($params as $key => $value) {
        if ($value !== '') {
            $str .= $key . '=' . urlencode($value) . '&';
        }
    }

        // 3. 拼接app_key
    $str .= 'app_key=' . $appkey;

        // 4. MD5运算+转换大写，得到请求签名
    $sign = strtoupper(md5($str));
    return $sign;
}
