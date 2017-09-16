<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Korea Calendar
 * 
 * https://www.data.go.kr/subMain.jsp?param=T1BFTkFQSUAxNTAxMjY5MA==#/L3B1YnIvdXNlL3ByaS9Jcm9zT3BlbkFwaURldGFpbC9vcGVuQXBpTGlzdFBhZ2UkQF4wMTJtMSRAXnB1YmxpY0RhdGFQaz0xNTAxMjY5MCRAXmJybUNkPU9DMDAxMyRAXnJlcXVlc3RDb3VudD0xNDgkQF5vcmdJbmRleD1PUEVOQVBJ
 */
class Calendar_kr {
	private $url = 'http://apis.data.go.kr/B090041/openapi/service/SpcdeInfoService/';
	
	protected $service_key = 'your service key';
	
	public $data = array();
	
	public function __construct () {
		
	}
	
	public function __destruct () {
		
	}
	
	/**
	 * holiday
	 * 
	 * 공휴일 데이터 리턴
	 * 
	 * @param   int     $year     4 length
	 * @param   int     $month    2 length
	 */
	public function holiday ($year,$month) {
		$path = $content = $day = '';
		$data = $xml = $json = $list = array();
		
		$month = sprintf('%02d',$month);
		
		$path = $this->url.'getHoliDeInfo?serviceKey='.$this->service_key.'&solYear='.$year.'&solMonth='.$month;
		$content = file_get_contents($path);
		$xml = simplexml_load_string($content,null,LIBXML_NOCDATA);
		$json = json_encode($xml);
		$list = json_decode($json,TRUE);
		
		$data['status'] = ($list['header']['resultCode'] == '00')?TRUE:FALSE;
		$data['message'] = $list['header']['resultMsg'];
		
		if ($list['body']['totalCount'] == 1) {
			$day = mb_substr($list['body']['items']['item']['locdate'],6,2,'UTF-8');
			
			$this->data[$day][] = $data['data'][$day][] = array(
				'name'=>$list['body']['items']['item']['dateName'],
				'category'=>'holiday'
			);
		} else if ($list['body']['totalCount'] > 0) {
			foreach ($list['body']['items']['item'] as $row) {
				$day = mb_substr($row['locdate'],6,2,'UTF-8');
				
				$this->data[$day][] = $data['data'][$day][] = array(
					'name'=>$row['dateName'],
					'category'=>'holiday'
				);
			}
		}
		
		return $data;
	}
	
	/**
	 * divisions
	 * 
	 * 24 절기 데이터 리턴
	 * 
	 * @param   int     $year     4 length
	 * @param   int     $month    2 length
	 */
	public function divisions ($year,$month) {
		$path = $content = $day = '';
		$data = $xml = $json = $list = array();
		
		$month = sprintf('%02d',$month);
		
		$path = $this->url.'get24DivisionsInfo?serviceKey='.$this->service_key.'&solYear='.$year.'&solMonth='.$month;
		$content = file_get_contents($path);
		$xml = simplexml_load_string($content,null,LIBXML_NOCDATA);
		$json = json_encode($xml);
		$list = json_decode($json,TRUE);
		
		$data['status'] = ($list['header']['resultCode'] == '00')?TRUE:FALSE;
		$data['message'] = $list['header']['resultMsg'];
		
		if ($list['body']['totalCount'] == 1) {
			$day = mb_substr($list['body']['items']['item']['locdate'],6,2,'UTF-8');
			
			$this->data[$day][] = $data['data'][$day][] = array(
				'name'=>$list['body']['items']['item']['dateName'],
				'category'=>'divisions'
			);
		} else if ($list['body']['totalCount'] > 0) {
			foreach ($list['body']['items']['item'] as $row) {
				$day = mb_substr($row['locdate'],6,2,'UTF-8');
				
				$this->data[$day][] = $data['data'][$day][] = array(
					'name'=>$row['dateName'],
					'category'=>'divisions'
				);
			}
		}
		
		return $data;
	}
	
