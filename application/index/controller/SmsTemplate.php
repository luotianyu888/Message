<?php
namespace app\index\controller;
use think\Db;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

class SmsTemplate{

    /**
     * @title 用户登录
     * @return html
     */
	public function login($username = '', $password = '') {

		if ($this->request->isPost()) {
			if (!$username || !$password) {
				return $this->error('用户名或者密码不能为空！', '');
			}

			$user = model('Member');
			$uid  = $user->login($username, $password);
			if ($uid > 0) {
				return $this->success('登录成功！', url('admin/index/index'));
			} else {
				switch ($uid) {
				case -1:$error = '用户不存在或被禁用！';
					break; //系统级别禁用
				case -2:$error = '密码错误！';
					break;
				default:$error = '未知错误！';
					break; // 0-接口参数错误（调试阶段使用）
				}
				return $this->error($error, '');
			}
		} else {
			return $this->fetch();
		}
	}

 
    
	

	public function message() {



// Download：https://github.com/aliyun/openapi-sdk-php
// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

    AlibabaCloud::accessKeyClient('<accessKeyId>', '<accessSecret>')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();

					try {
						$result = AlibabaCloud::rpc()
                          ->product('Dysmsapi')
                          // ->scheme('https') // https | http
                          ->version('2017-05-25')
                          ->action('QuerySmsTemplate')
                          ->method('POST')
                          ->host('dysmsapi.aliyuncs.com')
                          ->options([
                                        'query' => [
                                          'RegionId' => "cn-hangzhou",
                                          'TemplateCode' => "SMS_173473936",
                                        ],
                                    ])
                          ->request();
					print_r($result->toArray());
				} catch (ClientException $e) {
					echo $e->getErrorMessage() . PHP_EOL;
				} catch (ServerException $e) {
					echo $e->getErrorMessage() . PHP_EOL;
				}

}
}