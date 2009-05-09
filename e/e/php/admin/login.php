<?php
session_start();
import_request_variables("gP","");
include('../db/util.php');

$sql = new MySQL_class;
$sql->Create("ninjawar_nwtest");
//$sql->Create("crux");
?>

 <b><font color=red>Login Below</font></b><p>
<form action="login_mod.php" method="post">
<table>
<tr><td>Username</td><td><input type="text" name="adminname" style="font-family:Verdana, Arial;font-size:xx-small"></td></tr>
<tr><td>Password</td><td><input type="password" name="password1" style="font-family:Verdana, Arial;font-size:xx-small"></td></tr>
<tr><td><input type="submit" value="Login" style="font-family:Verdana, Arial;font-size:xx-small"></td><td>
<input type="hidden" value="1" name="logged" ></td></tr>
</table>
</form>


<?php

?>

