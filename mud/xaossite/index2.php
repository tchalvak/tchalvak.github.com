<html><head>
<?php
  if (!($page)){
    $page = "index";
  }
  echo("<title>XaosMUD <xaos-mud.org:5000> ::/".$page."</title>");
?>
<?php include("includes/index.css");?>
<script src="includes/popup.js" type="text/javascript"></script>
</head>

<body>
<center>
<img src="images/xaosheader.jpg"><p>

<!-- %%%%%%%%%%%% MENU -->

<table border="0" cellpadding="2" cellspacing="1" width=700 style = "border:solid 1px black; background-color: #F1F1F1;">

<tr>
	<td align = "center"><a href="index.php" class = "hoverMenu">       Home</a></td>
  <td align = "center"><a href="index.php?page=rules" class = "hoverMenu">       Rules</a></td>
  <td align = "center"><a href="index.php?page=factions" class = "hoverMenu">               Factions</a></td>
	<td align = "center"><a href="index.php?page=classes" class = "hoverMenu">     Classes</a></td>
	<td align = "center"><a href="index.php?page=races" class = "hoverMenu">       Races</a></td>
	<td align = "center"><a href="index.php?page=deities" class = "hoverMenu">     Deities</a></td>
	<td align = "center"><a href="index.php?page=gallery" class = "hoverMenu">   Galleries</a></td>
	<td align = "center"><a href="forum/" class = "hoverMenu">   Forums</a></td>
	<td align = "center"><a href="index.php?page=connect" class = "hoverMenu">     Connect</a></td>
	<td align = "center"><a href="index.php?page=contact"  class = "hoverMenu">              Contact</a></td>
</tr></table>
</td></tr>
<tr><td>


<!-- %%% CONTENT -->
<table border="0" cellpadding="2" cellspacing="1" width=700 style="border:solid 1px black; background-color:#FFFFFF; margin-top:3px;">
<tr><td>
    <?php
      if (!($page)){
        echo("<center><font style=\"font-size: 8pt;\">Click the links to navigate through the site</font></center>");
      }else{
        $fname = $page.".idx";
        if (!file_exists($fname)){
          echo("<center><font style=\"font-size: 8pt;\">Section ".$page." not found!</font></center>");
          
        }else{
          include($fname);
        }
      }   
      ?>
</td></tr>
</table>


<!-- %%% FOOTER -->
<table border="0" cellpadding="2" cellspacing="1" width=700 style="border:solid 1px black; background-color:#F1F1F1; margin-top:3px;">
<tr><td align = center>
<font style = "font-size:7pt;">
This page and its contents &copy;2004 XaosMUD unless otherwise specified.
Questions? Comments? <a href="mailto:xaos@xaos-mud.org">Contact us</a>
</td></tr>
</table>

</body></html>
