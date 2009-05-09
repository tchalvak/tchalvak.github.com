<?
include('interface/header.php');

$socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP); // Create the Socket 
$connection = socket_connect($socket,'irc.freenode.net',6667); // Connect to freenode 
socket_write($socket,"USER RHAP RHAP RHAP :RHAP\r\n"); // Send the Username to freenode 
socket_write($socket,"NICK Iris-Bot \r\n"); // Change our nickname 
socket_write($socket,"JOIN #ZODI \r\n"); // Join the channel PHPFREAKS!!! 
while($data = socket_read($socket,2046)) // read whatever IRC is telling us 
{ 
echo $data; 
if (stristr($data, 'iris dump'))
{socket_write($socket,"NICK Zodi-bot\r\n"); }

//if (stristr($data, 'nick'))
//{ $new_nick = stristr($data, 'nick');socket_write($socket,"NICK $new_nick\r\n"); }

if (stristr($data, 'slap'))
{ $slapped = stristr($data, 'slap');socket_write($socket,"PRIVMSG #ZODI Slaps $slapped \r\n"); }

if (stristr($data, 'quit'))
{ $quit = stristr($data, 'quit');socket_write($socket,"QUIT Iris Logging Off \r\n"); }

if (stristr($data, 'speak'))
{ $say = strrchr($data, 'speak'); ;socket_write($socket,"PRIVMSG #ZODI $say \r\n"); }

if (stristr($data, 'list_ninja'))
{ $sql->Query("select uname from players limit 10");$row = $sql->data;
$row = $sql->data;
socket_write($socket,"PRIVMSG #ZODI Ninja Found: $sql->rows\r\n");  
for ($i = 0; $i < $sql->rows; $i++) {
    $sql->Fetch($i);
    $name = $sql->data[0]; sleep(500);socket_write($socket,"PRIVMSG #ZODI $name \r\n"); 
} //end for
}





} //end socket loop

?>
