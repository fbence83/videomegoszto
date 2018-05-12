<?php
session_name("video");
include ("dao.php");

$stmt = oci_parse($conn, "Select cim from videok");
oci_execute($stmt);
$q = $_GET["q"];
$hint = "";





if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
	while (($row = oci_fetch_assoc($stmt)) != false) {
        if (stristr($q, substr($row["CIM"], 0, $len))) {
            if ($hint === "") {
                $hint = $row["CIM"];
            } else {
                $hint .=",". $row["CIM"];
            }
        }
    }
}

 
echo $hint === "" ? "Nincs találat" : $hint;
?>