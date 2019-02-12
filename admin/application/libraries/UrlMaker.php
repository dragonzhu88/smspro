<?php

    /**
     * @param $url
     * @param $strName
     * @param $strValue
     * @return string
     */
    function mkurl($url,$strName,$strValue){
        if(strpos($url,"?") === false){
            $url.="?";
        }else{
            $url.="&";
        }
        $tmp = $strName."=".$strValue;
        $url.=$tmp;
        return $url;
    }