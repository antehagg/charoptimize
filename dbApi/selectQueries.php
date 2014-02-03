<?php

#include "dbConnect.php";
include "../spells/dhHeal.php";

class SelectQueries
{
	private $dbConnect = "'localhost', 'root', 'ch3f3n'";
	private $mysqli;

	public function __construct()
	{
		$this->mysqli = new mysqli("localhost", "root", "ch3f3n");
	}	

	public function showDatabases()
	{
		$mysqli = new mysqli("localhost", "root", "ch3f3n");
		$sql = "SELECT * FROM charOptimizer.dhSpell WHERE classId = 5";

		if ($mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $mysqli->connect_error);
		    exit();
		}

		if ($result = $mysqli->query($sql))
		{ 
	        while($obj = $result->fetch_object())
	        { 
				var_dump($obj);
	        } 
	    }
    } 

	public function getDirectHeal($classId)
	{
		$sql = "SELECT * FROM charOptimizer.dhSpell WHERE classId = $classId";
		$returnArray = array();

		if ($this->mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $mysqli->connect_error);
		    exit();
		}

		if ($result = $this->mysqli->query($sql))
		{ 
	        while($obj = $result->fetch_object('DhHeal'))
	        { 
				array_push($returnArray, $obj);
	        } 
	    }
	    return $returnArray;
	}
}


?>