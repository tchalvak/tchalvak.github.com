<?php
session_start();
$alive      = true;
$private    = true;
$quickstat  = "player";
$page_title = "Your Skills";

include "interface/header.php";
?>
  
<span class="brownHeading">Skills</span>

<p>

<?php
$level = $_SESSION['level'];
$class = $_SESSION['class'];

$row = $sql->data;
if ($class != "")
{
  echo "You are a level $level, $class Ninja.<br /><br />\n";

  if ($class == "Black")
    {
      echo "<form action=\"skills_mod.php\" method=\"post\">\n";
      echo "<input type=\"submit\" name=\"command\" value=\"Stealth\" class=\"formButton\" />\n";
      echo "set to    <select name=\"mode\">n";
      echo "<option value=\"1\">Stealth Mode</option>\n";
      echo "<option value=\"0\">Normal Mode</option>\n";
      echo "</select> Turn Cost: 5 to Stealth, 0 to Unstealth\n";
      echo "</form><br />By selecing Stealth you will go into a mode where enemies can not hurt directly attack you, even in combat you initate. <a href=\"about.php#skills\">(help)</a>\n";
    }
  else
    {
      echo "You do not have any skills you can use on your self.\n";
    }
}
else
{
  echo "You do not possess a class, you must have signed up before classes where implemented.<br /><br /> Please inform <a href=\"mailto:Admin@NinjaWars.net?subject=Change My Ninja Class\">Admin</a> of which class(currently Red,White,Blue,Black) you want to be or it will be choosen later on.\n";
}
?>

<br /><br />

<a href="list_all_players.php?hide=dead">Use a Skill on a ninja?</a>
<form action="list_all_players.php" method="get">
<input type="text" name="searched" style="font-family:Verdana, Arial;font-size:xx-small;" />
<input type="hidden" name="hide" value="dead" />
<input type="submit" value="Search for Ninja" class="formButton" />
</form>

<hr />

<a href="about.php#magic">Magic Skills List</a>

</p>

</php
include "interface/footer.php";
?>

