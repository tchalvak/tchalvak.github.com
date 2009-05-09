<?php
session_start(); // *** If session isn't already started.

//include_once('Grid.php');
include_once('JavaGrid.php');
//include_once('Cell.php');
include_once('JavaCell.php');

//get information from form
$requestArray = array('cellID', 'destroySession');
foreach ($requestArray as $key => $name) 
{
	$$name = ( isset($_REQUEST[$name]) ? $_REQUEST[$name] : null);
}

if ($destroySession) // *** For testing purposes.
{
	session_destroy();
}

//var_dump($_SESSION['startingCellID']);
//var_dump($_SESSION['endingCellID']);

// *** Gets the movement candidates, if any.
$startingCellID = (isset($_SESSION['startingCellID'])? $_SESSION['startingCellID'] : NULL);
$endingCellID = (isset($_SESSION['endingCellID'])? $_SESSION['endingCellID'] : NULL);

$cellsWereInSession = FALSE;
$cells = (isset($_SESSION['cells'])? unserialize($_SESSION['cells']) : NULL);
if ($cells)
{
	$cellsWereInSession = TRUE;
}

$startingCell = NULL; // *** Will eventually become cell objects.
$endingCell = NULL; // *** Will eventually become the cell objects.

// *** Sets the movement candidates.
//var_dump(!is_numeric($startingCellID));
//echo 'Debug: Starting Cell ID';
//var_dump($startingCellID);
if (!is_numeric($startingCellID) && is_numeric($cellID)) // *** If there isn't already a starting, set it.
{
	$startingCellID = $cellID;
	$_SESSION['startingCellID'] = $startingCellID;
}
elseif (is_numeric($cellID)) // *** Set the ending cell.
{
	$endingCellID = $cellID;
	$_SESSION['endingCellID'] = $endingCellID;
}
//	var_dump($cellID);
//	echo 'StartingCellID';
//	var_dump($_SESSION['startingCellID']);
//	var_dump($startingCellID);
//	echo 'EndingCellID';
//	var_dump($_SESSION['endingCellID']);
//	var_dump($endingCellID);



if (!is_array($cells))
{
	$images = array(
		0 => array('Portal', 'bluePortal.gif')
		, 1 => array('Tree', 'tree.jpg')
		, 2 => array('Stone', 'stone.jpg')
	);
	$cell = new JavaCell();
	$cell->setImage('bluePortal.gif');
	$cell->setID(1);
	$cell->setName('Portal');
	$cell->setUnitType('px');
	$cell->setHeight(100);
	$cell->setWidth(100);
	$cell->setX(0);
	$cell->setY(0);

	// *** Hack to create the initial list of cells.
	$max = 200;
	$i = 0;
	$rowWidth = 10;
	while($i < $max)
	{
		$localCell = clone $cell;
		$localCell->setY($i/$rowWidth);
		$localCell->setX($i%$rowWidth);
		$localCell->setID($i+1);
		$rand = rand(0,2);
		$localCell->setImage($images[$rand][1]);
		$localCell->setName($images[$rand][0]);
		$localCell->setLink('map.php?cellID='.$localCell->getID());
		if ($i == 0)
		{
			$localCell->setImage('monkey.gif');
			$localCell->setName('Monkey');
		}
		$cells[$localCell->getID()] = $localCell;
		$i++;
	}
}// *** End of check for pre-existing cells.

$grid = new JavaGrid();
$grid->m_length='100';
$grid->m_width='100';

// *** Section that determines the movement of cells...
$moveCells = is_numeric($startingCellID) && is_numeric($endingCellID);
if ($moveCells)
{
	$grid->setCells($cells);
	$cells = $grid->getCells($unpositioned=TRUE);

	$startingCell = $cells[$startingCellID];
	$endingCell = $cells[$endingCellID];
	
	// *** Get the starting positions.
	$startingX = $startingCell->getX();
	$startingY = $startingCell->getY();
	
	$endingX = $endingCell->getX();
	$endingY = $endingCell->getY();
	
	// *** Change to final positions. Since objs are by referrence, that should change 'em in array also.
	$startingCell->setX($endingX);
	$startingCell->setY($endingY);
	
	$endingCell->setX($startingX);
	$endingCell->setY($startingY);
	
	//echo '<pre>';
	//var_dump('DEBUG NonNulls: ');
	//var_dump($startingCell);
	//var_dump($endingCell);
	//die();
	
	unset($_SESSION['startingCellID']);
	unset($_SESSION['endingCellID']);
	
	//var_dump('DEBUG NULLS: ');
	//var_dump($_SESSION['startingCellID']);
	//var_dump($_SESSION['endingCellID']);
	//var_dump('The movement section got hit, but did not work right!!');
	//session_destroy();
}

$grid->setCells($cells);
$_SESSION['cells'] = serialize($grid->getCells()); // *** Puts the modified cells into the session to store them.
$grid->setContainerStart('<div class="row">');
$grid->setContainerEnd('</div>');




echo '<html>';
echo '  <head>';
echo '  <title>';
echo '    Map';
echo '  </title>';
echo '  <link rel="stylesheet" type="text/css" href="map.css">';
echo '  </head>';
echo '<body>';
echo '<div>';

echo '      <div id="movement" style="color:green">&nbsp;';
if ($moveCells)
{
      echo '        Moving '.$startingCell->getName().' to '.$endingCell->getName().'.';
}
echo '                </div>';


$grid->drawGrid();

echo "<div style='clear:both'><a href=map.php?destroySession=1>Reset Map</a></div>";


		echo '</div>';
	echo '</body>';
echo '</html>';



?>
