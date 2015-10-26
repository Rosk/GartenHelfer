<?php
/**
 * Created by PhpStorm.
 * User: rosk
 * Date: 22.07.15
 * Time: 20:14
 */
if (!empty($del)) {
    $msg = 'Gelöscht: ID ' . $del . ' aus Sprüche';
}
if (!empty($del2)) {
    $msg2 = 'Hurra! Termin ' . $del2 . ' ist erledigt.';
}
if (!empty($del3)) {
    $msg3 = 'Pflanze ' . $del3 . ' wurde gerupft...';
}
if (!empty($del4)) {
    $msg4 = 'Wartung ' . $del4 . ' ist repariert.';
}
if (!empty($del5)) {
    $msg5 = 'Tonne ' . $del5 . ' wurde geleert.';
}
if (!empty($add)) {
    $msg_add = 'Hinzugefügt: ' . $add . ' in Sprüche';
}
if (!empty($add2)) {
    $msg_add2 = 'Hinzugefügt: ' . $add2 . ' in Termine';
}
if (!empty($add3)) {
    $msg_add3 = 'Hinzugefügt: ' . $add3 . ' in Pflanzen';
}
if (!empty($add4)) {
    $msg_add4 = 'Hinzugefügt: ' . $add4 . ' in Wartungen';
}
if (!empty($add5)) {
    $msg_add5 = 'Hinzugefügt: ' . $add5 . ' in Tonnen - ' . $add5_2;
}