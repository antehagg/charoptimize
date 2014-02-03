<?php

class DbUpdate
{
	private $dbConnect = "'localhost', 'root', 'ch3f3n'";
	private $mysqli;
	private $spellIdList = array();

	public function __construct()
	{
		$this->mysqli = new mysqli("localhost", "root", "ch3f3n");
		$this->getSpellIdList();
		$this->parseHtml();
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

	private function parseHtml()
	{
		foreach($this->spellIdList as $spellId)
		{
			$html = file_get_html("http://www.wowhead.com/spell=$spellId");

			var_dump($html);
		}
	}
}

?>