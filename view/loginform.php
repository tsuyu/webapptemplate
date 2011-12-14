<head>
    <link href="template/template_css.css" rel="stylesheet" type="text/css" />
</head>

<div style="border:1px solid grey; padding:5px; width:20em;">
    <form name="formLogin"  method="post">
        <table border="0">
            <tr>
                <td height="33" colspan="2"><img border="0" src="template/images/house.png" width="16" height="16"/>&nbsp;Login to your account </br></td>
            </tr>
            <tr>
                <td> User ID : </td>
                <td><input type="text" name="username" class="input" onKeyPress="this.style.background = '';"/></td>
            </tr>
            <tr>
                <td>Password : </td>
                <td><input type="password" name="password" class="input"  onKeyPress="this.style.background = '';"/></td>
            </tr>
            <tr>
                <th></th>
                <td colspan="2"><input type="submit" value="Enter" name="submitLogin"/><input name="btnReset" type="reset" id="btnReset"  value="Reset"/></td>
            </tr>
        </table>
    </form>
</div>