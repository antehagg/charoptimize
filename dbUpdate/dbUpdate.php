<?php
include "../wowarmoryapi/jsonConnect.class.php";

class DbUpdate
{
	private $dbConnect = "'localhost', 'root', 'ch3f3n'";
	private $mysqli;
	private $directHealSpellIdList = array();
	private $jsonConnect;

	public function __construct()
	{
		$this->mysqli = new mysqli("localhost", "root", "ch3f3n");
		$this->jsonConnect = new jsonConnect();
		$this->updateDirectHeals();
	}	

	public function updateClasses()
	{
		$classes = $this->jsonConnect->getClasses("eu");

		foreach($classes as $classArray)
		{
			foreach($classArray as $class)
			{
				$sqlClassUpdate = "UPDATE charOptimize.classes SET name = '". $class['name'] . "', mask = " . $class['mask'] . ", powerType = '" . $class['powerType'] . "' WHERE id = " . $class['id'];

				if ($this->mysqli->connect_errno)
				{
		    		printf("Connect failed: %s\n", $mysqli->connect_error);
		    		exit();
				}

				mysqli_query($this->mysqli, $sqlClassUpdate);
			}
		}
	}

	public function updateDirectHeals()
	{
		$this->getDirectHealSpellId();

		foreach($this->directHealSpellIdList as $healId)
		{
			$apiResult = $this->getSpellFromApi($healId);

			$powerExplodeResult = explode("%", $apiResult['powerCost']);
			$powerCost = $powerExplodeResult[0];

			if($apiResult['castTime'] == "Instant")
				$castTime = 0;
			else
			{
				$castTimeExplodeResult = explode(" ", $apiResult['castTime']);
				$castTime = $castTimeExplodeResult[0];
			}

			$sqlUpdateDhSpells = "UPDATE charOptimize.dhSpell SET name = '" . $apiResult['name'] . "', cost = $powerCost, castTime = $castTime WHERE id = $healId";

			mysqli_query($this->mysqli, $sqlUpdateDhSpells);
		}
	}

	private function getDirectHealSpellId()
	{
		$sql = "SELECT `id` from charOptimize.dhSpell";				

		if ($mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $this->mysqli->connect_error);
		    exit();
		}

		if ($result =mysqli_query($this->mysqli, $sql))
		{ 
	        while($row = $result->fetch_array(MYSQLI_ASSOC))
	        { 
				array_push($this->directHealSpellIdList, $row['id']);
	        } 
	    }
	}

	private function getSpellFromApi($id)
	{			
		$apiResult = file_get_contents('http://eu.battle.net/api/wow/spell/'. $id);
		$decodedApiResult = json_decode($apiResult, true);
		var_dump($decodedApiResult);
		return $decodedApiResult;
	}
}

?>