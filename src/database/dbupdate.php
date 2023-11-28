<?php
require '../../vendor/autoload.php';

use Ifsnop\Mysqldump as IMysqldump;

try {
    $dump = new IMysqldump\Mysqldump('mysql:host=mysql_db;dbname=odin', 'root', 'root');
    $dump->start('dump.sql');
} catch (\Exception $e) {
    echo 'mysqldump-php error: ' . $e->getMessage();
}