<?php

include 'Agenda.php';
include 'Facility.php';

/******** Agenda ********/


$agenda = new Agenda();

$agenda->setName('Hostile Takeover');
$agenda->setDifficulty(3);
$agenda->setAttribute(0,5);
$agenda->setLevel(0);

/********* Facility ******/

$facility = new Facility();
$facility->setName('Mutual Fund');
$facility->setCost(4);
$facility->setAttribute(0,1);
/******** Corp *********/

$BANK;

switch ($_GET['cmd'])
{
	case 'new' :
		$BANK = 5;
		echo "Your Bank is: ".$BANK."<br/>";
		echo "You have No Facilities<Br/>";
		if ($facility->getCost() <= $BANK)
		{
			echo "<form name='input' action='playCorp.php?cmd=build&bank=".$BANK."&facility=1' method='post'>";
			echo "<input type='submit' value='Build Facility (".$facility->getCost().")'>";
			echo "</form>";
		}
		echo  "<form name='input' action='playCorp.php?cmd=start&bank=".$BANK."&facility=0' method='post'>";
		echo "<input type='submit' value='Start Agenda'>";
		echo '</form>';
		break;

	case 'build' :
		$BANK = $_GET['bank'];
		$built = $_GET['facility'];
		$BANK -= $facility->getCost();

		echo "Your Bank is: ".$BANK."<br/>";
		if ($built)
		{
			echo "You have purchased ".$facility->getName()."<br/>";
		}

		echo  "<form name='input' action='playCorp.php?cmd=start&bank=".$BANK."&facility=".$built."' method='post'>	<input type='submit' value='Start Agenda'>	</form>";
		break;

	case 'start' :
		$BANK = $_GET['bank'];
		$built = $_GET['facility'];
		echo "Your Bank is: ".$BANK."<br/>";
		if ($built)
		{
			echo "You have purchased ".$facility->getName()."<br/>";
		}
		echo "You have started ".$agenda->getName()." at Level ".$agenda->getLevel();

		echo "<form name='input' action='playCorp.php?cmd=advance&bank=".$BANK."&level=".$agenda->getLevel()."&facility="
		.$built."' method='post'><input type='submit' value='Advance Agenda (1)'></form>";
		break;

	case 'advance' :

		if ($agenda->getDifficulty() <= $_GET['level']+1)
		{
			$BANK = $_GET['bank'];
			$BANK -= 1;
			$built = $_GET['facility'];
				
			echo "You have Scored ".$agenda->getName()."<br/><br/>";
			$BANK += $agenda->getAttribute(0);
			$agenda = new Agenda();

			if ($built)
			{
				$BANK += $facility->getAttribute(0);
			}

			echo "Your Bank is ".$BANK."<br/>";

			if ($BANK >= 10)
			{
				echo 'You win!<br/>';

				echo "<form name='input' action='playCorp.php?cmd=new' method='post'>	<input type='submit' value='Play Again'>	</form>";
			}

			else
			{
				if ((!$built) && ($facility->getCost() <= $BANK))
				{
					echo "<form name='input' action='playCorp.php?cmd=build&bank=".$BANK."&facility=1' method='post'>";
					echo "<input type='submit' value='Build Facility (".$facility->getCost()."'>";
					echo "</form>";
				}
				echo  "<form name='input' action='playCorp.php?cmd=start&bank=".$BANK."&facility=".$built."' method='post'>	<input type='submit' value='Start Agenda'>	</form>";
			}
		}
		else
		{
			$BANK = $_GET['bank'];
			$BANK -= 1;
			$built = $_GET['facility'];
			$agenda->setLevel($_GET['level']+1);
			

			echo "Your Bank is: ".$BANK."<br/>";

			if ($built)
			{
				echo "You have purchased ".$facility->getName()."<br/>";
			}

			echo "You have advanced ".$agenda->getName()." to Level ".$agenda->getLevel();

			echo "<form name='input' action='playCorp.php?cmd=advance&bank=".$BANK."&level=".$agenda->getLevel()."&facility=".$built."' method='post'><input type='submit' value='Advance Agenda (1)'></form>";
		}
		break;
}
