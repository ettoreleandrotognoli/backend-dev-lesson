<?php

global $db;
$db = new PDO('sqlite:'.__DIR__.'/db.sqlite3');
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);