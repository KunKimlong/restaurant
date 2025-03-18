<?php

/**
 * convert timestamp to date only without showing time
 * @Param $timestamp, time stamp to convert
 * @Return date when converted success
 */
if (! function_exists('formatToDate')) {
    function formatToDate($timestamp)
    {
        return date('d-m-Y',strtotime(convertTimeStampToString($timestamp)));
    }
}

/**
 * show edit icon
 * @Return icon edit
 */
if (! function_exists('iconEdit')) {
    function iconEdit()
    {
        return '<i class="bi bi-pencil-square"></i>';
    }
}

/**
 * show remove icon
 * @Return icon remove
 */
if (! function_exists('iconRemove')) {
    function iconRemove()
    {
        return '<i class="bi bi-trash"></i>';
    }
}

if (! function_exists('convertToRoman')) {
    function convertToRoman($num)
    {
        $map = [
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1
        ];
        $num = intval($num);
        $roman = '';
        foreach ($map as $symbol => $value) {
            while ($num >= $value) {
                $roman .= $symbol;
                $num -= $value;
            }
        }
        return $roman;
    }
}

if(! function_exists('fullName')){
    function fullName($first_name, $last_name, $gender){
        $prefix = $gender=="Male"?"Mr.": "Ms.";
        return $prefix.$first_name." ".$last_name;
    }
}

if(! function_exists('convertTimeStampToString')){
    function convertTimeStampToString($timestamp){
        return $timestamp ? $timestamp->toDateTimeString() : '';
    }
}
