<?php

final class RoutingEntry {
 	public int $index;
 	public string $destination;
 	public string $gateway;
 	public string $flags;
 	public string $netif;
 	public string $expire;
 
     public function __construct(int $index, string $destination, string $gateway, string $flags, string $netif, string $expire) 
     {
 		$this->index = $index;
        $this->destination = $destination;
 		$this->gateway = $gateway;
 		$this->flags = $flags;
 		$this->netif = $netif;
 		$this->expire = $expire;
     }
}

final class RoutingTable {

	private $entries;

	public function __construct(){
		$this->table = "routing_table";
		$this->entries = array();
	}

	public function reset() {
		$output = shell_exec("../service -r=true");
		echo "reset: $output";
	}
	
	public function getAll(){
		$index = 0;
		$output = shell_exec("../service");
		echo "load: $output";

		foreach(preg_split("/((\r?\n)|(\r\n?))/", $output) as $line){
			if ($index == 0) {
				$index++;
				continue;
			}

 			if ($line == "") {
 				continue;
 			}
 
			try {
				list($destination, $gateway, $flags, $netif, $expire) = explode(" ", $line, 5);
				$routing_entry = new RoutingEntry($index, $destination, $gateway, $flags, $netif, "");
				array_push($this->entries, $routing_entry);
			} catch (Exception $e) {
				echo "Failure: {$e->getMessage()}\n";
			}

			$index++;
		}

		return $this->entries;
	}

	public function delete($index){
		$output = shell_exec("../service -d $index");
		echo "delete: $output";
	}

	public function toggle($index){
		$output = shell_exec("../service -t $index");
		echo "toggle: $output";
	}
}

?>