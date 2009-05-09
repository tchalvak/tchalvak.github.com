<?php
session_start();
$alive      = false;
$private    = true;
$quickstat  = false;
$page_title = "Ninja List";

include "interface/header.php";

$searched   = $_GET['searched'];
$hide       = $_GET['hide'];
$page       = $_GET['page'];

echo "<span class=\"brownHeading\">Ninja List</span><br />\n";

if ($hide == "dead")
{
  echo "<a href=\"list_all_players.php?page=$page&searched=$searched\">(Show dead ninja)</a><br />\n";
  $dead_count = $sql->QueryItem("SELECT count(*) FROM rankings WHERE alive = 0");
}
else
{
  echo "<a href=\"list_all_players.php?page=$page&hide=dead&searched=$searched\">(Hide dead ninja)</a><br />\n";
  $dead_count = 0;
}

$where_clause = "";
if ($searched != "")
{
  $page = "searched";
  if ($searched == 0)
    {
      echo "Searching for: $searched<br />\n";
      echo "<a href=\"list_all_players.php\">Clear Search</a><br /><br />\n";
      
      if (strlen($searched) == 1)
	{
	  $where_clause = "WHERE (uname LIKE '".strtoupper($searched)."%' OR uname LIKE '".strtolower($searched)."%')";
	}
      else
	{
	  $where_clause = "WHERE (uname LIKE '%$searched%')";
	}

      if ($hide == "dead")
	{
	  $where_clause.=" AND alive = 1";
	}
    }
  else
    {
      if ($hide == "dead")
	{
	  $where_clause = "WHERE alive = 1";
	}
    }
}
else
{
  if ($hide == "dead")
    {
      $where_clause = "WHERE alive = 1";
    }
}

echo "<p>\n";

$record_limit = 20;

$query_count  = "SELECT count(*) FROM rankings ".$where_clause;

$totalrows    = $sql->QueryItem($query_count);

$rank = $sql->QueryItem("SELECT rank FROM rankings WHERE uname = '$_SESSION[username]'");

$rank = ($rank > 0 ? $rank : $totalrows+1);

if ($searched > 0)
{
  $page = ceil($searched/$record_limit);
}
else if ($page == "searched")
{
  $page = ($_GET['page'] == "" ? 1 : $_GET['page']);
}
else
{
  $page       = ($_GET['page'] == "" ? ceil(($rank-$dead_count)/$record_limit) : $_GET['page']);
  if ($_GET['page'] == "")
    {
      $page       = ($dead_count > $rank ? 1 : $page);
    }
}

$numofpages = ceil($totalrows/$record_limit);

$limitvalue   = ($page*$record_limit) - $record_limit;

$sql->Query("SELECT * FROM rankings ".$where_clause." LIMIT $limitvalue, $record_limit");

$row = $sql->data;


echo "<form action=\"list_all_players.php\" method=\"get\">\n";
echo "<input type=\"textbox\" name=\"searched\" style=\"font-family:Verdana, Arial;font-size:xx-small;\" />\n";
echo "<input type=\"hidden\" name=\"hide\" value=\"$hide\" />\n";
echo "<input type=\"submit\" class=\"formButton\" value=\"Search for Ninja\" />\n";
echo "</form>\n";

echo "<p>\n";
echo "You may search for ninja by name or numeric rank. If you search for a single letter, you will get all ninja whose names start with that letter.\n";
echo "</p>\n";

