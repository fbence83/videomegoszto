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
 
 
$conn = oci_connect('system', 'root', $tns,'UTF8');
?>

<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel=stylesheet type="text/css" href="mystyle2.css" />
	<title>Videomegoszto</title>
</head>
<body>
	<div class="homepage-header">
		
		<div class="logo">
		<a href ="megoszt.php" >
		<img src="kamera.jpg" style="width:40px;height:40px;"></a>
		</div>
		<div class = "navbar-right">
			
			<a href= "login.php">Login</a>
			<a href= "register.php">Join now!</a>
		</div>
	</div>
	<div class="oszlopok">
		
		<div class= "side-menubar">
				<a href="#">Valami1</a>
				<a href="#">Valami1</a>
				<a href="#">Valami1</a>
				<a href="#">Valami1</a>
		</div>
		<div class="main">
			<div class ="videonak">
				<?php
				$k = "Avicii- Wake me Up";
				$stmt = oci_parse($conn,"Select * from videok where cim = '$k'");
				oci_execute($stmt);
				
				while ($row = oci_fetch_assoc($stmt)){?>
				<div class= "video">
					<iframe width="720" height="480"
							src=<?php echo $row["LINK"]?>>
						</iframe>
				</div>
				<div class ="cim">
					<h2><?php echo $row["CIM"] ?></h2>
					<h3 id="szam"><?php echo $row["MEGTEKINTESEK_SZAMA"]?></h3>
					
				</div>
				<div class ="iconbar">
					<h3><?php echo $row["FELHASZNALONEV"]?></h3>
				<?php } ?>
					<img src="kamera.jpg" style="width:40px;height:40px;">
					<img src="kamera.jpg" style="width:40px;height:40px;">
					<img src="kamera.jpg" style="width:40px;height:40px;">
				</div>
			</div>
			<div class= "hozzaszolasok">
				<div class = "hozzaszolas">
					<p>Feltöltő</p>
					<p>Feltöltés ideje</p>
					<p>fasza</p>
				</div>
				<div class = "hozzaszolas">
					<p>Feltöltő</p>
					<p>Feltöltés ideje</p>
					<p>fasza</p>
				</div>
				<div class = "hozzaszolas">
					<p>Feltöltő</p>
					<p>Feltöltés ideje</p>
					<p>fasza</p>
				</div>
				
			
			</div>
		</div>
		<div class="feltolto">
			<h1>KAjak</h1>
		
		</div>
	</div>
</body>
</html>