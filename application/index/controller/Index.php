<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
		$code  = rand(100000,999999);
		//多个手机号以逗号隔开
		//$phone = '13096900712,13468678637';
		$send = send_sms($phone, 1, ['code'=>$code]);
		if($send['Message'] != 'OK'){
			dump($send);
		}else{
			echo '发送成功';
		}
    }
}
