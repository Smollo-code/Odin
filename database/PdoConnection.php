<?php

class PdoConnection implements PdoConnectionInterface
{
    public function pdo() {
        return new PDO('mysql:host=mysql_db;dbname=odin', 'root', 'root');
    }
}