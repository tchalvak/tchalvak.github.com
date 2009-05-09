<?php
include "interface/header.php";

$sql->Query("DROP TABLE IF EXISTS rankings");

$sql->Query("CREATE TABLE rankings (rank int AUTO_INCREMENT NOT NULL,score int,uname varchar(50),class varchar(10),level smallint,alive tinyint(1),days int,clan varchar(150),PRIMARY KEY (rank))");

include "interface/footer.php";
?>