<?php
/**
*功能：世界时间所对应的控制器
*作者：yumao
*联系方式:QQ:916564404
*创建日期:2013/9/15
*/
class WorldTimeAction extends Action{
	
	/*
	 * 所有action默认调用的方法
	 */
	function _initialize(){
	
		// 获取当前客户端ip
		//$ip = get_client_ip();	
		//$this->assign("ip",$ip);
		$this->assign("flag","shenghuo");
		
		$this->assign("headInfo", setHead()); // 设置页面头部信息
	}
	
	/*
	首页或者查询后结果页所对应的方法
	*/
	public function index(){
        header("Content-Type:text/html;charset=utf-8");
        // 用来标志是否在模版页面头部要包含另外的css
		$this->assign("headerFlag",1); // 1表示包含
		// 用来标志是否在模版页面尾部要包含另外的js
		$this->assign("footerFlag",1); // 1表示包含

        // 查询当前数据库中的表中查询主要城市的相关时区信息
        $timeZone = M('worldTime');

        // 查询数据库获取信息按时区从小到大排序
        $cityZoneInfo = $timeZone->order('time_zone asc')->select();

        // 按时区组装成二维数组
        $cityInfoByZone = array();
        
        foreach ($cityZoneInfo as $key=>$val) {

            // 数据组装成新的数组
            $cityInfoByZone[$val['time_zone']][] = $val;
        }
         
        // 如果时间的数据不存在则补空值
        for ($i = -11; $i <=12; $i++) {
            if(!$cityInfoByZone[$i]){
                //echo "wwwwwwwwwwwww$i";
                //dump($cityInfoByZone[$i]);
                $cityInfoByZone[$i] = "";
                //dump($cityInfoByZone[$i]);
            }
        }
         $cityInfoByZone[-12] =  $cityInfoByZone[12];
        unset($cityInfoByZone[12]);
        ksort($cityInfoByZone);
        // 把数组中最后一个元素取出来放到第一个元素
      
       // dump($cityInfoByZone[-2]['error_info']);
       
        //dump($cityInfoByZone[8][0]);
        // 数据按下标值排序
        //dump($cityInfoByZone);
        // 数据分配到前端模版
        $this->assign('cityInfoByZone',$cityInfoByZone);

        
        //echo "aaaaaaaaaaaaaa";
        // 展示模版
        $this->display();
    }
}