	/**
	 * sundry
	 * 
	 * 기타 데이터 리턴
	 * 
	 * @param   int     $year     4 length
	 * @param   int     $month    2 length
	 */
	public function sundry ($year,$month) {
		$path = $content = $day = '';
		$data = $xml = $json = $list = array();
		
		$month = sprintf('%02d',$month);
		
		$path = $this->url.'getSundryDayInfo?serviceKey='.$this->service_key.'&solYear='.$year.'&solMonth='.$month;
		$content = file_get_contents($path);
		$xml = simplexml_load_string($content,null,LIBXML_NOCDATA);
		$json = json_encode($xml);
		$list = json_decode($json,TRUE);
		
		$data['status'] = ($list['header']['resultCode'] == '00')?TRUE:FALSE;
		$data['message'] = $list['header']['resultMsg'];
		
		if ($list['body']['totalCount'] == 1) {
			$day = mb_substr($list['body']['items']['item']['locdate'],6,2,'UTF-8');
			
			$this->data[$day][] = $data['data'][$day][] = array(
				'name'=>$list['body']['items']['item']['dateName'],
				'category'=>'sundry'
			);
		} else if ($list['body']['totalCount'] > 0) {
			foreach ($list['body']['items']['item'] as $row) {
				$day = mb_substr($row['locdate'],6,2,'UTF-8');
				
				$this->data[$day][] = $data['data'][$day][] = array(
					'name'=>$row['dateName'],
					'category'=>'sundry'
				);
			}
		}
		
		return $data;
	}
	
