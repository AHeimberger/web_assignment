<?php
require_once "../controller/routing_table.php";

$mode = $_REQUEST['mode'];

$ojbRoutingTable = new RoutingTable();

if($mode == "load") {
	echo $ojbRoutingTable->getAll();
}

?>