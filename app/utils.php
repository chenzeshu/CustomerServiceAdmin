<?php

function toTime($time){
    return date('Y-m-d', strtotime($time));
}
//转换客户合同状态
function toStatus($status){
    switch ($status){
        case "0":
            return "故障处理";
            break;
        case "1":
            return "故障处理";
            break;
        case "2":
            return "故障处理";
            break;
        case "3":
            return "故障处理";
            break;
        case "4":
            return "故障处理";
            break;
        default:
            return null;
            break;
    }
}
//转换客服服务类型
function toType($type){
    switch ($type) {
        case "0":
            return "在保";
            break;
        case "1":
            return "过保";
            break;
        case "2":
            return "维保";
            break;
        default:
            return null;
            break;
    }
}