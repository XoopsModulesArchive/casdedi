<?php

// $Id: xoopscodes.php,v 1.1 2003/01/17 09:02:55 w4z004 Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://www.xoops.org>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: https://www.xoops.org/ http://jp.xoops.org/  http://www.myweb.ne.jp/  //
// Project: The XOOPS Project (https://www.xoops.org/)                        //
// ------------------------------------------------------------------------- //

/*
*  displayes xoopsCode buttons and target textarea to which xoopscodes are inserted
*  $textarea_id is a unique id of the target textarea
*/
function xoopsCodeTarea($textarea_id, $cols = 60, $rows = 15, $suffix = null)
{
    $hiddentext = isset($suffix) ? 'xoopsHiddenText' . trim($suffix) : 'xoopsHiddenText';

    echo "<a href='javascript:xoopsCodeUrl(\"$textarea_id\");'><img src='"
         . XOOPS_URL
         . "/images/url.gif' alt='url'></a>&nbsp;<a href='javascript:xoopsCodeEmail(\"$textarea_id\");'><img src='"
         . XOOPS_URL
         . "/images/email.gif' alt='email'></a>&nbsp;<a href='javascript:xoopsCodeImg(\"$textarea_id\");'><img src='"
         . XOOPS_URL
         . "/images/imgsrc.gif' alt='imgsrc'></a>&nbsp;<a href='javascript:openWithSelfMain(\""
         . XOOPS_URL
         . '/imagemanager.php?target='
         . $textarea_id
         . "\",\"imgmanager\",400,430);'><img src='"
         . XOOPS_URL
         . "/images/image.gif' alt='image'></a>&nbsp;<a href='javascript:xoopsCodeCode(\"$textarea_id\");'><img src='"
         . XOOPS_URL
         . "/images/code.gif' alt='code'></a>&nbsp;<a href='javascript:xoopsCodeQuote(\"$textarea_id\");'><img src='"
         . XOOPS_URL
         . "/images/quote.gif' alt='quote'></a><br>\n";

    $sizearray = ['xx-small', 'x-small', 'small', 'medium', 'large', 'x-large', 'xx-large'];

    echo "<select id='" . $textarea_id . "Size' onchange='setVisible(\"xoopsHiddenText\");setElementSize(\"" . $hiddentext . "\",this.options[this.selectedIndex].value);'>\n";

    echo "<option value='SIZE'>" . _SIZE . "</option>\n";

    foreach ($sizearray as $size) {
        echo "<option value='$size'>$size</option>\n";
    }

    echo "</select>\n";

    $fontarray = ['Arial', 'Courier', 'Georgia', 'Helvetica', 'Impact', 'Verdana'];

    echo "<select id='" . $textarea_id . "Font' onchange='setVisible(\"xoopsHiddenText\");setElementFont(\"" . $hiddentext . "\",this.options[this.selectedIndex].value);'>\n";

    echo "<option value='FONT'>" . _FONT . "</option>\n";

    foreach ($fontarray as $font) {
        echo "<option value='$font'>$font</option>\n";
    }

    echo "</select>\n";

    $colorarray = ['00', '33', '66', '99', 'CC', 'FF'];

    echo "<select id='" . $textarea_id . "Color' onchange='setVisible(\"xoopsHiddenText\");setElementColor(\"" . $hiddentext . "\",this.options[this.selectedIndex].value);'>\n";

    echo "<option value='COLOR'>" . _COLOR . "</option>\n";

    foreach ($colorarray as $color1) {
        foreach ($colorarray as $color2) {
            foreach ($colorarray as $color3) {
                echo "<option value='" . $color1 . $color2 . $color3 . "' style='background-color:#" . $color1 . $color2 . $color3 . ';color:#' . $color1 . $color2 . $color3 . ";'>#" . $color1 . $color2 . $color3 . "</option>\n";
            }
        }
    }

    echo "</select><span id='" . $hiddentext . "'>" . _EXAMPLE . "</span>\n";

    echo "<br>\n";

    echo "<a href='javascript:setVisible(\""
         . $hiddentext
         . '");makeBold("'
         . $hiddentext
         . "\");'><img src='"
         . XOOPS_URL
         . "/images/bold.gif' alt='bold'></a>&nbsp;<a href='javascript:setVisible(\""
         . $hiddentext
         . '");makeItalic("'
         . $hiddentext
         . "\");'><img src='"
         . XOOPS_URL
         . "/images/italic.gif' alt='italic'></a>&nbsp;<a href='javascript:setVisible(\""
         . $hiddentext
         . '");makeUnderline("'
         . $hiddentext
         . "\");'><img src='"
         . XOOPS_URL
         . "/images/underline.gif' alt='underline'></a>&nbsp;<a href='javascript:setVisible(\""
         . $hiddentext
         . '");makeLineThrough("'
         . $hiddentext
         . "\");'><img src='"
         . XOOPS_URL
         . "/images/linethrough.gif' alt='linethrough'></a>&nbsp;<input type='text' id='"
         . $textarea_id
         . "Addtext' size='20'>&nbsp;<input type='button' onclick='xoopsCodeText(\"$textarea_id\", \""
         . $hiddentext
         . "\")' value='"
         . _ADD
         . "'><br><br><textarea id='"
         . $textarea_id
         . "' name='"
         . $textarea_id
         . "' cols='$cols' rows='$rows'>"
         . $GLOBALS[$textarea_id]
         . "</textarea><br>\n";
}

