<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: fanxing
 * Date: 2017/3/16
 * Time: 13:02
 */
class Conponents
{
    const TYPE ="Type";
    const IMEI ="imei";
    const IMSI ="imsi";
    const ICCID ="iccid";
    const NUMBER ="number";
    const REG ="reg";
    const SLOT ="slot";
    const CALLSTATE ="callstate";
    const SIGNAL ="signal";
    const GPRS ="gprs";
    public $value;
    public function __construct()
    {
        $this->value = "";
    }
    public function addStr($str){
        $this->value .= $str;
        return $this;
    }
    public function getValue(){
        return $this->value;
    }
}
