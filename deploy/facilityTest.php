<?php

include 'Agenda.php';
include 'Facility.php';

/******** Agenda ********/


$agenda = new Agenda();

$agenda->setName('Hostile Takeover');
$agenda->setDifficulty(3);
$agenda->setAttribute(0,5);




/******* Facility *******/

$facility = new Facility();

$facility->setName('Facility #1');
$facility->setCost(5);
$facility->setAgenda($agenda);


/******* Output ********/

echo $facility->getName().'<br/>';
echo $facility->getCost().'<br/><br/>';
if ($facility->getAgenda() == null)
{
	echo 'There is no agenda at this faciliity<br/>';
}
else
{
	echo 'Agenda<br/>';
	echo $agenda->getName().'<br/>';
	echo $agenda->getDifficulty().'<br/>';
	echo 'Number of bits gained for completing: '.$agenda->getAttribute(0).'<br/>';

	if ($agenda->isComplete())
	{
		echo 'This agenda has been completed.<br/>';
	}
	else
	{
		echo 'This agenda has not been completed<br/>';
	}
}



?>