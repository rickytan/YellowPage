<html>
<head>
<meta content-type="text/html, charset=utf8">
<title>路径查询</title>
</head>
<body>
<?php

$id = $_GET['id'];
if (empty($id))
	echo "Invalid ID";

$conn = mysql_connect('localhost','izju','izju',true);
if (mysql_errno($conn))
	die("Can't connect mysql");
mysql_select_db("zjutel");
mysql_set_charset("utf8",$conn);

$pathes = array();
while ($id != 0) {
	$query = "SELECT n.id,n.pid,n.title FROM Node n WHERE n.id = $id";
	$result = mysql_query($query);
	if (!$result) {
		die("Query Error!".mysql_error());
	}
	$row = mysql_fetch_row($result);	
	array_push($pathes,$row[2]);	
	$id = $row[1];
}
echo implode("=>", array_reverse($pathes));
?>
</body>
</html>
