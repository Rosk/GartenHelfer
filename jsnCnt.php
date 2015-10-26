<?php
/**
 * Created by Rosk.
 * User: Rosk
 * Date: 28.02.15
 * Time: 16:54
 */

header("content-type:application/json");

function giveJson()
{
    $pg1 = array(
        array
        (
            'username' => 'facingdown',
            'profile_pic' => 'img/default-avatar.png'
        ),
        array
        (
            'username' => 'doggy_bag',
            'profile_pic' => 'img/default-avatar.png'
        ),
        array
        (
            'username' => 'goingoutside',
            'profile_pic' => 'img/default-avatar.png'
        ),
        array
        (
            'username' => 'redditdigg',
            'profile_pic' => 'img/default-avatar.png'
        ),
        array
        (
            'username' => 'lots_of_pudding',
            'profile_pic' => 'img/default-avatar.png'
        ),
        'nextpage' => '#pg2'
    );

    $jsonc = json_encode($pg1);
    return $jsonc;
}



