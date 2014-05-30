<?php
$curl = curl_init();
$jql_base ='http://task.sankuai.com/rest/api/2/search?maxResults=10&fields=key,summary&jql='; 
$jql = 'assignee%20%3D%20currentUser()%20AND%20resolution%20%3D%20Fixed%20AND%20resolutiondate%20>%20-7d%20ORDER%20BY%20resolutiondate%20DESC';
$jql2 = 'assignee%20%3D%20currentUser()%20AND%20status%20%3D%20Open';
$arr = array(
    CURLOPT_URL => $jql_base . $jql,
    CURLOPT_ENCODING => 'gzip,deflate',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_CONNECTTIMEOUT => 3,
    CURLOPT_TIMEOUT => 5,
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_USERPWD => $argv[1] .':' . $argv[2],
    CURLOPT_USERAGENT => 'MIS/1.0',
);

curl_setopt_array($curl, $arr);
$body = curl_exec($curl);
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//成功返回"204 No Content"

$body = json_decode($body, true);
echo "####本周回顾\n";
foreach($body['issues'] as $items) {
    echo "- **";//Tab
    echo $items['key'];
    echo "  ";
    echo $items['fields']['summary'];
    echo "**\n";
}
echo "####下周计划\n";
$arr[CURLOPT_URL] =  $jql_base . $jql2;
curl_setopt_array($curl, $arr);
$body = curl_exec($curl);
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$body = json_decode($body, true);
foreach($body['issues'] as $items) {
    echo "- **";//Tab
    echo $items['key'];
    echo "  ";
    echo $items['fields']['summary'];
    echo "**\n";
}
echo "####问题建议\n";
curl_close($curl);
