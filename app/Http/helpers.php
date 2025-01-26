<?php

    /**
     * convert timestamp to date only without showing time
     * @Param $timestamp, time stamp to convert
     * @Return date when converted success
     */
    if(! function_exists('formatToDate')){
        function formatToDate($timestamp){
            return \Illuminate\Support\Carbon::parse($timestamp)->format('d-m-Y');
        }
    }

    /**
     * show edit icon
     * @Return icon edit
     */
    if(! function_exists('iconEdit')){
        function iconEdit(){
            return '<i class="bi bi-pencil-square"></i>';
        }
    }

    /**
     * show remove icon
     * @Return icon remove
     */
    if(! function_exists('iconRemove')){
        function iconRemove(){
            return '<i class="bi bi-trash"></i>';
        }
    }



