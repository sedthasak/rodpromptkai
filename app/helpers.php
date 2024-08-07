<?php

if (!function_exists('decode_url')) {
    function decode_url($url) {
        return urldecode($url);
    }
}
