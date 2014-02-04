<?php

class DbUpdate
{
	private $dbConnect = "'localhost', 'root', 'ch3f3n'";
	private $mysqli;
	private $spellIdList = array();

	public function __construct()
	{
		$this->mysqli = new mysqli("localhost", "root", "ch3f3n");
		//$this->getSpellIdList();
		$this->getSpellsFromApi();
	}	

	private function getSpellIdList()
	{
		$sql = "(SELECT id from charOptimizer.dhSpell)
				UNION
				(SELECT id from charOptimizer.hotSpell)";

		if ($mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $this->mysqli->connect_error);
		    exit();
		}

		if ($result = $this->mysqli->query($sql))
		{ 
	        while($row = $result->fetch_array(MYSQLI_ASSOC))
	        { 
				array_push($this->spellIdList, $row['id']);
	        } 
	    }
	}

	public function getSpellsFromApi()
	{
			//$jsonResponse = new HttpRequest("http://eu.battle.net/api/wow/spell/34861", HttpRequest::METH_GET);

			
			$result = file_get_contents('http://eu.battle.net/api/data/character/classes');

			var_dump(json_decode($result));
	}
}

?>