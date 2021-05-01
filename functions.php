<?php

/**
 * 
 * replace headers content-type
 */

function brom_replace_wp_headers($headers) {
    $headers['content-type'] = 'application/json; charset=UTF-8';
    return $headers;
}
  
add_filter('wp_headers', 'brom_replace_wp_headers');