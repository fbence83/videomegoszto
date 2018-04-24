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

//$username = 'system';
$username = 'Gac_Pet';

//$password = 'root';
$password = '5bsxou30v7s';

$conn = oci_connect($username, $password, $tns, 'UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message']), E_USER_ERROR);
}
?>