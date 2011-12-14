<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="shortcut icon" href="template/images/mobile.png"></link>
        <link href="template/css/template_css.css" rel="stylesheet" type="text/css" ></link>
        <title>tsuyu.org</title>
    </head>
    <body>

        <div id="wrapper">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="2">
                        <div class="header"><img src="template/images/banner.jpg" /></div>

                        <?php
                        echo "<div style=\"margin-bottom:5; margin-left:1; color:black; font-size:1em; font-weight:bold\"  align='right'>";
                        if ($_SESSION['user']) {
                            echo 'User in Session: ';
                            echo '<a href="index.php?com=user&action=view&username=' . $_SESSION['user']['username'] . '">' . $_SESSION['user']['username'] . '</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            echo "</div>";
                        } else {
                            echo 'Welcome Guest&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            echo "</div>";
                        }
                        ?></td>
                </tr>

                <tr>
                    <td valign="top" width="150">

                        <div class="mainNav"><?php
                        $request->loadMenu();
                        ?></div>
                    </td>
                    <td valign="top">
                        <div class="content"><?php
                            /* if(SessionManager::getMessage()){
                              echo '<span class="statusmessage">'.SessionManager::getMessage().'</span>';
                              } */
                        ?> <?php $request->loadForm(); ?></div>
                    </td>
                </tr>
            </table>
            <br></br>
            <br></br>
        </div>

    </body>
    <div id="footer">

        <p>&copy; 2011 <strong>TSUYU</strong> | Valid <a
                href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a
                href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <a href="index.html">Home</a>&nbsp;|&nbsp; <a href="index.html">Sitemap</a></p>

    </div>
</html>
