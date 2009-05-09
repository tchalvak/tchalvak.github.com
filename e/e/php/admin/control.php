<?php
session_start();
import_request_variables("gP","");
include('../db/util.php');



$sql = new MySQL_class;
$sql->Create("ninjawar_nwtest");
//$sql->Create("crux");

?>


<script type="text/javascript">

var enablepersist="on" //Enable saving state of content structure? (on/off)

if (document.getElementById){
document.write('<style type="text/css">')
document.write('.switchcontent{display:none;}')
document.write('</style>')
}

function getElementbyClass(classname){
ccollect=new Array()
var inc=0
var alltags=document.all? document.all : document.getElementsByTagName("*")
for (i=0; i<alltags.length; i++){
if (alltags[i].className==classname)
ccollect[inc++]=alltags[i]
}
}

function contractcontent(omit){
var inc=0
while (ccollect[inc]){
if (ccollect[inc].id!=omit)
ccollect[inc].style.display="none"
inc++
}
}

function expandcontent(cid){
if (typeof ccollect!="undefined"){
contractcontent(cid)
document.getElementById(cid).style.display=(document.getElementById(cid).style.display!="block")? "block" : "none"
selectedItem=cid+"|"+document.getElementById(cid).style.display
}
}

function revivecontent(){
selectedItem=getselectedItem()
selectedComponents=selectedItem.split("|")
contractcontent(selectedComponents[0])
document.getElementById(selectedComponents[0]).style.display=selectedComponents[1]
}

function get_cookie(Name) { 
var search = Name + "="
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) { 
offset += search.length
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}

function getselectedItem(){
if (get_cookie(window.location.pathname) != ""){
selectedItem=get_cookie(window.location.pathname)
return selectedItem
}
else
return ""
}

function saveswitchstate(){
if (typeof selectedItem!="undefined")
document.cookie=window.location.pathname+"="+selectedItem
}

function do_onload(){
getElementbyClass("switchcontent")
if (enablepersist=="on" && getselectedItem()!="")
revivecontent()
}


if (window.addEventListener)
window.addEventListener("load", do_onload, false)
else if (window.attachEvent)
window.attachEvent("onload", do_onload)
else if (document.getElementById)
window.onload=do_onload

if (enablepersist=="on" && document.getElementById)
window.onunload=saveswitchstate

</script>

<style type="text/css">
<!--
a:link, a:active, a:visited {
color: white;
text-decoration: none}

a:hover {
color: white;
text-decoration: underline}

BODY {
font : bold 10px/16px Verdana, Arial, Helvetica, sans-serif;
color : #FFFFFF;
}
TD {
font : bold 10px/16px Verdana, Arial, Helvetica, sans-serif;
color : #FFFFFF;
}
-->
</style>
<body bgcolor="#1E2A42">
<b><font color=red>Control Panel</font></b><p>
<form action="control.php" method="post">

