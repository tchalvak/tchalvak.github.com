<?php

include 'Agenda.php';

$agenda = new Agenda();

$agenda->setName('Hostile Takeover');
$agenda->setDifficulty(3);
$agenda->setAttribute(0,5);

$name = $agenda->getName();
$difficulty = $agenda->getDifficulty();
$gain = $agenda->getAttribute(0);

echo $name.'<br/>';
echo $difficulty.'<br/>';
echo 'Number of bits gained for completing: '.$gain.'<br/>';
if ($agenda->isComplete())
{
	echo 'This agenda has been completed.<br/>';
}
else
{
	echo 'This agenda has not been completed<br/>';
}

$agenda->setCompleted(1);

if ($agenda->isComplete())
{
	echo 'This agenda has been completed.<br/>';
}
else
{
	echo 'This agenda has not been completed<br/>';
}
?>