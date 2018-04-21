<?php
session_name("video");
include ("dao.php");

$stmt = oci_parse($conn, "Select cim from videok");
oci_execute($stmt);
// get the q parameter from URL
$q = $_GET["q"];
$hint = "";



// lookup all hints from array if $q is different from "" 
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

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "Nincs találat" : $hint;
?>