<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/12/23
 * Time: 12:15
 */

$connection = mysqli_connect($host, $user, $password, $database);

$sql = 'SELECT * FROM TestTable WHERE 1';
$result = mysqli_query($query, $connection);

var_dump($result);