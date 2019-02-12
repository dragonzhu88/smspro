<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "FlagClass.php";
require_once "UrlMaker.php";
require_once "CommandInfoss.php";

/**
 * Created by PhpStorm.
 * User: fanxing
 * Date: 2017/3/15
 * Time: 9:29
 */
class Connections
{
    public $username;
    public $password;
    public $base_url;
    /**
     * Connection constructor.
     * $username,$password,$base_url
     * or
     * array()
     */
    function __construct(){
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this,$f),$a);
        }
    }
    function __construct1($array){
        $this->username=$array['username'];
        $this->password=$array['password'];
        $this->base_url=$array['base_url'];
    }
    function __construct3($username,$password,$base_url){
        $this->username=$username;
        $this->password=$password;
        $this->base_url=$base_url;
    }
    private function post_data($option, $data){
        $curl = curl_init($this->base_url.$option);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
        curl_setopt($curl, CURLOPT_USERPWD,$this->username.':'.$this->password);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        // print_r(error_get_last());
        $output = curl_exec($curl);
//    print_r(error_get_last());
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $json_response = json_decode($output,true);
        return array($status, $json_response);
    }
    private function get_data($option){
//        echo $this->base_url.$option;
//        echo "<br>";
        $curl = curl_init($this->base_url.$option);
        //设置选项，包括URL
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERPWD,$this->username.':'.$this->password);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //释放curl句柄
        curl_close($curl);
        $json_response = json_decode($output,true);
        return array($status, $json_response);
    }

    /**
     * @param array $param
     * @param array $port
     * @param str $encoding
     * @return array
     */
    function send_sms_data($text,$param, $port = NULL, $encoding = NULL){
        $data = array(
            "text" =>$text,
            "param" => $param
        );
        if ($port != NULL) {
            $data["port"] = $port;
        }
        if ($encoding != NULL) {
            $data["encoding"] = $encoding;
        }
        return $this->post_data('api/send_sms',$data);
    }

    /**
     * @param str[] $number
     * @param int[] $port
     * @param str like yyyy-mm-dd hh:mm:ss $time_after
     * @param str like yyyy-mm-dd hh:mm:ss $time_before
     * @param int[] $user_id
     * @return array error_code [int] ; result object[]
     */
    function query_sms_result_data($number, $port, $time_after, $time_before, $user_id){
        $data = array();
        if ($number != NULL) {
            $data["number"] = $number;
        }
        if ($port != NULL) {
            $data["port"] = $port;
        }
        if ($time_after != NULL) {
            $data["time_after"] = $time_after;
        }
        if ($time_before != NULL) {
            $data["time_before"] = $time_before;
        }
        if ($user_id != NULL) {
            $data["user_id"] = $user_id;
        }
        return $this->post_data('api/query_sms_result',$data);
    }

    /**
     * @param str[] $number
     * @param int[] $port
     * @param str like yyyy-mm-dd hh:mm:ss $time_after
     * @param str like yyyy-mm-dd hh:mm:ss $time_before
     * @return array error_code [int] ; result object[]
     */
    function query_sms_deliver_status($number, $port, $time_after, $time_before){
        $data = array();
        if ($number != NULL) {
            $data["number"] = $number;
        }
        if ($port != NULL) {
            $data["port"] = $port;
        }
        if ($time_after != NULL) {
            $data["time_after"] = $time_after;
        }
        if ($time_before != NULL) {
            $data["time_before"] = $time_before;
        }
        return $this->post_data('api/query_sms_deliver_status',$data);
    }

    /**
     * none
     * @return array error_code [int] ; in_queue[int]
     */
    function query_sms_in_queue(){
        return $this->get_data('api/query_sms_in_queue');
    }
    /**
     * @param $incoming_sms_id int
     * @param $flag string
     * @param $port int[]
     * @return array error_code[int] sms array[]
     */
    function query_incoming_sms($port,$flag=FlagClass::UNREAD,$incoming_sms_id=0){
        $url = "";
        if ($incoming_sms_id != NULL) {
            $url = mkurl($url,"incoming_sms_id",$incoming_sms_id);
        }
        if ($flag != NULL) {
            $url = mkurl($url,"flag",$flag);
        }
        if ($port != NULL) {
            $url = mkurl($url,"port",implode(",",$port));
        }
        return $this->get_data('api/query_incoming_sms'.$url);
    }
    /**
     *@param $text string
     *@param $port int[]
     *@param $command send or cancel default:send
     *@return array error_code[int] result int[]
     */
    function send_ussd($text,$port,$command=CommandInfoss::SEND){
        if ($text != NULL) {
            $data["text"] = $text;
        }
        if ($port != NULL) {
            $data["port"] = $port;
        }
        if ($command != NULL) {
            $data["command"] = $command;
        }
        return $this->post_data('api/send_ussd',$data);
    }
    /**
     *@param $port int[]
     *@return array error_code[int] reply int[]
     */
    function query_ussd_reply($port){
        $url = "";
        if ($port != NULL) {
            $url = mkurl($url,"port", implode(",",$port));
        }
        return $this->get_data('api/query_ussd_reply'.$url);
    }
    /**
     *@param $task_id int
     *@return array error_code[int] 200: 任务已删除|486: 未找到该任务|500: 其他错误
     */
    function stop_sms($task_id){
        $url = "";
        if ($task_id != NULL) {
            $url = mkurl($url,"task_id",$task_id);
        }
        return $this->get_data('api/stop_sms'.$url);
    }
    /**
     *@param $info_type String[]
     *@param $port int[] 默认为所有端口
     *@return array error_code[int] 200：正常查询到结果;400：非法请求;500：其他错误|info array
     */
    function get_port_info($info_type,$port=NULL){
        $url = "";
        if ($info_type != NULL) {
            $url = mkurl($url,"info_type",$info_type);
        }
        if ($port != NULL) {
            $url = mkurl($url,"port", implode(",",$port));
        }
        return $this->get_data('api/get_port_info'.$url);
    }
    /**
     *@param $action String
     *@param $param String
     *@param $port int 端口号，范围为 0 至 31
     *@return array error_code[int] 200：正常查询到结果;400：非法请求;500：其他错误
     */
    function set_port_info($action,$param,$port=NULL){
        $url="";
        if ($action != NULL) {
            $url = mkurl($url,"action",$action);
        }
        if ($param != NULL) {
            $url = mkurl($url,"param",$param);
        }
        if ($port != NULL) {
            $url = mkurl($url,"port",$port);
        }
        return $this->get_data('api/set_port_info'.$url);
    }

    /**
     * @param null $port  int[] 需要查询的端口，默认为所有端口
     * @param null $time_after string YYYY-MM-DD HH:MM:SS
     * @param null $time_before string YYYY-MM-DD HH:MM:SS
     * @return array error_code 200：正常查询到结果;400：非法请求;500：其他错误|cdr array
     */
    function get_cdr($port=NULL,$time_after=NULL,$time_before=NULL){
        if ($time_after != NULL) {
            $data["time_after"] = $time_after;
        }
        if ($time_before != NULL) {
            $data["time_before"] = $time_before;
        }
        if ($port != NULL) {
            $data["port"] = $port;
        }
        return $this->post_data('api/get_cdr',$data);
    }

    /**
     * @param $port int
     * @return array
     */
    function GetSTKView($port){
        $url = "";
        if ($port != NULL) {
            $url = mkurl($url,"port",$port);
        }

        return $this->get_data('GetSTKView'.$url);
    }

    /**
     * @param $port int
     * @param null $item int
     * @param null $param string
     * @param null $action string “ok”、“cancel”或 “home”
     * @return array
     */
    function STKGo($port,$item=NULL,$param=NULL,$action=NULL){
        if ($port != NULL) {
            $data["port"] = $port;
        }
        if ($item != NULL) {
            $data["item"] = $item;
        }
        if ($param != NULL) {
            $data["param"] = $param;
        }
        if ($action != NULL) {
            $data["action"] = $action;
        }
        return $this->post_data('STKGo',$data);
    }
    /**
     * @param $port int
     * @return int
     */
    function GetSTKCurrFrameIndex($port){
        $url = "";
        if ($port != NULL) {
            $url = mkurl($url,"port",$port);
        }
        return $this->get_data('GetSTKCurrFrameIndex'.$url);
    }
}
