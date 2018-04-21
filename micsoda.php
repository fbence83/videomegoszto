<?php
 $tns = "
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SID = xe)
    )
  )";
 
 
$conn = oci_connect('Gac_Pet', '5bsxou30v7s', $tns,'UTF8');


$stmt1=oci_parse($conn, "Select link from videok where felhasznalonev == :feltolto");
$feltolto=$_REQUEST["q"];
oci_bind_by_name($stmt1, ":feltolto", $feltolto);
oci_execute($stmt1);
	

?>