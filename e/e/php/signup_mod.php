<?php
session_start();
$alive      = false;
$private    = false;
$quickstat  = false;
$page_title = "Sign Up for NinjaWars";

include "interface/header.php";
?>
  
<span class="brownHeading">Signing Up</span>

<hr />

<?php
$send_name  = $_POST['send_name'];
$send_pass  = $_POST['send_pass'];
$send_class = $_POST['send_class'];
$send_email = $_POST['send_email'];

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: SysMsg <SysMsg@NinjaWars.net>\r\n";

if ($send_name != "" && $send_pass != "" && $send_email != "" && $send_class != "")
{
  $check_name  = $sql->QueryItem("SELECT count(uname) FROM players WHERE uname = '$send_name'");
  $check_email = $sql->QueryItem("SELECT count(email) FROM players WHERE email = '$send_email'");

  if (substr($send_name,0,1)!=0)
    {
      echo "Phase 1 Incomplete: Your ninja name may not start with a number.\n";
    }
  else
    {

      echo "Phase 1 Complete: All fields were filled in.<hr />\n";

      if ($check_name == 0 && $check_email == 0)
	{
	  echo "Phase 2: Username/Email is unique.<hr />\n";
	  echo "Phase 3: When you receive an email from SysMsg, it will descirbe how to activate your account.<br /><br />\n";
	  
	  $confirm = rand(1000,9999); //generate confirmation code
	  $sql->Insert("INSERT INTO players VALUES ('$send_name','$send_pass','150','5','50','','0','20','','0','$send_email','$send_class','1','0','0','0','','0','','')");
	  $sql->Update("UPDATE players SET confirm = '$confirm' WHERE uname = '$send_name'");
	  mail("$send_email", "NinjaWars Account Sign Up", "Thank you for signing up for Ninja Wars.<br /><br /> I am SysMsg, the email presence of NinjaWars. <br /><br /> Any emails you receive from the game will come from me. Please click on the link below to confirm your account<br /><br /><br /><a href=\"http://www.ninjawars.net/webgame/confirm.php?username=$send_name&confirm=$confirm\">Confirm Account</a><br />Or Paste this link http://www.ninjawars.net/webgame/confirm.php?username=$send_name&confirm=$confirm into your browser<br />If you require help use the forums at http://www.ninjawars.net/forum/<br /><br /><b>Account Info</b><br />Username: $send_name<br />Level: 1<br />Password: $send_pass<br />Class: $send_class Ninja","$headers");
	  
	  echo "Confirmation email has been sent to $send_email.\n";
	  echo "<br /><br />Please only sign up one account.\n";
	}
      else
	{
	  $what = ($check_email != 0 ? "Email" : "Username");
	  
	  echo "Phase 2 Incomplete: $what not unique. Please retry.\n";
	}
    }
}
else
{
  echo "Phase 1 Incomplete: You did not fill out all the necessary information.\n";
}
?>
<br /><br />
<a href="signup.php">Return to Sign Up ?</a>


<?php
include "interface/footer.php";

/*
function checkEmail($Email) { 
 
//Debug or not? 
$debug = 0; 
 
//Do the basic Reg Exp Matching for simple validation 
if (eregi("^[a-zA-Z0-9_]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$]", $Email)) {  
return FALSE;  
} 
 
//split the Email Up for Server validation 
list($Username, $Domain) = split("@",$Email); 
 
//If you get an mx record then this is a valid email domain 
if(getmxrr($Domain, $MXHost)) { 
return TRUE; 
if($debug == 1) { echo "$Domain<BR>getmxrr worked."; } 
} 
else {  
//else use the domain given to try and connect on port 25 
//if you can connect then it's a valid domain and that's good enough 
if(checkdnsrr($Domain.'.', "A")) { 
$ip = gethostbyname($Domain); 
 
//This is to counteract the effects of the Verisign .com .net unregistered email grab 
if($ip == "64.94.110.11") { 
if($debug == 1) { echo "$Domain<BR>is invalid. Verisign returned."; } 
return FALSE; 
} 
else { 
if($debug == 1) { echo "$Domain<BR>fsockopen worked. Verisign wasn't the IP."; } 
return TRUE; 
} 
} 
else { 
return FALSE;  
} 
} 
}
*/

?>
