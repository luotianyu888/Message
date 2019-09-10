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

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

/**
 * 阿里云短信服务接口调用
 * @param $action    接口类型 
 * @param $data    携带参数（array()）
 * @return json
 * @
 */

function aliyun_api($action,$data){
    AlibabaCloud::accessKeyClient($accessKeyId = 'LTAI4FoHccrYsh9cWGHqULss',
            $accessKeySecret = 'KEK8lwdg1YhXLFNDQtL5AWOxhsx6tK')
                    ->regionId('cn-hangzhou') // replace regionId as you need
                    ->asDefaultClient();

    try {
        $result = AlibabaCloud::rpc()
                    ->product('Dysmsapi')
                    // ->scheme('https') // https | http
                    ->version('2017-05-25')
                    ->action($action)
                    ->method('POST')
                    ->host('dysmsapi.aliyuncs.com')
                    ->options([
                                'query' => $data,
                            ])
                    ->request();
        return $result->toArray();
    } catch (ClientException $e) {
        echo $e->getErrorMessage() . PHP_EOL;
    } catch (ServerException $e) {
        echo $e->getErrorMessage() . PHP_EOL;
    }
}