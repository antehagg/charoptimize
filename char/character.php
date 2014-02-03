<?php

class Character
{
	private $name;
	private $classId;

	private $spells = array();

	public function __construct($name, $classId)	
	{
		$this->$name = $name;
		$this->$classId = $classId;
	}

	private function getSpellsFromDB()
	{
		
	}
}

?>