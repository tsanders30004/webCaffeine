<html>
<?php
function sanitizeString($var)
{
     $var = stripslashes($var);
     $var = strip_tags($var);
     $var = htmlentities($var);
     return $var;
}

$my_email_address = 'tim.sanders@web-caffeine.com';

if (isset($_POST['name']))
$name = $_POST['name'];
else $name = '[Not Defined]';

if (isset($_POST['email']))
$email = $_POST['email'];
else $email = '[Not Defined]';

if (isset($_POST['comments']))
$comments = $_POST['comments'];
else $comemnts = '[Not Defined]';

$name = sanitizeString($name);
$email = sanitizeString($email);
$comments = sanitizeString($comments);
$msg = wordwrap($name . ' | ' . $email . ' | ' . $comments, 70);
mail($my_email_address, 'Message from Web-Caffeine Visitor', $msg);
echo '<html><script type="text/javascript">window.location.href = "http://www.web-caffeine.com#about"</script></html>'
?>
</html>