/*
*  Displays smilie image buttons used to insert smilie codes to a target textarea in a form
* $textarea_id is a unique of the target textarea
*/
function xoopsSmilies($textarea_id)
{
    $myts = MyTextSanitizer::getInstance();

    $smiles = $myts->getSmileys();

    if (empty($smileys)) {
        $db = XoopsDatabaseFactory::getDatabaseConnection();

        if ($result = $db->query('SELECT * FROM ' . $db->prefix('smiles') . ' WHERE display=1')) {
            while (false !== ($smiles = $db->fetchArray($result))) {
                echo "<a href='javascript: justReturn()' onclick='xoopsCodeSmilie(\"" . $textarea_id . '", " ' . $smiles['code'] . " \");'>";

                echo '<img src="' . XOOPS_URL . '/uploads/' . htmlspecialchars($smiles['smile_url'], ENT_QUOTES | ENT_HTML5) . '" border="0" alt=""></a>';
            }
        }
    } else {
        $count = count($smiles);

        for ($i = 0; $i < $count; $i++) {
            if (1 == $smiles[$i]['display']) {
                echo "<a href='javascript: justReturn()' onclick='xoopsCodeSmilie(\"" . $textarea_id . '", " ' . $smiles[$i]['code'] . " \");'><img src='" . XOOPS_URL . '/uploads/' . htmlspecialchars($smiles['smile_url'], ENT_QUOTES | ENT_HTML5) . "' border='0' alt=''></a>";
            }
        }
    }

    echo "&nbsp;[<a href='javascript:openWithSelfMain(\"" . XOOPS_URL . '/misc.php?action=showpopups&amp;type=smilies&amp;target=' . $textarea_id . "\",\"smilies\",300,475);'>" . _MORE . '</a>]';
}

