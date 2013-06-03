<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$conn = mysql_connect('localhost','izju','izju',true);
if (mysql_errno($conn))
	die("Can't connect mysql");
mysql_select_db("zjutel");
mysql_set_charset("utf8",$conn);

$query = "SELECT pid FROM Node WHERE pid <> 0";
$result = mysql_query($query);
while ($row = mysql_fetch_row($result)) {
    $update = "UPDATE Node set has_child = true WHERE id = ".$row[0];
    if (!mysql_query($update)) {
        die("Update data Error!");
    }
}
?>
