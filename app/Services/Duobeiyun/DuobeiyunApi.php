<?php

namespace App\Services\Duobeiyun;

/**
 *
 * @author sharpbai
 *        
 */
class DuobeiyunApi {
	
	/**
	 * 房间类型一对一
	 * @var string
	 */
	public static $ROOM_TYPE_1v1 = "1";
	/**
	 * 房间类型一对多
	 * @var string
	 */
	public static $ROOM_TYPE_1vN = "2";
	/**
	 * 房间视频开启
	 * @var string
	 */
	public static $ROOM_HAS_VIDEO = "1";
	/**
	 * 房间视频关闭
	 * @var string
	 */
	public static $ROOM_NO_VIDEO = "0";
	/**
	 * 房间身份:房间助教
	 * @var string
	 */
    public static $ROLE_ASSISTANT = "4";
    /**
     * 房间身份:隐身监视者
     * @var string
     */
    public static $ROLE_MONITOR = "3";
	/**
	 * 房间身份:听众
	 * @var string
	 */
	public static $ROLE_AUDIENCE = "2";
	/**
	 * 房间身份:主讲人
	 * @var string
	 */
	public static $ROLE_MASTER = "1";
	
	private $serverAddress;
	private $partnerId;
	private $appKey;

	function __construct() {
		if(!function_exists('curl_init')) {
			echo '[DuobeiyunAPI][Error][Please enable curl in php.ini]';
		}
		$this->serverAddress = config('duobeiyun.server');
		$this->partnerId = config('duobeiyun.id');
		$this->appKey = config('duobeiyun.key');
	}
	
	/**
	 * 创建房间
	 * @param string $title
	 * @param date $startTime
	 * @param int $duration
	 * @param string $video
	 * @param string $roomType
	 * @return string
	 */
	public function createRoom($title, $startTime, $duration, $video, $roomType) {
		$startTimeStr = date("Y-m-d H:i", $startTime);
		$params = array();
		$params["title"] = $title;
		$params["startTime"] = $startTimeStr;
		$params["duration"] = (string)$duration;
		$params["video"] = $video;
		$params["roomType"] = $roomType;
	
		$path = "/api/v3/room/create";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}

	/**
	 * 创建房间2
	 * @param string $title
	 * @param date $startTime
	 * @param int $duration
	 * @param string $video
	 * @param string $roomType
	 * @return string
	 */
	public function createRoom2($title, $startTime, $length, $video, $roomType) {
		$startTimeStr = date("Y-m-d H:i", $startTime);
		$params = array();
		$params["title"] = $title;
		$params["startTime"] = $startTimeStr;
		$params["length"] = (string)$length;
		$params["video"] = $video;
		$params["roomType"] = $roomType;

		$path = "/api/v4/room/create";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}
	
	/**
	 * 更新房间标题
	 * @param string $roomId
	 * @param string $newTitle
	 * @return string
	 */
	public function updateRoomTitle($roomId, $newTitle) {
		$params = array();
		$params["title"] = $newTitle;
		$params["roomId"] = $roomId;
		
		$path = "/api/v3/room/update/title";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}

	/**
	 * 更新房间Hls开启状态
	 * @param string $roomId
	 * @param string $isOpenHls
	 * @return string
	 */
	public function updateRoomHls($roomId, $isOpenHls) {
		$params = array();
		$params["hls"] = $isOpenHls;
		$params["roomId"] = $roomId;
		
		$path = "/api/v3/room/update/hls";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}
	
	/**
	 * 更新房间开始时间和时长
	 * @param string $roomId
	 * @param date $startTime
	 * @param int $duration
	 * @return string
	 */
	public function updateRoomSchedule($roomId, $startTime, $duration) {
		$startTimeStr = date("Y-m-d H:i", $startTime);
		$params = array();
		$params["roomId"] = $roomId;
		$params["startTime"] = $startTimeStr;
		$params["duration"] = (string)$duration;
	
		$path = "/api/v3/room/update/time";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}
	
