<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('getHeaderInfo')) {
    function getHeaderInfo($title, $css) {
        return array(
            'params' => array(
                    array(
                        'title' => $title,
                        'headerCss' => "assets/css/header.css",
                        'css' => "assets/css/" . $css . ".css"
                        )
                )
        );
    }
}