<?php
session_register();
$alive      = false;
$private    = false;
$quickstat  = false;
$page_title = "Sign Up";

include "interface/header.php";
?>
  
<span class="brownHeading">Sign Up</span>

<p>
Sign Up Module: Beta
</p>

<form action="signup_mod.php" method="post">
<table border="0">
<tr>
  <td>
  Username
  </td>

  <td>
  <input type="text" name="send_name" style="font-family:Verdana, Arial;font-size:xx-small;" />
  </td>
</tr>
<tr>
  <td>
  Password
  </td>

  <td>
  <input type="password" name="send_pass" style="font-family:Verdana, Arial;font-size:xx-small;" />
  </td>
</tr>
<tr>
  <td>
  Ninja Type
  </td>

  <td>
  <select name="send_class">
    <option selected="selected" value="">Pick Ninja Class</option>
    <option value="Red">Red</option>
    <option value="Blue">Blue</option>
    <option value="White">White</option>
    <option value="Black">Black</option>
  </select>
  </td>
</tr>
<tr>
  <td>
  Email Address
  </td>

  <td>
  <input type="text" name="send_email" style="font-family:Verdana, Arial;font-size:xx-small;" />
  </td>
</tr>
<tr>
  <td colspan="2">
  <input type="submit" value="Create New Account" class="formButton" />
  </td>
</tr>
</table>
</form>
<hr />
A valid email address is required for this game, do not put an invalid address.<br /><br />
Lost Your Password ? <a href="lostpass.php">Retrive Password</a><br /><br />
Didn't get your confirmation code ? <a href="lostconfirm.php">Activate Account</a>

<hr />

<?php
include "interface/footer.php";
?>