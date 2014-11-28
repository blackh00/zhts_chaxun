<?php
/**
 * 省份广告
 * 
 * @copyright (C)2013 ZHTS Inc.
 * @project KEFU
 * @author Linmaogan <linmaogan@163.com>
 * @CreateDate: 2013-2-5 上午10:40:14
 * @version 1.0
 *
 * @ModificationHistory  
 * Who          When                What 
 * --------     ----------          ------------------------------------------------ 
 * Linmaogan   2013-2-5 上午10:40:14      todo
 */
class ProvinceAdvAction extends CommonAction
{
	// 指定省份ID数组
	private $provinceIds = array();
	private $provinceInfo = array();
	
	public function __construct(){
		$this->provinceInfo = C('APPOINT_AD_PROVINCE');
		$provinceIds = array();
		foreach ($this->provinceInfo as $value){
			$provinceIds[] = $value['id'];
		}
		$this->provinceIds = $provinceIds;//var_dump($_SESSION);
		parent::__construct();
	}
	
	public function index()
	{
		$where = '';
		$parameter = array();
		$name = trim($_REQUEST['name']);
		$position_id = intval($_REQUEST['position_id']);
		
		if(!empty($name))
		{
			$where .= " AND a.name LIKE '%".mysqlLikeQuote($name)."%'";
			$this->assign("name",$name);
			$parameter['name'] = $name;
		}

		if($position_id > 0)
		{
			$this->assign("position_id",$position_id);
			$parameter['position_id'] = $position_id;
			$where .= " AND a.position_id = '$position_id'";
		}

		$model = M();
		
		if(!empty($where))
			$where = 'WHERE 1' . $where;
		
		$sql = 'SELECT COUNT(DISTINCT a.id) AS acount 
			FROM '.C("DB_PREFIX").'province_adv AS a '.$where;

		$count = $model->query($sql);
		$count = $count[0]['acount'];

		$sql = 'SELECT a.*,ap.name AS position_name  
			FROM '.C("DB_PREFIX").'province_adv AS a 
			LEFT JOIN '.C("DB_PREFIX").'province_adv_position AS ap ON ap.id = a.position_id '.$where;
		$this->_sqlList($model,$sql,$count,$parameter,'a.id');
		
		$ap_list = M("ProvinceAdvPosition")->where('status = 1')->select();
		$this->assign("ap_list",$ap_list);
		
		$this->display ();
	}
	
	public function add()
	{		
		$ap_list = M("ProvinceAdvPosition")->where('status = 1')->select();
		$this->assign("ap_list",$ap_list);		
		
		// 设置省份列表
		$region = $this->getRegion('', $this->provinceIds);//var_dump($region);
		$this->assign("regionList", $region);
		parent::add();
	}
	
	public function insert()
	{
		$urls = $_POST['code'];
		
		// 删除URl可能多余的空格
		foreach ($urls as &$value) {
			$value = trim($value);
		}		
		
		$_POST['code'] = serialize($urls);		
		$_POST['status'] = getAdVerifyStatus(); // 默认广告未通过审核
		
		$model = D("ProvinceAdv");
		if(false === $data = $model->create())
		{
			$this->error($model->getError());
		}
		
		//保存当前数据对象
		$id = $model->add($data);
		if ($id !== false)
		{			
			$this->saveLog(1,$id);
			$this->success (L('ADD_SUCCESS'));
		}
		else
		{
			$this->saveLog(0);
			$this->error (L('ADD_ERROR'));
		}
	}
	
	public function edit()
	{
		$ap_list = M("ProvinceAdvPosition")->where('status = 1')->select();
		$this->assign("ap_list",$ap_list);		
		
		$name = $this->getActionName();
		$model = D($name);
		
		$id = $_REQUEST [$model->getPk ()];
		$vo = $model->getById($id);
		
		// 如果是编辑后待审状态
		if ($vo['status'] == 3) {
			$adCode = $vo['desc'];
		} else {
			$adCode = $vo['code'];
		}
		$this->assign ( 'vo', $vo );
		
		// 设置省份列表
		$region = $this->getRegion(unserialize($adCode));
		$this->assign("regionList", $region);
		$this->display ();
	}
	
	public function update()
	{
		$id = intval($_REQUEST['id']);
		
		$urls = $_POST['code'];
		
		// 删除URl可能多余的空格
		foreach ($urls as &$value) {
			$value = trim($value);
		}
		
		// 管理员默认通过审核
		if ($status = getAdVerifyStatus()) {
			$_POST['code'] = serialize($urls); // 直接更新广告内容
		} else {
			$_POST['desc'] = serialize($urls); // 存放到待审核字段中
			$status = 3; // 编辑未通过审核状态
		}
		
		$_POST['status'] = $status; // 默认广告未通过审核
		
		$old_img = D("ProvinceAdv")->where('id = '.$id.' AND type IN (1,2)')->getField('code');
				
		$model = D("ProvinceAdv");
		if(false === $data = $model->create())
		{
			$this->error($model->getError());
		}
		
		//保存当前数据对象
		$list=$model->save($data);
		if (false !== $list)
		{			
			$this->saveLog(1,$id);
			$this->assign('jumpUrl', Cookie::get ( '_currentUrl_' ) );
			$this->success (L('EDIT_SUCCESS'));
		}
		else
		{
			//错误提示
			$this->saveLog(0,$id);
			$this->error (L('EDIT_ERROR'));
		}
	}

