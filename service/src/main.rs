extern crate clap;

use clap::Parser;
use std::{fs::{File, self}, io::Write, thread, time::Duration};

/// Simple program to greet a person
#[derive(clap::Parser, Debug)]
#[command(author, version, about, long_about = None)]
struct Arguments {
    /// Show routing table
    #[arg(short = 'x', long)]
    routing_table: bool,
    /// Delete routing table entry
    #[arg(short, long)]
    delete_index: Option<usize>,
    /// Enable/Disable entry
    #[arg(short, long)]
    toggle_index: Option<usize>,
    /// Reset to default settings
    #[arg(short, long)]
    reset: Option<bool>,
}

#[derive(Default, Debug)]
struct TableEntry {
    destination: String,
    gateway: String,
    flags: String,
    netif: String,
    expire: String,
    enabled: String,
}

#[derive(Default, Debug)]
struct RoutingTable {
    entries: Vec<TableEntry>,
}

impl RoutingTable {
    pub fn new() -> Self {
        let content = fs::read_to_string("./table.entries");
        match content {
            Ok(_) => {
                let buffer = content.unwrap_or("".to_string());
                Self { entries: RoutingTable::init(&buffer) }
            }
            Err(_) => {
                let buffer = include_str!("../table.default");
                Self { entries: RoutingTable::init(&buffer) }
            }
        }
        
    }

    pub fn print(&self) {
        thread::sleep(Duration::from_millis(3000));
        for entry in &self.entries {
            println!(
                "{} {} {} {} {} {}",
                entry.destination,
                entry.gateway,
                entry.flags,
                entry.netif,
                entry.expire,
                entry.enabled
            );
        }
    }

    pub fn remove_index(&mut self, index: usize) {
        thread::sleep(Duration::from_millis(3000));
        self.entries.remove(index);
    }

    pub fn toggle_index(&mut self, index: usize) {
        thread::sleep(Duration::from_millis(3000));
        if let Some(element) = self.entries.get_mut(index) {
            if element.enabled == "true" {
                element.enabled = "false".to_string();
            }
            else if element.enabled == "false" {
                element.enabled = "true".to_string();
            }
        }
    }

    pub fn save(&self) {
        let mut file = File::create("./table.entries").unwrap();
        let mut content: String = "".to_string();
        for (index, entry) in self.entries.iter().enumerate() {
            if index != 0 {
                content.push('\n');
            }

            content.push_str(
                &format!(
                    "{} {} {} {} {} {}",
                    entry.destination,
                    entry.gateway,
                    entry.flags,
                    entry.netif,
                    entry.expire,
                    entry.enabled
                )
                .to_string(),
            );
        }
        file.write_all(content.as_bytes()).unwrap();
    }

    pub fn reset(&mut self) {
        let _ = &self.entries.clear();
        let buffer = include_str!("../table.default");
        self.entries = RoutingTable::init(&buffer);
    }

    fn init(buffer: &str) -> Vec<TableEntry> {
        let mut new_entries = Vec::new();
        let lines: Vec<&str> = buffer.split('\n').collect();
        for line in lines {
            let entries: Vec<&str> = line.split_whitespace().collect();
            new_entries.push(TableEntry {
                destination: entries.first().unwrap_or(&"..").to_string(),
                gateway: entries.get(1).unwrap_or(&"..").to_string(),
                flags: entries.get(2).unwrap_or(&"..").to_string(),
                netif: entries.get(3).unwrap_or(&"..").to_string(),
                expire: entries.get(4).unwrap_or(&"..").to_string(),
                enabled: entries.get(5).unwrap_or(&"true").to_string(),
            })
        }
        
        new_entries
    }
}

fn main() {
    let args = Arguments::parse();
    let mut routing_table = RoutingTable::new();

    if args.routing_table {
        routing_table.print();
    } else if args.delete_index.is_some() {
        routing_table.remove_index(args.delete_index.unwrap());
        routing_table.save();
    } else if args.toggle_index.is_some() {
        routing_table.toggle_index(args.toggle_index.unwrap());
        routing_table.save();
    } else if args.reset.is_some() {
        routing_table.reset();
        routing_table.save();
    } else {
        routing_table.print();
    }
}
