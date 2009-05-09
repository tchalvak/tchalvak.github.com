<?php
/************************/
/*		Facility Class	*/
/************************/
//	This class will be used for marking generic Facilities for use by the Corp.
//	Each Facility will have an array of ICE, as well as the ability to have an Agenda.
/************************/


class Facility
{
	private $name;
	private $attributes = array();
	private $ice = array();
	private $cost;
	private $m_agenda;
	
	// Constructor

	function __construct()
	{
		// Setup Attribute Array
		$attributes[0] = 0;		// Gain of having the facility 
		$cost = 0;				// cost = # of bits to build the facility
	}

	//	Accessors

	function getName()
	{
		return $this->name;
	}

	function getCost()
	{
		return $this->cost;
	}

	function getIce($p_index)
	{
		return $this->ice[$p_index];
	}

	function getAttribute($p_index)
	{
		return $this->attributes[$p_index];
	}
	
	function getAgenda()
	{
		return $this->m_agenda;
	}

	//	Mutators

	function setName($p_name)
	{
		$this->name = $p_name;
	}

	function setIce($p_index, $p_ice)
	{
		$this->ice[$p_index] = $p_ice;
	}

	function setCost($p_cost)
	{
		$this->cost = $p_cost;
	}

	function setAttribute($p_index, $p_value)
	{
		$this->attributes[$p_index] = $p_value;
	}
	
	function setAgenda($agenda)
	{
		$this->m_agenda = $agenda;
	}

}

?>
