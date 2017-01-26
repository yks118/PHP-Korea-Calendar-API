# PHP-Korea-Calendar-API
[공공데이터포털](https://www.data.go.kr)의 특일 정보제공 서비스 api를 사용하는 PHP 라이브러리입니다.

## 사용법
1. [공공데이터포털](https://www.data.go.kr)에 회원가입을 합니다.
2. [특일정보 페이지](https://www.data.go.kr/subMain.jsp?param=T1BFTkFQSUAxNTAxMjY5MA==#/L3B1YnIvdXNlL3ByaS9Jcm9zT3BlbkFwaURldGFpbC9vcGVuQXBpTGlzdFBhZ2UkQF4wMTJtMSRAXnB1YmxpY0RhdGFQaz0xNTAxMjY5MCRAXmJybUNkPU9DMDAxMyRAXnJlcXVlc3RDb3VudD0xNTEkQF5vcmdJbmRleD1PUEVOQVBJ)에서 api 사용신청을 하여, 서비스 키를 받습니다.
3. 파일에서 your service key라고 써있는곳에, 여러분들이 받은 키를 입력합니다.
4. require_once 'your/path/Calendar_kr.php';
5. $calendar = new Calendar_kr();
6. $data = $calendar->get(2017,01);
7. print_r($data);

## 주의사항
일단 파일을 보시면 아시겠지만, solar_event_day 함수가 존재합니다.<br />
특일정보 api에서 제공하지는 않지만, 추가하고 싶은 기념일이 있다면 이쪽에 추가해주세요.<br />
현재는 [네이버달력](https://search.naver.com/search.naver?sm=tab_hty.top&where=nexearch&oquery=2017%EB%85%84+%EB%8B%AC%EB%A0%A5&ie=utf8&query=%EB%8B%AC%EB%A0%A5)을 보고서 추가를 해둔 상태입니다.<br />
음력의 경우는 정월대보름이 빠져있습니다.<br />
필요하신분은 설날에서 2주를 추가해주세요.

## 사용중인곳
[api.manana.kr](http://api.manana.kr/calendar.json)<br />

1. 현재 달의 데이터를 얻는 경우.<br />
http://api.manana.kr/calendar.json
2. 2017년 01월의 데이터를 얻는 경우.<br />
http://api.manana.kr/calendar/2017/01.json
3. 2017년 01월 01일의 데이터를 얻는 경우.<br />
http://api.manana.kr/calendar/2017/01/01.json
4. 2017년 01월 국경일의 데이터만 얻는 경우.<br />
http://api.manana.kr/calendar/2017/01/00/holiday.json
5. json이 아닌, xml방식의 데이터를 원하는 경우.<br />
http://api.manana.kr/calendar.xml

순서대로 http://api.manana.kr/calendar/{4자리 년도}/{2자리 월}/{2자리 일}/{all / holiday / divisions / sundry}.{json / xml} 입니다.
