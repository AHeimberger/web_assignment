<?php
require_once "../controller/routing_table.php";

$mode = $_REQUEST['mode'];

$ojbRoutingTable = new RoutingTable();

if ($mode == "load") {
	$entries = $ojbRoutingTable->getAll();
	foreach ($entries as &$entry) {
		$enabled_text = ($entry->enabled == "true") ? "ON" : "OFF";
		$enabled_style = ($entry->enabled == "true") ? "btn-success" : "btn-danger";
		echo "<tr>
				<td scope=\"row\">" . $entry->index . "</td>
				<td>" . $entry->destination . "</td>
				<td>" . $entry->gateway . "</td>
				<td>" . $entry->flags . "</td>
				<td>" . $entry->$netif . "</td>
				<td>" . $entry->$expire . "</td>
				<td> <button name=\"toggle\" class=\"toggle btn " . $enabled_style . "\" data_index=\"" . $entry->index . "\">" . $enabled_text . "</button> </td>
				<td> <button name=\"delete\" class=\"delete btn btn-primary\" data_index=\"" . $entry->index . "\">Delete</button> </td>
			</tr>";
	}
}
else if ($mode=="reset"){
	$ojbRoutingTable->reset();
}
else if ($mode=="delete"){
	$index = $_REQUEST['index'];
	$ojbRoutingTable->delete($index);
}
else if ($mode=="toggle"){
	$index = $_REQUEST['index'];
	$ojbRoutingTable->toggle($index);
}

?>