<?php

class Spell
{
	protected $id;
	private $name;
	private $cost;
	private $castTime;
	private $classId;
	private $gcd;
	private $spMultiplier;
	private $cd;
	private $targets;

	public function __construct($id)
	{
		$this->id = $id;
		echo "constructing " . __CLASS__ . " with id of $id\n";
	}
}

?>