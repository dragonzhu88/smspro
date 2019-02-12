<?php
/**
 * Created by PhpStorm.
 * User: fanxing
 * Date: 2017/3/14
 * Time: 9:30
 */
require "configs.php";
require "Connections.php";
require "Conponents.php";
require "Actions.php";
//!!!设置时区 Setting the time zone
date_default_timezone_set("Asia/Shanghai");
//短信发送 |Send short message-------------------------
$conn = new Connection(Config::USERNAME,Config::PASSWORD,Config::BASE_URL);
$text= "#param#";
$param = array(
    array(
        "number" => "10086",
        "text_param" => array("ye"),
        "user_id" => 1,
    )
);
$port = array(6);
var_dump($conn->send_sms_data($text,$param,$port));
//TEST RESULT
//array(2) { [0]=> int(200) [1]=> array(3) { ["error_code"]=> int(202) ["sms_in_queue"]=> int(2) ["task_id"]=> int(1) } }

//查询短信发送结果 |Select result-------------------------
$number = array(
    "10086"
);
$port = array(6);
$tm = time();
$time_after=date('Y-m-d H:i:s',strtotime('-1 hour'));
$time_before=date('Y-m-d H:i:s', $tm);
$user_id=array(1);
var_dump($conn->query_sms_result_data($number, $port, $time_after, $time_before, $user_id));
//TEST RESULT
//array(2) { [0]=> int(200) [1]=> array(2) { ["error_code"]=> int(200) ["result"]=> array(0) { } } }

//查询短信送达状态 |SMS service state-------------------------
$number = array(
    "10086"
);
$port = array(6);
$time_after=date('Y-m-d H:i:s',strtotime('-1 hour'));
$time_before=date('Y-m-d H:i:s', $tm);
var_dump($conn->query_sms_deliver_status($number, $port, $time_after, $time_before));
//TEST RESULT
//array(2) { [0]=> int(200) [1]=> array(2) { ["error_code"]=> int(200) ["result"]=> array(0) { } } }

//待发送短信数量 |Number of messages to be sent-------------------------
var_dump($conn->query_sms_in_queue());
//TEST RESULT
//array(2) { [0]=> int(200) [1]=> array(2) { ["error_code"]=> int(200) ["in_queue"]=> int(2) } }

//短信接收 |Receive MSG-------------------------
$port = array(6);
var_dump($conn->query_incoming_sms($port));
//TEST RESULT
//array(2) { [0]=> int(200) [1]=> array(4) { ["error_code"]=> int(200) ["sms"]=> array(0) { } ["read"]=> int(0) ["unread"]=> int(0) } }

//发送 USSD |Send USSD-------------------------
$text = "*125#";
$port = array(6);
var_dump($conn->send_ussd($text,$port));
//TEST RESULT
//array(2) { [0]=> int(200) [1]=> array(2) { ["error_code"]=> int(202) ["result:"]=> array(1) { [0]=> array(2) { ["port"]=> int(2) ["status"]=> int(503) } } } }

//接收 USSD |Receive USSD-------------------------
$port = array(6);
var_dump($conn->query_ussd_reply($port));
//TEST RESULT
//array(2) { [0]=> int(200) [1]=> array(2) { ["error_code"]=> int(200) ["reply"]=> array(1) { [0]=> array(2) { ["port"]=> int(1) ["text"]=> string(0) "" } } } }

//中止短信发送任务 |Abort SMS-------------------------
var_dump($conn->stop_sms(1));
//TEST RESULT
//array(2) { [0]=> int(200) [1]=> array(1) { ["error_code"]=> int(200) } }

// 端口信息获取 |Obtain PORT NEWS-------------------------
$com = new Conponent();
$com->addStr(Conponent::GPRS)->addStr(Conponent::CALLSTATE);
var_dump($conn->get_port_info($com->getValue()));
//TEST RESULT
//array(2) { [0]=> int(200) [1]=> array(2) { ["error_code"]=> int(200) ["info"]=> array(8) { [0]=> array(3) { ["port"]=> int(0) ["callstate"]=> string(4) "Idle" ["gprs"]=> string(8) "detached" } [1]=> array(3) { ["port"]=> int(1) ["callstate"]=> string(4) "Idle" ["gprs"]=> string(8) "detached" } [2]=> array(3) { ["port"]=> int(2) ["callstate"]=> string(4) "Idle" ["gprs"]=> string(8) "detached" } [3]=> array(3) { ["port"]=> int(3) ["callstate"]=> string(4) "Idle" ["gprs"]=> string(8) "detached" } [4]=> array(3) { ["port"]=> int(4) ["callstate"]=> string(4) "Idle" ["gprs"]=> string(8) "detached" } [5]=> array(3) { ["port"]=> int(5) ["callstate"]=> string(4) "Idle" ["gprs"]=> string(8) "detached" } [6]=> array(3) { ["port"]=> int(6) ["callstate"]=> string(4) "Idle" ["gprs"]=> string(8) "attached" } [7]=> array(3) { ["port"]=> int(7) ["callstate"]=> string(4) "Idle" ["gprs"]=> string(8) "detached" } } } }

//端口设置 |PROT OPTION-------------------------
var_dump($conn->set_port_info(Action::POWER,"on",6));
//TEST RESULT
//array(2) { [0]=> int(200) [1]=> array(1) { ["error_code"]=> int(200) } }

//获取 CDR |Obtain CDR-------------------------
$time_after=date('Y-m-d H:i:s',strtotime('-1 hour'));
$time_before=date('Y-m-d H:i:s', $tm);
var_dump($conn->get_cdr(array(1,2),$time_after,$time_before));
//TEST RESULT
//array(2) { [0]=> int(200) [1]=> array(2) { ["error_code"]=> int(200) ["cdr"]=> array(0) { } } }

//获取  STK 视图 |Obtain K STK view-------------------------
var_dump($conn->GetSTKView(7));
//TEST RESULT
//array(2) { [0]=> int(200) [1]=> array(4) { ["title"]=> string(13) "USIM卡应用" ["item"]=> array(7) { [0]=> array(2) { ["item_id"]=> int(1) ["item_string"]=> string(12) "我的品牌" } [1]=> array(2) { ["item_id"]=> int(2) ["item_string"]=> string(12) "服务助理" } [2]=> array(2) { ["item_id"]=> int(3) ["item_string"]=> string(12) "无线城市" } [3]=> array(2) { ["item_id"]=> int(4) ["item_string"]=> string(12) "移动精品" } [4]=> array(2) { ["item_id"]=> int(5) ["item_string"]=> string(12) "业务超市" } [5]=> array(2) { ["item_id"]=> int(76) ["item_string"]=> string(12) "应用管理" } [6]=> array(2) { ["item_id"]=> int(77) ["item_string"]=> string(12) "下载设置" } } ["input_type"]=> int(2) ["frame_id"]=> int(9) } }

//STK 操作 |STK OPTION-------------------------
var_dump($conn->STKGo(7));
//TEST RESULT
//array(2) { [0]=> int(200) [1]=> array(1) { ["error_code"]=> int(200) } }

//获取 K STK 的 Frame ID |Obtain K STK 的 Frame ID-------------------------
var_dump($conn->GetSTKCurrFrameIndex(7));
//TEST RESULT
//array(2) { [0]=> int(200) [1]=> array(1) { ["frame_id"]=> int(9) } }