	public function remove()
	{
		//删除指定记录
		$result = array('isErr'=>0,'content'=>'');
		$id = $_REQUEST['id'];
		if(!empty($id))
		{
			$name=$this->getActionName();
			$model = D($name);
			$pk = $model->getPk ();
			$condition = array ($pk => array ('in', explode ( ',', $id ) ) );
			$advs = $model->where($condition)->select();
			if(false !== $model->where ( $condition )->delete ())
			{
				foreach($advs as $adv)
				{
					if(!empty($adv['code']) && ($adv['type'] == 1 || $adv['type'] == 2))
						@unlink(FANWE_ROOT.$adv['code']);
				}
				$this->saveLog(1,$id);
			}
			else
			{
				$this->saveLog(0,$id);
				$result['isErr'] = 1;
				$result['content'] = L('REMOVE_ERROR');
			}
		}
		else
		{
			$result['isErr'] = 1;
			$result['content'] = L('ACCESS_DENIED');
		}
		
		die(json_encode($result));
	}
	
	/**
	 * 获取调用代码
	 *
	 * @author Linmaogan <linmaogan@163.com>
	 * @CreateDate: 2013-3-15 下午2:30:46
	 */
	public function getCode()
	{
		$name = $this->getActionName();
		$model = D($name);
	
		$id = $_REQUEST [$model->getPk ()];
		$vo = $model->getById($id);
		$this->assign ( 'vo', $vo );
		$this->display ();
	}
	
	public function toggleStatus()
	{
		$id = intval($_REQUEST['id']);
		if($id == 0)
			exit;
		
		$val = intval($_REQUEST['val']);
			
		$field = trim($_REQUEST['field']);
		if(empty($field))
			exit;
		
		// 如果是编辑未审核，则通过审核，将新编辑的内容替换掉旧的内容
		$name=$this->getActionName();
		$model = D($name);
		$pk = $model->getPk();
		$vo = $model->getById($id);
		if ($vo['status'] == 3) {
			$model->where($pk.' = '.$id)->setField('code',array('exp','`desc`'));//echo $model->getLastSql();die('d3d');
			$_REQUEST['val'] = 0; // 恢复status为标准值
		}		
		parent::toggleStatus();		
	}
	
	/**
	 * 获取地区列表
	 *
	 * @author Linmaogan <linmaogan@163.com>
	 * @CreateDate: 2013-2-5 下午6:19:22
	 * @param array $urls 广告地址数组
	 * @param array $provinceIds 指定省份ID数组
	 * @return array:
	 */
	public function getRegion($urls = array(), $provinceIds = array()){
		// 获取省份列表
		$regionList = D("Region")->where('parent_id = 0')->field('id,parent_id,name')->select();
						
		// 合并默认广告地址		
		$regionList = array_merge($this->provinceInfo, $regionList);
		$regionList = array_unique_fb($regionList); // 过滤掉重复的数组		
		
		// 重组数组下标，用id值做下标
		foreach ($regionList as $value) {
			$regionList2[$value['id']] = $value;
		}		
		unset($regionList);
		tdSort($regionList2, 'id'); // 对省份进行排序
		
		// 因为排序后数组下标发生了重置，所以再次重组数组下标，用id值做下标
		foreach ($regionList2 as $value) {
			$newRegionList[$value['id']] = $value;
		}
		unset($regionList2);
		
		// 添加广告时，获取默认显示的省份
		if ($provinceIds && is_array($provinceIds)) {
			foreach ($newRegionList as &$val) {	
				if (in_array($val['id'], $provinceIds)) {
					$regionDefaultList[] = $val; // 默认显示的省份
					$val['isSelect'] = '1'; // 增加默认显示标记
				}
			};
		}
		
		// 修改广告时，获取默认显示的省份
		if ($urls && is_array($urls)) {
			foreach ($urls as $key => $value) {									
				$newRegionList[$key]['url'] = $value; // 数据追加广告地址
				$newRegionList[$key]['isSelect'] = 1; // 增加默认显示标记
				$expandRegionList[] = $newRegionList[$key];
			};
			$regionDefaultList = $expandRegionList;//var_dump($urls,$expandRegionList);
		}
		return array('default' => $regionDefaultList, 'all' => $newRegionList);
	}		
}

//二维数组去掉重复值  并保留键值
function array_unique_fb($array2D){
	foreach ($array2D as $k=>$v){
		$v = join(",",$v);  //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
		$temp[$k] = $v;
	}
	$temp = array_unique($temp);    //去掉重复的字符串,也就是重复的一维数组
	foreach ($temp as $k => $v){
		$array=explode(",",$v);		//再将拆开的数组重新组装
		$temp2[$k]["id"] =$array[0];
		$temp2[$k]["parent_id"] =$array[1];
		$temp2[$k]["name"] =$array[2];
	}
	return $temp2;
}
?>