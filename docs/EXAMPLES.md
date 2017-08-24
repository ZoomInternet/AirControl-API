### Basic example usage

Basic synchronize your database with aircontrol 
```php
<?php

require __DIR__ . '/../vendor/autoload.php';

use AirControl\Api\Client;

$client = new Client('192.168.1.2', 'ubnt', 'ubnt');
try {
    $db = new PDO('mysql:dbname=db_name;host=192.168.1.3', 'user', 'password');	
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

foreach($db->query("SELECT ip_address FROM devices")->fetchAll() as $device) {
    $client->addDevice(long2ip($device['ip_address']), 'ubnt', 'ubnt', 22);
}
```