<?php
$adminname = $_SESSION['adminname'];
if ($adminname != "")
{
  echo "<table align=\"left\" valign=\"top\" border=\"1\">\n";
  echo "<tr><td>\n";
  echo "<tr><td bgcolor=\"#6666CC\"><font color=\"white\"><B><a onClick=\"expandcontent('sc1')\" style=\"cursor:hand; cursor:pointer\">Player Global:</a></b></font></td></tr>\n";
  echo "<tr><td><div id=\"sc1\" class=\"switchcontent\">\n";
  echo "Commands: <a href=control.php?command=Logout>Logout</a><br><br>\n";
  echo "<a href=\"control.php?command=AddPlayer\">Add Player</a><br>\n";
  echo "<a href=\"control.php?command=DeletePlayer\">Delete Player</a><br>\n";
  echo "<a href=\"control.php?command=ViewAll\">View All</a><br>\n";
  echo "<form action=\"control.php?command=ViewAll\"><br>\n";
  echo "<input type=\"textbox\" name=\"searched\" style=\"font-family:Verdana, Arial;font-size:xx-small\" /><br>\n";
  echo "<input type=\"hidden\" name=\"command\" value=\"ViewAll\" /><br><input type=\"submit\" style=\"font-family:Verdana, Arial;font-size:xx-small\" value=\"Search For Player\" /></form><br>\n";
  echo "</div></td></tr>\n";

  echo "<tr><td bgcolor=\"#6666CC\"><font color=\"white\"><B><a onClick=\"expandcontent('sc2')\" style=\"cursor:hand; cursor:pointer\">Player Seperate:</a></b></font></td></tr>\n";
  echo "<tr><td><div id=\"sc2\" class=\"switchcontent\">\n";
  echo "<a href=\"control.php?command=SetHealth\">Set Health</a><br>\n";
  echo "<a href=\"control.php?command=SetActive\">Set Active</a><br>\n";
  echo "<a href=\"control.php?command=SetPassword\">Set Password</a><br>\n";
  echo "<a href=\"control.php?command=SetStrength\">Set Strength</a><br>\n";
  echo "<a href=\"control.php?command=SetKills\">Set Kills</a><br>\n";
  echo "<a href=\"control.php?command=SetGold\">Set Gold</a> <br>\n";
  echo "<a href=\"control.php?command=SetTurns\">Set Turns</a><br>\n";
  echo "<a href=\"control.php?command=SetClass\">Set Class</a><br>\n";
  echo "<a href=\"control.php?command=SetLevel\">Set Level</a><br>\n";
  echo "<a href=\"control.php?command=SetStatus\">Set Status</a><br>\n";
  echo "<a href=\"control.php?command=SetMember\">Set Member</a>\n";
  echo "</div></td></tr>\n";

  echo "<tr><td bgcolor=\"#6666CC\"><font color=\"white\"><B><a onClick=\"expandcontent('sc3')\" style=\"cursor:hand; cursor:pointer\">Misc:</a></b></font></td></tr>\n";
  echo "<tr><td><div id=\"sc3\" class=\"switchcontent\">\n";
  echo "Item Control: <a href=\"control.php?command=AddItem\">Add Item to Player</a><br>\n";
  echo "<b>Mass EMail:</b> <a href=\"control.php?command=MassEmail\">Send Global Email</a> <br>\n";
  echo "<b>News:</b> <a href=\"control.php?command=ModifyNews\">Modify News</a> <br>\n";
  echo "</div></td></tr>\n";

  echo "</td></tr></table>\n";

  echo "<table align=\"left\" valign=\"top\" border=\"1\">\n";
  echo "<tr><td>\n";


  if ($command == "Logout")
    {
      echo "logging out";
      $_SESSION['adminname'] = "";
    }
  
  if ($command == "MassEmail")
    {
      
      $mass_email = "";
      $sql->QueryRow("select * from players");
      $mass_email = "admin@ninjawars.net";
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $email = $sql->data[10];
	  $mass_email = $mass_email . ";". $email;
	  //echo "Email: $email<br>";
	}
      echo "<form action='control.php' method='post'><input type='hidden' name='sending' value='1'>";
      echo "<input type='hidden' name='command' value='MassEmail'>";
      echo "Subject: <input type='textbox' name='subject' width='20'><br>";
      echo "Message<textarea name='msg' cols='70' rows='15'></textarea><br>";
      echo "<input type='submit'  value='Send Mass Email'></form>";
      if ($sending == 1)
	{
	  echo "Mass EMail Subject: $subject, Message: $msg to $email<br>";
	  $headers  = "MIME-Version: 1.0\r\n";
	  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	  
	  /* additional headers */
	  $headers .= "From: SysMsg <SysMsg@NinjaWars.net>\r\n";
	  //$headers .= "Bcc: $mass_email\r\n";
	  $sql->QueryRow("select * from players");
	  $row = $sql->data;
	  for ($i = 0; $i < $sql->rows; $i++)
	    {
	      $sql->Fetch($i);
	      $email = $sql->data[10];
	      
	      if ($subject != "" && $msg != "") {   mail($email, $subject, $msg,$headers);} else {echo "<br>Missing data"; }
	    } //end for
	} //end sending
      
      
    } //end function
  
  if ($command == "ViewAll")
    {
      echo "<b>Viewing All Players</b>";
      echo "<table border='1'>";
      
      if ($searched != "") { $sql->Query("Select * from players where uname LIKE '%$searched%'");}
      if ($searched == "") {$sql->QueryRow("select * from players");}
      
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $name = $sql->data[0];
	  $pass = $sql->data[1];
	  $hp = $sql->data[2];
	  $str = $sql->data[3];
	  $gold = $sql->data[4];
	  $msg = $sql->data[5];
	  $kills = $sql->data[6];
	  $turns = $sql->data[7];
	  $confirm = $sql->data[8];
	  $confirmed = $sql->data[9];
	  $email = $sql->data[10];
	  $cla = $sql->data[11];
	  $lev = $sql->data[12];
	  $status = $sql->data[13];
	  $member = $sql->data[14];
	  echo "<tr><td>Usr</td><td>Pwd</td><td>HP</td><td>Str</td><td>$$$</td><td>Msg</td></tr>";
	  echo "<tr><td>$name</td><td>$pass</td><td><a href='control.php?command=SetHealth&Player=$name'>$hp</a></td><td><a href='control.php?command=SetStrength&Player=$name'>$str</td><td><a href='control.php?command=SetGold&Player=$name'>$gold</a></td><td>$msg</td></tr>";
	  echo "<tr><td height='5'></td></tr>";   
	  echo "<tr><td>Kills</td><td>Turns</td><td>C</td><td>C1</td><td>@</td><td>Class</td><td>Lev</td><td>Status</td><td>Member</td></tr>";
	  echo "<tr><td><a href='control.php?command=SetKills&Player=$name'>$kills</a></td><td><a href='control.php?command=SetTurns&Player=$name'>$turns</a></td><td>$confirm</td><td><a href='control.php?command=SetActive&Player=$name'>$confirmed</a></td><td><a href='control.php?command=SetEmail&Player=$name'>$email</a></td><td><a href='control.php?command=SetClass&Player=$name'>$cla</a></td><td>$lev</td><td><a href='control.php?command=SetStatus&Player=$name'>$status</a></td><td><a href='control.php?command=SetMember&Player=$name'>$member</a></td></tr>";
	  echo "<tr><td height='20'></td></tr>";   
        }
      echo "</table>";
    }
  
  if ($command == "SetHealth")
    {
      echo "<form action='control.php' method='post'>Set Health<br><br>";
      echo "<select name='Player' style='font-family:Verdana, Arial;font-size:xx-small'>";
      
      echo "<option selected value=''>Pick a Name";
      echo "<option value=$Player SELECTED> $Player";
      $sql->QueryRow("select * from players");
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $name = $sql->data[0];
	  
	  echo "<option value='$name'>$name";
	  
	}
      
      echo "</select>";
      
      echo "<input type='text' name='new_value' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='command' value='SetHealth' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='process' value='1' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='submit' value='Set Health' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "</form>";
      if ($process == 1)
	{
	  if ($Player == '')
	    {
	      die('No Player Selected');
	    }
	  echo "$Players Health is now $new_value";
	  $sql->Update("update players set health = '$new_value' where uname = '$Player'");
	  $affected_rows = $sql->a_rows;
	}
      
    }
  
  if ($command == "SetEmail")
    {
      echo "<form action='control.php' method='post'>Set Email<br><br>";
      echo "<select name='Player' style='font-family:Verdana, Arial;font-size:xx-small'>";
      
      echo "<option selected value=''>Pick a Name";
      echo "<option value=$Player SELECTED> $Player";
      $sql->QueryRow("select * from players");
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $name = $sql->data[0];
	  
	  echo "<option value='$name'>$name";
	  
	}
      
      echo "</select>";
      
      echo "<input type='text' name='new_value' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='command' value='SetHealth' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='process' value='1' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='submit' value='Set Email' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "</form>";
      if ($process == 1)
	{
	  if ($Player == '')
	    {
	      die('No Player Selected');
	    }
	  echo "$Players Email is now $new_value"; 
	  $sql->Update("update players set health = '$new_value' where uname = '$Player'");
	  $affected_rows = $sql->a_rows;
	}
      
    }
  
  
  
  if ($command == "SetMember")
    {
      echo "<form action='control.php' method='post'>Set Member<br><br>";
      echo "<select name='Player' style='font-family:Verdana, Arial;font-size:xx-small'>";
      
      echo "<option selected value=''>Pick a Name";
      echo "<option value=$Player SELECTED> $Player";
      $sql->QueryRow("select * from players");
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $name = $sql->data[0];
	  
	  echo "<option value='$name'>$name";
	  
	}
      
      echo "</select>";
      
      echo "<input type='text' name='new_value' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='command' value='SetMember' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='process' value='1' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='submit' value='Set Member' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "</form>";
      if ($process == 1)
	{
	  if ($Player == '')
	    {
	      die('No Player Selected');
	    }
	  echo "Member is now $new_value";
	  $sql->Update("update players set member = '$new_value' where uname = '$Player'");
	  $affected_rows = $sql->a_rows;
	}
      
    }
  
  
  if ($command == "SetStatus")
    {
      echo "<form action='control.php' method='post'>Set Status<br><br>";
      echo "<select name='Player' style='font-family:Verdana, Arial;font-size:xx-small'>";
      
      echo "<option selected value=''>Pick a Name";
      echo "<option value=$Player SELECTED> $Player";
      $sql->QueryRow("select * from players");
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $name = $sql->data[0];
	  
	  echo "<option value='$name'>$name";
	  
	}
      
      echo "</select>";
      
      echo "<input type='text' name='new_value' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='command' value='SetStatus' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='process' value='1' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='submit' value='Set Status' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "</form>";
      if ($process == 1)
	{
	  if ($Player == '')
	    {
	      die('No Player Selected');
	    }
	  echo "Status is now $new_value";
	  $sql->Update("update players set status = '$new_value' where uname = '$Player'");
	  $affected_rows = $sql->a_rows;
	}
      
    }
  
  
  if ($command == "SetStrength")
    {
      echo "<form action='control.php' method='post'>Set Strength<br><br>";
      echo "<select name='Player' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<option selected value=''>Pick a Name";
      echo "<option value=$Player SELECTED> $Player";
      $sql->QueryRow("select * from players");
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $name = $sql->data[0];
	  
	  echo "<option value='$name'>$name";
	}
      echo "</select>";
      echo "<input type='text' name='new_value' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='command' value='SetStrength' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='process' value='1' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='submit' value='Set Strength' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "</form>";
      if ($process == 1)
	{
	  if ($Player == '')
	    {
	      die('No Player Selected');
	    }
	  echo "Strength is now $new_value";
	  $sql->Update("update players set strength = '$new_value' where uname = '$Player'");
	  $affected_rows = $sql->a_rows;
	}
      
    }
  
  
  if ($command == "SetKills")
    {
      echo "<form action='control.php' method='post'>Set Kills<br><br>";
      echo "<select name='Player' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<option selected value=''>Pick a Name";
      echo "<option value=$Player SELECTED> $Player";
      $sql->QueryRow("select * from players");
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $name = $sql->data[0];
	  
	  echo "<option value='$name'>$name";
	}
      echo "</select>";
      echo "<input type='text' name='new_value' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='command' value='SetKills' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='process' value='1' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='submit' value='Set Kills' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "</form>";
      if ($process == 1)
	{
	  if ($Player == '')
	    {
	      die('No Player Selected');
	    }
	  echo "$Players's Kills is now $new_value";
	  $sql->Update("update players set kills = '$new_value' where uname = '$Player'");
	  $affected_rows = $sql->a_rows;
	}
      
    }
  
  
  if ($command == "SetActive")
    {
      echo "<form action='control.php' method='post'>Set Active<br><br>";
      echo "<select name='Player' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<option selected value=''>Pick a Name";
      echo "<option value=$Player SELECTED> $Player";
      $sql->QueryRow("select * from players");
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $name = $sql->data[0];
	  
	  echo "<option value='$name'>$name";
	}
      echo "</select>";
      echo "<input type='text' name='new_value' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='command' value='SetActive' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='process' value='1' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='submit' value='Set Active' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "</form>";
      if ($process == 1)
	{
	  if ($Player == '')
	    {
	      die('No Player Selected');
	    }
	  echo "Account is now $new_value";
	  $sql->Update("update players set health = '$new_value' where uname = '$Player'");
	  $affected_rows = $sql->a_rows;
	}
      
    }
  
  
  if ($command == "SetPassword")
    {
      echo "<form action='control.php' method='post'>Set Password<br><br>";
      echo "<select name='Player' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<option selected value=''>Pick a Name";
      echo "<option value=$Player SELECTED> $Player";
      $sql->QueryRow("select * from players");
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $name = $sql->data[0];
	  
	  echo "<option value='$name'>$name";
	}
      echo "</select>";
      echo "<input type='text' name='new_value' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='command' value='SetPassword' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='process' value='1' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='submit' value='Set Password' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "</form>";
      if ($process == 1)
	{
	  if ($Player == '')
	    {
	      die('No Player Selected');
	    }
	  echo "Password is now $new_value";
	  $sql->Update("update players set pname = '$new_value' where uname = '$Player'");
	  $affected_rows = $sql->a_rows;
	}
      
    }
  
  
  if ($command == "SetGold")
    {
      echo "<form action='control.php' method='post'>Set Gold<br><br>";
      echo "<select name='Player' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<option selected value=''>Pick a Name";
      echo "<option value=$Player SELECTED> $Player";
      $sql->QueryRow("select * from players");
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $name = $sql->data[0];
	  
	  echo "<option value='$name'>$name";
	}
      echo "</select>";
      echo "<input type='text' name='new_value' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='command' value='SetGold' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='process' value='1' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='submit' value='Set Gold' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "</form>";
      if ($process == 1)
	{
	  if ($Player == '')
	    {
	      die('No Player Selected');
	    }
	  echo "Gold is now $new_value";
	  $sql->Update("update players set gold = '$new_value' where uname = '$Player'");
	  $affected_rows = $sql->a_rows;
	}
      
    }
  
  
  if ($command == "SetTurns")
    {
      echo "<form action='control.php' method='post'>Set Turns<br><br>";
      echo "<select name='Player' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<option selected value=''>Pick a Name";
      echo "<option value=$Player SELECTED> $Player";
      $sql->QueryRow("select * from players");
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $name = $sql->data[0];
	  
	  echo "<option value='$name'>$name";
	}
      echo "</select>";
      echo "<input type='text' name='new_value' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='command' value='SetTurns' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='process' value='1' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='submit' value='Set Turns' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "</form>";
      if ($process == 1)
	{
	  if ($Player == '')
	    {
	      die('No Player Selected');
	    }
	  echo "Turns set to $new_value";
	  $sql->Update("update players set turns = '$new_value' where uname = '$Player'");
	  $affected_rows = $sql->a_rows;
	}
      
    }
  
  
  if ($command == "SetClass")
    {
      echo "<form action='control.php' method='post'>Set Class<br><br>";
      echo "<select name='Player' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<option selected value=''>Pick a Name";
      echo "<option value=$Player SELECTED> $Player";
      $sql->QueryRow("select * from players");
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $name = $sql->data[0];
	  
	  echo "<option value='$name'>$name";
	}
      echo "</select>";
      echo "<input type='text' name='new_value' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='command' value='SetClass' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='process' value='1' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='submit' value='Set Class' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "</form>";
      if ($process == 1)
	{
	  if ($Player == '')
	    {
	      die('No Player Selected');
	    }
	  echo "$Player Class set to $new_value";
	  $sql->Update("update players set class = '$new_value' where uname = '$Player'");
	  $affected_rows = $sql->a_rows;
	}
      
    }
  
  if ($command == "SetLevel")
    {
      echo "<form action='control.php' method='post'>Set Level<br><br>";
      echo "<select name='Player' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<option selected value=''>Pick a Name";
      echo "<option value=$Player SELECTED> $Player";
      $sql->QueryRow("select * from players");
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $name = $sql->data[0];
	  
	  echo "<option value='$name'>$name";
	}
      echo "</select>";
      echo "<input type='text' name='new_value' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='command' value='SetLevel' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='process' value='1' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='submit' value='Set Level' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "</form>";
      if ($process == 1)
	{
	  if ($Player == '')
	    {
	      die('No Player Selected');
	    }
	  echo "$Player Level set to $new_value";
	  $sql->Update("update players set level = '$new_value' where uname = '$Player'");
	  $affected_rows = $sql->a_rows;
	}
      
    }
  
  if ($command == "AddPlayer")
    {
      if ($process == 1)
        {
	  if  ($username != "" && $userpass != "")
	    {
	      //$sql->Insert("insert into players VALUES ('$username','$userpass','$health','$strength','$gold','','','','','')");
	      $sql->Insert("insert into players VALUES ('$username','$userpass','150','5','50','','0','20','','$confirmed','$email','$class','$level')");
	      $affected_rows = $sql->a_rows;
	      echo "Player Added";
	    }
	  else
	    {
	      "You left out information";
	    }
        }
      
      echo "<form action='control.php' method='post'>Adding Player<br><br>";
      
      echo "<table><tr>";
      
      echo "<tr><td>Username</td><td>Password</td><td>Health</td><td>Strength</td><td>Gold</td><td>Messages</td></tr>";
      
      echo "<tr>";
      echo "<td><input type='text' name='username' style='font-family:Verdana, Arial;font-size:xx-small'></td>";
      echo "<td><input type='text' name='userpass' style='font-family:Verdana, Arial;font-size:xx-small'></td>";
      echo "<td><input type='text' name='health' style='font-family:Verdana, Arial;font-size:xx-small'></td>";
      echo "<td><input type='text' name='strength' style='font-family:Verdana, Arial;font-size:xx-small'></td>";
      echo "<td><input type='text' name='gold' style='font-family:Verdana, Arial;font-size:xx-small'></td>";
      echo "<td><input type='text' name='messages' style='font-family:Verdana, Arial;font-size:xx-small'></td>";
      echo "</tr>";
      
      
      echo "<tr><td>Kills</td><td>Turns</td><td>Confirm</td><td>Confirmed</td><td>Email</td><td>Class</td><td>Level</td></tr>";
      
      
      echo "<tr>";
      echo "<td><input type='text' name='kills' style='font-family:Verdana, Arial;font-size:xx-small'></td>";
      echo "<td><input type='text' name='turns' style='font-family:Verdana, Arial;font-size:xx-small'></td>";
      echo "<td><input type='text' name='confirm' style='font-family:Verdana, Arial;font-size:xx-small'></td>";
      echo "<td><input type='text' name='confirmed' style='font-family:Verdana, Arial;font-size:xx-small'></td>";
      echo "<td><input type='text' name='email' style='font-family:Verdana, Arial;font-size:xx-small'></td>";
      echo "<td><input type='text' name='class' style='font-family:Verdana, Arial;font-size:xx-small'></td>";
      echo "<td><input type='text' name='level' style='font-family:Verdana, Arial;font-size:xx-small'></td>";
      echo "</tr></table>";
      
      echo "<input type='hidden' name='process' value='1' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='command' value='AddPlayer' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='submit' value='Add Player' style='font-family:Verdana, Arial;font-size:xx-small'>";
    }
  
  
  if ($command == "DeletePlayer")
    {
      echo "<form action='control.php'>";
      echo "Deleting Player<br>";
      echo "<select name='DeletedPlayer' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<option selected value=''>Pick a Name";
      $sql->QueryRow("select * from players");
      $row = $sql->data;
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $name = $sql->data[0];
	  
	  echo "<option value='$name'>$name";
	}
      echo "</select>";
      echo "<input type='hidden' name='command' value='DeletePlayer' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='hidden' name='process' value='1' style='font-family:Verdana, Arial;font-size:xx-small'>";
      echo "<input type='submit' value='Delete this Player' style='font-family:Verdana, Arial;font-size:xx-small'>";
      
      if ($process == 1)
        {
	  if ($DeletedPlayer != "")
            {
	      $sql->Delete("delete from players where uname = '$DeletedPlayer'");
	      $affected_rows = $sql->a_rows;
	      echo "<br>Player $username has been deleted";
            }
	  else
	    {
	      echo "No Player was Selected";
	    }
	}
    }
  
  echo "</td></tr></table>\n";
}  // main if
else
{
  echo "You are not logged in";
}

//include('interface/footer.php');
?>
