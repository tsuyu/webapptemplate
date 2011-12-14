<script type="text/javascript">
window.seconds = 10;
window.onload = function()
{
if (window.seconds != 0)
{
document.getElementById('secondsDisplay').innerHTML = '' +
window.seconds + ' second' + ((window.seconds > 1) ? 's' : '');
window.seconds--;
setTimeout(window.onload, 1000);
}
else
{
window.location = 'loginform.php';
}
}
</script>
<p> The resource you have requested requires user authentication. Either
you have not supplied the necessary credentials or the credentials you
have supplied do not authorize you for access. </p> <p> <strong>
You will be redirected to the login page in <span id="secondsDisplay">
10 seconds </span>.</strong></p><p>If you are not
automatically taken there.
