<?php

// ------------------------------------------------------------------------- //
//                XOOPS - PHP Content Management System                      //
//                       <https://www.xoops.org>                             //
// ------------------------------------------------------------------------- //
// Based on:								     //
// myPHPNUKE Web Portal System - http://myphpnuke.com/	  		     //
// PHP-NUKE Web Portal System - http://phpnuke.org/	  		     //
// Thatware - http://thatware.org/					     //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------- //
include 'header.php';
include 'include/functions.php';

$GLOBALS['xoopsOption']['template_main'] = 'casdedi_sign.html';

if ('casdedi' == $xoopsConfig['startpage']) {
    $xoopsOption['show_rblock'] = 1;

    require XOOPS_ROOT_PATH . '/header.php';

    make_cblock();

    echo '<br>';
} else {
    $xoopsOption['show_rblock'] = 0;

    require XOOPS_ROOT_PATH . '/header.php';
}

//include config file
include 'cache/config.php';
$myts = MyTextSanitizer::getInstance();

//assign variable of xoopsuser to form
if (isset($_POST['message'])) {
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES | ENT_HTML5);
} else {
    $message = '';
}
if (isset($_POST['title'])) {
    $title_v = htmlspecialchars($_POST['title'], ENT_QUOTES | ENT_HTML5);
} else {
    $title_v = '&nbsp;';
}
if (isset($_POST['email'])) {
    $email_v = htmlspecialchars($_POST['email'], ENT_QUOTES | ENT_HTML5);
} else {
    $email_v = !empty($xoopsUser) ? $xoopsUser->getVar('email', 'E') : '';
}
if (isset($_POST['username'])) {
    $name_v = htmlspecialchars($_POST['username'], ENT_QUOTES | ENT_HTML5);
} else {
    $name_v = !empty($xoopsUser) ? $xoopsUser->getVar('uname', 'E') : '';
}
if (isset($_POST['url'])) {
    $url_v = htmlspecialchars($_POST['url'], ENT_QUOTES | ENT_HTML5);
} else {
    $url_v = !empty($xoopsUser) ? $xoopsUser->getVar('url', 'E') : '';
}

//show preview mode
if (isset($_GET['preview'])) {
    $xoopsTpl->assign('gb_show_preview', true);

    //sanitize text before show

    $a_msg = [];

    if ($poster = get_user_data($xoopsUser)) {
        $a_msg = &$poster;

        $a_msg['is_user'] = true;
    } else {
        $a_msg = [];

        $a_msg['is_user'] = false;

        $a_msg['poster'] = $name_v;

        if ($url_v) {
            $a_msg['url'] = "<a href='" . $url_v . "' target='_blank'><img src='" . XOOPS_URL . "/images/icons/www.gif' alt='" . _VISITWEBSITE . "'></a>";
        }

        if ($email_v) {
            $a_msg['email'] = "<a href='mailto:" . $email_v . "'><img src='" . XOOPS_URL . "/images/icons/email.gif' alt='" . sprintf(_SENDEMAILTO, $name_v) . "'></a>";
        }
    }

    $a_msg['i'] = 'x';

    $a_msg['title'] = $myts->displayTarea($title_v);

    $a_msg['msg'] = $myts->displayTarea($message, $allowhtml, $allowsmileys, $allowbbcode);

    $a_msg['date'] = formatTimestamp(mktime(), 'm');

    $xoopsTpl->assign('post', $a_msg);
}

if ($xoopsUser) {
    $disabled = "disabled='disabled'";
} else {
    $disabled = '';
}

$xoopsTpl->assign('gb_sign', _GBK_SIGNGUESTBOOK);
$xoopsTpl->assign('gb_back', "<a href='index.php'>" . _GBK_BACKGUESTBOOK . '</a>');
$xoopsTpl->assign('gb_desc', _GBK_DESC);

$xoopsTpl->assign('tbl_name', _GBK_NAME);
$xoopsTpl->assign('tbl_email', _GBK_EMAIL);
$xoopsTpl->assign('tbl_url', _GBK_URL);
$xoopsTpl->assign('tbl_title', _GBK_TITLE);
$xoopsTpl->assign('tbl_message', _GBK_MESSAGE);

$xoopsTpl->assign('frm_name', "<input name='username' type='text'$disabled value='$name_v'>");
$xoopsTpl->assign('frm_email', "<input name='email' type='text'$disabled value='$email_v'>");
$xoopsTpl->assign('frm_url', "<input name='url' type='text'$disabled value='$url_v'>");
$xoopsTpl->assign('frm_title', "<input name='title' id='title' type='text' value='$title_v'>");

$textarea = '';
require_once XOOPS_ROOT_PATH . '/modules/casdedi/include/xoopscodes.php';
if (1 == $GLOBALS['allowbbcode']) {
    $textarea .= xoopsCodeTareaRet('message');
} else {
    $textarea .= "<textarea id='message' name='message' wrap='virtual' cols='50' rows='10'></textarea><br>";
}
if (1 == $GLOBALS['allowsmileys']) {
    $textarea .= xoopsSmiliesRet('message');
}
$xoopsTpl->assign('frm_message', $textarea);

$xoopsTpl->assign('frm_preview', "<input name='previewbutton' id='previewbutton' type='submit' onclick='document.forms.guestbook.action=\"sign.php?preview=1\";' value='" . _GBK_PREVIEW . "'>");
$xoopsTpl->assign('frm_submit', "<input name='submitbutton' id='submitbutton' type='submit' value='" . _GBK_SEND . "'>");

require XOOPS_ROOT_PATH . '/footer.php';
