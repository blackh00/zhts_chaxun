<?php
/**
 * 根据省份自动跳转到指定广告
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project CHAXUNLE.COM
 * @author Linmaogan <linmaogan@163.com>
 * @CreateDate: 2013-2-28 下午6:10:25
 * @version 1.0
 */
class ClickAction extends Action
{	
	public function index()
	{
		$ip = $this->getIp();
		$provinceId = $this->ipBelongProvince($ip);
		
		$adId = $_GET['id']; // 广告ID
		$this->adRedirect($adId, $provinceId); // 执行广告跳转
		
		$this->display ();
	}

	/**
	 * 从cookie获取IP地址
	 *
	 * @author Linmaogan <linmaogan@163.com>
	 * @CreateDate: 2013-2-28 下午6:24:56
	 * @return string $ip 
	 */
	public function getIp() {
		$ip = cookie('clientIp');		
		if (!$ip) {
			$ip = get_client_ip();
			cookie('clientIp', $ip, 3600 * 24);
		}
		return $ip;
	}
	
	/**
	 * 判断当前IP所属省份的ID
	 *
	 * @author Linmaogan <linmaogan@163.com>
	 * @CreateDate: 2013-3-1 上午9:52:33
	 * @param string $ip
	 * @return int $provinceId 省份对应的ID
	 */
	public function ipBelongProvince($ip){
		$provinceId = cookie('provinceId');
		
		// 如果从cookie获取成功，则直接返回
		if ($provinceId) {
			return $provinceId;				
		}
		$regionList = $this->getRegion();		
		
		import('ORG.Net.IpLocation'); // 导入IpLocation类
		$Ip = new IpLocation(); // 实例化类
		$ip = '125.122.139.124';
		$location = $Ip->getlocation($ip); // 获取某个IP地址所在的位置'218.79.93.194'
		$province = iconv('gbk', 'utf-8', $location['country']);
		foreach ($regionList as $value) {
			if (strpos($province, $value['name']) === false) {
				continue;				
			} else {
				$provinceId[] = $value['id']; // 存储符合的省份和该省份下的城市id	
				break; // 如果注释掉break，可以同时获取到城市和该城市所在的省份id
			}	
		}
		$provinceId = $provinceId ? $provinceId[0] : 0; // 因为省份列表默认排序是城市在前，所以城市id优先，如果搜索不到则设置id为默认省份
		cookie('provinceId', $provinceId, 3600 * 24);
		return $provinceId;		
	}
	
	/**
	 * 根据省份跳转到对应的广告
	 *
	 * @author Linmaogan <linmaogan@163.com>
	 * @CreateDate: 2013-3-1 上午11:52:28
	 * @param int $adId 广告ID
	 * @param int $provinceId 省份ID
	 */
	public function adRedirect($adId, $provinceId) {
		$adId = $adId ? intval($adId) : 0;
		$cache = Cache::getInstance('File',array('expire'=>'300')); // 实例化缓存类
		
		// 获取广告信息
		$redirectUrl = $cache->get('redirectUrl_' . $adId);  // 获取缓存的广告数据
		if (!$redirectUrl) {
			/* $advPosition = D("ProvinceAdvPosition")->where('id = ' . $adId . ' AND (status != 0)')->field('id')->select();
			if (!$advPosition) {var_dump($advPosition);
				exit('广告位为空或未通过审核');
			} */
			
			$ad = D("ProvinceAdv")->where('id = ' . $adId . ' AND status != 0')->field('code')->select();
			if (!$ad) {
				exit('传入参数有误或广告位内容为空或广告未通过审核');
			}
			
			$adArray = unserialize($ad[0]['code']); // 将数据库中的广告字符串转换为数组
			
			// 如果指定省份广告地址为空，则用默认地址代替
			$redirectUrl = $adArray[$provinceId] ? $adArray[$provinceId] : $adArray[0];
			
			$cache->set('redirectUrl_' . $adId, $redirectUrl);  // 缓存广告数据
		}
		//var_dump($adId, $provinceId, $redirectUrl);
		header('Location: ' . $redirectUrl);		
	}
	
	/**
	 * 获取地区列表
	 *
	 * @author Linmaogan <linmaogan@163.com>
	 * @CreateDate: 2013-2-5 下午6:19:22
	 * @return array:
	 */
	public function getRegion(){
		// 获取省份列表
		$regionList = D("Region")->where('parent_id = 0')->field('id,parent_id,name')->select();
	
		// 合并默认广告地址		
		$provinceInfo = C('APPOINT_AD_PROVINCE');
		$regionList = array_merge($provinceInfo, $regionList);
		$regionList = array_unique_fb($regionList); // 过滤掉重复的数组		
	
		return $regionList;
	}
}

// 二维数组去掉重复值  并保留键值
function array_unique_fb($array2D){
    foreach ($array2D as $k=>$v){
        $v = join(",",$v);  // 降维,也可以用implode,将一维数组转换为用逗号连接的字符串
		$temp[$k] = $v;
    }
	$temp = array_unique($temp);    // 去掉重复的字符串,也就是重复的一维数组
    foreach ($temp as $k => $v){
        $array=explode(",",$v);		// 再将拆开的数组重新组装
		$temp2[$k]["id"] =$array[0];   
		$temp2[$k]["parent_id"] =$array[1];
		$temp2[$k]["name"] =$array[2];	
	}
    return $temp2;
}
?>