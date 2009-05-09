<?php
session_start();
$private    = true;

include "interface/header.php";
?>

<span class="brownHeading">Change Class</span>

<p>
<?php
$member = $sql->QueryItem("SELECT member FROM players WHERE uname = '".$_SESSION['username']."'");

if ($member == 0)
{
  echo "You are not a paid member.\n";
}
else
{
  if  ($changeclass == 1)
    {
      if ($newclass != "")
	{
	  $_SESSION['class'] = $newclass;
	  $sql->Update("UPDATE players SET class = '$newclass' WHERE uname = '".$_SESSION['username']."'");
	  echo "Your class has been changed to $newclass.\n";
	}
      else
	{
	  echo "Cannot enter a blank class.\n";
	}
    }
  else
    {
  ?>

<form action="change_class.php" method="post">
<select name="newclass">
  <option selected value="">Pick a Class</option>
  <option value="Red">Red</option>
  <option value="Blue">blue</option>
  <option value="Black">Black</option>
  <option value="White">White</option>
  <option value="Thief">Thief</option>
  <option value="Undead">Undead</option>
</select>
<input type="hidden" name="changeclass" value="1" />
<input type="submit" value="Change Your Class" class="formButton" />
</form>

<?php
   }
  echo "<hr />\n";
  echo "If you require account help, email: <a href=\"mailto:Admin@ninjawars.net\">Admin NinjaLord</a>\n";
}

include "interface/footer.php";
?>

