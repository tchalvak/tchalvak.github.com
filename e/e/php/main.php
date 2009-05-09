<?php
session_start();
$alive      = false;
$private    = false;
$quickstat  = false;
$page_title = "Main";

include "interface/header.php";
?>

Welcome to <span class="brownHeading">Ninja Wars</span>

<br /><br />

<span class="brownHeading">Ninja Wars</span> is an online game where you battle players all over the world. <a href="about.php">(more)</a>

<br /><br />

<a href="signup.php">Sign up</a> for the alpha/beta test.

<br /><br />

<a href="news.php">News</a> - Find out whats new in NW

<br /><br />

<a href="members.php">Members</a>  - NW needs your support to survive. <a href="donate.php">Donate</a>

<br /><br />

<a href="lostpass.php">Lost Your Password ?</a>

<br />

<a href="lostconfirm.php">Didn't get your confirmation code ?</a>

<br /><br />

<a href="http://ninjawars.proboards19.com" target="_blank">New Message Board</a>

<br /><br />

<a href="village.php">New In-Game Chat</a>

<br /><br />

<a href="http://www.bbgdev.com/interviews.php?vid=4" target="_blank">Interview with the creator of NinjaWars on www.bbgdev.com</a>

<br /><br />

<a href="vote.php">Vote for Ninja Wars</a>

<br /><br />

<hr />

<?php
include "interface/footer.php";
?>