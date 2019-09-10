<?php
namespace app\index\controller;

class Index
{
	public function index(){

	}

	//发送信息
    public function send()
    {
    	$data=[
    		'RegionId' => "cn-hangzhou",
	        //'PhoneNumbers' => "18710359268,13096900712,18710376114",
	        'SignName' => "畅通网络科技有限公司",
	        'TemplateCode' => "SMS_173473936",
    	];
		aliyun_api('SendSms',$data);
	}

	//获取短信发送记录和发送状态
	public function send_details(){
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
	}
}
