<?php
    if($_SESSION['%^&*(^433'] != '&*((*^^^$'){
        exit ();
    }
?>
<link href="template/paging_css.css" rel="stylesheet" type="text/css" />
<h3><img border=0 src=template/images/computer.png width=16 height=16 />&nbsp;User
         list</h3>
    <?php
    ?>
<script language="JavaScript">
    function deleteUser()
    {
        return confirm("Are you sure you wish to delete this entry?");
    }
</script>
<form name="formAddUser" action="" method="post"><?php
    ?>
    <table class="listtable" border="0" cellspacing="0" cellpadding="0"
           width="100%">

        <tr>
<?php
?>
            <th>&nbsp</th>
            <?php ?>

            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>

        </tr>
<?php ?>
        <tr>

<?php
?>
            <td><input type="checkbox" name="selected[]"
                       value="<?php echo $value->username; ?>" /></td>
        <?php ?>


            <td><?php echo $value->username; ?></td>
            <td><?php echo $value->name; ?></td>
            <td><?php echo $value->email; ?></td>
            <td><?php echo $value->telno; ?></td>
            <td><a
                    href="index.php?com=user&action=view&username=<?php echo $value->username; ?>"><img
                        border=0 src=template/images/pencil.png width=16 height=16 /></a></td>
            <td><a href="mailto:<?php echo $value->email; ?>"><img border=0
                                                                   src=template/images/mail_write.png width=16 height=16 /></a></td>
        </tr>
<?php ?>
    </table>

<?php ?> <input type="hidden" name="com" value="user" /> <input
        type="hidden" name="action" value="delete" /> <input type="submit"
        name="deleteUser" value="Delete User" onClick="return deleteUser();" />
</form>

<?php
?>