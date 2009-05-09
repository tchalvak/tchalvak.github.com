<?php
session_start();
import_request_variables("gP","");
include('../db/util.php');

$sql = new MySQL_class;
$sql->Create("ninjawar_nwtest");
//$sql->Create("crux");
?>




<?php



    $l_result= mysql_query("select pname from admins where uname='$adminname' and pname='$password1'") or die;
    $login = mysql_num_rows($l_result);

               if ($login != "0")  // check login info is correct

                 {
             //echo "<br><br>login sucessful";

                  $_SESSION['adminname'] = $adminname;
                  //session_register("$username");
                  echo "Logging you in: " . $_SESSION['adminname'] . "";

                  echo "<br><br>You are now logged in goto <a href='control.php'>Control</a><br><br>";


                  }
                  else { echo "password incorrect  Click <a href='login.php'>here</a> to login";}

?>

<br><br><br><br><br><br>     <br><br><br>
<?php


?>
