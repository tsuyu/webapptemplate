<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author tsuyu / mohamad dot yusuf at hotmail dot com
 */

define('ROOT' , $_SERVER['DOCUMENT_ROOT']);
define('FOLDER', 'webapptemplate');
define('DS', DIRECTORY_SEPARATOR);
define('SERVER_ROOT',ROOT.DS.FOLDER.DS );
define('IS_ENV_PRODUCTION', true);

include SERVER_ROOT.'util'.DS.'class.util.php';

Util::common();
Util::setReporting();
Util::removeMagicQuotes();
Util::unregisterGlobals();
?>