	/**
	 * solar_event_day
	 * 
	 * 양력 이벤트 데이터 리턴
	 * 
	 * @param   int     $year     4 length
	 * @param   int     $month    2 length
	 */
	public function solar_event_day ($year,$month) {
		$week = $time = $day = 0;
		$data = array();
		
		$month = sprintf('%02d',$month);
		
		$data['status'] = TRUE;
		$data['message'] = 'ok';
		
		switch ($month) {
			case '01' :
				break;
			case '02' :
					$this->data['14'][] = $data['data']['14'][] = array(
						'name'=>'밸런타인데이',
						'category'=>'sundry'
					);
				break;
			case '03' :
					$time = strtotime($year.'-'.$month.'-01 00:00:00');
					$week = date('w',$time);
					$day = ($week > 3)?date('d',strtotime('+'.number_format(21 - ($week - 3)).' day',$time)):date('d',strtotime('+'.number_format(14 - ($week - 3)).' day',$time));
					$this->data[$day][] = $data['data'][$day][] = array(
						'name'=>'상공의 날',
						'category'=>'sundry'
					);
					
					$this->data['03'][] = $data['data']['03'][] = array(
						'name'=>'납세자의 날',
						'category'=>'sundry'
					);
					
					$this->data['14'][] = $data['data']['14'][] = array(
						'name'=>'화이트데이',
						'category'=>'sundry'
					);
					
					$this->data['15'][] = $data['data']['15'][] = array(
						'name'=>'3.15 의거 기념일',
						'category'=>'sundry'
					);
					
					$this->data['22'][] = $data['data']['22'][] = array(
						'name'=>'세계 물의 날',
						'category'=>'sundry'
					);
				break;
			case '04' :
					$this->data['03'][] = $data['data']['03'][] = array(
						'name'=>'제주4.3 사건',
						'category'=>'sundry'
					);
					
					$this->data['05'][] = $data['data']['05'][] = array(
						'name'=>'식목일',
						'category'=>'sundry'
					);
					
					$this->data['07'][] = $data['data']['07'][] = array(
						'name'=>'보건의 날',
						'category'=>'sundry'
					);
					
					$this->data['13'][] = $data['data']['13'][] = array(
						'name'=>'임시정부 수립일',
						'category'=>'sundry'
					);
					
					$this->data['19'][] = $data['data']['19'][] = array(
						'name'=>'4.19혁명',
						'category'=>'sundry'
					);
					
					$this->data['20'][] = $data['data']['20'][] = array(
						'name'=>'장애인의 날',
						'category'=>'sundry'
					);
					
					$this->data['21'][] = $data['data']['21'][] = array(
						'name'=>'과학의 날',
						'category'=>'sundry'
					);
					
					$this->data['22'][] = $data['data']['22'][] = array(
						'name'=>'정보통신의 날',
						'category'=>'sundry'
					);
					
					$this->data['22'][] = $data['data']['22'][] = array(
						'name'=>'지구의 날',
						'category'=>'sundry'
					);
					
					$this->data['25'][] = $data['data']['25'][] = array(
						'name'=>'법의 날',
						'category'=>'sundry'
					);
					
					$this->data['28'][] = $data['data']['28'][] = array(
						'name'=>'충무공 탄신일',
						'category'=>'sundry'
					);
				break;
			case '05' :
					$time = strtotime($year.'-'.$month.'-01 00:00:00');
					$week = date('w',$time);
					$day = ($week > 1)?date('d',strtotime('+'.number_format(21 - ($week - 1)).' day',$time)):date('d',strtotime('+'.number_format(14 - ($week - 1)).' day',$time));
					$this->data[$day][] = $data['data'][$day][] = array(
						'name'=>'성년의 날',
						'category'=>'sundry'
					);
					
					$this->data['01'][] = $data['data']['01'][] = array(
						'name'=>'근로자의날',
						'category'=>'sundry'
					);
					
					$this->data['08'][] = $data['data']['08'][] = array(
						'name'=>'어버이날',
						'category'=>'sundry'
					);
					
					$this->data['10'][] = $data['data']['10'][] = array(
						'name'=>'유권자의 날',
						'category'=>'sundry'
					);
					
					$this->data['15'][] = $data['data']['15'][] = array(
						'name'=>'스승의날',
						'category'=>'sundry'
					);
					
					$this->data['18'][] = $data['data']['18'][] = array(
						'name'=>'5.18 민주화운동 기념일',
						'category'=>'sundry'
					);
					
					$this->data['19'][] = $data['data']['19'][] = array(
						'name'=>'발명의 날',
						'category'=>'sundry'
					);
					
					$this->data['20'][] = $data['data']['20'][] = array(
						'name'=>'세계인의 날',
						'category'=>'sundry'
					);
					
					$this->data['21'][] = $data['data']['21'][] = array(
						'name'=>'부부의 날',
						'category'=>'sundry'
					);
					
					$this->data['25'][] = $data['data']['25'][] = array(
						'name'=>'방재의 날',
						'category'=>'sundry'
					);
					
					$this->data['31'][] = $data['data']['31'][] = array(
						'name'=>'바다의 날',
						'category'=>'sundry'
					);
				break;
			case '06' :
					$this->data['01'][] = $data['data']['01'][] = array(
						'name'=>'의병의 날',
						'category'=>'sundry'
					);
					
					$this->data['05'][] = $data['data']['05'][] = array(
						'name'=>'세계 환경의 날',
						'category'=>'sundry'
					);
					
					$this->data['10'][] = $data['data']['10'][] = array(
						'name'=>'6.10 민주항쟁기념일',
						'category'=>'sundry'
					);
					
					$this->data['25'][] = $data['data']['25'][] = array(
						'name'=>'6.25 한국 전쟁',
						'category'=>'sundry'
					);
				break;
			case '07' :
					$time = strtotime($year.'-'.$month.'-01 00:00:00');
					$week = date('w',$time);
					$day = ($week > 3)?date('d',strtotime('+'.number_format(14 - ($week - 3)).' day',$time)):date('d',strtotime('+'.number_format(7 - ($week - 3)).' day',$time));
					$this->data[$day][] = $data['data'][$day][] = array(
						'name'=>'정보보호의날',
						'category'=>'sundry'
					);
				break;
			case '08' :
				break;
			case '09' :
					$this->data['18'][] = $data['data']['18'][] = array(
						'name'=>'철도의 날',
						'category'=>'sundry'
					);
				break;
			case '10' :
					$time = strtotime($year.'-'.$month.'-01 00:00:00');
					$week = date('w',$time);
					$day = date('d',strtotime('+'.number_format(14 - ($week - 6)).' day',$time));
					$this->data[$day][] = $data['data'][$day][] = array(
						'name'=>'문화의 날',
						'category'=>'sundry'
					);
					
					$this->data['01'][] = $data['data']['01'][] = array(
						'name'=>'국군의 날',
						'category'=>'sundry'
					);
					
					$this->data['02'][] = $data['data']['02'][] = array(
						'name'=>'노인의 날',
						'category'=>'sundry'
					);
					
					$this->data['05'][] = $data['data']['05'][] = array(
						'name'=>'세계 한인의 날',
						'category'=>'sundry'
					);
					
					$this->data['08'][] = $data['data']['08'][] = array(
						'name'=>'재향 군인의 날',
						'category'=>'sundry'
					);
					
					$this->data['15'][] = $data['data']['15'][] = array(
						'name'=>'체육의 날',
						'category'=>'sundry'
					);
					
					$this->data['21'][] = $data['data']['21'][] = array(
						'name'=>'경찰의 날',
						'category'=>'sundry'
					);
					
					$this->data['24'][] = $data['data']['24'][] = array(
						'name'=>'국제연합일',
						'category'=>'sundry'
					);
					
					$this->data['25'][] = $data['data']['25'][] = array(
						'name'=>'독도의날',
						'category'=>'sundry'
					);
					
					$this->data['28'][] = $data['data']['28'][] = array(
						'name'=>'교정의 날',
						'category'=>'sundry'
					);
					
					$this->data['29'][] = $data['data']['29'][] = array(
						'name'=>'지방자치의날',
						'category'=>'sundry'
					);
				break;
			case '11' :
					$this->data['03'][] = $data['data']['03'][] = array(
						'name'=>'학생 독립운동 기념일',
						'category'=>'sundry'
					);
					
					$this->data['11'][] = $data['data']['11'][] = array(
						'name'=>'빼빼로데이',
						'category'=>'sundry'
					);
					
					$this->data['11'][] = $data['data']['11'][] = array(
						'name'=>'농업인의 날',
						'category'=>'sundry'
					);
					
					$this->data['11'][] = $data['data']['11'][] = array(
						'name'=>'지체장애인의 날',
						'category'=>'sundry'
					);
					
					$this->data['17'][] = $data['data']['17'][] = array(
						'name'=>'순국선열의 날',
						'category'=>'sundry'
					);
				break;
			case '12' :
					$this->data['03'][] = $data['data']['03'][] = array(
						'name'=>'소비자의 날',
						'category'=>'sundry'
					);
					
					$this->data['05'][] = $data['data']['05'][] = array(
						'name'=>'무역의 날',
						'category'=>'sundry'
					);
					
					$this->data['27'][] = $data['data']['27'][] = array(
						'name'=>'원자력의 날',
						'category'=>'sundry'
					);
				break;
		}

		// etc
		if ($year == '2017') {
			if ($month == '05') {
				$this->data['09'][] = $data['data']['09'][] = array(
					'name'=>'19대 대통령 선거',
					'category'=>'holiday'
				);
			} else if ($month == '10') {
				$this->data['02'][] = $data['data']['02'][] = array(
					'name'=>'임시공휴일',
					'category'=>'holiday'
				);
			}
		}
		
		return $data;
	}
	
	public function lunar_event_day () {
		// 1.15 정월대보름 (설날로부터 2주후)
	}
	
	/**
	 * get
	 * 
	 * @param   int     $year     4 length
	 * @param   int     $month    2 length
	 */
	public function get ($year,$month) {
		$data = array();
		
		$month = sprintf('%02d',$month);
		
		// get holiday
		$data['holiday'] = $this->holiday($year,$month);
		
		// get solar event day
		$data['solar_event_day'] = $this->solar_event_day($year,$month);
		
		// get 24 divisions
		$data['divisions'] = $this->divisions($year,$month);
		
		// get sundry
		$data['sundry'] = $this->sundry($year,$month);
		
		// sort
		ksort($this->data);
		
		return $this->data;
	}
}
