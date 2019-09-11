<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Cache;

class Index extends controller
{
/*	public function index(){
		$menberId = 1;
		$value = [1,2,3,4];
		//这里的参数我就不多说了，多看手册。
		cache('redis_value'.$menberId, $value);
		$menberId = 2;
		$value = [5,6,7,8];
		cache('redis_value'.$menberId, $value);
	}*/

	//发送信息
/*    public function send()
    {
    	$data=[
    		'RegionId' => "cn-hangzhou",
	        //'PhoneNumbers' => "18710359268,13096900712,18710376114",
	        'SignName' => "陕西畅通网络科技有限公司",
	        'TemplateCode' => "SMS_173473936",
    	];
		aliyun_api('SendSms',$data);
	}*/

	//获取短信发送记录和发送状态
/*	public function send_details(){
		echo '<pre>';
		$data= [
			'RegionId' => "cn-hangzhou",
            'PhoneNumber' => "13096900712",
            'SendDate' => "20190910",
            'PageSize' => "50",
            'CurrentPage' => "1",
		];
		$result = aliyun_api('QuerySendDetails',$data);
		dump($result);
	}*/
}
