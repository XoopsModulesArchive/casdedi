<?php

if ('' != $_POST['title']) {
    include 'header.php';

    include 'cache/config.php';

    $myts = MyTextSanitizer::getInstance();

    if ($xoopsUser) {
        $uid = $xoopsUser->uid();
    } else {
        $uid = 0;
    }

    $title = $myts->addSlashes($_POST['title']);

    $email = $myts->addSlashes($_POST['email']);

    $url = $myts->addSlashes($_POST['url']);

    if ($xoopsUser) {
        $username = $xoopsUser->uname();
    } else {
        $username = $myts->addSlashes($_POST['username']);
    }

    $message = $myts->addSlashes($_POST['message']);

    $datetime = time();

    $poster_ip = $GLOBALS['REMOTE_ADDR'];

    $sqlinsert = 'INSERT INTO '
                 . $xoopsDB->prefix('casdedi')
                 . ' (user_id,uname,title,message,post_time,email,url,poster_ip,moderate) VALUES ('
                 . $uid
                 . ",'"
                 . $username
                 . "','"
                 . $title
                 . "','"
                 . $message
                 . "','"
                 . $datetime
                 . "','"
                 . $email
                 . "','"
                 . $url
                 . "','"
                 . $poster_ip
                 . "','"
                 . $moderate
                 . "')";

    if (!$result = $xoopsDB->queryF($sqlinsert)) {
        $messagesent = _GBK_ERRORINSERT;
    }

    // Send mail to webmaster

    if (1 == $sendmail2webmaster) {
        $subject = $xoopsConfig['sitename'] . ' - ' . _GBK_NAMEMODULE;

        $xoopsMailer = getMailer();

        $xoopsMailer->useMail();

        $xoopsMailer->setToEmails($xoopsConfig['adminmail']);

        $xoopsMailer->setFromEmail($xoopsConfig['adminmail']);

        $xoopsMailer->setFromName($xoopsConfig['sitename']);

        $xoopsMailer->setSubject($subject);

        $xoopsMailer->setBody(_GBK_NEWMESSAGE . ' ' . XOOPS_URL . '/modules/casdedi/');

        $xoopsMailer->send();
    }

    if ($moderate) {
        $messagesent .= '<br>' . _GBK_AFTERMODERATE;
    }

    redirect_header('index.php', 2, $messagesent);
}
