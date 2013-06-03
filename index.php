<?php
//include 'haschild.php';
exit(0);

$conn = mysql_connect("localhost", "izju", "izju", TRUE);
if (mysql_errno($conn)) {
    die("Can't Connect to Mysql");
}
mysql_select_db("zjutel");
mysql_set_charset("utf8", $conn);

$file = fopen("tree.txt", "r");

$currentLevel = 0;
$currentID = 0;
$parentIDs = array();
$lastParentID = 0;
while ($row = fgets($file)) {
    $level = 0;
    while ($row[$level] == '!')     // 统计当前层级
        $level++;

    if ($currentLevel < $level) {

        $parent = $currentID;
        array_push($parentIDs, $lastParentID);
        $lastParentID = $currentID;
        
    } else if ($currentLevel == $level) {
        $parent = $lastParentID;
    } else {
        $sub = $currentLevel - $level;
        while ($sub--)
            $parent = array_pop($parentIDs);
        $lastParentID = $parent;
    }

    $currentLevel = $level;

    if ($row[$level] == '+') {      // non-leaf
        $str = substr($row, $level + 1);
        $str = trim($str);
        $SQL = "INSERT INTO Node (`pid`,`title`,`is_leaf`,`create_date`) values ($parent,'$str',false,NOW());";
        if (!mysql_query($SQL)) {
            die("Insert data Error!");
        }
        $currentID = mysql_insert_id();
    } else {                        // is leaf
        $str = substr($row, $level);
        $str = trim($str);
        list($title,$number) = split(":", $str);
        $title = trim($title);
        $number = trim($number);
        $SQL = "INSERT INTO Node (`pid`,`title`,`is_leaf`,`create_date`) values ($parent,'$title',true,NOW());";
        if (!mysql_query($SQL)) {
            die("Insert data Error!");
        }
        $currentID = mysql_insert_id();
        $nums = preg_split('/[、 ]+/', $number);
        foreach ($nums as $tel) {
            $telSQL = "INSERT INTO Number (`nid`,`number`) values ($currentID,'$tel');";
            if (!mysql_query($telSQL)) {
                echo 'Insert number Error!';
            }
        }
        
    }
}
?>
