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
namespace szjcomo\message;
/**
 * 短信网发送短信sdk
 */
Class Dxw {
	/**
	 * 短信网接口根地址
	 */
	Protected const HostURL 		= 'http://api.1cloudsp.com/';
	/**
	 * 验证码短信接口地址
	 */
	Protected const singleSendURL 	= 'api/v2/single_send';
	/**
	 * 短信群发接口
	 */
	Protected const allSendURL 		= 'api/v2/send';
	/**
	 * 获取用户短信回复接口
	 */
	Protected const reportURL 		= 'report/up';
	/**
	 * 获取账号余额
	 */
	Protected const accountURL		= 'query/account';
	/**
	 * 短信模版查询接口
	 */
	Protected const templateURL		= 'query/templatelist';
	/**
	 * 短信状态接口
	 */
	Protected const statusURL		= 'report/status';
	/**
	 * 错误列表
	 */
	Protected const ERRORLIST = [
		'9001'=>'签名格式不正确=>',
		'9002'=>'参数未赋值=>',
		'9003'=>'手机号码格式不正确',
		'9006'=>'用户accessKey不正确',
		'9007'=>'IP白名单限制',
		'9009'=>'短信内容参数不正确',
		'9010'=>'用户短信余额不足',
		'9011'=>'用户帐户异常',
		'9012'=>'日期时间格式不正确',
		'9013'=>'不合法的语音验证码，4~8位的数字',
		'9014'=>'超出了最大手机号数量',
		'9015'=>'不支持的国家短信',
		'9016'=>'无效的签名或者签名ID',
		'9017'=>'无效的模板ID',
		'9018'=>'单个变量限制为1-20个字',
		'9019'=>'内容不可以为空',
		'9021'=>'主叫和被叫号码不能相同',
		'9022'=>'手机号码不能为空',
		'9023'=>'手机号码黑名单',
		'9024'=>'手机号码超频',
		'10001'=>'内容包含敏感词',
		'10002'=>'内容包含屏蔽词',
		'10003'=>'错误的定时时间',
		'10004'=>'自定义扩展只能是数字且长度不能超过4位',
		'10005'=>'模版类型不存在',
		'10006'=>'模版和内容不匹配'
	];
	/**
	 * [send 发送信息]
	 * @Author    como
	 * @DateTime  2019-08-27
	 * @copyright 思智捷管理系统
	 * @version   [1.5.0]
	 * @param     [type]     $accesskey [description]
	 * @param     [type]     $secret    [description]
	 * @return    [type]                [description]
	 */
	static function send($accesskey,$secret,$options = []){
		$data = array_merge(['accesskey'=>$accesskey,'secret'=>$secret],$options);
		try{
			return call_user_func([__CLASS__,$options['type']],$data);
		} catch(\Exception $err){
			return self::appResult($err->getMessage());
		}
	}
	/**
	 * [allSend 群发短信功能]
	 * @Author    como
	 * @DateTime  2019-08-27
	 * @copyright 思智捷管理系统
	 * @version   [1.5.0]
	 * @param     array      $data [description]
	 * @return    [type]           [description]
	 */
	Protected static function allSend($data = []){
		$result = self::request(self::HostURL.self::allSendURL,$data);
		if($result['err'] == true) return $result;
		return self::appResult($result['info'],['batchId'=>$result['data']['batchId']],false);
	}
	/**
	 * [single 发送短信验证码功能]
	 * @Author    como
	 * @DateTime  2019-08-27
	 * @copyright 思智捷管理系统
	 * @version   [1.5.0]
	 * @param     array      $data [description]
	 * @return    [type]           [description]
	 */
	Protected static function single($data = []){
		$result = self::request(self::HostURL.self::singleSendURL,$data);
		if($result['err'] == true) return $result;
		return self::appResult($result['info'],['smUuid'=>$result['data']['smUuid']],false);
	}
	/**
	 * [account 获取用户账号余额]
	 * @Author    como
	 * @DateTime  2019-08-27
	 * @copyright 思智捷管理系统
	 * @version   [1.5.0]
	 * @return    [type]     [description]
	 */
	Protected static function account($data = []){
		$result = self::request(self::HostURL.self::accountURL,$data);
		if($result['err'] == true) return $result;
		return self::appResult($result['info'],$result['data']['data'],false);
	}
	/**
	 * [getStatus 获取短信状态列表]
	 * @Author    como
	 * @DateTime  2019-08-27
	 * @copyright 思智捷管理系统
	 * @version   [1.5.0]
	 * @param     array      $data [description]
	 * @return    [type]           [description]
	 */
	Protected static function getStatus($data = []){
		$result = self::request(self::HostURL.self::statusURL,$data);
		if($result['err'] == true) return $result;
		return self::appResult($result['info'],$result['data']['data'],false);
	}
	/**
	 * [templatelist 获取模版列表]
	 * @Author    como
	 * @DateTime  2019-08-27
	 * @copyright 思智捷管理系统
	 * @version   [1.5.0]
	 * @param     array      $data [description]
	 * @return    [type]           [description]
	 */
	Protected static function templatelist($data = []){
		$result = self::request(self::HostURL.self::templateURL,$data);
		if($result['err'] == true) return $result;
		return self::appResult($result['info'],$result['data']['data'],false);
	}
	/**
	 * [getReply 获取用户回复消息]
	 * @Author    como
	 * @DateTime  2019-08-27
	 * @copyright 思智捷管理系统
	 * @version   [1.5.0]
	 * @param     array      $data [description]
	 * @return    [type]           [description]
	 */
	Protected static function getReply($data = []){
		$result = self::request(self::HostURL.self::reportURL,$data);
		if($result['err'] == true) return $result;
		return self::appResult($result['info'],$result['data']['data'],false);
	}
	/**
	 * [request 发送请求数据]
	 * @Author    como
	 * @DateTime  2019-08-27
	 * @copyright 思智捷管理系统
	 * @version   [1.5.0]
	 * @param     [type]     $url  [description]
	 * @param     [type]     $data [description]
	 * @return    [type]           [description]
	 */
	Protected static function request($url,$data){
		try{
			$res = self::curl_post($url,$data);
			$data = json_decode($res,true);
			if(empty($data['code'])){
				$tmp = isset($data['msg'])?$data['msg']:(isset($data['message'])?$data['message']:'SUCCESS');
				return self::appResult($tmp,$data,false);
			} else {
				$tmp = empty(self::ERRORLIST[$data['code']])?'未知错误,请联系管理员':self::ERRORLIST[$data['code']];
				return self::appResult($tmp);
			}
		} catch(\Exception $err){
			return self::appResult($err->getMessage());
		}
	}
	/**
	 * [appResult 统一返回值]
	 * @Author    como
	 * @DateTime  2019-08-27
	 * @copyright 思智捷管理系统
	 * @version   [1.5.0]
	 * @param     string     $info [description]
	 * @param     [type]     $data [description]
	 * @param     boolean    $err  [description]
	 * @return    [type]           [description]
	 */
	Protected static function appResult($info = '',$data = null,$err = true){
		return ['info'=>$info,'data'=>$data,'err'=>$err];
	}
	/**
	 * [curl_get 获取]
	 * @作者     como
	 * @时间     2018-07-23
	 * @版权     FASTNODEJS WEB  FRAMEWORK
	 * @版本     1.0.1
	 * @param  string     $url [description]
	 * @return [type]          [description]
	 */
	static function curl_get($url = '',$header = array()){
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $url);  
		curl_setopt($ch, CURLOPT_HEADER, 0);
		if(empty($header)){
			curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
		$data = curl_exec($ch);  
		if (curl_errno($ch)) {
	        return curl_error($ch);//捕抓异常
	    }
		curl_close($ch);
		return $data;
	}
	/**
	 * [curl_post 提交]
	 * @作者     como
	 * @时间     2018-07-23
	 * @版权     FASTNODEJS WEB       FRAMEWORK
	 * @版本     1.0.1
	 * @param  [type]     $url      [description]
	 * @param  array      $postdata [description]
	 * @return [type]               [description]
	 */
	static function curl_post($url,$postdata = array(),$header = array()){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		if(empty($header)){
			curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);    
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
		$data = curl_exec($ch);
		if (curl_errno($ch)) {
	        return curl_error($ch);//捕抓异常
	    }
		curl_close($ch);
		return $data;
	}
}