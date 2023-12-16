<?php
require_once "../controller/routing_table.php";

$mode = $_REQUEST['mode'];

$ojbRoutingTable = new RoutingTable();

if($mode == "load") {
	$entries = $ojbRoutingTable->getAll();
	foreach ($entries as &$entry) {
		echo "<tr>
				<td scope=\"row\">" . $entry->index . "</td>
				<td>" . $entry->destination . "</td>
				<td>" . $entry->gateway . "</td>
				<td>" . $entry->flags . "</td>
				<td>" . $entry->$netif . "</td>
				<td>" . $entry->$expire . "</td>
			</tr>";
	}
}

?>