	/**
	 * 上传文档
	 * @param string $filename
	 * @return string
	 */
	public function uploadDocument($filename) {
		$params = $this->prepareParameters(array());
		$params["slidesFile"] = "@" . $filename;
		
		$path = "/api/v3/documents/upload";
		$result = $this->post($path, $params);
		return $result;
	}
	
	/**
	 * 附加文档到房间
	 * @param string $roomId
	 * @param string $documentId
	 * @return string
	 */
	public function attatchDocument($roomId, $documentId) {
		$params = array();
		$params["roomId"] = $roomId;
		$params["documentId"] = $documentId;
	
		$path = "/api/v3/room/attachDocument";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}
	
	/**
	 * 获取文档转换状态
	 * @param string $documentId
	 * @return string
	 */
	public function getDocumentStatus($documentId) {
		$params = array();
		$params["documentId"] = $documentId;
	
		$path = "/api/v3/documents/status";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}
	
	public function generateRoomEnterUrl($uid, $nickname, $roomId, $userRole) {
		$params = array();
		$params["uid"] = $uid;
		$params["nickname"] = $nickname;
		$params["roomId"] = $roomId;
		$params["userRole"] = $userRole;
		$params = $this->prepareParameters($params);
		$queryStrings = array();
		foreach($params as $key => $value) {
			array_push($queryStrings, urlencode($key) . "=" . urlencode($value));
		}
		$url = str_replace("https://", "http://", $this->serverAddress) . "/api/v3/room/enter?";
		$result = $url . implode("&", $queryStrings);
		return $result;
	}

	public function generateRoomEnterHlsUrl($uid, $nickname, $roomId, $userRole) {
		$params = array();
		$params["uid"] = $uid;
		$params["nickname"] = $nickname;
		$params["roomId"] = $roomId;
		$params["userRole"] = $userRole;
		$params["hls"] = true;
		$params = $this->prepareParameters($params);
		$queryStrings = array();
		foreach($params as $key => $value) {
			array_push($queryStrings, urlencode($key) . "=" . urlencode($value));
		}
		$url = str_replace("https://", "http://", $this->serverAddress) . "/api/v3/room/enter?";
		$result = $url . implode("&", $queryStrings);
		return $result;
	}

	//获取房间文档列表
	public function getDocumentListByRoomId($roomId) {
		$params = array();
		$params["roomId"] = $roomId;
		$params = $this->prepareParameters($params);

		$path = "/api/v3/room/listDocuments";
		$result = $this->post($path, $params);
		return $result;
	}

	//从教室中删除指定文档
	public function deleteDocumentFromRoom($roomId, $documentId) {
		$params = array();
		$params["roomId"] = $roomId;
		$params["documentId"] = $documentId;

		$path = "/api/v3/room/removeDocument";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}

	//查看机构中的文档列表，按标题搜索文档
	public function listDocument($title, $pageNo) {
		$params = array();
		if(!empty($title) && $title != "") {
			$params["docName"] = $title;
		}
		if(!empty($pageNo) && $pageNo != ""){
			$params["pageNo"] = $pageNo;
		}

		$path = "/api/v3/document/list";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}

	//查看机构详情
	public function getMerchantDetail() {
		$params = array();

		$path = "/api/v3/merchant";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}

	//查看教室详情
	public function getRoomDetail($roomId) {
		$params = array();
		$params["roomId"] = $roomId;

		$path = "/api/v3/room/detail";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}

	//查看教室列表，按时间或标题搜索教室列表
	public function pageRoom($title, $startTime, $endTime, $pageNo) {
		$params = array();
		if(!empty($title) && $title != ""){
			$params["title"] = $title;
		}
		if(!empty($startTime) && $startTime != ""){
			$params["startTime"] = $startTime;
		}
		if(!empty($endTime) && $endTime != ""){
			$params["endTime"] = $endTime;
		}
		if(!empty($pageNo) && $pageNo != ""){
			$params["pageNo"] = $pageNo;
		}

		$path = "/api/v3/room/list";
		$result = $this->post($path, $this->prepareParameters($params));

		return $result;
	}

