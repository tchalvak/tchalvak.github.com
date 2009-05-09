<?php
/************************/
/*		Agenda Class	*/
/************************/
//	This class will be used for marking generic Agenda's for use by the Corp.
//	Each Agenda will have an array of attributes, dictating what the in game changes are once the agenda in scored.
/************************/


class Agenda
{
	private $name;
	private $attributes = array();
	private $ice = array();
	private $difficulty;
	private $completed;
	private $level;

	// Constructor

	function __construct()
	{
		// Setup Attribute Array

		$attributes[0] = 0;				// attributes[0] = # of bits earned for completing the Agenda.
		$difficulty = 0;				// difficult = # of actions/bits to complete the agenda
		$completed = 0;					// completed = Whether it has been completed or not.
		$level = 0;
	}

	//	Accessors

	function getName()
	{
		return $this->name;
	}

	function getDifficulty()
	{
		return $this->difficulty;
	}

	function isComplete()
	{
		return $this->completed;
	}

	function getAttribute($p_index)
	{
		return $this->attributes[$p_index];
	}

	function getLevel()
	{
		return $this->level;
	}

	function getIce($p_index)
	{
		return $this->ice[$p_index];
	}

	//	Mutators

	function setName($p_name)
	{
		$this->name = $p_name;
	}

	function setAttribute($p_index, $p_value)
	{
		$this->attributes[$p_index] = $p_value;
	}

	function setDifficulty($p_difficulty)
	{
		$this->difficulty = $p_difficulty;
	}

	function setCompleted($p_completed)
	{
		$this->completed = $p_completed;
	}

	function setLevel($p_level)
	{
		$this->level = $p_level;
	}

	function setIce($p_index, $p_ice)
	{
		$this->ice[$p_index] = $p_ice;
	}
}

?>