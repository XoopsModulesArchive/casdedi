<?php

function get_user_data($uid)
{
    if (!(int)$uid) {
        return false;
    }

    $poster = new XoopsUser($uid);

    if ($poster->isActive()) {
        $a_poster['poster'] = "<a href='../../userinfo.php?uid=$uid'>" . $poster->uname() . '</a>';

        $a_poster['active'] = $poster->isActive();

        $a_poster['online'] = $poster->isOnline();

        $a_poster['regdate'] = $poster->user_regdate();

        $a_poster['from'] = $poster->user_from();

        $a_poster['posts'] = $poster->posts();

        $rank = $poster->rank();

        if ($rank['title']) {
            $a_poster['rank'] = $rank['title'];
        }

        if ($rank['image']) {
            $a_poster['rank_img'] = "<img src='" . XOOPS_URL . '/uploads/' . $rank['image'] . "' alt=''>";
        }

        if ($poster->user_avatar()) {
            $a_poster['avatar'] = "<img src='" . XOOPS_URL . '/uploads/' . $poster->user_avatar() . "' alt=''>";
        }

        if ($poster->url()) {
            $a_poster['url'] = "<a href='" . $poster->url() . "' target='_blank'><img src='" . XOOPS_URL . "/images/icons/www.gif' alt='" . _VISITWEBSITE . "'></a>";
        }

        if ($poster->user_viewemail() && $poster->email()) {
            $a_poster['email'] = "<a href='mailto:" . $poster->email() . "'><img src='" . XOOPS_URL . "/images/icons/email.gif' alt='" . sprintf(_SENDEMAILTO, $poster->uname()) . "'></a>";
        }

        return $a_poster;
    }

    return false;
}
