<?php


/*
* // *** Standin for javascript grid drawing class.
*/
class JavaGrid
{
	public $m_id;		// *** int.
	public $m_length;	// *** int. In smallest units.
	public $m_width;	// *** int. In smallest units.
	public $m_positionedCells;	// *** Cell[]. Indexed by position.
	public $m_unpositionedCells;	// *** Cell[]. Indexed by position.
	
	public function __construct(){}
	
	public function getID()
	{
		return $this->m_id;
	}
	
	public function getLength()
	{
		return $this->m_length;
	}
	
	public function getWidth()
	{
		return $this->m_width;
	}
	
	public function getCells($unpositioned=FALSE)
	{
		if ($unpositioned)
		{
			return $this->m_unpositionedCells;
		}
		else
		{
			return $this->m_positionedCells;
		}
	}
	
	public function setCells($cells)
	{
		$positionedCells = array();
		$unpositionedCells = array();

		if (!is_array(reset($cells)))
		{
			foreach ($cells AS $loopACell)
			{
				$positionedCells[$loopACell->getY()][$loopACell->getX()] = $loopACell;
				$unpositionedCells[$loopACell->getID()] = $loopACell;
			}
		}
		else // The cells aren't indexed by ID, they're positioned.
		{
			foreach ($cells AS $loopRow)
			{
				foreach ($loopRow AS $loopSingle)
				{
					$positionedCells[$loopSingle->getY()][$loopSingle->getX()] = $loopSingle;
					$unpositionedCells[$loopSingle->getID()] = $loopSingle;
				}
			}
		}

		$this->m_positionedCells = $positionedCells;
		$this->m_unpositionedCells = $unpositionedCells;
	}
	
	public function getACellByPosition($x, $y)
	{
		return $this->m_positionedCells[$y][$x];
	}

	public function setContainerStart($start)
	{
		$this->m_containerStart = $start;
	}
	
	public function getContainerStart()
	{
		return $this->m_containerStart;
	}
	
	public function setContainerEnd($end)
	{
		$this->m_containerEnd = $end;
	}
	
	public function getContainerEnd()
	{
		return $this->m_containerEnd;
	}
	
	public function drawGrid()
	{
		$cells = $this->getCells();
/*
		echo '<pre>';
		var_dump($cells);
		echo '</pre>';	
*/
		$yCoordinatesOfCells = array_keys($cells);
		foreach ($yCoordinatesOfCells AS $loopYCoord)
		{
			$rowOfCells = $cells[$loopYCoord];
			$xCoordinatesOfCells = array_keys($rowOfCells);
			echo $this->getContainerStart();
			foreach ($xCoordinatesOfCells AS $loopXCoord)
			{
				$singleCell = $cells[$loopYCoord][$loopXCoord];
				$singleCell->display($loopXCoord, $loopYCoord);
			}
			echo $this->getContainerEnd();
		}
		/*foreach ($cells AS $loopCellYPosition => $loopCellRow)
		{
			echo $this->getContainerStart();
			foreach ($loopCellRow AS $loopCellXPosition => $loopACell)
			{
				$loopACell->display();
			}
			echo $this->getContainerEnd();
		}*/
	}
}

?>
