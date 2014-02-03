<?php

class Spell
{
	protected $id;
	private $name;
	private $cost;
	private $castTime;
	private $classId;
	private $gcd;
	private $gcdCategory;
	private $spMultiplier;
	private $cd;
	private $target;
	private $school;


	public function __construct($id)
	{
		$this->id = $id;
		echo "constructing " . __CLASS__ . " with id of $id\n";
	}
}

?>