<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author tsuyu / mohamad dot yusuf at hotmail dot com
 */

define('SERVER_ROOT' , 'D:/xampp/htdocs/webapptemplate/');
define('DS', DIRECTORY_SEPARATOR);
define('IS_ENV_PRODUCTION', true);

include SERVER_ROOT.'util'.DS.'class.util.php';

Util::common();
Util::setReporting();
Util::removeMagicQuotes();
Util::unregisterGlobals();
?>
