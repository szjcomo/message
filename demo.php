<?php
/**
 * |-----------------------------------------------------------------------------------
 * @Copyright (c) 2014-2018, http://www.sizhijie.com. All Rights Reserved.
 * @Website: www.sizhijie.com
 * @Version: 思智捷管理系统 1.5.0
 * @Author : como 
 * 版权申明：szjshop网上管理系统不是一个自由软件，是思智捷科技官方推出的商业源码，严禁在未经许可的情况下
 * 拷贝、复制、传播、使用szjshop网店管理系统的任意代码，如有违反，请立即删除，否则您将面临承担相应
 * 法律责任的风险。如果需要取得官方授权，请联系官方http://www.sizhijie.com
 * |-----------------------------------------------------------------------------------
 */

require './vendor/autoload.php';

use szjcomo\message\Dxw;


/*

//获取账号余额
$result = Dxw::send('xxx','xxx',['type'=>'account']);
print_r($result);



//发送短信
$options = [
	'sign'=>'【思智捷科技】',
	'templateId'=>'xxx',
	'content'=>mt_rand(100000,999999).'##10',
	'mobile'=>'xxx',
	'type'=>'single'
];
$result = Dxw::send('xxx','xxx',$options);
print_r($result);



//批量发送
$options = [
	'sign'=>'【思智捷科技】',
	'templateId'=>'xxx',
	'content'=>mt_rand(100000,999999).'##10',
	'mobile'=>'xxx,xxx',
	'type'=>'single'
];
$result = Dxw::send('xxx','xxx',$options);
print_r($result);


//批量发送另外一种形式
$options = [
	'sign'=>'【思智捷科技】',
	'templateId'=>'xxx',
	'mobile'=>'xxx,xxx',
	'data'=>json_encode(['xxx'=>'xxx同学,短信验证码为'.mt_rand(100000,999999).'##10','xxx'=>'xxx同学,短信验证码为'.mt_rand(100000,999999).'##10']),
	'type'=>'allSend'
];
$result = Dxw::send('xxx','xxx',$options);
print_r($result);


//主动获取用户的回复信息
$options = [
	'type'=>'getReply'
];
$result = Dxw::send('xxx','xxx',$options);
print_r($result);



//主动获取短信状态
$options = [
	'type'=>'getStatus'
];
$result = Dxw::send('xxx','xxx',$options);
print_r($result);



//获取自定义模版列表
$options = [
	'type'=>'templatelist'
];
$result = Dxw::send('xxx','xxx',$options);
print_r($result);

*/




