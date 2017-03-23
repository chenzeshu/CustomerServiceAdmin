<?php

function toTime($time){
    return date('Y-m-d', strtotime($time));
}
//转换质保状态
function toStatus($time2){
    switch ($time2 >= time()){
        case true:
            return "在保";
            break;
        case false:
            return "过保";
            break;
        default:
            return null;
            break;
    }
}
//转换合同服务类型
function toType($type){
    switch ($type){
        case "0":
            return "故障处理";
            break;
        case "1":
            return "巡检";
            break;
        case "2":
            return "应急保障";
            break;
        case "3":
            return "远程协助";
            break;
        case "4":
            return "其他";
            break;
        default:
            return null;
            break;
    }
}

/**
 * @destination 判断角色是否含有权限
 * @param $perm 权限
 * @param $role 角色
 * @return true or false
 */
function permCheck($perm, $role){
    return $role->hasPermission($perm->name)? true:false;
}