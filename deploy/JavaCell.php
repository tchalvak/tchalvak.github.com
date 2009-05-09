<?php


class JavaCell
{

	private $m_id; 	// int.
	private $m_displayType; // int.  The type of display, e.g. text, image, etc.
	private $m_position; // int. The position number of the cell.
	private $m_name; // string.
	private $m_shape; // int.
	private $m_image; // string path. Path to the image to be displayed in the cell.
	private $m_link; // string path.  Url that the cell links to.
	private $m_orientation; // int. From 0 to 360.
	private $m_height; // int. Height in smallest units, expandable.
	private $m_width; // int. Width in smallest units, expandable.
	private $m_unitType; // string.  CSS unit type to display the cell with.
	private $m_xCoOrd; // int.  X row location within the grid.
	private $m_yCoOrd; // int.  Y column location within the grid.
	private $m_importance; // *** Determines precedence in the movement of the cells.

	public function __construct()
	{
	}
	
	public function getID()
	{
		return $this->m_id;
	}
	
	public function setID($id)
	{
		$this->m_id = $id;
	}
	
	public function setDisplayType($type)
	{
		$this->m_displayType = $displayType;
	}
	
	public function getDisplayType()
	{
		return $this->m_displayType;
	}
	
	public function getPosition()
	{
		return $this->m_position;
	}
	
	public function getName()
	{
		return $this->m_name;
	}
	
	public function setName($name)
	{
		$this->m_name = $name;
	}
	
	public function getColor()
	{
		return $this->m_color;
	}
	
	public function setColor($color)
	{
		$this->m_color = $color;
	}
	
	public function getShape()
	{
		return $this->m_shape;
	}
	
	public function getImage()
	{
		return $this->m_image;
	}
	
	public function setImage($imagePath)
	{
		$this->m_image = $imagePath;
	}
	
	public function getLink()
	{
		return $this->m_link;
	}
	
	public function setLink($link)
	{
		$this->m_link = $link;
	}
	
	public function getOrientation()
	{
		return $this->m_orientation;
	}
	
	public function getHeight()
	{
		return $this->m_height;
	}
	
	public function setHeight($height)
	{
		$this->m_height = (int) $height;
	}
	
	public function getWidth()
	{
		return $this->m_width;
	}
	
	public function setWidth($width)
	{
		$this->m_width = (int) $width;
	}
	
	public function getUnitType()
	{
		return $this->m_unitType;
	}
	
	public function setUnitType($unitType)
	{
		$this->m_unitType = (string) $unitType;
	}
	
	public function getX()
	{
		return $this->m_xCoOrd;
	}
	
	public function setX($x)
	{
		$this->m_xCoOrd = (int) $x;
	}
	
	public function getY()
	{
		return $this->m_yCoOrd;
	}
	
	public function setY($y)
	{
		$this->m_yCoOrd = (int) $y;
	}
	
	public function getImportance()
	{
		return $this->m_importance;
	}
	
	public function display($xPos, $yPos)
	{
		$name = $this->getName();
		$link = $this->getLink();
		$id = $this->getID();
		$unitType = $this->getUnitType();
		$width = $this->getWidth();
		if (!$width)  {$width=1;}
		$height = $this->getHeight();
		if (!$height)  {$height=1;}
		$imagePath = $this->getImage();
		
		echo 
			"
				<div onclick='document.location = \"".$link."\"' class='cell' style='top: ".$height*$yPos."px;left: ".$width*$xPos."px;width:".$width.$unitType.";height:".$height.$unitType.";background-image:url(".$imagePath.");' id='cell".$id."' title='".(isset($name)? $name : '')."'>&nbsp;
				</div>
			";
		
	}
}

?>
