<?php
//require_once(SERVER_ROOT.'Square.php');

/*
* The grid class is the php version of the javascript standin JavaGrid.
*/
class Grid
{
	public $m_id;		// *** int.
	public $m_length;	// *** int. In smallest units.
	public $m_width;	// *** int. In smallest units.
	public $m_cells;	// *** Cell[]. Indexed by position.
	public $m_containerStart; // *** String. Start of a row.
	public $m_containerEnd; // *** String. End of a row.
	
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
	
	public function getCells()
	{
		return $this->m_cells;
	}
	
	public function setCells($cells, $preGridded=FALSE)
	{
		$positionedCells = array();
		if (is_array($cells)) // *** Wipe old cells from grid.
		{
			$this->m_cells = NULL;
		}
		foreach ($cells AS $loopACell)
		{
			$positionedCells[$loopACell->getY()][$loopACell->getX()] = $loopACell;
		}
		$this->m_cells = $positionedCells;
	}
	
	public function getACellByPosition($x, $y)
	{
		return $this->m_cells[$y][$x];
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
		//var_dump($cells);
		foreach ($cells AS $loopCellYPosition => $loopCellRow)
		{
			$this->getContainerStart();
			foreach ($loopCellRow AS $loopCellXPosition => $loopACell)
			{
				$loopACell->display();
			}
			$this->getContainerEnd();
		}
	}
}

?>