	//生成文档预览url
	public function generateDocPreviewUrl($uuid) {
		$params = array();
		$params["uuid"] = $uuid;
		$params = $this->prepareParameters($params);
		$queryStrings = array();
		foreach($params as $key => $value) {
			array_push($queryStrings, urlencode($key) . "=" . urlencode($value));
		}
		$url = str_replace("https://", "http://", $this->serverAddress) . "/api/v3/document/preview?";
		$result = $url . implode("&", $queryStrings);
		return $result;
	}

	public function deleteRoom($roomId){
		$params = array();
		$params["roomId"] = $roomId;

		$path = "/api/v3/room/delete";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}

	public function openWeixinLive($roomId, $teacherName, $teacherBrief, $description){
		$params = array();
		$params["roomId"] = $roomId;
		$params["teacherName"] = $teacherName;
		$params["teacherBrief"] = $teacherBrief;
		$params["description"] = $description;

		$path = "/api/v3/course/weixin/live/open";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}


	public function closeWeixinLive($roomId){
		$params = array();
		$params["roomId"] = $roomId;

		$path = "/api/v3/course/weixin/live/close";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}

	public function updateWeixinLive($roomId, $teacherName, $teacherBrief, $description){
		$params = array();
		$params["roomId"] = $roomId;

		if(!is_null($teacherName)){
			$params["teacherName"] = $teacherName;
		}
		if(!is_null($teacherBrief)){
			$params["teacherBrief"] = $teacherBrief;
		}
		if(!is_null($description)) {
			$params["description"] = $description;
		}

		$path = "/api/v3/course/weixin/live/update";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}

	public function deleteDocument($documentId){
		$params = array();
		$params["documentId"] = $documentId;

		$path = "/api/v3/document/delete";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}

	public function detailDocument($documentId){
		$params = array();
		$params["documentId"] = $documentId;

		$path = "/api/v3/document/detail";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}

	public function createVideoCourse($title, $videoKey){
		$params = array();
		$params["title"] = $title;
		$params["videoKey"] = $videoKey;

		$path = "/api/v3/room/video/create";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}

	public function createRoomByMinute($title, $startTime, $duration, $video, $roomType) {
		$startTimeStr = date("Y-m-d H:i", $startTime);
		$params = array();
		$params["title"] = $title;
		$params["startTime"] = $startTimeStr;
		$params["length"] = (string)$duration;
		$params["video"] = $video;
		$params["roomType"] = $roomType;

		$path = "/api/v4/room/create";
		$result = $this->post($path, $this->prepareParameters($params));
		return $result;
	}

	private function prepareParameters($params) {
		$params["partner"] = $this->partnerId;
		$params["timestamp"] = (string)time() . "000";
		$sign = $this->buildSign($params);
		$params["sign"] = $sign;
		echo $sign;
		echo "\n";
		return $params;
	}
	
	private function buildSign($params) {
		$validParams = array();
		foreach($params as $key => $value) {
			//if(!empty($value) && $value != "") {
			if($value != null) {
				array_push($validParams, $key . "=" . $value);
			}
		}
		sort($validParams);
		echo implode("&", $validParams) . $this->appKey;
		echo "\n";
		$sign = md5(implode("&", $validParams) . $this->appKey);
		return $sign;
	}
	
	private function post($path, $postFields) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->serverAddress . $path);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_ENCODING , "");
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		if(DIRECTORY_SEPARATOR=='\\') {
			curl_setopt ($ch, CURLOPT_CAINFO, dirname(__FILE__) . "\\cacert.pem");
		} else {
			curl_setopt ($ch, CURLOPT_CAINFO, dirname(__FILE__) . "/cacert.pem");
		}
		$result=curl_exec($ch);
		if($result === false) {
			echo '[DuobeiyunAPI][Error][curl error: ' . curl_error($ch) . ']';
		}
		curl_close($ch);
		return $result;
	}
}