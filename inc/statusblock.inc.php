<?php
/**
 * Created by PhpStorm.
 * User: rosk
 * Date: 14.09.15
 * Time: 12:03
 */



function printStatusblock($start,$label){

    $l = $label;
    $now = time(); // or your date as well
    $start = strtotime($start);
    $datediff = $now - $start;
    $day = floor($datediff/(60*60*24));


    $block = '<div class="stausWrap">';
    $block .= '<div class="statusDay">';
    $block .= $day;
    $block .= '<div class="statusDay statusTitle">'.$l.'</div>';
    $block .= '</div>';
    $block .= '</div>';
    print $block;
}