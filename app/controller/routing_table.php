<?php

class RoutingTable{
	public function __construct(){
		$this->table = "routing_table";
	}
	public function getAll(){
		$index = 0;
		$table = "";
		$output = shell_exec("../service");

		foreach(preg_split("/((\r?\n)|(\r\n?))/", $output) as $line){
			if ($line == "") {
				continue;
			}

			list($destination, $gateway, $flags, $netif, $expire) = explode(" ", $line);

			if ($index == 0) {
				$index++;
				continue;
			}

			$table .= "
			<tr>
				<td scope=\"row\">" . $index . "</td>
				<td>" . $destination . "</td>
				<td>" . $gateway . "</td>
				<td>" . $flags . "</td>
				<td>" . $netif . "</td>
				<td>" . $expire . "</td>
			</tr>
			";

			$index++;
		}
		return $table;
	}
}
?>