<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/29
 * Time: 1:18
 */



//require_once  '../libraries/configs.php';
//require_once  '../libraries/Connections.php';
//require_once  '../libraries/Conponents.php';
//require_once  '../libraries/Actions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header('Access-Control-Allow-Headers:x-requested-with,content-type');
class Commands extends CI_Controller
{

	public $conn;
	public $USERNAME ="admin";
	public $PASSWORD = "admin";
	public $BASE_URL = "http://172.16.55.251/";

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Actions');
		$this->load->library('CommandInfoss');
		$this->load->library('Conponents');
		$this->load->library('Connections');
		$this->load->library('Configs');
		$this->conn = new Connections($this->USERNAME,$this->PASSWORD,$this->BASE_URL);

	}

	public function smsSend()
	{
		$body = @file_get_contents('php://input');
		$body = json_decode($body);
		if(isset ($body->text) && isset ($body->phone)){
			$text = $body->text;
			$param = array(
				array(
					"number" => $body->phone,
					"user_id" => 1,
				)
			);
			$port = array(6);
			echo json_encode($this->conn->send_sms_data($text,$param,$port));
		}
	}

	public function index()
	{
		echo json_encode(array(
			"number" => "10086",
			"text_param" => array("ye"),
			"user_id" => 1,
		));
//		echo 'Hello World!';
	}

	public function smsSelectSend()
	{
		$number = array(
			"10086"
		);
		$port = array(6);
		$tm = time();
		$time_after=date('Y-m-d H:i:s',strtotime('-1 hour'));
		$time_before=date('Y-m-d H:i:s', $tm);
		$user_id=array(1);
		echo json_encode($this->conn->query_sms_result_data($number, $port, $time_after, $time_before, $user_id));
	}

	public function SMSServiceState()
	{
		$tm = time();
		$number = array(
			"10086"
		);
		$port = array(6);
		$time_after=date('Y-m-d H:i:s',strtotime('-1 hour'));
		$time_before=date('Y-m-d H:i:s', $tm);
		echo json_encode($this->conn->query_sms_deliver_status($number, $port, $time_after, $time_before));
	}

	public function NumberOfMessagesToBeSent()
	{
		echo json_encode($this->conn->query_sms_in_queue());
	}
	public function receiveMSG()
	{
		$port = array(6);
//		echo 123333;
		echo json_encode($this->conn->query_incoming_sms($port));
	}

	public function sendUSSD()
	{

		$body = @file_get_contents('php://input');
		$body = json_decode($body);
		if(isset ($body->text)){
			$text = $body->text;
			$port = array(6);
			echo json_encode($this->conn->send_ussd($text,$port));
		}
	}

	public function receiveUSSD()
	{
		$port = array(6);
		var_dump($this->conn->query_ussd_reply($port));
		echo json_encode($this->conn->query_ussd_reply($port));
	}

	public function abortSMS()
	{
		echo json_encode($this->conn->stop_sms(1));
	}

	public function obtainPortNews()
	{
		$com = new Conponents();
		$com->addStr(Conponents::GPRS)->addStr(Conponents::CALLSTATE);
		echo json_encode($this->conn->get_port_info($com->getValue()));
	}

	public function portOption()
	{
		echo json_encode($this->conn->set_port_info(Actions::POWER,"on",6));
	}

	public function obtainCDR()
	{
		$tm = time();
		$time_after=date('Y-m-d H:i:s',strtotime('-1 hour'));
		$time_before=date('Y-m-d H:i:s', $tm);
		echo json_encode($this->conn->get_cdr(array(1,2),$time_after,$time_before));
	}

	public function obtainKSTKView()
	{
		echo json_encode($this->conn->GetSTKView(7));
	}

	public function STKGo()
	{
		echo json_encode($this->conn->STKGo(7));
	}

	public function getSTKCurrFrameIndex()
	{
		echo json_encode($this->conn->GetSTKCurrFrameIndex(7));
	}

}
