# Web Assignment

![application](docs/application.png)

- install rust : https://rustup.rs/
- build rust service: `pushd service && cargo build && popd`
- get sources like bootstrap and jquery: `./scripts/get_files.sh`
- install php: `apt-get install php`
- start php server: `./scripts/start_server.sh`

## Architecture

![architecture](docs/architecture.drawio.png)

- `index.php` - starting point for the application
- `js/app.js` - jquery async get/post request listening to button clicks
- `rest/routing_table.php` - rest_api to start operations
- `controller/routing_table.php` - implementation to call linux service 
- `service` - implementation of a service which provides the routing_table entries
- `table.entries` - storage to store entries

## Resources

- https://github.com/heryvandoro/simple-crud-php-oop-jquery-ajax
- https://www.php.net/docs.php
- https://api.jquery.com/
- https://api.jquery.com/jQuery.ajax/
- https://icons.getbootstrap.com/
