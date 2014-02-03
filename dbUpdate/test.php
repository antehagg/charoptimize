<?php

include "dbUpdate.php";

//$dbUpdate = new DbUpdate();

$data = file_get_contents('http://www.wowhead.com/spell=34861/circle-of-healing');

$dom = new domDocument;

@$dom->loadHTML($data);
$dom->preserveWhiteSpace = false;
$tables = $dom->getElementsByTagName('table');

$rows = $tables->item(2)->getElementsByTagName('tr'); 

  // loop over the table rows
  foreach ($rows as $row) 
  { 
  	var_dump($row);
   // get each column by tag name
      $cols = $row->getElementsByTagName('td'); 
   // echo the values  
      foreach($cols as $col)
      	var_dump($col);

  } 

?>