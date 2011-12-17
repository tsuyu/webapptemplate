<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author tsuyu / mohamad dot yusuf at hotmail dot com
 */
date_default_timezone_set("Asia/Kuala_Lumpur");

define('ROOT' , $_SERVER['DOCUMENT_ROOT']);
define('FOLDER', 'webapptemplate');
define('DS', DIRECTORY_SEPARATOR);
define('SERVER_ROOT',ROOT.DS.FOLDER.DS );
define('IS_ENV_PRODUCTION', true);

include SERVER_ROOT.'util'.DS.'class.util.php';
include SERVER_ROOT.'libs'.DS.'class.session.php';

Util::setReporting();
Util::removeMagicQuotes();
Util::unregisterGlobals();

?>
