<html>
<head>
</head>
<body>
<?php

header("Content-Type: application/json; charset=UTF-8");

$q = json_decode($_POST['x'], false);
echo "<h1>" .$q. "</h1>";

?>
</body>
</html>