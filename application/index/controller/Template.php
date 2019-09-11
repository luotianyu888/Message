<?php
namespace app\index\controller;
use \think\View;
use \think\Controller;
use \think\Request;
use \think\Model;


use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;



class Template extends controller{
	
	
public function index() {
      	
	
    $smcode = 'SMS_173767319';
   

// Download：https://github.com/aliyun/openapi-sdk-php
// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

    AlibabaCloud::accessKeyClient($accessKeyId='LTAI4FoHccrYsh9cWGHqULss', $accessKeySecret='KEK8lwdg1YhXLFNDQtL5AWOxhsx6tK')
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
                                          'TemplateCode' => $smcode,
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



    public function add(){
		
		 if (request()->isPost()) {
          $data = input('post.');

          // dump($data);die;
		
		
  AlibabaCloud::accessKeyClient($accessKeyId='LTAI4FoHccrYsh9cWGHqULss', $accessKeySecret='KEK8lwdg1YhXLFNDQtL5AWOxhsx6tK')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();

try {
    $result = AlibabaCloud::rpc()
                          ->product('Dysmsapi')
                          // ->scheme('https') // https | http
                          ->version('2017-05-25')
                          ->action('AddSmsTemplate')
                          ->method('POST')
                          ->host('dysmsapi.aliyuncs.com')
                          ->options([
                                        'query' => [
                                          'RegionId' => "cn-hangzhou",
                                          'TemplateType' => "1",
                                          'TemplateName' => $data['TemplateName'],
                                          'TemplateContent' => $data['TemplateContent'],
                                          'Remark' => $data['Remark'],
                                        ],
                                    ])
                          ->request();
						  
                           // print_r($result->toArray());
	
	
								} catch (ClientException $e) {
									echo $e->getErrorMessage() . PHP_EOL;
								} catch (ServerException $e) {
									echo $e->getErrorMessage() . PHP_EOL;
								}
                        
						
						   $arr=$result->toArray();
                          
						   $data['TemplateCode']=$arr['TemplateCode'];
						   $data['RequestId']=$arr['RequestId'];
						   $data['time']=time();
                           
						   $res=db('templete')->insert($data);
						   if($res){
								return $this->success("添加模板成功！", url('Template/add'));
							}else {
								return $this->error('添加模板失败！');
							}


		 }else{
			 $url=url("Template/add");
			 $this->assign('url',$url);
			  return $this->fetch(); 
			 }



}



    public function del(){
		

AlibabaCloud::accessKeyClient($accessKeyId='LTAI4FoHccrYsh9cWGHqULss', $accessKeySecret='KEK8lwdg1YhXLFNDQtL5AWOxhsx6tK')
                        ->regionId('cn-hangzhou') // replace regionId as you need
                        ->asDefaultClient();

try {
    $result = AlibabaCloud::rpc()
                          ->product('Dysmsapi')
                          // ->scheme('https') // https | http
                          ->version('2017-05-25')
                          ->action('DeleteSmsTemplate')
                          ->method('POST')
                          ->host('dysmsapi.aliyuncs.com')
                          ->options([
                                        'query' => [
                                          'RegionId' => "default",
                                          'TemplateCode' => "SMS_173762423",
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



public function edit(){
		

AlibabaCloud::accessKeyClient($accessKeyId='LTAI4FoHccrYsh9cWGHqULss', $accessKeySecret='KEK8lwdg1YhXLFNDQtL5AWOxhsx6tK')
                        ->regionId('cn-hangzhou') // replace regionId as you need
                        ->asDefaultClient();

try {
    $result = AlibabaCloud::rpc()
                          ->product('Dysmsapi')
                          // ->scheme('https') // https | http
                          ->version('2017-05-25')
                          ->action('ModifySmsTemplate')
                          ->method('POST')
                          ->host('dysmsapi.aliyuncs.com')
                          ->options([
                                        'query' => [
                                          'RegionId' => "cn-hangzhou",
                                          'TemplateType' => "1",
                                          'TemplateName' => "123",
                                          'TemplateCode' => "123",
                                          'TemplateContent' => "123",
                                          'Remark' => "123",
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