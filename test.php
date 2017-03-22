<?php
$date = date('Ymd');
$number = "20170314";
$_number = substr($number, 0, 8);
if ( $_number == $date){
    echo 1;
};