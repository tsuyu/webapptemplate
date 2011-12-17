<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * @author tsuyu / mohamad dot yusuf at hotmail dot com
 */

class Util {

    /**
     * RFC(2)822 Email Parser
     *
     * By Cal Henderson <cal@iamcal.com>
     * This code is licensed under a Creative Commons
     * Attribution-ShareAlike 2.5 License
     * http://creativecommons.org/licenses/by-sa/2.5/
     * Revision 5 - http://www.iamcal.com/publish/articles/php/parsing_email/
     *
     * Comments were stripped, check the source for the way this
     * parser is built. It is a very interesting reading.
     *
     * @param string Email
     * @return bool Is email
     */
    public static function isValidEmail($email) {
        $email = trim($email);
        $n = explode(' ', $email);
        if (count($n) > 1) {
            return false;
        }
        $no_ws_ctl = "[\\x01-\\x08\\x0b\\x0c\\x0e-\\x1f\\x7f]";
        $alpha = "[\\x41-\\x5a\\x61-\\x7a]";
        $digit = "[\\x30-\\x39]";
        $cr = "\\x0d";
        $lf = "\\x0a";
        $crlf = "($cr$lf)";
        $obs_char = "[\\x00-\\x09\\x0b\\x0c\\x0e-\\x7f]";
        $obs_text = "($lf*$cr*($obs_char$lf*$cr*)*)";
        $text = "([\\x01-\\x09\\x0b\\x0c\\x0e-\\x7f]|$obs_text)";
        $obs_qp = "(\\x5c[\\x00-\\x7f])";
        $quoted_pair = "(\\x5c$text|$obs_qp)";
        $wsp = "[\\x20\\x09]";
        $obs_fws = "($wsp+($crlf$wsp+)*)";
        $fws = "((($wsp*$crlf)?$wsp+)|$obs_fws)";
        $ctext = "($no_ws_ctl|[\\x21-\\x27\\x2A-\\x5b\\x5d-\\x7e])";
        $ccontent = "($ctext|$quoted_pair)";
        $comment = "(\\x28($fws?$ccontent)*$fws?\\x29)";
        $cfws = "(($fws?$comment)*($fws?$comment|$fws))";
        $cfws = "$fws*";
        $atext = "($alpha|$digit|[\\x21\\x23-\\x27\\x2a\\x2b\\x2d\\x2f\\x3d\\x3f\\x5e\\x5f\\x60\\x7b-\\x7e])";
        $atom = "($cfws?$atext+$cfws?)";
        $qtext = "($no_ws_ctl|[\\x21\\x23-\\x5b\\x5d-\\x7e])";
        $qcontent = "($qtext|$quoted_pair)";
        $quoted_string = "($cfws?\\x22($fws?$qcontent)*$fws?\\x22$cfws?)";
        $word = "($atom|$quoted_string)";
        $obs_local_part = "($word(\\x2e$word)*)";
        $obs_domain = "($atom(\\x2e$atom)*)";
        $dot_atom_text = "($atext+(\\x2e$atext+)*)";
        $dot_atom = "($cfws?$dot_atom_text$cfws?)";
        $dtext = "($no_ws_ctl|[\\x21-\\x5a\\x5e-\\x7e])";
        $dcontent = "($dtext|$quoted_pair)";
        $domain_literal = "($cfws?\\x5b($fws?$dcontent)*$fws?\\x5d$cfws?)";
        $local_part = "($dot_atom|$quoted_string|$obs_local_part)";
        $domain = "($dot_atom|$domain_literal|$obs_domain)";
        $addr_spec = "($local_part\\x40$domain)";

        $done = 0;
        while (!$done) {
            $new = preg_replace("!$comment!", '', $email);
            if (strlen($new) == strlen($email)) {
                $done = 1;
            }
            $email = $new;
        }
        return preg_match("!^$addr_spec$!", $email) ? true : false;
    }

    public static function redirect($url = NULL) {
        if (is_null($url))
            $url = $_SERVER['PHP_SELF'];
        header("Location: $url");
        exit();
    }

    public static function stripSlashesDeep($value) {
        $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
        return $value;
    }

    public static function removeMagicQuotes() {
        if (get_magic_quotes_gpc()) {
            $_GET = self::stripSlashesDeep($_GET);
            $_POST = self::stripSlashesDeep($_POST);
            $_COOKIE = self::stripSlashesDeep($_COOKIE);
        }
    }

    public static function unregisterGlobals() {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }

    public static function setReporting() {
        if (IS_ENV_PRODUCTION == TRUE) {
            error_reporting(E_ALL ^ E_NOTICE);
            ini_set('display_errors', 'On');
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', SERVER_ROOT . 'tmp' . DS . 'logs' . DS . 'error.log');
        }
    }

    public static function injection($query) {
        return trim(str_replace(array("#", "--", "\\", "//", ";", "/*", "*/", "drop", "truncate"), "", strtolower($query)));
    }

}

?>
