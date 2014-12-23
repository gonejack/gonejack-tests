<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/12/16
 * Time: 16:19
 */


try {
	$user     = 'root';
	$password = '';
	$dsn      = 'mysql:dbname=pdotest;host=127.0.0.1';
	$dbh      = new PDO($dsn, $user, $password);
} catch (Exception $exception) {
	die("Unable to connect: {$exception->getMessage()}");
}

try {
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$dbh->beginTransaction();
	$dbh->exec('INSERT INTO first (name) VALUES (name)');
	echo $dbh->exec('INSERT INTO first (name) VALUES ("Another Name)');
	$dbh->commit();
} catch (Exception $exception) {
	$dbh->rollBack();
	echo "Failed: {$exception->getMessage()}";
}