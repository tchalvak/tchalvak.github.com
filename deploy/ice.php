<?php
/**
* ICE are defensive corp programs used to prevent runners from getting to the facility defended by the ICE.
*/
class ICE
{
	private $m_name;         ///< String. Name of the ICE
	private $m_cost;         ///< Int. Cost of rezzing the ICE
	private $m_strength;     ///< Int. Strength of the ICE
	private $m_subroutines;  ///< String[]. Names of functions that are the subroutines of the ice, in order

	public function __contsruct()
	{
	}

	public function getName()
	{ return $this->m_name; }

	public function getCost()
	{ return $this->m_cost; }

	public function getStrength()
	{ return $this->m_strength; }

	public function getSubroutines()
	{ return $this->m_subroutines; }

	public function setName($p_name)
	{
		$this->m_name = $p_name;
	}

	public function setCost($p_cost)
	{
		$this->m_cost = $p_cost;
	}

	public function setStrength($p_strength)
	{
		$this->m_strength = $p_strength;
	}

	public function setSubroutines($p_subroutines)
	{
		$this->m_subroutines = $p_subroutines;
	}
}	// *** End Class: ICE ***
?>