function xoopsCodeTareaRet($textarea_id, $cols = 60, $rows = 15, $suffix = null)
{
    $ret = '';

    $hiddentext = isset($suffix) ? 'xoopsHiddenText' . trim($suffix) : 'xoopsHiddenText';

    $ret .= "<a href='javascript:xoopsCodeUrl(\"$textarea_id\");'><img src='"
                   . XOOPS_URL
                   . "/images/url.gif' alt='url'></a>&nbsp;<a href='javascript:xoopsCodeEmail(\"$textarea_id\");'><img src='"
                   . XOOPS_URL
                   . "/images/email.gif' alt='email'></a>&nbsp;<a href='javascript:xoopsCodeImg(\"$textarea_id\");'><img src='"
                   . XOOPS_URL
                   . "/images/imgsrc.gif' alt='imgsrc'></a>&nbsp;<a href='javascript:openWithSelfMain(\""
                   . XOOPS_URL
                   . '/imagemanager.php?target='
                   . $textarea_id
                   . "\",\"imgmanager\",400,430);'><img src='"
                   . XOOPS_URL
                   . "/images/image.gif' alt='image'></a>&nbsp;<a href='javascript:xoopsCodeCode(\"$textarea_id\");'><img src='"
                   . XOOPS_URL
                   . "/images/code.gif' alt='code'></a>&nbsp;<a href='javascript:xoopsCodeQuote(\"$textarea_id\");'><img src='"
                   . XOOPS_URL
                   . "/images/quote.gif' alt='quote'></a><br>\n";

    $sizearray = ['xx-small', 'x-small', 'small', 'medium', 'large', 'x-large', 'xx-large'];

    $ret .= "<select id='" . $textarea_id . "Size' onchange='setVisible(\"xoopsHiddenText\");setElementSize(\"" . $hiddentext . "\",this.options[this.selectedIndex].value);'>\n";

    $ret .= "<option value='SIZE'>" . _SIZE . "</option>\n";

    foreach ($sizearray as $size) {
        $ret .= "<option value='$size'>$size</option>\n";
    }

    $ret .= "</select>\n";

    $fontarray = ['Arial', 'Courier', 'Georgia', 'Helvetica', 'Impact', 'Verdana'];

    $ret .= "<select id='" . $textarea_id . "Font' onchange='setVisible(\"xoopsHiddenText\");setElementFont(\"" . $hiddentext . "\",this.options[this.selectedIndex].value);'>\n";

    $ret .= "<option value='FONT'>" . _FONT . "</option>\n";

    foreach ($fontarray as $font) {
        $ret .= "<option value='$font'>$font</option>\n";
    }

    $ret .= "</select>\n";

    $colorarray = ['00', '33', '66', '99', 'CC', 'FF'];

    $ret .= "<select id='" . $textarea_id . "Color' onchange='setVisible(\"xoopsHiddenText\");setElementColor(\"" . $hiddentext . "\",this.options[this.selectedIndex].value);'>\n";

    $ret .= "<option value='COLOR'>" . _COLOR . "</option>\n";

    foreach ($colorarray as $color1) {
        foreach ($colorarray as $color2) {
            foreach ($colorarray as $color3) {
                $ret .= "<option value='" . $color1 . $color2 . $color3 . "' style='background-color:#" . $color1 . $color2 . $color3 . ';color:#' . $color1 . $color2 . $color3 . ";'>#" . $color1 . $color2 . $color3 . "</option>\n";
            }
        }
    }

    $ret .= "</select><span id='" . $hiddentext . "'>" . _EXAMPLE . "</span>\n";

    $ret .= "<br>\n";

    $ret .= "<a href='javascript:setVisible(\""
            . $hiddentext
            . '");makeBold("'
            . $hiddentext
            . "\");'><img src='"
            . XOOPS_URL
            . "/images/bold.gif' alt='bold'></a>&nbsp;<a href='javascript:setVisible(\""
            . $hiddentext
            . '");makeItalic("'
            . $hiddentext
            . "\");'><img src='"
            . XOOPS_URL
            . "/images/italic.gif' alt='italic'></a>&nbsp;<a href='javascript:setVisible(\""
            . $hiddentext
            . '");makeUnderline("'
            . $hiddentext
            . "\");'><img src='"
            . XOOPS_URL
            . "/images/underline.gif' alt='underline'></a>&nbsp;<a href='javascript:setVisible(\""
            . $hiddentext
            . '");makeLineThrough("'
            . $hiddentext
            . "\");'><img src='"
            . XOOPS_URL
            . "/images/linethrough.gif' alt='linethrough'></a>&nbsp;<input type='text' id='"
            . $textarea_id
            . "Addtext' size='20'>&nbsp;<input type='button' onclick='xoopsCodeText(\"$textarea_id\", \""
            . $hiddentext
            . "\")' value='"
            . _ADD
            . "'><br><br><textarea id='"
            . $textarea_id
            . "' name='"
            . $textarea_id
            . "' cols='$cols' rows='$rows'>"
            . $GLOBALS[$textarea_id]
            . "</textarea><br>\n";

    return $ret;
}

/*
*  Displays smilie image buttons used to insert smilie codes to a target textarea in a form
* $textarea_id is a unique of the target textarea
*/
function xoopsSmiliesRet($textarea_id)
{
    $ret = '';

    $myts = MyTextSanitizer::getInstance();

    $smiles = $myts->getSmileys();

    if (empty($smileys)) {
        $db = XoopsDatabaseFactory::getDatabaseConnection();

        if ($result = $db->query('SELECT * FROM ' . $db->prefix('smiles') . ' WHERE display=1')) {
            while (false !== ($smiles = $db->fetchArray($result))) {
                $ret .= "<a href='javascript: justReturn()' onclick='xoopsCodeSmilie(\"" . $textarea_id . '", " ' . $smiles['code'] . " \");'>";

                $ret .= '<img src="' . XOOPS_URL . '/uploads/' . htmlspecialchars($smiles['smile_url'], ENT_QUOTES | ENT_HTML5) . '" border="0" alt=""></a>';
            }
        }
    } else {
        $count = count($smiles);

        for ($i = 0; $i < $count; $i++) {
            if (1 == $smiles[$i]['display']) {
                $ret .= "<a href='javascript: justReturn()' onclick='xoopsCodeSmilie(\"" . $textarea_id . '", " ' . $smiles[$i]['code'] . " \");'><img src='" . XOOPS_URL . '/uploads/' . htmlspecialchars($smiles['smile_url'], ENT_QUOTES | ENT_HTML5) . "' border='0' alt=''></a>";
            }
        }
    }

    $ret .= "&nbsp;[<a href='javascript:openWithSelfMain(\"" . XOOPS_URL . '/misc.php?action=showpopups&amp;type=smilies&amp;target=' . $textarea_id . "\",\"smilies\",300,475);'>" . _MORE . '</a>]';

    return $ret;
}