if ($sql->rows == 0)
{
  echo "No ninja to display.<br />\n";
  echo "<a href=\"list_all_players.php?hide=$hide\">Back to Ninja List</a>\n";
}
else
{
  if ($searched > 0)
    {
      $searched = "";
    }
  
  echo "<form action=\"list_all_players.php\" method=\"get\">\n";
  
  if($page != 1)
    {
      $pageprev = $page-1;
      echo "<a href=\"list_all_players.php?hide=$hide&page=1&searched=$searched\">First</a> | \n";
      echo("<a href=\"list_all_players.php?page=$pageprev&searched=$searched&hide=$hide\">Previous ".$record_limit."</a>&nbsp;");
    }
  else
    {
      echo "First | \n";
      echo("Previous ".$record_limit."&nbsp;");
    }
  
  echo "<input type=\"hidden\" name=\"hide\" value=\"$hide\" />\n";
  echo "<input type=\"submit\" class=\"formButton\" value=\"Page\" />\n";
  echo "<input type=\"hidden\" name=\"searched\" value=\"$searched\" />\n";
  echo "<input type=\"textbox\" name=\"page\" value=\"$page\" style=\"font-family:Verdana, Arial;font-size:xx-small;\" size=3/>\n";
  
  if(($totalrows - ($record_limit * $page)) > 0)
    {
      $pagenext   = $page+1;
      echo("<a href=\"list_all_players.php?page=$pagenext&searched=$searched&hide=$hide\">Next ".$record_limit."</a>");
      echo " | <a href=\"list_all_players.php?page=$numofpages&hide=$hide&searched=$searched\">Last ($numofpages)</a>\n";
    }
  else
    {
      echo("Next ".$record_limit);
      echo " | Last ($numofpages)\n";
    }
  echo "</form>\n";
  echo "<table cellpadding=\"2\" cellspacing=\"1\" class=\"playerTable\">\n";
  echo "<tr>\n";
  echo "  <th class=\"playerTable\">\n";
  echo "  Rank\n";
  echo "  </th>\n";

  echo "  <th class=\"playerTable\">\n";
  echo "  Name\n";
  echo "  </th>\n";
  
  echo "  <th class=\"playerTable\">\n";
  echo "  Class\n";
  echo "  </th>\n";
  
  echo "  <th class=\"playerTable\">\n";
  echo "  Level\n";
  echo "  </th>\n";
  
  echo "  <th class=\"playerTable\">\n";
  echo "  Alive\n";
  echo "  </th>\n";
  
  echo "  <th class=\"playerTable\">\n";
  echo "  Last Login\n";
  echo "  </th>\n";
  
  echo "  <th class=\"playerTable\">\n";
  echo "  Clan\n";
  echo "  </th>\n";
  echo "</tr>\n";
  
  for ($i = 0; $i < $sql->rows; $i++)
    {
      $sql->Fetch($i);
      $rank = $sql->data[0]; // rank
      $score = $sql->data[1]; // score
      $name = $sql->data[2]; // username
      $class = $sql->data[3]; // class
      $level = $sql->data[4]; // level
      $alive = ($sql->data[5] == 1 ? "Alive" : "Dead"); // alive
      $days = $sql->data[6]; // days
      $clan = $sql->data[7];        // clan
      
      echo "<tr>\n";
      echo "  <td class=\"playerTable\">\n";
      echo "  $rank\n";
      echo "  </td>\n";

      echo "  <td class=\"playerTable\">\n";
      echo "  <a href=\"player.php?player=$name\">$name</a>\n";
      echo "  </td>\n";
      
      echo "  <td class=\"playerTable\">\n";
      echo    $class."\n";
      echo "  </td>\n";
      
      echo "  <td class=\"playerTable\">\n";
      echo    $level."\n";
      echo "  </td>\n";
      
      echo "  <td class=\"playerTable\">\n";
      echo    $alive."\n";
      echo "  </td>\n";
      
      echo "  <td class=\"playerTable\">\n";
      echo    $days." days ago\n";
      echo "  </td>\n";
      
      echo "  <td class=\"playerTable\">\n";
      echo    $clan."\n";
      echo "  </td>\n";
      echo "</tr>\n";
    }
  echo "</table>\n";

  if ($searched > 0)
    {
      $searched = "";
    }

  echo "<form action=\"list_all_players.php\" method=\"get\">\n";

  if($page != 1)
    {
      $pageprev = $page-1;
      echo "<a href=\"list_all_players.php?hide=$hide&page=1&searched=$searched\">First</a> | \n";
      echo("<a href=\"list_all_players.php?page=$pageprev&searched=$searched&hide=$hide\">Previous ".$record_limit."</a>&nbsp;");
    }
  else
    {
      echo "First | \n";
      echo("Previous ".$record_limit."&nbsp;");
    }

  echo "<input type=\"hidden\" name=\"hide\" value=\"$hide\" />\n";
  echo "<input type=\"hidden\" name=\"searched\" value=\"$searched\" />\n";
  echo "<input type=\"submit\" class=\"formButton\" value=\"Page\" />\n";
  echo "<input type=\"textbox\" name=\"page\" value=\"$page\" style=\"font-family:Verdana, Arial;font-size:xx-small;\" size=3/>\n";

  if(($totalrows - ($record_limit * $page)) > 0)
    {
      $pagenext   = $page+1;
      echo("<a href=\"list_all_players.php?page=$pagenext&searched=$searched&hide=$hide\">Next ".$record_limit."</a>");
      echo " | <a href=\"list_all_players.php?page=$numofpages&hide=$hide&searched=$searched\">Last ($numofpages)</a>\n";
    }
  else
    {
      echo("Next ".$record_limit);
      echo " | Last ($numofpages)\n";
    }
}

/*
echo "<br /><br />\n";
echo "</form>\n";
echo "<form action=\"list_all_players.php\" method=\"get\">\n";
echo "<input type=\"textbox\" name=\"searched\" style=\"font-family:Verdana, Arial;font-size:xx-small;\" />\n";
echo "<input type=\"hidden\" name=\"hide\" value=\"$hide\" />\n";
echo "<input type=\"submit\" class=\"formButton\" value=\"Search for Ninja\" />\n";
echo "</form>\n";

echo "<p>\n";
echo "You may search for ninja by name or numeric rank. If you search for a single letter, you will get all ninja whose names start with that letter.\n";
echo "</p>\n";
*/

echo "</p>\n";

include "interface/footer.php";
?>

