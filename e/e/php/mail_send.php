<?php
session_start();
$alive      = false;
$private    = true;
$quickstat  = false;
$page_title = "Send Mail";

include "interface/header.php";
?>

<span class="brownHeading">Mail</span>

<br /><br />

<?php
$to = $_GET['to'];
if ($_GET['to'] == "") {$to = $_POST['to'];}


if ($to == "") { die("This message has no recipent.\n");}
$messenger = $_GET['messenger'];
$message   = $_GET['message'];

if ($message == "") {die("Your message was blank.\n");}

if ($messenger == 1)
{
  if ($to == "SysMsg") {die("SysMsg is a bot, do not email SysMsg.\n");}
  $message = str_replace("fuck", "(filter)", $message);
  $message = str_replace("bitch", "(filter)", $message);
  $message = str_replace("cock", "(filter)", $message);
  $message = str_replace("cunt", "(filter)", $message);
  $message = str_replace("pussy", "(filter)", $message);
  $message = str_replace("bitch", "(filter)", $message);
  $message = str_replace("whore", "(filter)", $message);
  
  $message = str_replace("fellatio", "(filter)", $message);
  $message = str_replace("sodomy", "(filter)", $message);
  $message = str_replace("shit", "(filter)", $message);
  $message = str_replace("spic", "(filter)", $message);
  $message = str_replace("tit", "(filter)", $message);
  
  $message = str_replace("twat", "(filter)", $message);
  
  $message = str_replace("naked", "(filter)", $message);
  $message = str_replace("ass ", "(filter)", $message);
  $message = str_replace("ass.", "(filter)", $message);
  $message = str_replace("cornhole", "(filter)", $message);
  
  $message = str_replace("virgin", "(filter)", $message);
  $message = str_replace("hell", "(filter)", $message);
  $message = str_replace("ass", "(filter)", $message);
  
      
  $message = str_replace("rimjob", "(filter)", $message);
  $message = str_replace("masturbation", "(filter)", $message);
  $message = str_replace("clit", "(filter)", $message);
  
  $message = str_replace("damn", "(filter)", $message);
  $message = str_replace("skank", "(filter)", $message);
  $message = str_replace("hoe", "(filter)", $message);
  $message = str_replace("nigga", "(filter)", $message);
  $message = str_replace("nigger", "(filter)", $message);
  $message = str_replace("cracker", "(filter)", $message);
  $message = str_replace("dick", "(filter)", $message);
  
  if ($to == "clansend")
    {
      $clan = getClan($_SESSION['username']);
      $loop_sql = $sql;
      $loop_sql->QueryRow("SELECT * FROM players WHERE clan = '$clan'");
      $row = $loop_sql->data;

      for ($i = 0; $i < $loop_sql->rows; $i++)
	{
	  $loop_sql->Fetch($i);
	  $name = $loop_sql->data[0];
	  echo "Sending mail to: $name<br />\n";
	  sendMessage($_SESSION['username'],$name,$message);
	}
      die("<br /><a href=\"mail_read.php\">Go to Your Mail</a><br /><br /><a href=\"clan.php\">Return to Clan Options</a>\n");
    }
  
  if ($to != "clansend") {sendMessage($_SESSION['username'],$to,$message);}

  echo "A messenger takes your message and will deliver your mail <br />From: ".$_SESSION['username']." <br />TO: $to <br />Message: $message<br /><br />\n";
  echo "<a href=\"player.php?player=$to\">Return to Player Detail</a>";
}
else
{
  "You need to give your message to a <a href=\"mail.php\">messenger</a> for delivery.";
}

include "interface/footer.php";
?>

