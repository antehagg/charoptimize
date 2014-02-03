<?php

include_once "spell.php";

class DhHeal extends Spell
{
	private $minHeal;
	private $maxHeal;

	public function __construct($id)
	{
		parent::__construct($id);
	}
}

?>