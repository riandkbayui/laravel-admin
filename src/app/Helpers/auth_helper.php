<?php

if (! function_exists('userId')) {
    function userId() {
        return service('authentication')->session("userId") ?: "0";
    }
}

if (! function_exists('user')) {
    function user($key="") {
        return service('authentication')->user($key);
    }
}

if (! function_exists('prevUserId')) {
    function prevUserId() {
        return service('authentication')->session("prevUserId") ?: "0";
    }
}

if (! function_exists('prevUser')) {
    function prevUser($key="") {
        return service('authentication')->prevUser($key);
    }
}

if (! function_exists('inGroup')) {
    function inGroup($group)
    {
        return service('authentication')->inGroup($group);
    }
}

if (! function_exists('office')) {
    function office($key="")
    {
        return service('configs')->officedata($key);
    }
}