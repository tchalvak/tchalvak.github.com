<?php
session_start();
$page_title = "Development Notes";
$alive      = false;
$private    = false;
$quickstat  = false;

include "interface/header.php";
?>
  

<span style="font-weight: bold;color: red;">Development Notes</span>

<p>

<table border="1">
<tr>
  <th>
  <small>Modules</small>
  </th>

  <th>
  <small><a href="#login">Login</a></small>
  </th>

  <th>
  <small><a href="#stats">Stats</a></small>
  </th>

  <th>
  <small><a href="#mail">Mail</a></small>
  </th>

  <th>
  <small><a href="#attack">Attack</a></small>
  </th>

  <th>
  <small><a href="#shrine">Shrine</a></small>
  </th>

  <th>
  <small><a href="#dojo">Dojo</a></small>
  </th>

  <th>
  <small><a href="#village">Village</a></small>
  </th>
</tr>
<tr>
  <th>
  <small>% Finished
  </th>

  <td>
  <small>75%</small>
  </td>

  <td>
  <small>25%</small>
  </td>

  <td>
  <small>85%</small>
  </td>

  <td>
  <small>45%</small>
  </td>

  <td>
  <small>75%</small>
  </td>

  <td>
  <small>0%</small>
  </td>

  <td>
  <small>0%</small>
  </td>
</tr>
</table>
<p style="font-family:Verdana, Arial;font-size:xx-small;">

<a name="#login">
<span style="font-weight: bold;color: red;">Login/Logout:<br />
Login Screen appears to function ok the db/session code needs changing
<br /><br />

<a name="#stats">
<span style="font-weight: bold;color: red">Stats:</span><br />
Stats Page is up , can now change password , no longer uses external script
<a name="#stats"><br /><br />

<a name="#mail">
<span style="font-weight: bold;color: red">Mail:</span><br />
Mail once logged is addressed from your login name, and uses a drop down box to select a user to send to.  Delivery is now done internally in the database. Upon reading mail you have the option to delete it.
<br /><br />

<a name="#attack">
<span style="font-weight: bold;color: red">Attack:</span><br />
Initial attack module core.  You can now attack another user, but not yourself, not your a dead player and not anyone if your dead. Put in the inital attack NPC code should relate to training in dojo
<br /><br />

<a name="#shrine">
<span style="font-weight: bold;color: red">Shrine:</span><br />
You can now heal yourself at a shrine,  in increments of 5, 10, 20, 30, 40, 50, using 1 gold per life point. May design full heal mode.
<br /><br />

<a name="#dojo">
<span style="font-weight: bold;color: red">Dojo:</span><br/>
Must develop structure for advancement.  thinking of 1 point per day on demand perhaps towards skill.
<br /><br/>

<a name="#village">
<span style="font-weight: bold;color: red">Village:</span><br />
User defined modules.  Wanna help write some addons ?
<br /><br />


</p>


<?php
include "interface/footer.php";
?>

