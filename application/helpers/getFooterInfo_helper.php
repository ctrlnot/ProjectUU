<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('getFooterInfo')) {
    function getFooterInfo($js) {
        return array(
            'params' => array(
                    array(
                        'js' => "assets/js/" . $js . ".js"
                        )
                )
        );
    }
}