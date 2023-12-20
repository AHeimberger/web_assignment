<?php
require_once "../controller/routing_table.php";

$mode = $_REQUEST['mode'];

$ojbRoutingTable = new RoutingTable();

if ($mode == "load") {
	$entries = $ojbRoutingTable->getAll();
	foreach ($entries as &$entry) {
		$enabled_style = ($entry->enabled == "true") ? "flexSwitchCheckChecked" : "flexSwitchCheckDefault";
		$enabled_action = ($entry->enabled == "true") ? "checked" : "";
		echo '<tr>
				<td scope="row">' . $entry->index . '</td>
				<td>' . $entry->destination . '</td>
				<td>' . $entry->gateway . '</td>
				<td>' . $entry->flags . '</td>
				<td>' . $entry->netif . '</td>
				<td>' . $entry->expire . '</td>
				<td>
					<div class="form-check form-switch"><input class="toggle form-check-input" type="checkbox" role="switch" id="' . $enabled_style . '" data_index="' . $entry->index . '" ' . $enabled_action . '></div>
					<button class="edit btn btn-secondary"><i class="bi bi-pencil"></i></button>
					<button class="save btn btn-success" style="display: none;"><i class="bi bi-save"></i></button>
					<button class="cancel btn btn-danger" style="display: none;"><i class="bi bi-x"></i></button>
					<button class="delete btn btn-danger" data_index="' . $entry->index . '"><i class="bi bi-trash"></i></button>
				</td>
			</tr>';
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