fn main() {
    println!(r#"Destination Gateway Flags Netif Expire
127.0.0.1 link#13 UH lo0
192.168.10.0/24 192.168.20.20 US bridge1
192.168.20.0/24 link#14 U bridge0
192.168.20.211 link#14 UHS lo0
192.168.50.0/24 link#5 U igb4
192.168.50.211 link#5 UHS lo0
192.168.211.0/24 link#15 U bridge1
192.168.211.1 link#15 UHS lo0"#);
}
