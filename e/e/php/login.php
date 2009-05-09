<?php
session_start();
$private    = false;
$alive      = false;
$quickstat  = false;
$page_title = "Login";

include "interface/header.php";
?>

<span class="brownHeading">Login Below</span>

<p>

<form action="login_mod.php" method="post">
<table>
<tr>
  <td>
  Username
  </td>

  <td>
  <input type="text" name="username" value="<?echo $_COOKIE['user_cookie'];?>" style="font-family:Verdana, Arial;font-size:xx-small;" />
  </td>
</tr>
<tr>
  <td>
  Password
  </td>

  <td>
  <input type="password" name="password1" style="font-family:Verdana, Arial;font-size:xx-small;" >
  </td>
</tr>
<tr>
  <td>
  <input type="submit" value="Login" class="formButton" />
  </td>

  <td>
  <input type="hidden" value="1" name="logged" />
  </td>
</tr>
</table>
</form>

<hr />

</p>

<span class="brownHeading">Lost Password:</span>&nbsp;&nbsp;Password Retrival script click <a href="lostpass.php">Lost Pass</a>.<br />
Didn't get your confirmation code ? <a href="lostconfirm.php">Activate Account</a><br /><br />

<?php
include "interface/footer.php";
?>

